<?php

class Clients extends View{

private $main_title;
private $products_count = 8;

public function __construct(){
	$this->main_title = $this->getTitle();
	parent::__construct();
}

public function showcontent(){
	$title = $this->main_title;
	$m_desc = "PY PRODUCTION";
	$m_key = "py";
	$contents = $this->renderContent();
	$this->Render($this->main_title, $m_desc, $m_key, $contents, true, true);
}

private function renderContent(){
	$h = $this->getHeaders("clients");
	$t["header"] = $this->security($h["header"]);
	$t["desc"] = $this->security($h["desc"]);
	$t["clients"] = $this->getInnerClients();
	return $this->getReplacedContent($t, "clients-page-content");
}

protected function getInnerClients(){
	$s = $this->controller->getBrands();
	$temp = "";
	for($i = 0; $i < count($s); $i++){
		$t["img_link"] = $s[$i]["logo_url"];
		$t["description"] = $s[$i]["logo_history"];
		$temp .= $this->getReplacedContent($t, "clients-inner-block");
	}
	return $temp;
}

public function returnScripts(){
	return '<script src="'.MAIN_DIR.'js/baron.min.js?'.time().'"></script>';
}

}
?>