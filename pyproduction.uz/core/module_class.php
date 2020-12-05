<?php
abstract class Module{

protected $db;
protected $controller;
protected $user;

public function __construct(){
	$this->db = DB::getInstance();
	$this->controller = DBController::getInstance($this->db);
		$this->user = new User($this->db);
}

public function getContent($tmpl){
	$tpl = file_get_contents(DIR_TMPL.$tmpl.".tpl");
	$tpl = str_replace("%address%", SITE_ADDRESS, $tpl);
	$tpl = str_replace("%main_dir%", MAIN_DIR, $tpl);
	return $tpl;
}

protected function getTitle(){
	return "PY PRODUCTION — Продакшн компания полного цикла";
}

public function getContentAjax($tmpl){
	$tpl = file_get_contents("../".DIR_TMPL.$tmpl.".tpl");
	$tpl = str_replace("%address%", SITE_ADDRESS, $tpl);
	$tpl = str_replace("%main_dir%", MAIN_DIR, $tpl);
	return $tpl;
}

public function getReplacedContent($replaces = [], $tmpl, $ajax = false){
	$tmpl = (!$ajax) ? $this->getContent($tmpl) : $this->getContentAjax($tmpl);
	foreach($replaces as $k => $v){
		$tmpl = str_replace("%".$k."%", $v, $tmpl);
	}
	return $tmpl;
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

//the end of the class
}
?>