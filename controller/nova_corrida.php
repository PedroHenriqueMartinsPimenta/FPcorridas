<?php
	session_start();
	if (isset($_GET['id']) && isset($_SESSION['user'])) {
		$id = $_GET['id'];
		if ($id == 1) {
			// Adiciona nova corrida
			$nome = $_POST['nome'];
			$dia = $_POST['dia'];
		}
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../');
	}
?>