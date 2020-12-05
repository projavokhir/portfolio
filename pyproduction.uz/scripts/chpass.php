<?php
if(isset($_POST)){
if(isset($_POST["ch_pass"])){
$pass = trim(htmlspecialchars($_POST["new_pass"]));
$re_pass = trim(htmlspecialchars($_POST["re_pass"]));
$email = $_SESSION["email"];
if($pass === $re_pass){
	$q = $this->user->updatePass(md5($pass), $email);
	if($q){
		header("Location: /admin");
		$_SESSION["login_message"] = "Пароль изменён";
		unset($_SESSION["email"]);
		unset($_SESSION["secure_code"]);
		exit;
	}
	else{
		header("Location: /admin");
		$_SESSION["login_message"] = "Произошла ошибка при изменении пароля";
		exit;
	}
}
}
}

?>