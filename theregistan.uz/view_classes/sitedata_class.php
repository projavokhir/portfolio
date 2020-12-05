<?php

class Sitedata extends View{

protected $key;
protected $all_params;
private $title;
private $meta_desc;
private $meta_key;
private $params;

public function __construct($params){
	parent::__construct();
	$this->params = $params;
	$this->all_params = $params;
	$this->key = array_shift($params);
}



public function showContent(){

$cont = "";

switch(CONTROLLER){
	case "contacts": $cont = $this->getContactContent();
	break;

	case "edition": $cont =  $this->getBoardContent();
	break;

	case "ad": $cont = $this->getAdContent();
	break;

	case "terms": $cont = $this->getRegContent();
	break;

	default: return $this->notFound();
}

return $this->Render($this->title, $this->meta_desc, $this->meta_key, $cont);
}

private function getContactContent(){

$this->title = SITE_NAME." - Контакты";
$this->meta_desc = "Контакты, The Registan, контакты The Registan";
$this->meta_key = SITE_NAME." - Контакты";

return $this->getContent("contacts");
}

private function getBoardContent(){

$this->title = SITE_NAME." - Редакция";
$this->meta_desc = "Контакты, The Registan, контакты The Registan";
$this->meta_key = SITE_NAME." - Контакты";

return $this->getContent("redakciya");
}

private function getAdContent(){

$this->title = SITE_NAME." - Реклама на сайте";
$this->meta_desc = "Контакты, The Registan, контакты The Registan";
$this->meta_key = SITE_NAME." - Контакты";

return $this->getContent("ads");
}

private function getRegContent(){

$this->title = SITE_NAME." - Пользовательское соглашение";
$this->meta_desc = "Пользовательское соглашение, The Registan, Соглашение";
$this->meta_key = "пользовательское соглашение, The Registan, соглашение, py, the registan, py production, parviz, yakhayayev, parviz yakhayayev";
$this->meta_key = SITE_NAME." - Контакты";

return $this->getContent("reglament");
}

}

?>