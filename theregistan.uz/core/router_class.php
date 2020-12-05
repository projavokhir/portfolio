<?php
class Router{

private $url;
private $routes;
protected $view;

public function __construct(){
$this->view = new View();
$url = $_SERVER["REQUEST_URI"];
$this->url = (trim($url, "/") != "") ? trim($url, "/"): "/";
$this->routes = require_once __DIR__."/routes.php";
}

public function Route(){
$route = $this->addRoute();
if(!$route) {$this->view->notFound(); return;}
$controller = new $route["controller"]($route["params"]);
if(!method_exists($controller, $route["method"])){ $this->view->notFound(); return false; exit; }
$method = $route["method"];
$controller->$method();
}

private function addRoute(){
$match = $this->Match($this->routes);
if(!$match) $this->view->notFound();
return $match;
}

protected function ParseParams(){
	$params = explode("/", $this->url);
	array_splice($params, 0, 1);
	return $params;
}

private function Match($route){
	
$matches = [];
$params = [];
for($i = 0; $i < count($route); $i++){
if( preg_match($route[$i]["pattern"], $this->url, $matches)){
	define("CONTROLLER", array_shift($matches));
	return [
		"params" 	 => $this->ParseParams(),
		"controller" => $this->routes[$i]["controller"],
		"method" => $this->routes[$i]["method"]
	 ];
	}
}
}
/*  The end of the Class  */
}

?>