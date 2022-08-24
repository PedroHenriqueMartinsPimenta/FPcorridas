<?php
	session_start();
	if (isset($_GET['id']) && isset($_SESSION['user'])) {
		include_once('conexao.php');
		$id = $_GET['id'];
		if ($id == 1) {
			// Adiciona novo parceiro
			$codigo = $_GET['codigo'];

			$sql = "DELETE FROM brinde WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['sucess'] = "Brinde deletado com sucesso!";
				header('location: ../user/admin/brinde.php');
			}else{
				$_SESSION['erro'] = mysqli_error($con);
				header('location: ../user/admin/brinde.php');
			}
		}else if($id == 2){
			//desativar / ativar
			$codigo = $_GET['codigo'];
			if ($_GET['status'] == 1) {
				$status = 0;
			}else{
				$status = 1;
			}
			$sql = "UPDATE brinde SET ATIVO = $status WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['sucess'] = "Status alterado com sucesso!";
				header('location: ../user/admin/brinde.php');
			}else{
				$_SESSION['erro'] = mysqli_error($con);
				header('location: ../user/admin/brinde.php');
			}
		}
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../');
	}
?>