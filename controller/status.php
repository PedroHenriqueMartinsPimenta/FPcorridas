<?php
	session_start();
	include_once('conexao.php');
	if (isset($_SESSION['user']) && $_SESSION['user']['permissao'] == 1) {
			$inscricao = $_POST['codigo'];
			$status = $_POST['status'];
			$sql = "UPDATE inscrito SET ATIVO = $status WHERE CODIGO = $inscricao";
			$query = mysqli_query($con, $sql);
			if ($query) {
				echo json_encode(1);
			}else{
				echo json_encode(0);
			}
	}else{
		$_SESSION['error'] = "Você não tem permissão!";
		header('location: ../');
	}
?>