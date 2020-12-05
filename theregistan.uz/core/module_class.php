<?php
abstract class Module{

protected $db;
protected $article;
protected $video;
protected $tetxview;
protected $user;
protected $v_control;

public function __construct(){
	$this->db = DB::getInstance();
	$this->article = Article::getInstance($this->db);
	$this->v_control = new Views($this->db);
	$this->user = new User($this->db);
}

public function getContent($tmpl){
	$tpl = file_get_contents(DIR_TMPL.$tmpl.".tpl");
	$tpl = str_replace("%address%", SITE_ADDRESS, $tpl);
	$tpl = str_replace("%main_dir%", MAIN_DIR, $tpl);
	return $tpl;
}

public function getContentAjax($tmpl){
	$tpl = file_get_contents("../".DIR_TMPL.$tmpl.".tpl");
	$tpl = str_replace("%address%", SITE_ADDRESS, $tpl);
	$tpl = str_replace("%main_dir%", MAIN_DIR, $tpl);
	return $tpl;
}

protected function viewsControl(){
$v = $this->v_control->getAllViews();
$all_views = 0;
$all_users = 0;
for($i = 0; $i < count($v); $i++){
	$all_views += $v[$i]["views"];
	$all_users += $v[$i]["users"];
}
$v = array_shift($v);
$today_views = $v["views"];
$today_users = $v["users"];
return ["all_views" => $all_views, "all_users" => $all_users, "today_views" => $today_views, "today_users" => $today_users];
}

public function getReplacedContent($replaces = [], $tmpl, $ajax = false){
	$tmpl = (!$ajax) ? $this->getContent($tmpl) : $this->getContentAjax($tmpl);
	foreach($replaces as $k => $v){
		$tmpl = str_replace("%".$k."%", $v, $tmpl);
	}
	return $tmpl;
}

private function getMonthName($order){
	$months =	array("Янв", "Фев", "Мар", "Апр", "Май", "Июнь", "Июль", "Авг", "Сен", "Окт", "Ноя", "Дек");
	return $months[$order];
}

protected function getPagination($count_on_page, $count_a_a, $cont_name){
$all_pages = ceil($count_a_a/$count_on_page);
$links = "";
if($count_on_page >= $count_a_a) return ["", 1];
for($i = 0; $i < $all_pages; $i++){
	if(strpos($_SERVER["REQUEST_URI"], "cat")){ $cats = explode("/", $_SERVER["REQUEST_URI"]); $cat = $cats[3];}

	$sr["link"] = (strpos($_SERVER["REQUEST_URI"], "cat")) ? SITE_ADDRESS."article/cat/$cat/page/".($i+1) : SITE_ADDRESS."article/page/".($i+1);
	$sr["order"] = ($i+1);
	$links .= $this->getReplacedContent($sr, "pagination_items");
}
$pag["page_items"] =  $links;
return [
	$this->getReplacedContent($pag, "pagination"), 
	$all_pages
			 ];
}

protected function formatDate($time){
	return date("d/m/Y", $time);
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

//the end of the class
}
?>