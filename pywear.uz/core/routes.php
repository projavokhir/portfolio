<?php

return array(
array(  
		"pattern" 	 => "/(^\/$)|(^index$)/i",
		"controller" => "Index",
		"method" 	 => "show_content"
),
array(  
		"pattern" 	 => "/^product\/([a-z0-9\-\+\_])*$/i",
		"controller" => "Product_view",
		"method" 	 => "show_product"
),
array(  
		"pattern" 	 => "/^products\/cat\/([a-z0-9\-\+\_])*$/i",
		"controller" => "Product_view",
		"method" 	 => "show_by_cat"
),
array(
		"pattern" 	 => "/^news$/i",
		"controller" => "SiteData",
		"method" 	 => "showNews"
),
array(
		"pattern" 	 => "/^franchise$/i",
		"controller" => "SiteData",
		"method" 	 => "showFranshize"
),
array(
		"pattern" 	 => "/^vacancy$/i",
		"controller" => "SiteData",
		"method" 	 => "showVacancy"
),
array(
		"pattern" 	 => "/^about$/i",
		"controller" => "SiteData",
		"method" 	 => "showAbout"
),
array(
		"pattern" 	 => "/^contact$/i",
		"controller" => "SiteData",
		"method" 	 => "showContact"
),
array(
		"pattern" 	 => "/^deliver$/i",
		"controller" => "SiteData",
		"method" 	 => "showDeliver"
),
array(
		"pattern" 	 => "/^payment$/i",
		"controller" => "SiteData",
		"method" 	 => "showPayments"
),
array(
		"pattern" 	 => "/^refund$/i",
		"controller" => "SiteData",
		"method" 	 => "showRefund"
),
array(
		"pattern" 	 => "/^sizes$/i",
		"controller" => "SiteData",
		"method" 	 => "showSizes"
),
array(
		"pattern" 	 => "/^offer$/i",
		"controller" => "SiteData",
		"method" 	 => "showNews"
),
array(  
		"pattern" 	 => "/^search\?q\=/i",
		"controller" => "Search_view",
		"method" 	 => "getResults"
),
array(  
		"pattern" 	 => "/(^admin$)|(^admin\/([a-z0-9\_\-\+\.\/\=])*$)/i",
		"controller" => "CPanel_view",
		"method" 	 => "ManagaControlPanel"
)
);

?>