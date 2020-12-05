<?php

class Sitedata extends View{

private $title;
private $meta_desc;
private $meta_key;

public function __construct(){
	parent::__construct();
}


public function showNews(){
$this->title = SITE_NAME." &nbsp;&#8211;&nbsp; Новости";
$this->meta_desc = "";
$this->meta_key = "";
$content = $this->getContent("news_content");
$this->Render($this->title, $this->meta_desc, $this->meta_key, $content);
}

public function showFranshize(){
$this->title = SITE_NAME." &nbsp;&#8211;&nbsp; Франшиза";
$this->meta_desc = "";
$this->meta_key = "";
$content = $this->getContent("franshize_content");
$this->Render($this->title, $this->meta_desc, $this->meta_key, $content);
}

public function showVacancy(){
$this->title = SITE_NAME." &nbsp;&#8211;&nbsp; Вакансии";
$this->meta_desc = "";
$this->meta_key = "";
$content = $this->getContent("vacancy_content");
$this->Render($this->title, $this->meta_desc, $this->meta_key, $content);
}

public function showAbout(){
$this->title = SITE_NAME." &nbsp;&#8211;&nbsp; О Компании";
$this->meta_desc = "";
$this->meta_key = "";
$content = $this->getContent("about_content");
$this->Render($this->title, $this->meta_desc, $this->meta_key, $content);
}

public function showDeliver(){
$this->title = SITE_NAME." &nbsp;&#8211;&nbsp; Доставка";
$this->meta_desc = "";
$this->meta_key = "";
$content = $this->getContent("deliver_content");
$this->Render($this->title, $this->meta_desc, $this->meta_key, $content);
}

public function showPayments(){
$this->title = SITE_NAME." &nbsp;&#8211;&nbsp; Оплата";
$this->meta_desc = "";
$this->meta_key = "";
$content = $this->getContent("payment_content");
$this->Render($this->title, $this->meta_desc, $this->meta_key, $content);
}

public function showRefund(){
$this->title = SITE_NAME." &nbsp;&#8211;&nbsp; Возврат";
$this->meta_desc = "";
$this->meta_key = "";
$content = $this->getContent("refund_content");
$this->Render($this->title, $this->meta_desc, $this->meta_key, $content);
}

public function showSizes(){
$this->title = SITE_NAME." &nbsp;&#8211;&nbsp; Таблица размеров";
$this->meta_desc = "";
$this->meta_key = "";
$content = $this->getContent("sizes_content");
$this->Render($this->title, $this->meta_desc, $this->meta_key, $content);
}

}

?>