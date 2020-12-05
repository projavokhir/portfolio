<?php
require_once "db_class.php";
require_once "email_class.php";
require_once "../load.php";

class Manage{

private $db;
private $mail;
private $article;

protected $data;
public function __construct(){
	ob_start();
	session_start();
	$this->db = DB::getInstance();
	$this->article = Article::getInstance($this->db);
}

public function SubscribeEmail(){
	$this->mail = new Email($this->db);
	$username = htmlspecialchars(strip_tags($_POST["username"]));
	$email = htmlspecialchars(strip_tags($_POST["email"]));
	$return_link = htmlspecialchars(strip_tags($_POST["redirect"]));
	if(empty($email)) $this->redirect_single($return_link);
	if(empty($username)) $this->redirect_single($return_link, $return_link, "");
	$link = "message/SystemSuccess";
	$time = time();
	if(!$this->mail->issetEmail($email)){
		$d = array("id" => "", "email" => $email, "name" => $username, "subscribe_time" => $time);
		$q = $this->mail->insertMail($d);
		if($q){
			$message = "Ваша подписка успешна добавлена в нашу систему. Теперь вы получаете оповищение о новых статьях";
			$this->redirect($return_link, $link, $message);
			return;
		}
	}
	else {
		$message = "Эта почта уже подписана на обновление.";
		$this->redirect($return_link, $link, $message);
		return;
	}
}

public function addPost(){

$title = htmlspecialchars($_POST["title"]);
$alias = $this->toLatin(htmlspecialchars($_POST["title"]));
$cover = htmlspecialchars($_POST["post_cover"]);
$desc = htmlspecialchars($_POST["desc"]);
$keywords = htmlspecialchars($_POST["keywords"]);
$category = htmlspecialchars($_POST["category"]);
$category_alias = $this->toLatin(htmlspecialchars($_POST["category"]));
$full_text = $_POST["full_text"];


if($title != "" && $cover != "" && $category != "" && $full_text != ""){

$array = array("title" => $title, "full_text" => $full_text, "description" => $desc, "keywords" => $keywords, "alias" => $alias, "time" => time(), "category" => $category, "category_alias" => $category_alias, "views" => 0, "cover_link" => $cover);


$a = $this->article->getArticle($alias);

if(!$a) {
$this->article->add($array);
return $this->redirect("admin/", "Пост успешно добавлен");
} else{
	$r = ceil(rand(0, 100));
	$alias .= "-".$r;
	$array = array("title" => $title, "full_text" => $full_text, "description" => $desc, "keywords" => $keywords, "alias" => $alias, "time" => time(), "category" => $category, "category_alias" => $category_alias, "views" => 0, "cover_link" => $cover);
	$this->article->add($array);
	return $this->redirect("admin/", "Пост успешно добавлен");
}

}
return $this->redirect("admin/", "Произошла ошибка при добавлении поста");
}

public function editPost(){

$title = htmlspecialchars($_POST["title"]);
$alias = $this->toLatin(htmlspecialchars($_POST["title"]));
$cover = htmlspecialchars($_POST["post_cover"]);
$desc = htmlspecialchars($_POST["desc"]);
$keywords = htmlspecialchars($_POST["keywords"]);
$category = htmlspecialchars($_POST["category"]);
$category_alias = $this->toLatin(htmlspecialchars($_POST["category"]));
$where = htmlspecialchars($_POST["alias"]);
$full_text = $_POST["full_text"];


if($title != "" && $cover != "" && $category != "" && $full_text != ""){

$array = array("title" => $title, "full_text" => $full_text, "description" => $desc, "keywords" => $keywords, "alias" => $alias, "time" => time(), "category" => $category, "category_alias" => $category_alias, "cover_link" => $cover);


$a = $this->article->getArticle($where);

if(!$a) {
	return $this->redirect("admin/", "Произошла внутренняя ошибка");
} else{

	$r = ceil(rand(0, 100));
	$alias .= "-".$r;
	$array = array("title" => $title, "full_text" => $full_text, "description" => $desc, "keywords" => $keywords, "alias" => $alias, "time" => time(), "category" => $category, "category_alias" => $category_alias, "cover_link" => $cover);
	if($this->article->editPost($array, $where))	return $this->redirect("admin/", "Пост успешно обновлен!");
	else return $this->redirect("admin/", "Произошла ошибка при добавлении поста");
}

}
	return $this->redirect("admin/", "Произошла ошибка при добавлении поста");
}

public function deletePost(){

if(isset($_POST["alias"])){
	$alias = trim(htmlspecialchars($_POST["alias"]));
	$q = $this->article->DeletePost($alias);
	if($q) echo "OK";
	else echo "Error";
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

private function addXML($title, $full_text, $category){
	$f = new Feeds(MAIN_TITLE, SITE_ADDRESS, "Блог публикует новые статьи с мира ИТ");
	$link = SITE_ADDRESS.$this->toLatin($title);
	$descript = mb_substr(strip_tags($full_text), 0, 40);
	$f->addItem($title, $link, $descript, $category, new DateTime());
	$f_name = "rss.xml";
	$file = fopen($f_name, "w");
	fwrite($file, $f->saveXML());
	fclose($file);
}

protected function toLatin($text){
	$text = mb_strtolower($text);
//Filter for uncaught symbols
	$filter = "~[\№\~\`\!\@\#\$\%\^\&\*\(\)\-\_\=\+\\\|\[\]\;\:\'\"\,\.\<\>\?\/\«\»\–]~u";
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

public function editSlider(){
$url = htmlspecialchars(trim($_POST["url"], "/"));
if($url != ""){
$f = file_put_contents("../core/ini_files/slider.txt", $url);
	if($f){
		echo "OK";
	} else echo "ERR";
}
exit;
}


}

?>