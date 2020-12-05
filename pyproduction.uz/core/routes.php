<?php

return array(
array(  
		"pattern" 	 => "/(^\/$)|(^index$)/i",
		"controller" => "Index",
		"method" 	 => "show_content"
),
array(  
		"pattern" 	 => "/^project\/([a-z0-9\-\+\_])*$/i",
		"controller" => "Projects",
		"method" 	 => "showProject"
),
array(
		"pattern" 	 => "/^about$/i",
		"controller" => "About",
		"method" 	 => "showcontent"
),
array(
		"pattern" 	 => "/^services$/i",
		"controller" => "Services",
		"method" 	 => "showcontent"
),
array(
		"pattern" 	 => "/^clients$/i",
		"controller" => "Clients",
		"method" 	 => "showcontent"
),
array(
		"pattern" 	 => "/^projects$/i",
		"controller" => "Projects",
		"method" 	 => "showcontent"
),

array(
		"pattern" 	 => "/^contacts$/i",
		"controller" => "About",
		"method" 	 => "getContacts"
),

array(  
		"pattern" 	 => "/(^admin$)|(^admin\/([a-z0-9\_\-\+\.\/])*$)/i",
		"controller" => "CPanel_view",
		"method" 	 => "ManagaControlPanel"
)
);

?>