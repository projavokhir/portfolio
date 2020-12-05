<?php
$link = "";
require_once "../core/manage_class_1.php";

if(isset($_POST)){
$manage = new Manage();
	if(isset($_POST["subcribe_email"])) $manage->SubscribeEmail();
	else if(isset($_POST["add_post"])) $manage->addPost();
	else if(isset($_POST["edit_post"])) $manage->editPost();
	else if(isset($_POST["delete"])) $manage->deletePost();
	else if(isset($_POST["edit_img"])) $manage->editSlider();
	else if(isset($_POST["ajaxcont"])){
		require_once "../core/module_class.php";
		require_once "../core/db_class.php";
		require_once "../view_classes/article_view_class.php";
		$db = DB::getInstance();
		$article = new Article_view(array());
		$limit = strip_tags(htmlspecialchars($_POST["limit"]));
		if(isset($_POST["category"]) && $_POST["category"] != ""){
			$cat = strip_tags(htmlspecialchars($_POST["category"]));
			echo $article->getCatAjaxContent($limit, $cat);
		}
		else echo $article->getMainAjaxContent($limit);
		exit;
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