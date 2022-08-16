<?php
	session_start();
	if (isset($_GET['id']) && isset($_SESSION['user'])) {
		include_once('conexao.php');
		$id = $_GET['id'];
		if ($id == 1) {
			// Apagar corrida
			$codigo = $_GET['codigo'];
			$sql = "DELETE FROM midia WHERE prova_CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$sql = "DELETE FROM prova WHERE CODIGO = $codigo";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$_SESSION['sucess'] = "Prova removida";
					header('location: ../user/admin/corridas.php');
				}else{
					$_SESSION['erro'] = mysqli_error($con);
					header('location: ../user/admin/corridas.php');
				}	
			}else{
				$_SESSION['erro'] = mysqli_error($con);
				header('location: ../user/admin/corridas.php'); 
			}
						
		}
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../');
	}
?>