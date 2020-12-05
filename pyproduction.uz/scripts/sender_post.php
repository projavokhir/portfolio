<?php
require_once "../core/manage_class_1.php";
if(isset($_POST)){
$manage = new Manage();
	if(isset($_POST["add_product"])) $manage->addProduct();
	if(isset($_POST["add-port"])) $manage->addPort();
	else if(isset($_POST["edit_youtube"])) $manage->editYoutube();
	else if(isset($_POST["edit-services-h"])) $manage->editHeader($_POST["services-header"],"services");
	else if(isset($_POST["edit-services-s-h"])) $manage->editDesc($_POST["services-s-header"], "services");
	else if(isset($_POST["edit-clients-h"])) $manage->editHeader($_POST["clients-header"], "clients");
	else if(isset($_POST["edit-clients-s-h"])) $manage->editDesc($_POST["clients-s-header"], "clients");
	else if(isset($_POST["add-service"])) $manage->addService();
	else if(isset($_POST["add-project"])) $manage->addProject();
	else if(isset($_POST["add-vacancy"])) $manage->addVacancy();
	else if(isset($_POST["add-client"])) $manage->addClient();
	else if(isset($_POST["add_about_block"])) $manage->addBlock();
	else if(isset($_POST["delete_service"])) $manage->deleteService();
	else if(isset($_POST["delete_client"])) $manage->deleteClient();
	else if(isset($_POST["edit-client-img"])) $manage->editClLogo();
	else if(isset($_POST["edit-client-desc"])) $manage->editClDesc();
	else if(isset($_POST["edit-service-name"])) $manage->editServiceName();
	else if(isset($_POST["edit-service-desc"])) $manage->editServiceDesc();
	else if(isset($_POST["edit-service-cat"])) $manage->editServiceCat();
	else if(isset($_POST["edit-company-name"])) $manage->editPrCName();
	else if(isset($_POST["edit-project-header"])) $manage->editPrHeader();
	else if(isset($_POST["edit-project-desc"])) $manage->editPrSHeader();
	else if(isset($_POST["edit-project-tags"])) $manage->editPrTags();
	else if(isset($_POST["edit-project-img"])) $manage->editPrCover();
	else if(isset($_POST["edit-project-images"])) $manage->editPrImages();
	else if(isset($_POST["edit-about-bl"])) $manage->editAbout();
	else if(isset($_POST["edit-about-h"])) $manage->editHeader($_POST["about-header"], "about");
	else if(isset($_POST["edit-about-s-h"])) $manage->editDesc($_POST["about-s-header"], "about");
	else if(isset($_POST["edit-vac-s-header"])) $manage->editDesc($_POST["vac-s-header"], "vacancy");
	else if(isset($_POST["edit_other_h"])) $manage->editOtherH();
	else if(isset($_POST["edit_other_s_h"])) $manage->editOtherSecH();
	else if(isset($_POST["edit_other_ftext"])) $manage->editOtherFT();
	else if(isset($_POST["edit-vacancy"])) $manage->editVacancy();
	else if(isset($_POST["edit-port-link"])) $manage->editPortImg();
	else if(isset($_POST["edit-port-url"])) $manage->editPortURL();
	else if(isset($_POST["edit_pdf"])) $manage->editPDF();
	else if(isset($_POST["delete_project"])) $manage->DeleteProject();
	else if(isset($_POST["delete_section"])) $manage->DeleteSection();
	else if(isset($_POST["delete_vac"])) $manage->DeleteVacancy();
	else if(isset($_POST["delete_port"])) $manage->DeletePort();
	else if(isset($_POST["ajaxcont"])){
		require_once "../core/db_class.php";
		require_once "../core/module_class.php";
		require_once "../view_classes/projects_class.php";
		$db = DB::getInstance();
		$projects = new Projects(array());
		$limit = strip_tags(htmlspecialchars($_POST["limit"]));
		echo $projects->getPortfolios($limit, true) != false ? $projects->getPortfolios($limit, true) : "err";
	}
	else{
		header("Location: /");
		exit;
	}
} else {
	header("Location: /");
	exit;
}

?>