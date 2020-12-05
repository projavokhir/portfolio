<?php

class Product_view extends View{

protected $key;
protected $all_params;
private $title;
private $meta_desc;
private $meta_key;
private $params;
private $products_count = 9;

public function __construct($params){
	parent::__construct();
	$this->params = $params;
	$this->all_params = $params;
	$this->key = array_shift($params);
}

public function getTitle($cat){
	$title = SITE_NAME." &nbsp;&#8211;&nbsp; ";
	switch($cat){
	}
	return $title;
}

public function getMainAjaxContent($limit){
	$products = $this->products->getAllSByDLimit($limit);
	$cont = "";
	if(!$products || count($products) == 0){echo "err"; return;}
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
		$cont .= $this->getReplacedContent($ar, "product_review", true);
	}
	return $cont;
}

public function show_by_cat(){
	$cat = $this->params[1];
	$this->title = $this->getTitle($cat);
	$this->meta_desc = $this->getTitle($cat);
	$this->meta_key = $this->getTitle($cat);
	$sr["filters"] = $this->getFilter($cat);
	$sr["products"] = $this->getProducts($cat);
	$cont = $this->getReplacedContent($sr, "products_isotope");
	$this->Render($this->title, $this->meta_desc, $this->meta_key, $cont);
}

public function show_product(){
	$product = $this->products->getProduct($this->key);
	if(!$product) return $this->notFound();
	$this->title = $product["name"];
	$this->meta_desc = $product["name"];
	$this->meta_key = mb_strtolower($product["name"]);

	$sr["pr_id"] = $product["id"];
	$sr["images"] = $this->addGallery($product["images"]);
	$sr["name"] = $product["name"];
	$sr["price"] = $product["price"];
	$sr["desc"] = $product["description"];
	$sr["factors"] = $this->addFacotrs($product["factors"]);
	$sr["related"] = $this->addRelated();

	$cont = $this->getReplacedContent($sr, "product_detailed");
	$this->Render($this->title, $this->meta_desc, $this->meta_key, $cont);
}

private function addGallery($images){
	if($images == "") return $this->getReplacedContent(array("image_link" => "/".MAIN_DIR."images/no_pr_cover.jpg") ,"product_detailed_gallery");
	$gallery = explode(",", $images);
	$text = "";

	for($i = 0; $i < count($gallery); $i++){
		$sr["image_link"] = $gallery[$i];
		$text .=	$this->getReplacedContent($sr, "product_detailed_gallery");
	}
	return $text;
}


private function addFacotrs($factors){
	$fac = "";
	if(strlen($factors) > 4) $fac = !json_decode($factors) ? "" : json_decode($factors);
	$text = "";
	if(!is_string($fac) && strlen($factors) > 4){
		foreach($fac as $key => $value){
			$sr["key"] = $key;
			$sr["value"] = $value;
			$text .= $this->getReplacedContent($sr, "product_detailed_factors");
		}
	} 
	return $text;
}

private function addRelated(){
	$inting = $this->products->getInterestingProducts($this->key, 4);
	$text = "";
	for($i = 0; $i < count($inting); $i++){
		$cover = explode(",", $inting[$i]["images"]);
		$cover = $cover[0];
		$sr["link"] = $inting[$i]["alias"];
		$sr["image_link"] = $cover;
		$sr["name"] = $inting[$i]["name"];
		$sr["price"] = $inting[$i]["price"];
		$text .= $this->getReplacedContent($sr, "product_detailed_related");
	}
	if(count($inting) == 0) $text = $this->getContent("no_related");
	return $text;
}

private function getProducts($cat){
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
$script["sort"] = $cat;
$text .= $this->getReplacedContent($script, "isotope_script");
	return $text;
}


}
?>