<?php
	session_start();
	include_once('conexao.php');
	if (isset($_SESSION['user']) && $_SESSION['user']['permissao'] == 1) {
			$inscricao = $_GET['codigo'];
			$sql = "UPDATE inscrito SET PAGO = 1 WHERE CODIGO = $inscricao";
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['sucess'] = "Pagamento confirmado!";
				header('location: ../user/admin/inscritos.php');
			}else{

				$_SESSION['error'] = mysqli_error($con);
				header('location: ../user/admin/inscritos.php');
			}
	}else{
		$_SESSION['error'] = "Você não tem permissão!";
		header('location: ../');
	}
?>