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
						
		}else if($id == 2){
			//Ativa / Desativa Corrida
			$codigo = $_GET['codigo'];
			$status = $_GET['status'];
			if ($status == 1) {
				$status = 0;
			}else{
				$status = 1;
			}
			$sql = "UPDATE prova SET DISPONIVEL = $status WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['sucess'] = "Corrida atualizada";
				header('location: ../user/admin/corridas.php'); 
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