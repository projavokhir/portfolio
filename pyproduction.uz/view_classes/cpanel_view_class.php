<?php

class CPanel_view extends View{

protected $key;
private $params;
private $title;
private $category_name = "Панель управления";

public function __construct($params){
	parent::__construct();
	$this->params = $params;
	$this->key = array_shift($params);
	$r = "https://youtu.be/EHcyz7ekMQY";
}

public function ManagaControlPanel(){
$con = "";
$this->title = "Панель управления";

if(!isset($_SESSION["user"]) && !isset($_SESSION["password"])){

	if(count($this->params) == 0) $con = $this->LoginPage();
	else{
		switch($this->key){
			case "register": $con = $this->RegisterPage();
			break;
			case "remind": $con = $this->RemindPass();
			break;
			case "chpass": $con = $this->ChangePass();
			break;
			default: $this->notFound();
		}
	}
}

else{

if(!$this->key) $con = $this->CPanel();
else
switch($this->key){
	case "main": $con = $this->mainPageEdit();
	break;
	case "about": $con = $this->aboutPageEdit();
	break;
	case "services": $con = $this->servicesPageEdit();
	break;
	case "service": $con = $this->serviceEdit();
	break;
	case "clients": $con = $this->clientsPageEdit();
	break;
	case "client": $con = $this->clientEdit();
	break;
	case "projects": $con = $this->projectsPage();
	break;
	case "project": $con = $this->projectEditPage();
	break;
	case "vacancy": $con = $this->vacancyPage();
	break;
	case "other_edit": $con = $this->OtherEdit();
	break;
	case "port": $con = $this->Portfolio();
	break;
	case "pdf": $con = $this->PDF();
	break;
	case "logout": $con = $this->Logout();
	break;
	default: $con = $this->notFound();
}
}
$this->RenderCpanel($this->title, $con);
return;
}

private function CPanel(){
$s['page_head'] = "Панель управления";
$s['content'] = $this->getMain();
$t['container'] = $this->getReplacedContent($s, "admin_main");
return $this->getReplacedContent($t, "admin_main_container");
}

private function getMain(){
	return $this->getContent("admin_cp_main");
}

private function Portfolio(){
	$s['page_head'] = "Собственные проекты";
	$s['content'] = $this->getPortEditor();
	$t['container'] = $this->getReplacedContent($s, "admin_main");
	return $this->getReplacedContent($t, "admin_main_container");
}

private function OtherEdit(){
	$s['page_head'] = "Редактор страницы";
	$s['content'] = $this->getOtherEditor();
	$t['container'] = $this->getReplacedContent($s, "admin_main");
	return $this->getReplacedContent($t, "admin_main_container");
}

private function getPortEditor(){
	if(count($this->params) === 1){
		$s['list'] = $this->getPortList();
		return $this->getReplacedContent($s, 'admin_list_port');
	}
	else if(count($this->params) === 2 && $this->params[1] != 'add'){
		$id = $this->params[1];
		$p = $this->controller->getBrand($id);
		if(!$p){
			header("Location: /admin/port");
			exit;
		}
		$s['port-url'] = $p['logo_url'];
		$s['port-logo'] = $p['project_link'];
		$s['port-id'] = $p['id'];
		return $this->getReplacedContent($s, 'admin_port_editor');
	}
	else if(count($this->params) === 2 && $this->params[1] === 'add') return $this->getContent('admin_port_add');
	else $this->notFound();
}

private function getPortList(){
	$l = $this->controller->getOwnProjects();
	$t = count($l) == 0 ? 'Нет проектов' : '';
	for($i = 0; $i < count($l); $i++){
		$s['id'] = $l[$i]['id'];
		$s['link'] = $l[$i]['logo_url'];
		$t .= $this->getReplacedContent($s, 'admin_port_li');
	}
	return $t;
}

private function getOtherEditor(){
	$id = count($this->params) === 2 ? $this->params[1] : false;
	$o = $this->controller->getOtherBlock($id);
	if(!$o){
		header("Location: /admin/about");
		exit;
	}

	$s['section-id'] = $o['id'];
	$s['header'] = $o['header'];
	$s['s-header'] = $o['description'];
	$s['ftext'] = $o['full_text'];
	return $this->getReplacedContent($s, 'admin_other_editor');
}

private function PDF(){
	if(count($this->params) === 1){
		$f = parse_ini_file(MAIN_DIR.'contents/pdf_url.ini');
				$r['pdf'] = $f['f'];
		$s['page_head'] = "PDF файл презентации";
		$s['content'] = $this->getReplacedContent($r, 'admin_pdf');
		$t['container'] = $this->getReplacedContent($s, "admin_main");
		return $this->getReplacedContent($t, "admin_main_container");
	}
}

private function mainPageEdit(){
	$s['page_head'] = "Изменить (Главная страница)";
	$s['content'] = $this->getMainEditor();
	$t['container'] = $this->getReplacedContent($s, "admin_main");
	return $this->getReplacedContent($t, "admin_main_container");
}



private function aboutPageEdit(){
	$s['page_head'] = "Редактор страницы";
	$s['content'] = $this->getAboutEditor();
	$t['container'] = $this->getReplacedContent($s, "admin_main");
	return $this->getReplacedContent($t, "admin_main_container");
}

private function servicesPageEdit(){
	if(isset($this->params[1]) && $this->params[1] === "add"){
			$s['page_head'] = "Добавить ( Услуги )";
			$s['content'] = $this->addService();
		$t['container'] = $this->getReplacedContent($s, "admin_main");
		return $this->getReplacedContent($t, "admin_main_container");
	}
	else if(isset($this->params[1]) && $this->params[1] !== "add"){
			$s['page_head'] = "Категория ( ".$this->params[1]." )";
			$s['content'] = $this->servicesByCat($this->params[1]);
		$t['container'] = $this->getReplacedContent($s, "admin_main");
		return $this->getReplacedContent($t, "admin_main_container");
	}
	else{
		$s['page_head'] = "Изменить (Услуги)";
		$s['content'] = $this->getServicesEditor();
		$t['container'] = $this->getReplacedContent($s, "admin_main");
		return $this->getReplacedContent($t, "admin_main_container");
	}
}

private function vacancyPage(){
	if(isset($this->params[1]) && $this->params[1] === "add"){
			$s['page_head'] = "Добавить ( Вакансия )";
			$s['content'] = $this->addVacancy();
		$t['container'] = $this->getReplacedContent($s, "admin_main");
		return $this->getReplacedContent($t, "admin_main_container");
	}
	else if(isset($this->params[1]) && $this->params[1] !== "add"){
			$s['page_head'] = "Изменить ( Вакансия )";
			$s['content'] = $this->getVacEditor($this->params[1]);
		$t['container'] = $this->getReplacedContent($s, "admin_main");
		return $this->getReplacedContent($t, "admin_main_container");
	} else{
		header("Location: /admin/about");
		exit;
	}
}

private function getVacEditor($id){
	$vac = $this->controller->getVac($id);
	if(!$vac || $vac === ''){
		header("Location: /admin/about");
		exit;
	}
	$t['id'] = $vac['id'];
	$t['vac-name'] = $vac['category'];
	$t['duties'] = $vac['duties'];
	$t['reqs'] = $vac['requirements'];
	$t['conds'] = $vac['conditions'];
	return $this->getReplacedContent($t, 'admin_vacancy_edit');
}

private function servicesByCat($cat){
	$ser = $this->controller->getServicesByCat($cat);
	$t = "";
	for($i = 0; $i < count($ser); $i++){
		$r["id"] = $ser[$i]["id"];
		$r["name"] = $ser[$i]["name"];
		$t .= $this->getReplacedContent($r, "admin_services_list_item");
	}
	return $this->getReplacedContent(array("list" => $t), "admin_services_list");
}

private function projectsPage(){
	if(isset($this->params[1]) && $this->params[1] === "add"){
			$s['page_head'] = "Добавить ( Проект )";
			$s['content'] = $this->addProject();
		$t['container'] = $this->getReplacedContent($s, "admin_main");
		return $this->getReplacedContent($t, "admin_main_container");
	}
	else{
		 $s['page_head'] = "Все проекты";
		 $s['content'] = $this->projectsMain();
		$t['container'] = $this->getReplacedContent($s, "admin_main");
		return $this->getReplacedContent($t, "admin_main_container");
	}
}

private function projectEditPage(){
	$id = $this->params[1];
	$pr = $this->controller->getProject($id);
	if($id == "" || !$pr){
		header("Location: /admin/projects");
		exit;
	}
		$s['cname'] = $pr['description'];
		$s['project-header'] = $pr['header'];
		$s['project-desc'] = $pr['second_header'];
		$s['project-tags'] = $pr['hashtag'];
		$s['project-img'] = $pr['img_cover'];
		$s['project_images'] = $this->getProjectImages($pr['images']);
		$s['project-id'] = $id;
	$t['content'] = $this->getReplacedContent($s, 'admin_project_editor');
	$t['page_head'] = 'Изменить ( Проект )';
	return $this->getReplacedContent($t, 'admin_main');
}

private function getProjectImages($im){
	if(count($im) === 0 || $im === '') return false;
	$arr = explode(",", $im);
	$t = '';
	for($i = 0; $i < count($arr); $i++){
		$r["project-image"] = $arr[$i];
		$r["order"] = $i+1;
		$t .= $this->getReplacedContent($r, "admin_project_images");
	}
	return $t;
}

private function projectsMain(){
	$t['list'] = $this->getAllProjects();
	return $this->getReplacedContent($t, 'admin_main_projects');
}

private function getAllProjects(){
	$pr = $this->controller->getProjects();
	$li = '';
	for($i = 0; $i < count($pr); $i++){
		$s['id'] = $pr[$i]['id'];
		$s['desc'] = $pr[$i]['description'];
		$li .= $this->getReplacedContent($s, 'admin_project_li');
	}
	return $li;
}

private function clientsPageEdit(){
	if(isset($this->params[1]) && $this->params[1] === "add"){
			$s['page_head'] = "Добавить ( Клиенты )";
			$s['content'] = $this->addClient();
		$t['container'] = $this->getReplacedContent($s, "admin_main");
		return $this->getReplacedContent($t, "admin_main_container");
	}
	else{
		$s['page_head'] = "Проекты (Клиенты)";
		$s['content'] = $this->getClientsEditor();
		$t['container'] = $this->getReplacedContent($s, "admin_main");
		return $this->getReplacedContent($t, "admin_main_container");
	}
}


private function addService(){
	$s['options'] = $this->getOptions();
	return $this->getReplacedContent($s, 'admin_service_add');
}

private function addClient(){
	return $this->getContent('admin_add_client');
}

private function addProject(){
	return $this->getContent('admin_project_add');
}

private function addVacancy(){
	return $this->getContent('admin_vacancy_add');
}

private function serviceEdit(){
	$id = $this->params[1];
	$service = $this->controller->getService($id);
	if($id == "" || !$service){
		header("Location: /admin/services");
		exit;
	}
		$s['service-name'] = $service['name'];
		$s['service-id'] = $id;
		$s['list-services'] = $service['description'];
		$s['options'] = $this->getOptions($service["category"]);
	$t['page_head'] = 'Изменить ( '.$service['name'].' )';
	$t['content'] = $this->getReplacedContent($s, 'services_editor');
	return $this->getReplacedContent($t, 'admin_main');
}

private function getOptions($key = ""){
	$c = $this->controller->getCategories();
	$t = '';
	for($i = 0; $i < count($c); $i++){
		$r["val"] = $c[$i]["service_name"];
		$r["selected"] = $c[$i]["service_name"] == $key ? "selected":"";
		$t .= $this->getReplacedContent($r, "admin_service_options");
	}
	return $t;
}

private function clientEdit(){
	$id = $this->params[1];
	$cl = $this->controller->getClient($id);
	if($id == "" || !$cl){
		header("Location: /admin/clients");
		exit;
	}
		$s['client-logo'] = $cl['logo_url'];
		$s['client-id'] = $id;
		$s['client-desc'] = $cl['logo_history'];
	$t['page_head'] = 'Изменить ( Клиент )';
	$t['content'] = $this->getReplacedContent($s, 'admin_clients_edit');
	return $this->getReplacedContent($t, 'admin_main');
}

private function getMainEditor(){
	$f = parse_ini_file(MAIN_DIR.'contents/youtube.ini');
	$r['youtube-video'] = $f['t'];
	return $this->getReplacedContent($r, "admin_main_page_edit");
}

private function getAboutEditor(){
	if(isset($this->params[1]) && $this->params[1] != "add_block"){
		$h = $this->controller->getAbout($this->params[1]);
		$r['about-text'] = $h['full_text'];
		$r['about-id'] = $h['id'];
		return $this->getReplacedContent($r, "admin_about_block_editor");
	}
	else if(count($this->params) == 1){
		$h = $this->getHeaders('about');
		$hh = $this->getHeaders('vacancy');
		$r['about-header'] = $h['header'];
		$r['about-s-header'] = $h['desc'];
		$r['vac-s-header'] = $hh['desc'];
		$r['list_blocks'] = $this->getAboutBlocks();
		$r['list_vacancies'] = $this->getAboutVacs();
		$r['list_blocks_2'] = $this->getAboutOthersList();
		return $this->getReplacedContent($r, "admin_about_editor");
	}
	else if(isset($this->params[1]) && $this->params[1] == "add_block"){
		$h = $this->getHeaders('about');
		$hh = $this->getHeaders('vacancy');
		$r['about-header'] = $h['header'];
		$r['about-s-header'] = $h['desc'];
		$r['vac-s-header'] = $hh['desc'];
		$r['list_blocks'] = $this->getAboutBlocks();
		$r['list_vacancies'] = $this->getAboutVacs();
		return $this->getReplacedContent($r, "about-block-editor");
	}
}

private function getAboutOthersList(){
	$l = $this->controller->getOther();
	$t = '';
	if(count($l) === 0) return $t;
	for($i = 0; $i < count($l); $i++){
		$s['block_id'] = $l[$i]['id'];
		$s['name'] = $l[$i]['header'];
		$t .= $this->getReplacedContent($s, 'admin_bloks_list');
	}
	return $t;
}

private function getAboutBlocks(){
	$b = $this->controller->getAboutBlocks();
	$t = '';
	if(count($b) === 0){ $t = 'Нет постов!'; return $t;}
	for($k = 0; $k < count($b); $k++){
		$s['controller'] = 'about';
		$s['id'] = $b[$k]['id'];
		$s['name'] = 'Блок&nbsp;&nbsp;'.($k+1);
		$t .= $this->getReplacedContent($s, 'admin_about_list_item');
	}
	return $t;
}

private function getAboutVacs(){
	$b = $this->controller->getVacs();
	$t = '';
	if(count($b) === 0){ $t = 'Нет постов!'; return $t;}
	for($k = 0; $k < count($b); $k++){
		$s['controller'] = 'vacancy';
		$s['id'] = $b[$k]['id'];
		$s['name'] = $b[$k]['category'];
		$t .= $this->getReplacedContent($s, 'admin_about_list_item');
	}
	return $t;
}

private function getServicesEditor(){
	$contents = parse_ini_file(MAIN_DIR.'/contents/contents.ini', true);
	$r['services-header'] = $contents['services']['header'];
	$r['services-s-header'] = $contents['services']['desc'];
	$r['list'] = $this->getServicesHeaders();
	return $this->getReplacedContent($r, "admin_services_editor");
}

private function getClientsEditor(){
	$contents = parse_ini_file(MAIN_DIR.'/contents/contents.ini', true);
	$r['services-header'] = $contents['clients']['header'];
	$r['services-s-header'] = $contents['clients']['desc'];
	$r['list'] = $this->getClientsLogo();
	return $this->getReplacedContent($r, "admin_clients_page_editor");
}

private function getServicesHeaders(){
	$h = $this->controller->getCategories();
	$l = '';
	for($i = 0; $i < count($h); $i++){
		$t['title'] = $h[$i]['service_name'];
		$t['id'] = $h[$i]['service_name'];
		$l .= $this->getReplacedContent($t, 'services-list');
	}
	return $l;
}

private function getClientsLogo(){
	$h = $this->controller->getBrands();
	$l = '';
	for($i = 0; $i < count($h); $i++){
		$t['link'] = $h[$i]['logo_url'];
		$t['id'] = $h[$i]['id'];
		$l .= $this->getReplacedContent($t, 'admin_clients_li');
	}
	return $l;
}

private function RegisterPage(){
 $sr["message"] = (isset($_SESSION["reg_message"])) ? $_SESSION["reg_message"] : "";
 unset($_SESSION["reg_message"]);
 require_once "scripts/register.php";
 return $this->getReplacedContent($sr, "admin_register");
}

private function RemindPass(){
	if(!isset($_SESSION["secure_code"])){
	$sr["message"] = (isset($_SESSION["rem_message"])) ? $_SESSION["rem_message"] : "";
	unset($_SESSION["rem_message"]);
	require_once "scripts/remind.php";
	return $this->getReplacedContent($sr, "admin_remind");
	} else if(isset($_SESSION["secure_code"]) && $_SESSION["secure_code"] === USER_HASH){
		header("Location: /admin/chpass/");
		exit;
	}
}

private function ChangePass(){
if(isset($_SESSION["secure_code"]) && $_SESSION["secure_code"] === USER_HASH){
$sr["message"] = (isset($_SESSION["rem_message"])) ? $_SESSION["rem_message"] : "";
unset($_SESSION["rem_message"]);
require_once "scripts/chpass.php";
return $this->getContent("admin_chpass");
} else{
	header("Location: /admin/remind");
	exit;
}
}

private function LoginPage(){ 
$sr["message"] = (isset($_SESSION["login_message"])) ? $_SESSION["login_message"] : "";
unset($_SESSION["login_message"]);
require_once "scripts/login.php";
return $this->getReplacedContent($sr, "admin_login");
}

private function Logout(){
	if(isset($_SESSION["user"])){
		unset($_SESSION["user"]);
		unset($_SESSION["username"]);
		unset($_SESSION["password"]);
		header("Location: /admin");
		exit;
	} else{
		header("Location: /admin");
		exit;
	}
}

}

?>