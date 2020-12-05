<?php
require_once "db_class.php";
require_once "email_class.php";
require_once "../load.php";

class Manage{

private $db;
private $mail;
private $controller;

protected $data;
public function __construct(){
	ob_start();
	session_start();
	$this->db = DB::getInstance();
	$this->controller = DBController::getInstance($this->db);
}

public function addService(){
	$name = stripslashes(htmlspecialchars($_POST['service-name']));
	$cat = stripslashes(htmlspecialchars($_POST['service-cat']));
	$desc = $_POST['service-desc'];
	$this->controller->add("services", array("category" => $cat, "name" => $name, "description" => $desc));
	header("Location: /admin/services");
	exit;
}

public function addPort(){
	$img = stripslashes(htmlspecialchars($_POST['port-img']));
	$url = stripslashes(htmlspecialchars($_POST['port-url']));
	$this->controller->add("portfolio", array("logo_url" => $img, "project_link" => $url));
	header("Location: /admin/port");
	exit;
}

public function addBlock(){
	$h = stripslashes(htmlspecialchars($_POST['header']));
	$s_header = stripslashes(htmlspecialchars($_POST['s-header']));
	$full_text = $_POST['desc'];

	$this->controller->add('about_sections', array('header' => $h, 'description' => $s_header, 'full_text' => $full_text));
	header("Location: /admin/about");
	exit;
}

public function addVacancy(){
	$vname = htmlspecialchars($_POST['vname']);
	$duties = $_POST['duties'];
	$reqs = $_POST['requirements'];
	$conds = $_POST['conditions'];
	$this->controller->add("vacs", array("category" => $vname, "duties" => $duties, "requirements" => $reqs, "conditions" => $conds));
	header("Location: /admin/about");
	exit;
}

public function editVacancy(){
	$vname = htmlspecialchars($_POST['vname']);
	$duties = $_POST['duties'];
	$reqs = $_POST['requirements'];
	$conds = $_POST['conditions'];
	$id = htmlspecialchars($_POST['id']);
	$arr = array("category" => $vname, "duties" => $duties, "requirements" => $reqs, "conditions" => $conds);
	$this->controller->editV($arr, $id);
	header("Location: /admin/vacancy/".$id);
	exit;
}

public function editOtherH(){
	$h = htmlspecialchars($_POST['header']);
	$id = htmlspecialchars($_POST['section-id']);
	$this->controller->editOtherH($h, $id);
	header("Location: /admin/other_edit/".$id);
	exit;
}

public function editOtherSecH(){
	$sh = htmlspecialchars($_POST['s-header']);
	$id = htmlspecialchars($_POST['section-id']);
	$this->controller->editOtherSecH($sh, $id);
	header("Location: /admin/other_edit/".$id);
	exit;
}

public function editOtherFt(){
	$ft = htmlspecialchars($_POST['fulltext']);
	$id = htmlspecialchars($_POST['section-id']);
	$this->controller->editOtherFT($ft, $id);
	header("Location: /admin/other_edit/".$id);
	exit;
}

public function addProject(){
	$companyname = htmlspecialchars(stripslashes($_POST["cname"]));
	$prheader = htmlspecialchars(stripslashes($_POST["project-header"]));
	$prdesc = $_POST["project-desc"];
	$prtags = htmlspecialchars(stripslashes($_POST["project-tags"]));
	$prcover = htmlspecialchars(stripslashes($_POST["project-img"]));
	$prcover = htmlspecialchars(stripslashes($_POST["project-img"]));
	$f = '';
	foreach($_POST as $key => $val){
		if(preg_match("~^project\-image~", $key)){
			$f .= $val.",";
		}
	}
	$f = htmlspecialchars(substr($f, 0, -1));
	$arr = ["description" => $companyname, "header" => $prheader, "hashtag" => $prtags, "second_header" => $prdesc, "images" => $f, "img_cover" => $prcover];
	$this->controller->add("projects", $arr);
	header("Location: /admin/projects");
	exit;
}

public function addClient(){
	$logo = $_POST['client-logo'];
	$desc = $_POST['client-descitption'];
	$last = $this->controller->getClOrder();
	$last++;
	$this->controller->add("clients", array("logo_url" => $logo, "logo_history" => $desc, "logo_order" => $last));
	header("Location: /admin/clients");
	exit;
}

public function editAbout(){
	$text = $_POST['about-text'];
	print_r($_POST);
	$id = htmlspecialchars($_POST['about-id']);
	$this->controller->editAbout($text, $id);
	header("Location: /admin/about/".$id);
	exit;
}

public function editYoutube(){
	$d = "t=".htmlspecialchars($_POST['youtube_url']);
	$f = file_put_contents("../".MAIN_DIR.'contents/youtube.ini', $d);
	header("Location: /admin/main");
	exit;
}

public function editServicesBg($l){
	$d = "t=".htmlspecialchars($_POST['services-bg']);
	$f = file_put_contents("../".MAIN_DIR.'contents/services/bg.ini', $d);
	header("Location: /admin/".$l);
	exit;
}

public function editServicesBgHeader($l){
	$d = "t=".htmlspecialchars($_POST['services-bg-h']);
	$f = file_put_contents("../".MAIN_DIR.'contents/services/bg_header.ini', $d);
	header("Location: /admin/".$l);
	exit;
}

public function editServiceName(){
	$n = htmlspecialchars(stripslashes($_POST["service-name"]));
	$id = htmlspecialchars(stripslashes($_POST["service-id"]));
	$r = $this->controller->editServiceName($n, $id);
	header("Location: /admin/service/".$id);
	exit;
}

public function editServiceDesc(){
	$desc = $_POST["service-desc"];
	$id = htmlspecialchars(stripslashes($_POST["service-id"]));
	$r = $this->controller->editServicesDesc($desc, $id);
	header("Location: /admin/service/".$id);
	exit;
}

public function editServiceCat(){
	$cat = htmlspecialchars(stripslashes($_POST["service-cat"]));
	$id = htmlspecialchars(stripslashes($_POST["service-id"]));
	$r = $this->controller->editServicesCat($cat, $id);
	header("Location: /admin/service/".$id);
	exit;
}

public function editPrCName(){
	$name = htmlspecialchars(stripslashes($_POST["cname"]));
	$id = htmlspecialchars(stripslashes($_POST["project-id"]));
	$r = $this->controller->editPrCname($name, $id);
 header("Location: /admin/project/".$id);
	exit;
}

public function editPrHeader(){
	$name = htmlspecialchars(stripslashes($_POST["project-header"]));
	$id = htmlspecialchars(stripslashes($_POST["project-id"]));
	$r = $this->controller->editPrHeader($name, $id);
 header("Location: /admin/project/".$id);
	exit;
}

public function editPrSHeader(){
	$name = htmlspecialchars(stripslashes($_POST["project-desc"]));
	$id = htmlspecialchars(stripslashes($_POST["project-id"]));
	$r = $this->controller->editPrSHeader($name, $id);
 header("Location: /admin/project/".$id);
	exit;
}

public function editPrTags(){
	$name = htmlspecialchars(stripslashes($_POST["project-tags"]));
	$id = htmlspecialchars(stripslashes($_POST["project-id"]));
	$r = $this->controller->editPrTags($name, $id);
 header("Location: /admin/project/".$id);
	exit;
}

public function editPortImg(){
	$im = htmlspecialchars(stripslashes($_POST["port-url"]));
	$id = htmlspecialchars(stripslashes($_POST["port-id"]));
	$r = $this->controller->editPortImg($im, $id);
 header("Location: /admin/port/".$id);
	exit;
}

public function editPortURL(){
	$url = htmlspecialchars(stripslashes($_POST["port-url"]));
	$id = htmlspecialchars(stripslashes($_POST["port-id"]));
	$r = $this->controller->editPortURL($url, $id);
 header("Location: /admin/port/".$id);
	exit;
}

public function editPrcover(){
	$name = htmlspecialchars(stripslashes($_POST["project-img"]));
	$id = htmlspecialchars(stripslashes($_POST["project-id"]));
	$r = $this->controller->editPrcover($name, $id);
 header("Location: /admin/project/".$id);
	exit;
}

public function editPrImages(){
	$id = htmlspecialchars(stripslashes($_POST["project-id"]));
	$f = '';
	foreach($_POST as $key => $val){
		if(preg_match("~^project\-image~", $key)){
			$f .= $val.",";
		}
	}
	$f = substr($f, 0, -1);
	$r = $this->controller->editPrImages($f, $id);
	header("Location: /admin/project/".$id);
	exit;
}

public function DeleteProject(){
	$id = htmlspecialchars($_POST["id"]);
	return $this->controller->DeleteProject($id);
}

public function DeletePort(){
	$id = htmlspecialchars($_POST["id"]);
	return $this->controller->DeletePort($id);
}

public function DeleteSection(){
	$id = htmlspecialchars($_POST["id"]);
	return $this->controller->DeleteSection($id);
}

public function DeleteVacancy(){
	$id = htmlspecialchars($_POST["id"]);
	return $this->controller->DeleteVac($id);
}

public function editHeader($data, $name){
	$h = htmlspecialchars(stripslashes($data));
	$this->setIni("../".MAIN_DIR."contents/contents.ini", $name, "header", $h);
	header("Location: /admin/".$name);
	exit;
}

public function editClDesc(){
	$d = $_POST['client-desc'];
	$id = htmlspecialchars($_POST['client-id']);
	$this->controller->editClDesc($d, $id);
	header("Location: /admin/client/".$id);
	exit;
}

public function editClLogo(){
	$d = $_POST['client-logo'];
	$id = htmlspecialchars($_POST['client-id']);
	$this->controller->editClLogo($d, $id);
	header("Location: /admin/client/".$id);
	exit;
}

public function editDesc($data, $name){
	$this->setIni("../".MAIN_DIR."contents/contents.ini", $name, "desc", $data);
	header("Location: /admin/".$name);
	exit;
}

public function editPDF(){
	$url = "f=".htmlspecialchars($_POST['pdf_url']);
	file_put_contents("../".MAIN_DIR.'contents/pdf_url.ini', $url);
	header("Location: /admin/pdf");
	exit;
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

public function deleteService(){
if(isset($_POST["id"])){
	$id = trim(htmlspecialchars($_POST["id"]));
	$q = $this->controller->DeleteS($id);
	if($q) echo "OK";
	else echo "Error";
}
return;
}

public function deleteClient(){
if(isset($_POST["id"])){
	$id = trim(htmlspecialchars($_POST["id"]));
	$q = $this->controller->DeleteC($id);
	if($q) echo "OK";
	else echo "Error";
}
return;
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