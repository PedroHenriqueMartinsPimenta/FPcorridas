<?php
	session_start();
	$email = $_POST['email'];
	$assunto = $_POST['assunto'];
	$message = $_POST['message'] . "\n\n (" . $email . ")";
	$to = "fpcorridas@gmail.com";
	mail($to, $assunto, $message);
	$_SESSION['sucess'] = "Prontinho! Vamos entrar em contato por e-mail assim que possível ;)";
	header('location: ../parceria.php');
?>