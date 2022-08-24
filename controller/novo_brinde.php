<?php
	session_start();
	if (isset($_GET['id']) && isset($_SESSION['user'])) {
		include_once('conexao.php');
		$id = $_GET['id'];
		if ($id == 1) {
			// Adiciona novo parceiro
			$desc = $_POST['desc'];
			$valor = $_POST['valor'];
			
			$sql = "INSERT INTO brinde (DESCRICAO, VALOR) VALUES('$desc', '$valor')";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['sucess'] = "Parceiro cadastrado com sucesso!";
				header('location: ../user/admin/brinde.php');
			}else{
				$_SESSION['erro'] = mysqli_error($con);
				header('location: ../user/admin/novo_brinde.php');
			}
		}
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../');
	}
?>