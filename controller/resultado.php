<?php
	session_start();
	if (isset($_GET['id']) && isset($_SESSION['user'])) {
		include_once('conexao.php');
		include_once('../config/link.php');
		include_once('upload.php');
		$id = $_GET['id'];
		if ($id == 1) {
			// Adiciona novo parceiro
			$codigo = $_GET['codigo'];
			$arquivo = $_FILES['arquivo'];
			$arquivo_url = upload($arquivo, $url);
			$data = date('Y-m-d h:i:s');
			$hora = $_POST['hora'];
			$minutos = $_POST['minuto'];
			$segundos = $_POST['segundo'];

			$sql = "INSERT INTO resultado (DATA, LINK, HORA, MINUTO, SEGUNDO,VALIDADO, PAGO, PG_COMPROVANTE, inscrito_CODIGO) VALUES('$data', '$arquivo_url', $hora, $minutos, $segundos, 0, 0, '0', $codigo)";
			
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['sucess'] = "Obrigado pelo envio!<br>Agora é só aguardar o resultado";
				header('location: ../user/minhas_corridas.php');
			}else{
				$_SESSION['erro'] = mysqli_error($con);
				header('location: ../user/enviar_prova.php?codigo='.$codigo);
			}
		}
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../');
	}
?>