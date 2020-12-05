<?php
$link = "";
require_once "../core/manage_class_1.php";

if(isset($_POST)){
$manage = new Manage();
	if(isset($_POST["subcribe_email"])) $manage->SubscribeEmail();
	else if(isset($_POST["add_product"])) $manage->addProduct();
	else if(isset($_POST["edit_product"])) $manage->editProduct();
	else if(isset($_POST["edit_g_item"])) $manage->editGItem();
	else if(isset($_POST["edit_products_d"])) $manage->EditProductsData();
	else if(isset($_POST["edit_products_d"])) $manage->EditProductsData();
	else if(isset($_POST["edit_block_1"])) $manage->EditBlock1();
	else if(isset($_POST["edit_block_2"])) $manage->EditBlock2();
	else if(isset($_POST["delete"])) $manage->deleteProduct();
	else if(isset($_POST["delete_g_item"])) $manage->deleteGItem();
	else if(isset($_POST["add_g_item"])) $manage->addGItem();
	else if(isset($_POST["ajaxcont"])){
		require_once "../core/module_class.php";
		require_once "../core/db_class.php";
		require_once "../view_classes/product_view_class.php";
		$db = DB::getInstance();
		$article = new Product_view(array());
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