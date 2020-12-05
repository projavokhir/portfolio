<?php

class Index extends View{

private $main_title = "PY WEAR - Узбекский бренд уличной одежды";
private $products_count = 0;

public function __construct(){
	parent::__construct();
}

public function notFound(){
	header("HTTP/1.1 404 Not Found");
	header("Status: 404 Not Found");
	$contents = $this->getContent("not_found");
	$title = "Запрощенная страницане найдена - ".SITE_NAME;
	$m_desc = "Запрощенная страницане найдена, 404, Страница не найдена";
	$m_key = "запрощенная страницане найдена, 404, страница не найдена, не найдена";
	$this->Render($title, $m_desc, $m_key, $contents);
	exit;
}

public function show_content(){
	$title = $this->main_title;
	$m_desc = "PY WEAR";
	$m_key = "py, py wear";
	$contents = $this->getIndexContent();
	$this->Render($this->main_title, $m_desc, $m_key, $contents, true, true);
}

protected function getIndexContent(){
	$pr = $this->getSection("products");
	$sr["gallery"] = $this->getGallery();
	$sr["block_1"] = $this->getBlock1();
	$sr["product_h"] = $pr["h"];
	$sr["product_desc"] = $pr["desc"];
	$sr["block_2"] = $this->getBlock2();
	$sr["categories_big"] = $this->getBigCategories();
	$sr["products_isotope"] = $this->getProducts();
	return $this->getReplacedContent($sr, "main_index");
}

private function getBlock1(){
	$c = $this->getSection("block_1");
	$s["block_1_h"] = $c["h"];
	$s["block_1_desc"] = $c["desc"];
	$s["block_1_img"] = $c["img"];
	return $this->getReplacedContent($s, "block_1");
}

private function getBlock2(){
	$c = $this->getSection("block_2");
	$s["block_2_h"] = $c["h"];
	$s["block_2_desc"] = $c["desc"];
	$s["block_2_img"] = $c["img"];
	return $this->getReplacedContent($s, "block_2");
}

private function getAds(){
	return $this->getContent("ads-left-block");
}

private function getGallery(){
	$gallery = $this->getSection("main-bg");
	$text = "";
		$sr["img_link"] = $gallery["img"];
		$text = $this->getReplacedContent($sr, "slick_item");
	$g["slick_items"] = $text;
	return	$this->getReplacedContent($g, "gallery");
}

private function getBigCategories(){
	$filters = $this->products->getCategories();
	$text = "";
	for($i = 0; $i < count($filters); $i++){
		$sr["bootstrap_col"] = ($i <= 1)?"6":"4";
		$sr["image_link"] = $filters[$i]["cover"];
		$sr["link"] = $filters[$i]["alias"];
		$sr["title"] = $filters[$i]["title"];
		$sr["desc"] = $filters[$i]["description"];
		$text .= $this->getReplacedContent($sr, "category_inner");
	}
	return $text;
}

private function getProducts(){
	$products = $this->products->getAllSByDLimit($this->products_count);
	$text = "";
	if(count($products) == 0 || gettype($products) == "boolean"){
		$text = $this->getContent("no_product");
}
else{
for($i = 0; $i < count($products); $i++){
	$cover = explode(",", $products[$i]["images"]);
	$cover = $cover[0];
		$ar["category"] = $products[$i]["category_alias"];
		$ar["if_new"] = ((time() - $products[$i]["time"]) < 3600*48) ? "label-new" : "";
		$ar["label_new"] = ((time() - $products[$i]["time"]) < 3600*48) ? 'data-label="New"' : "";
		$ar["link"] = $products[$i]["alias"];
		$ar["cover_link"] = $cover;
		$ar["name"] = $products[$i]["name"];
		$ar["price"] = $products[$i]["price"];
		$text .= $this->getReplacedContent($ar, "product_review");
	}
}
	$sr["filters"] = $this->getFilter();
	$sr["products"] = $text;
	return $this->getReplacedContent($sr, "products_isotope");
}

}
?>