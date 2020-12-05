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
	case "slider": $con = $this->editSlider();
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
$sr["page_head"] = "Добавить пост";
$sr["message"] = (isset($_SESSION["message"])) ? $_SESSION["message"] : "";
unset($_SESSION["message"]);

$sr["title"] = "";
$sr["img_c"] = "";
$sr["desc"] = "";
$sr["keywords"] = "";
$sr["full_text"] = "";
$sr["submit_name"] = "add_post";
$sr["option"] = $this->getCats();

$page = $this->getReplacedContent($sr, "admin_main");


$sr["container"] = $page;
return $this->getReplacedContent($sr, "admin_main_container");
}

private function editSlider(){
	$url = file_get_contents("./core/ini_files/slider.txt");
	$sl["img_src"] = trim(htmlspecialchars($url), "/");
	$sr["container"] = $this->getReplacedContent($sl, "admin_slider_edit");
	return $this->getReplacedContent($sr, "admin_main_container");
}

private function getAllPosts(){
	$posts = $this->article->getAllSortByDate();
	if(count($posts) !== 0){
	$posts_tmpl = "";
	for($i = 0; $i < count($posts); $i++){
		$pos["title"] = $posts[$i]["title"];
		$pos["alias"] = $posts[$i]["alias"];
		$posts_tmpl .= $this->getReplacedContent($pos, "admin_posts_inner");
	}

	$sr["posts"] = $posts_tmpl;
	return $this->getReplacedContent($sr, "admin_posts");
	} else{
		return $this->getContent("no_article");
	}
}

private function editPost(){
if(!isset($this->params[1])) return $this->notFound();
else {
	$post = $this->article->getArticle($this->params[1]);
	if(!$post || $post == false) return $this->notFound();

	$message = (isset($_SESSION["message"])) ? $_SESSION["message"] : "";
	$sr["message"] = $message;
	$sr["alias"] = $post["alias"];
	$sr["page_head"] = "Изменить пост";
	$sr["title"] = $post["title"];
	$sr["img_c"] = $post["cover_link"];
	$sr["page_head"] = "Изменить пост";
	$sr["desc"] = $post["description"];
	$sr["keywords"] = $post["keywords"];
	$sr["option"] = $this->getCats($post["category"]);
	$sr["full_text"] = $post["full_text"];
	$sr["submit_name"] = "edit_post";

	return $this->getReplacedContent($sr, "admin_main");
}


}

private function getCats($cat = ""){
	$c = $this->article->getCategories();
	$temp = "";
	if($c)
		for($i = 0; $i < count($c); $i++){
		$sr["selected"] = ($c[$i]["namecat"] === $cat) ? "selected" : "";
		$sr["val"] = $c[$i]["namecat"];
		$sr["name"] = $c[$i]["namecat"];
		$temp .= $this->getReplacedContent($sr, "admin_option_select");
		}
return $temp;
}

}

?>