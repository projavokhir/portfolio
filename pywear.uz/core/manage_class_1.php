<?php
require_once "db_class.php";
require_once "email_class.php";
require_once "../load.php";

class Manage{

private $db;
private $mail;
private $products;

protected $data;
public function __construct(){
	ob_start();
	session_start();
	$this->db = DB::getInstance();
	$this->products = Products::getInstance($this->db);
}

public function addProduct(){

$pr_name = htmlspecialchars(trim($_POST["pr_name"]));
$pr_main_img = htmlspecialchars(trim($_POST["pr_main_img"]));
$pr_img_1 = htmlspecialchars(trim($_POST["pr_img_1"]));
$pr_img_2 = htmlspecialchars(trim($_POST["pr_img_2"]));
$category = htmlspecialchars(trim($_POST["category"]));
$price = htmlspecialchars(trim($_POST["price"]));
$factor_main = htmlspecialchars(trim($_POST["factor_main"]));
$factor_main_select = htmlspecialchars(trim($_POST["factor_main-select"]));
$description = trim($_POST["full_text"]);
$images = "";
if($pr_img_1 != "" && $pr_img_2 == "") $images = $pr_main_img.",".$pr_img_1;
else if($pr_img_1 == "" && $pr_img_2 != "") $images = $pr_main_img.",".$pr_img_2;
else if($pr_img_1 == "" && $pr_img_2 == "") $images = $pr_main_img;
else $images = $pr_main_img.",".$pr_img_1.",".$pr_img_2;

	if($pr_name != "" && $pr_main_img != "" && $category != "" && $factor_main != "" && $factor_main_select != "" && $description != "" && $price != ""){
		$a = $this->products->getProduct($this->toLatin($pr_name));
		$i = 0;
		$factor = [];
		$factor_select = [];
		$factors_json = "{ ";

		foreach($_POST as $key => $value){
			if(preg_match("/factor-/", $key)){
				$factor[$i] = $key;
				$i++;
			}
		}

		$k = 0;
		foreach($_POST as $key => $value){
			if(preg_match("/factor_select/", $key)){
				$factor_select[$k] = $key;
				$k++;
			}
		}

		$factors_json .= '"'.$_POST["factor_main-select"].'": "'.$_POST["factor_main"].'", ';

		for($j = 0; $j < $k; $j++){
			if(($_POST[$factor_select[$j]] == "" || $_POST[$factor[$j]] == "")) break;
			$factors_json .= '"'.$_POST[$factor_select[$j]].'": "'.$_POST[$factor[$j]].'", ';

		}
			$factors_json = substr($factors_json, 0, -2);
			$factors_json .= " }";
			if(strlen($factors_json) < 4) $factors_json = "";

		if(!$a) {
				$arr = array("name" => $pr_name, "category" => $category, "category_alias" => $this->toLatin($category), "description" => $description, "alias" => $this->toLatin($pr_name), "factors" => $factors_json, "price" => $price, "images" => $images, "time" => time());
				$this->products->add($arr);
				return $this->redirect("admin/", "Продукт успешно добавлен");
		} else{
				$r = ceil(rand(0, 100));
				$alias = $this->toLatin($pr_name)."-".$r;
				$arr = array("name" => $pr_name, "category" => $category, "category_alias" => $this->toLatin($category), "description" => $description, "alias" => $alias, "factors" => $factors_json, "price" => $price, "images" => $images, "time" => time());
				$this->products->add($arr);
				return $this->redirect("admin/", "Продукт успешно добавлен");
		}
	}
return $this->redirect("admin/", "Произошла ошибка при добавлении продукта");
}

public function addGItem(){
	$h = htmlspecialchars($_POST["header"]);
	$desc = htmlspecialchars($_POST["desc"]);
	$img = htmlspecialchars($_POST["img"]);
	$this->products->addGItem(["name" => $h, "description" => $desc, "image" => $img]);
	return $this->redirect("admin/gallery/", "Изображение успешно добавлено");
}

public function editGItem(){
	$h = htmlspecialchars($_POST["header"]);
	$id = htmlspecialchars($_POST["id"]);
	$d = htmlspecialchars($_POST["desc"]);
	$i = htmlspecialchars($_POST["img"]);
	$a = ["name" => $h, "description" => $d, "image" => $i];
	$this->products->editGItem($a, $id);
	return $this->redirect("admin/g_edit/".base64_encode($id), "Изменение прошло успешно");
}

public function EditProductsData(){
	$h = htmlspecialchars($_POST["header"]);
	$d = htmlspecialchars($_POST["desc"]);
	$this->setIni("../".MAIN_DIR."cont/contents.ini", "products", "h", $h);
	$this->setIni("../".MAIN_DIR."cont/contents.ini", "products", "desc", $d);
	return $this->redirect("admin/edit_block/products", "Изменение прошло успешно");
}

public function EditBlock1(){
	$h = htmlspecialchars($_POST["header"]);
	$d = htmlspecialchars($_POST["desc"]);
	$img = htmlspecialchars($_POST["img"]);
	$this->setIni("../".MAIN_DIR."cont/contents.ini", "block_1", "h", $h);
	$this->setIni("../".MAIN_DIR."cont/contents.ini", "block_1", "desc", $d);
	$this->setIni("../".MAIN_DIR."cont/contents.ini", "block_1", "img", $img);
	return $this->redirect("admin/edit_block/block_1", "Изменение прошло успешно");
}

public function EditBlock2(){
	$h = htmlspecialchars($_POST["header"]);
	$d = htmlspecialchars($_POST["desc"]);
	$img = htmlspecialchars($_POST["img"]);
	$this->setIni("../".MAIN_DIR."cont/contents.ini", "block_2", "h", $h);
	$this->setIni("../".MAIN_DIR."cont/contents.ini", "block_2", "desc", $d);
	$this->setIni("../".MAIN_DIR."cont/contents.ini", "block_2", "img", $img);
	return $this->redirect("admin/edit_block/block_2", "Изменение прошло успешно");
}

public function editProduct(){

$pr_name = htmlspecialchars(trim($_POST["pr_name"]));
$pr_main_img = htmlspecialchars(trim($_POST["pr_main_img"]));
$pr_img_1 = htmlspecialchars(trim($_POST["pr_img_1"]));
$pr_img_2 = htmlspecialchars(trim($_POST["pr_img_2"]));
$category = htmlspecialchars(trim($_POST["category"]));
$price = htmlspecialchars(trim($_POST["price"]));
$factor_main = htmlspecialchars(trim($_POST["factor_main"]));
$factor_main_select = htmlspecialchars(trim($_POST["factor_main-select"]));
$description = trim($_POST["full_text"]);
$where = htmlspecialchars($_POST["alias"]);

if(empty($where)) return $this->redirect("admin/", "Произошла ошибка при обновлении продукта");

$images = "";
if($pr_img_1 != "" && $pr_img_2 == "") $images = $pr_main_img.",".$pr_img_1;
else if($pr_img_1 == "" && $pr_img_2 != "") $images = $pr_main_img.",".$pr_img_2;
else if($pr_img_1 == "" && $pr_img_2 == "") $images = $pr_main_img;
else $images = $pr_main_img.",".$pr_img_1.",".$pr_img_2;

	if($pr_name != "" && $pr_main_img != "" && $category != "" && $factor_main != "" && $factor_main_select != "" && $description != "" && $price != ""){
		echo $where;
		$a = $this->products->getProduct($where);
		$i = 0;
		$factor = [];
		$factor_select = [];
		$factors_json = "{ ";
		foreach($_POST as $key => $value){
			if(preg_match("/factor-/", $key)){
				$factor[$i] = $key;
				$i++;
			}
		}

		$k = 0;
		foreach($_POST as $key => $value){
			if(preg_match("/factor_select/", $key)){
				$factor_select[$k] = $key;
				$k++;
			}
		}

		$factors_json .= '"'.$_POST["factor_main-select"].'": "'.$_POST["factor_main"].'", ';

		for($j = 0; $j < $k; $j++){
			if(($_POST[$factor_select[$j]] == "" || $_POST[$factor[$j]] == "")) break;
			$factors_json .= '"'.$_POST[$factor_select[$j]].'": "'.$_POST[$factor[$j]].'", ';

		}
			$factors_json = substr($factors_json, 0, -2);
			$factors_json .= " }";
			if(strlen($factors_json) < 4) $factors_json = "";

		if(!$a) {
				//return $this->redirect("admin/", "Произошла внутренняя ошибка");
		} else{
				$r = ceil(rand(0, 100));
				$alias = $this->toLatin($pr_name)."-".$r;
				$arr = array("name" => $pr_name, "category" => $category, "category_alias" => $this->toLatin($category), "description" => $description, "alias" => $alias, "factors" => $factors_json, "price" => $price, "images" => $images, "time" => time());
				if($this->products->editProduct($arr, $where)){
					return $this->redirect("admin/", "Продукт успешно обновлен!");
				} else {
					 return $this->redirect("admin/", "Произошла ошибка при обновлении продукта");
				}
		}
	}
return $this->redirect("admin/", "Произошла ошибка при обновлении продукта");
}

public function deleteProduct(){

if(isset($_POST["alias"])){
	$alias = trim(htmlspecialchars($_POST["alias"]));
	$q = $this->products->DeletePost($alias);
	if($q) echo "OK";
	else echo "Error";
}
return;
}

public function setIni($config_file, $section, $key, $value){
 $config_data = parse_ini_file($config_file, true);
 $config_data[$section][$key] = $value;
 $new_content = '';
 foreach ($config_data as $section => $section_content) {
  $section_content = array_map(function($value, $key) {
      return "$key=$value";
  }, array_values($section_content), array_keys($section_content));
  $section_content = implode("\n", $section_content);
  $new_content .= "[$section]\n$section_content\n";
 }
file_put_contents($config_file, $new_content);
}

public function deleteGItem(){

if(isset($_POST["id"])){
	$id = trim(htmlspecialchars($_POST["id"]));
	$q = $this->products->DeleteGItem($id);
}
return;
}

private function redirect($redirect_link, $message){
	header("Location: ".SITE_ADDRESS.$redirect_link);
	$_SESSION["message"] = $message;
	exit;
}

private function redirect_single($return_link){
	header("Location: ".SITE_ADDRESS.$return_link);
	exit;
}

protected function toLatin($text){
	$text = mb_strtolower($text);
//Filter for uncaught symbols
	$filter = "~[\№\~\`\!\@\#\$\%\^\&\*\(\)\-\_\=\+\\\|\[\]\;\:\'\"\,\.\<\>\?\/\«\»]~u";
	$f = (mb_strlen(preg_filter($filter, " ", $text)) != 0) ? preg_filter($filter, " ", $text) : $text;
	$f = trim($f, " ");
	$arr = explode(" ", $f);
for($i = 0; $i < count($arr); $i++){
	if($arr[$i] == "" || $arr[$i] == " "){
		unset($arr[$i]);
		$arr = array_values($arr);
		$i = 0;
	}
}
$dict = parse_ini_file("ini_files/dict.ini", true);
$tr = str_replace($dict["RUSSIAN"], $dict["ENGLISH"], $arr);
$tr_text = implode("-", $tr);
return $tr_text;
}


}

?>