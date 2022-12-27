<?php
	session_start();
	include_once('../../controller/conexao.php');
	if (isset($_SESSION['user']) && isset($_GET['p'])) {
		$evento = base64_decode($_GET['p']);
		$codigo = $_SESSION['user']['codigo'];
		$sql = "UPDATE inscrito SET PAGO = 1 WHERE atleta_CODIGO = $codigo AND prova_CODIGO = $evento";
		$query = mysqli_query($con, $sql);
		if ($query) {
			$_SESSION['sucess'] = "Pagamento confirmado! Obrigado!";
			header('location: ../minhas_corridas.php');
		}else{
			$_SESSION['erro'] = "<b>Erro</b> Entre em contato com o administrador para confirmar o pagamento!";
			header('location: ../minhas_corridas.php');
		}
	}else{
		$_SESSION['erro'] = "<b>Erro</b> Entre em contato com o administrador para confirmar o pagamento!";
		header('location: ../../');
	}
?>