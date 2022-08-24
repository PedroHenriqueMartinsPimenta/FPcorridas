<?php
	session_start();
	if (isset($_GET['id']) && isset($_SESSION['user'])) {
		include_once('conexao.php');
		include_once('../config/link.php');
		include_once('upload.php');
		$id = $_GET['id'];
		if ($id == 1) {
			// Atualizar corrida
			$codigo = $_GET['codigo'];
			$nome = $_POST['nome'];
			$dia = $_POST['dia'];
			$desc = str_replace("\n", "<br>", $_POST['desc']);
			$ins_inicio = $_POST['ins_inicio'];
			$ins_fim = $_POST['ins_fim'];
			$preco = $_POST['preco'];
			$distancia = $_POST['distancia'];
			$elevacao = $_POST['elevacao'];
			$categoria = $_POST['categoria'];
			$usuario = $_SESSION['user']['codigo'];

			$sql = "UPDATE prova SET NOME = '$nome', DATA = '$dia', DESCRICAO = '$desc', INSC_MIN = '$ins_inicio', INSC_MAX = '$ins_fim', PRC_INSCRICAO = $preco, DISTANCIA = $distancia, ELEVACAO = $elevacao, CATEGORIA = $categoria, usuario_CODIGO = $usuario WHERE CODIGO = $codigo";
			$query = mysqli_query($con, $sql);
			if($query){
				$_SESSION['sucess'] = "Corrida atualizada";
				header('location: ../user/admin/corridas.php'); 
			}else{
				$_SESSION['erro'] = mysqli_error($con);
				header('location: ../user/admin/atualizar_corrida.php?codigo=' . $codigo); 
			}
			
		}else if($id == 2){
			// atualizar arquivos
			$codigo = $_GET['codigo'];
			$edital = $_FILES['edital'];
			$midia = $_FILES['midia'];
			$sucesso = true;
			if ($edital['size'] > 0) {
				$url_edital = upload($edital, $url);
				$sql = "UPDATE prova SET EDITAL = '$url_edital' WHERE CODIGO = $codigo";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$_SESSION['sucess'] .= "Edital atualizado <br>";
				}else{
					$sucesso = false;
					$_SESSION['erro'] .= mysqli_error($con)."<br>";
				}
			}
			if ($midia['size'] > 0) {
				$url_midia = upload($midia, $url);
				$sql = "UPDATE midia SET LINK = '$url_midia' WHERE prova_CODIGO = $codigo";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$_SESSION['sucess'] .= "Midia atualizada";
				}else{
					$sucesso = false;
					$_SESSION['erro'] .= mysqli_error($con)."<br>";
				}
			}

			if ($sucesso) {
				header('location: ../user/admin/corridas.php');
			}else{
				header('location: ../user/admin/atualizar_corrida.php?codigo=' . $codigo);
			}
		}
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../');
	}
?>