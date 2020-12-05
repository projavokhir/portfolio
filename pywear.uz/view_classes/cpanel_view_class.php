<?php

class CPanel_view extends View{

protected $key;
private $params;
private $title;
private $category_name = "Панель управления";

public function __construct($params){
	parent::__construct();
	$this->params = $params;
	$this->key = array_shift($params);
}

public function ManagaControlPanel(){
$con = "";
$this->title = "Панель управления";

if(!isset($_SESSION["user"]) && !isset($_SESSION["password"])){

	if(count($this->params) == 0) $con = $this->LoginPage();
	else{
		switch($this->key){
			case "register": $con = $this->RegisterPage();
			break;
			case "remind": $con = $this->RemindPass();
			break;
			case "chpass": $con = $this->ChangePass();
			break;
			default: $this->notFound();
		}
	}
}

else{

if(!$this->key) $con = $this->CPanel();
else
switch($this->key){
	case "add-post": $con = $this->CPanel();
	break;
	case "posts": $con = $this->getAllPosts();
	break;
	case "edit": $con = $this->editPost();
	break;
	case "blocks": $con = $this->Blocks();
	break;
	case "edit_block": $con = $this->BlockEditor();
	break;
	case "logout": $con = $this->Logout();
	break;
	default: $con = $this->notFound();
}
}
$this->RenderCpanel($this->title, $con);
return;
}

private function RegisterPage(){
$sr["message"] = (isset($_SESSION["reg_message"])) ? $_SESSION["reg_message"] : "";
unset($_SESSION["reg_message"]);
require_once "scripts/register.php";
return $this->getReplacedContent($sr, "admin_register");
}

private function RemindPass(){
if(!isset($_SESSION["secure_code"])){
$sr["message"] = (isset($_SESSION["rem_message"])) ? $_SESSION["rem_message"] : "";
unset($_SESSION["rem_message"]);
require_once "scripts/remind.php";
return $this->getReplacedContent($sr, "admin_remind");
} else if(isset($_SESSION["secure_code"]) && $_SESSION["secure_code"] === USER_HASH){
	header("Location: /admin/chpass/");
	exit;
}
}

private function ChangePass(){
if(isset($_SESSION["secure_code"]) && $_SESSION["secure_code"] === USER_HASH){
$sr["message"] = (isset($_SESSION["rem_message"])) ? $_SESSION["rem_message"] : "";
unset($_SESSION["rem_message"]);
require_once "scripts/chpass.php";
return $this->getContent("admin_chpass");
} else{
	header("Location: /admin/remind");
	exit;
}
}

private function LoginPage(){ 
$sr["message"] = (isset($_SESSION["login_message"])) ? $_SESSION["login_message"] : "";
unset($_SESSION["login_message"]);
require_once "scripts/login.php";
return $this->getReplacedContent($sr, "admin_login");
}

private function Logout(){
	if(isset($_SESSION["user"])){
		unset($_SESSION["user"]);
		unset($_SESSION["username"]);
		unset($_SESSION["password"]);
		header("Location: /admin");
		exit;
	} else{
		header("Location: /admin");
		exit;
	}
}

private function CPanel(){
$page = "";
$sr["page_head"] = "Добавить продукт";
$sr["message"] = (isset($_SESSION["message"])) ? $_SESSION["message"] : "";
unset($_SESSION["message"]);
$sr["page_head"] = "Добавить продукт";
$sr["pr_name"] = "";
$sr["img_c_main"] = "";
$sr["img_c_1"] = "";
$sr["img_c_2"] = "";
$sr["description"] = "";
$sr["submit_name"] = "add_product";
$sr["categories"] = $this->getCats();
$sr["price"] = "";
$sr["factors"] = $this->getAllFactors();
$page = $this->getReplacedContent($sr, "admin_main");
$sr["container"] = $page;
return $this->getReplacedContent($sr, "admin_main_container");
}

private function getAllPosts(){
	$posts = $this->products->getAllSortByDate();
	if(count($posts) !== 0){
	$posts_tmpl = "";
	for($i = 0; $i < count($posts); $i++){
		$pos["title"] = $posts[$i]["name"];
		$pos["alias"] = $posts[$i]["alias"];
		$posts_tmpl .= $this->getReplacedContent($pos, "admin_posts_inner");
	}
	$sr["posts"] = $posts_tmpl;
	return $this->getReplacedContent($sr, "admin_posts");
	} else{
		return $this->getContent("no_product");
	}
}

private function editPost(){
	if(!isset($this->params[1])) return $this->notFound();
	else {
		$product = $this->products->getProduct($this->params[1]);
		if(!$product || $product == false) return $this->notFound();
		$message = (isset($_SESSION["message"])) ? $_SESSION["message"] : "";
		$images = explode(",", $product["images"]);
		$sr["alias"] = $product["alias"];
		$sr["page_head"] = "Изменить продукт";
		$sr["message"] = $message;
		$sr["pr_name"] = $product["name"];
		$sr["img_c_main"] = $images[0];
		$sr["img_c_1"] = (isset($images[1])) ? $images[1] : "";
		$sr["img_c_2"] = (isset($images[2])) ? $images[2] : "";
		$sr["description"] = $product["description"];
		$sr["categories"] = $this->getCats($product["category"]);
		$sr["price"] = $product["price"];
		$sr["submit_name"] = "edit_product";
		$factors = json_decode($product["factors"]);
		$i = 1;
		foreach((array)$factors as $key => $value){
			if($i == 1)	$sr["factors"] = $this->getAllFactors($key);
			$i++;
		}
		return $this->getReplacedContent($sr, "admin_main");
	}
}

private function Blocks(){
	$s["message"] = isset($_SESSION["message"]) ? $_SESSION["message"] : '';
	unset($_SESSION["message"]);
	if(count($this->params) === 1){
		$s["page_head"] = "Галерея ( Добавить / Изменить )";
		$s["id"] = "";
		$s["header"] = "";
		$s["desc"] = "";
		$s["img"] = "";
		$s["img"] = "/".MAIN_DIR."admin/img/photo_bg.png";
		$s["submit_name"] = "add_g_item";
	} else $this->notFound();
		return $this->getReplacedContent($s, "admin_gallery");
}

private function BlockEditor(){
	$i = $this->getSection($this->params[1]);
	if(!$i){
		header("Location: /admin/blocks");
		exit;
	}
	if($this->params[1] != "products"){
		$sr["page_head"] = "Изменить блок";
		$sr["message"] = isset($_SESSION["message"]) ? $_SESSION["message"] : "";
		unset($_SESSION["message"]);
		$sr["header"] = $i["h"];
		$sr["desc"] = $i["desc"];
		$sr["img"] = $i["img"];
		$sr["b_name"] = $this->params[1];
		return $this->getReplacedContent($sr, "admin_gallery_editor");
	}
	else if($this->params[1] == "products"){
		$sr["page_head"] = "Изменить блок";
		$sr["message"] = isset($_SESSION["message"]) ? $_SESSION["message"] : "";
		unset($_SESSION["message"]);
		$sr["header"] = $i["h"];
		$sr["desc"] = $i["desc"];
		return $this->getReplacedContent($sr, "admin_gallery_editor_1");
	}
}

private function getCats($cat = ""){
	$c = $this->products->getCategories();
	$temp = "";
	if($c)
		for($i = 0; $i < count($c); $i++){
			if(trim($c[$i]["title"]) == $cat) $sr["selected"] = "selected";
			else $sr["selected"] = "";
			$sr["val"] = trim($c[$i]["title"]);
			$sr["name"] = trim($c[$i]["title"]);
			$temp .= $this->getReplacedContent($sr, "admin_option_select");
		}
return $temp;
}

private function getAllFactors($factor = ""){
	$f = parse_ini_file("view/factors.ini");
	$t = "";	
	for($i = 0; $i < count($f); $i++){
		$sr["val"] = $f[$i];
		$sr["name"] = $f[$i];
		$t .= $this->getReplacedContent($sr, "admin_option_select");
	}
	return $t;
}

}

?>