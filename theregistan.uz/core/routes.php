<?php

return array(
array(  
		"pattern" 	 => "/(^\/$)|(^index$)/i",
		"controller" => "Index",
		"method" 	 => "show_content"
),
array(  
		"pattern" 	 => "/^article\/cat\/([a-z0-9\-\+\.\/]*)$/i",
 		"controller" => "Article_view", 
 		"method" 	 => "showArticles"
),
array(  
		"pattern" 	 => "/^article\/[a-z0-9\-\+\_]*$/i",
		"controller" => "Article_view",
		"method" 	 => "show_article"
),
array(
		"pattern" 	 => "/^edition$/i",
		"controller" => "SiteData",
		"method" 	 => "showContent"	
),
array(
		"pattern" 	 => "/^terms$/i",
		"controller" => "SiteData",
		"method" 	 => "showContent"	
),
array(
		"pattern" 	 => "/^ad$/i",
		"controller" => "SiteData",
		"method" 	 => "showContent"	
),
array(
		"pattern" 	 => "/^contacts$/i",
		"controller" => "SiteData",
		"method" 	 => "showContent"	
),
array(  
		"pattern" 	 => "/(^admin$)|(^admin\/([a-z0-9\_\-\+\.\/])*$)/i",
		"controller" => "CPanel_view",
		"method" 	 => "ManagaControlPanel"
)
);

?>