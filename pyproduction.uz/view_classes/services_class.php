<?php

class Services extends View{

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

public function returnScripts(){
	return $this->getContent("projects-scripts");
}

private function getClientsInnerPage(){
	$cats = $this->controller->getCategories();
	$t = '';
	for($i = 0; $i < count($cats); $i++){
		$s = $this->controller->getServicesByCat($cats[$i]['service_name']);
		for($j = 0; $j < count($s); $j++){
			$r['cat'] = mb_strtolower($s[$j]['category']);
			$r['name'] = $s[$j]['name'];
			$r['desc'] = $s[$j]['description'];
			$t .= $this->getReplacedContent($r, 'services-inner-list');
		}
	}
	return $this->getReplacedContent(array('list-services' => $t), 'services-inner');
}

private function renderContent(){
	$h = $this->getHeaders("services");
	$t["header"] = $this->security($h["header"]);
	$t["desc"] = $this->security($h["desc"]);
	$t["contents"] = $this->getClientsInnerPage();
	return $this->getReplacedContent($t, "services-content");
}

}
?>