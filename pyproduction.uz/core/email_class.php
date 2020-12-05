<?php

class Email{

private $db;
private $table_name;
private $admin_mail = "prostojparen.java@gmail.com";

public function __construct($db){
$this->db = $db;
$this->table_name = "mails";
}

public function issetEmail($email){
	$check = $this->db->getItemByField($this->table_name, "`email`='$email'");
	if(gettype($check) == "boolean" && $check == false) return false;
	return true;
}

public function insertMail($fields){
	return $this->db->insert($this->table_name, $fields);
}

//function send RAS messages
public function sendMail($title, $controller, $link){
$mails = $this->db->getAllSortById_Up($this->table_name);
$subject = "Блог ".SITE_NAME.". В блоге появилась новая статья.";
$headers = "Content-type: text/html; charset=utf-8 \r\n";
$headers .= "From: ".$this->admin_mail."\r\n";
$headers .= "Reply-To: no-replay@mail.ru\r\n";
$link = SITE_ADDRESS.$controller."/".$link;
if(count($mails) != 0){
	for($i = 0; $i < count($mails); $i++){
	$to = $mails[$i]["email"];
	$user_name = $mails[$i]["name"];
	$message =
	"<p>Добрый день ".$user_name.". На сайте появилась новая статья.</p>
		<p>Статья называется ".$title.". Чтобы посмотреть статью перейдите по ссылке ниже:</p><br />
		<a href='".$link."' title='Ссылка для статьи'>".$link.".</a><br />
		<p>Если хотите ознакомиться с нашим блогом перейдите по этой ссылке:</p><br />
		<a href='".SITE_ADDRESS."about' title='О блоге'>".SITE_ADDRESS."'about</a><br />
		<p>Если хотите отписаться от этих сообщений вот ссылка:</p><br />
		<a href='".SITE_ADDRESS."desubscribe' title='Отписаться'>".SITE_ADDRESS."desubscribe</a><br />";

if(!mail($to, $subject, $message, $headers)){
	$f_name = "ini_files/errors_mail.txt";
	$file = fopen($f_name, "w");
	fwrite($file, "Error sending mail to".$mails[$i]["mail"]);
	fclose($file);
}
}
}	else return false;
}

}

?>