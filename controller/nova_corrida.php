<?php
	session_start();
	if (isset($_GET['id']) && isset($_SESSION['user'])) {
		include_once('conexao.php');
		include_once('../config/link.php');
		include_once('upload.php');
		$id = $_GET['id'];
		if ($id == 1) {
			// Adiciona nova corrida
			$nome = $_POST['nome'];
			$dia = $_POST['dia'];
			$desc = str_replace("\n", "<br>", $_POST['desc']);
			$ins_inicio = $_POST['ins_inicio'];
			$ins_fim = $_POST['ins_fim'];
			$preco = $_POST['preco'];
			$distancia = $_POST['distancia'];
			$edital = $_FILES['edital'];
			$elevacao = $_POST['elevacao'];
			$categoria = $_POST['categoria'];
			$pg_link = $_POST['pg_link'];
			$midia = $_FILES['midia'];
			$usuario = $_SESSION['user']['codigo'];
			$url_edital = upload($edital, $url);
			$url_midia = upload($midia, $url);

			$sql = "INSERT INTO prova (NOME, DATA, DESCRICAO, INSC_MIN, INSC_MAX, PRC_INSCRICAO, DISTANCIA, EDITAL, ELEVACAO, CATEGORIA, PG_LINK, usuario_CODIGO) VALUES('$nome', '$dia', '$desc', '$ins_inicio', '$ins_fim', $preco, $distancia, '$url_edital', $elevacao, $categoria,'$pg_link', $usuario)";
			echo $sql;
			$query = mysqli_query($con, $sql);
			if($query){
				$sql = "SELECT CODIGO FROM prova WHERE EDITAL = '$url_edital'";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$codigo = mysqli_fetch_array($query)['CODIGO'];
					$sql = "INSERT INTO midia (TIPO, LINK, prova_CODIGO) VALUES (1, '$url_midia', $codigo)";
					$query = mysqli_query($con,$sql);
					if ($query) {
						$_SESSION['sucess'] = "Corrida criada com sucesso!";
						header('location: ../user/admin/corridas.php');
					}else{
						$_SESSION['erro'] = mysqli_error($con);
						header('location: ../user/admin/nova_corrida.php');
					}
				}else{
					$_SESSION['erro'] = mysqli_error($con);
					header('location: ../user/admin/nova_corrida.php');
				}
			}else{
				$_SESSION['erro'] = mysqli_error($con);
				header('location: ../user/admin/nova_corrida.php');
			}			
		}
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../');
	}
?>