<?php

if(isset($_POST["remind"])){
$email = trim(htmlspecialchars($_POST["email"]));
$hash = trim(htmlspecialchars($_POST["secret"]));

if($hash === USER_HASH){
	echo "My: hash: ".$hash."<br />";
	$u = $this->user->getUserByEmail($email);
	if(!$u){
		header("Location: /admin/remind");
		$_SESSION["rem_message"] = "Пользователь не найден!";
		exit;
	} else {
			header("Location: /admin/chpass");
			$_SESSION["secure_code"] = USER_HASH;
			$_SESSION["email"] = $email;
			exit;
	}
} else {
		header("Location: /admin/remind");
		$_SESSION["rem_message"] = "Секретный код неверно";
		exit;
}

}

?>