<?php
	session_start();
	include_once('conexao.php');
	include_once('../config/link.php');
	include_once('upload.php');
	if (isset($_SESSION['user']) && $_SESSION['user']['permissao'] == 1) {
			$codigo = $_GET['codigo'];
			$num = $_GET['num'];
			$pg = $_FILES['pg'];
			$pg_url = upload($pg, $url);
			$sql = "UPDATE resultado SET PG_COMPROVANTE = '$pg_url', PAGO = 1 WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['sucess'] = "Pagamento confirmado!";
				header('location: ../user/admin/resultado.php?codigo='.$num);
			}else{

				$_SESSION['error'] = mysqli_error($con);
				header('location: ../user/admin/resultado.php?codigo='.$num);
			}
	}else{
		$_SESSION['error'] = "Você não tem permissão!";
		header('location: ../');
	}
?>