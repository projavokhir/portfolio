<?php
mb_internal_encoding("UTF-8");
session_start();
ob_start();
require_once "load.php";
$router = new Router();
$router->Route();
?>