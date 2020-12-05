<?php
if(isset($_POST["login"])){

$login = trim(htmlspecialchars($_POST["username"]));
$password = md5(trim(htmlspecialchars($_POST["password"])));
echo $this->user->getUser($login, $password);
$user =	$this->user->getUser($login, $password);
if(!$user){
	header("Location: /admin");
	$_SESSION["login_message"] = "Неправильный логин и/или пароль";
	exit;
}else{
	$_SESSION["user"] = $user["login"];
	$_SESSION["username"] = $user["username"];
	$_SESSION["password"] = $user["password"];
	header("Location: /admin");
	exit;
}

}
?>