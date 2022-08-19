<?php
	session_start();
	if (isset($_GET['id']) && isset($_SESSION['user'])) {
		include_once('conexao.php');
		include_once('../config/link.php');
		include_once('upload.php');
		$id = $_GET['id'];
		if ($id == 1) {
			// Adiciona novo parceiro
			$nome = $_POST['nome'];
			$tel = $_POST['telefone'];
			$contribuicao = $_POST['contribuicao'];
			$logo = $_FILES['logo'];
			$url_logo = upload($logo, $url);
			$corrida = $_POST['corrida'];

			$sql = "INSERT INTO parceria (NOME, TELEFONE, LOGO, CONTRIBUICAO, prova_CODIGO) VALUES('$nome', '$tel', '$url_logo', $contribuicao, $corrida)";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['sucess'] = "Parceiro cadastrado com sucesso!";
				header('location: ../user/admin/parceiros.php');
			}else{
				$_SESSION['erro'] = mysqli_error($con);
				header('location: ../user/admin/novo_parceiro.php');
			}
		}
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../');
	}
?>