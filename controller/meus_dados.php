<?php
	session_start();
	if (isset($_GET['id']) && isset($_SESSION['user'])) {
		include_once('conexao.php');
		include_once('upload.php');
		include_once('../config/link.php');
		$id = $_GET['id'];
		if ($id == 1) {
			// Alterar dados Pessoais
			$codigo = $_SESSION['user']['codigo'];
			$nome = $_POST['nome'];
			$sobrenome = $_POST['sobrenome'];
			$email = $_POST['email'];
			$sexo = $_POST['sexo'];
			$nasc = $_POST['nasc'];
			$tel = $_POST['tel'];
			$bancario = $_POST['bancario'];
			$foto = $_FILES['perfil'];
			if ($foto['name'] != "") {
				$perfil_url = upload($foto, $url);
				$sql = "UPDATE usuario SET NOME = '$nome', SOBRENOME = '$sobrenome', EMAIL = '$email', SEXO = '$sexo', NASC = '$nasc', TELEFONE = '$tel', BANCARIO = '$bancario',PERFIL = '$perfil_url' WHERE CODIGO = $codigo";
			}else{
				$sql = "UPDATE usuario SET NOME = '$nome', SOBRENOME = '$sobrenome', EMAIL = '$email', SEXO = '$sexo', NASC = '$nasc', TELEFONE = '$tel', BANCARIO = '$bancario' WHERE CODIGO = $codigo";
			}
			$query = mysqli_query($con, $sql);
			if ($query) {
				$_SESSION['sucess'] = "Dados atualizados com sucesso!";
				header('location: ../user/meus_dados.php');
			}else{
				$_SESSION['erro'] = mysqli_error($con);
				header('location: ../user/meus_dados.php');
			}

		}else if ($id == 2) {
			// Alterar Senha
			$codigo = $_SESSION['user']['codigo'];
			$senha = md5($_POST['senha']);
			$senha_c = md5($_POST['senha_c']);
			if ($senha == $senha_c) {
				$sql = "UPDATE usuario SET PASSWORD = '$senha' WHERE CODIGO = $codigo";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$_SESSION['sucess'] = "Dados atualizados com sucesso!";
					header('location: ../user/meus_dados.php');
				}else{
					$_SESSION['erro'] = mysqli_error($con);
					header('location: ../user/meus_dados.php');
				}
			}else{
				$_SESSION['erro'] = "Senha diferentes, verifique e tente novamente!";
				header('location: ../user/meus_dados.php');
			}
		}
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../');
	}
?>