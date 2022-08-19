<?php
	session_start();
	if (isset($_GET['id']) && isset($_SESSION['user'])) {
		include_once('conexao.php');
		include_once('../config/link.php');
		include_once('upload.php');
		$id = $_GET['id'];
		if ($id == 1) {
			// Adiciona novo parceiro
			$codigo = $_GET['codigo'];

			$sql = "DELETE FROM parceria WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['sucess'] = "Parceiro deletado com sucesso!";
				header('location: ../user/admin/parceiros.php');
			}else{
				$_SESSION['erro'] = mysqli_error($con);
				header('location: ../user/admin/parceiros.php');
			}
		}
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../');
	}
?>