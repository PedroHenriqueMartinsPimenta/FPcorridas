<?php
	session_start();
	if (isset($_GET['id']) && isset($_SESSION['user'])) {
		include_once('conexao.php');
		$id = $_GET['id'];
		if ($id == 1) {
			// Increver em evento
			$codigo = $_GET['codigo'];
			$brinde = $_POST['kit'];
			$atleta = $_SESSION['user']['codigo'];
			$sql = "SELECT * FROM prova WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			$prova = mysqli_fetch_array($query);
			$sql = "SELECT * FROM brinde WHERE CODIGO = $brinde";
			$query = mysqli_query($con, $sql);
			$brinde_row = mysqli_fetch_array($query);
			if($prova['PRC_INSCRICAO'] + $brinde_row['VALOR'] > 0){
				$pagamento = 0;
				$msg = "Inscrição feita com sucesso! Finalize o pagamento";
			}else{
				$pagamento = 1;
				$msg = "Inscrição feita com sucesso!";
			}
 			$data = date('Y-m-d h:i:s');
 			$sql = "INSERT inscrito (DATA, PAGO, ATIVO, atleta_CODIGO, prova_CODIGO, brinde_CODIGO) VALUES('$data', $pagamento, 1, $atleta, $codigo, $brinde)";
 			$query =mysqli_query($con, $sql);
 			if ($query) {
 				$_SESSION['sucess'] = $msg;
 				header('location: ../user/minhas_corridas.php');
 			}else{
 				$_SESSION['erro'] = mysqli_error($con);
 				header('location: ../inscricao.php?codigo=' . $codigo);
 			}
		}else if ($id == 2) {
			// Cancelar

			$codigo = $_GET['codigo'];
			$sql = "DELETE FROM inscrito WHERE CODIGO = $codigo";
			$query =mysqli_query($con, $sql);
 			if ($query) {
 				$_SESSION['sucess'] = "Corrida cancelada";
 				header('location: ../user/minhas_corridas.php');
 			}else{
 				$_SESSION['erro'] = mysqli_error($con);
 				header('location: ../user/minhas_corridas.php');
 			}
		}
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../');
	}
?>