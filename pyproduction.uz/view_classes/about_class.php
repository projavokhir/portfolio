<?php

class About extends View{

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
	$hh = $this->getHeaders('about');
	$vacancy_h = $this->getHeaders('vacancy');
	$t['header'] = $hh['header'];
	$t['second_header'] = $hh['desc'];
	$t['vacancy_s_h'] = $vacancy_h['desc'];
	$t['vacancy_list'] = $this->getVacList();
	$t['vacancy_block'] = $this->getVacanciesBlock();
	$t['about_blocks'] = $this->getCHistory();
	$t['blocks'] = $this->getOther();
	return $this->getReplacedContent($t, "about-page-content");
}

private function getOther(){
	$b = $this->controller->getOther();
	$t = '';
	for($i = 0; $i < count($b); $i++){
		$s['header_1'] = $b[$i]['header'];
		$s['second_header_1'] = $b[$i]['description'];
		$s['full_text'] = $b[$i]['full_text'];
		$t .= $this->getReplacedContent($s, 'about-blocks');
	}
	return $t;
}

private function getCHistory(){
	$h = $this->controller->getAboutBlocks();
	$t = '';
	for($i = 0; $i < count($h); $i++){
		$r['text'] = $h[$i]['full_text'];
		$t .= $this->getReplacedContent($r, 'about_chistory_block');
	}
	return $t;
}

private function getVacList(){
	$v = $this->controller->getVacs();
	$t = '';
	if(count($v) === 0){$t = "Нет вакансий!"; return $t;}
	for($i = 0; $i < count($v); $i++){
		$s['id'] = $this->toLatin(mb_strtolower($v[$i]['category']));
		$s['name'] = $v[$i]['category'];
		$t .= $this->getReplacedContent($s, 'about_vacancy_list');
	}
	return $t;
}

private function getVacanciesBlock(){
	$v = $this->controller->getVacs();
	$t = '';
	if(count($v) === 0){$t = "Нет вакансий!"; return $t;}
	for($i = 0; $i < count($v); $i++){
		$s['id'] = $this->toLatin(mb_strtolower($v[$i]['category']));
		$s['name'] = $v[$i]['category'];
		$s['duties'] = $v[$i]['duties'];
		$s['requirements'] = $v[$i]['requirements'];
		$s['conditions'] = $v[$i]['conditions'];
		$t .= $this->getReplacedContent($s, 'about_vacancy_block');
	}
	return $t;
}

public function getContacts(){
	$h = $this->getHeaders('contacts');
	$gh['header'] = $h['header'];
	$gh['desc'] = $h['desc'];
	$title = $this->main_title;
	$m_desc = "PY PRODUCTION";
	$m_key = "py";
	$contents = $this->getReplacedContent($gh, "contacts-content");
	$this->Render($this->main_title, $m_desc, $m_key, $contents, true, true);
}
}
?>