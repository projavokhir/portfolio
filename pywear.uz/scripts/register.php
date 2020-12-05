<?php
if(isset($_POST["register"])){
$name = trim(htmlspecialchars($_POST["username"]));
$email = trim(htmlspecialchars($_POST["email"]));
$login = trim(htmlspecialchars($_POST["log_name"]));
$pass = trim(htmlspecialchars($_POST["password"]));
$re_pass = trim(htmlspecialchars($_POST["re_password"]));
$secret = trim(htmlspecialchars($_POST["secret"]));
if(!empty($name) || !empty($emai) || !empty($login) || !empty($pass) || !empty($re_pass) || !empty($re_pass)){
if($secret == USER_HASH){
	if($pass == $re_pass){
		$pass = md5($pass);
		if(!$this->user->getUserByLogin($login, $email)) $req = $this->user->addUser(array("login" => $login, "password" => $pass, "username" => $name, "email" => $email, "regdate" => time()));
		else{
			header("Location: /admin/register");
			$_SESSION["reg_message"] = "Данный пользователь или email уже существует";
			exit;		
		}
		if($req){
			header("Location: /admin");
			$_SESSION["login_message"] = "Вы успешно зарегистрированы";
			exit;
		} else{
			header("Location: /admin/register");
			$_SESSION["reg_message"] = "Произошла ошибка, повторите попытку";
			exit;
		}
	} else {
			header("Location: /admin/register");
			$_SESSION["reg_message"] = "Пароли не совпадают";
			exit;
	}
} else {
		header("Location: /admin/register");
			$_SESSION["reg_message"] = "Секретный код введён неверно";
			exit;
	}
}
}
?>