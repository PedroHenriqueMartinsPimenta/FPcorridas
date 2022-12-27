<?php
	$id = 0;
	if (isset($_GET['id'])) {
		session_start();
		include_once("conexao.php");
		include_once('../config/link.php');
		$id = $_GET['id'];
	}else{
		?>
			<h1>Erro 404 - Página não encontrada</h1>
		<?php
	}
	if ($id == 1) {
		// Enviar e-mail com código
		$email = $_POST['email'];
		$sql = "SELECT * FROM usuario WHERE EMAIL = '$email'";
		$query = mysqli_query($con, $sql);
		if (mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_array($query);
			$code = md5(rand(10000, 99999));
			$link = $url . "esqueci_senha.php?code=" . $code . "&user=" . base64_encode($row['CODIGO']);
			$_SESSION['senha']['code'] = $code;
			$message = "Aqui está o link para alteração da senha: \n" . $link;
			mail($email, "Alterar senha", $message);
		}
		$_SESSION['sucess'] = "E-mail enviado :)";
		header('location: ../esqueci_senha.php');
	}else if ($id == 2) {
		// Alterar Senha
			$codigo = base64_decode($_GET['code']);
			$senha = md5($_POST['senha']);
			$senha_c = md5($_POST['senha_c']);
			if ($senha == $senha_c) {
				$sql = "UPDATE usuario SET PASSWORD = '$senha' WHERE CODIGO = $codigo";
				$query = mysqli_query($con, $sql);
				if ($query) {
					$_SESSION['sucess'] = "Dados atualizados com sucesso!";
					header('location: ../login.php');
				}else{
					$_SESSION['erro'] = mysqli_error($con);
					header('location: ../login.php');
				}
			}else{
				$_SESSION['erro'] = "Senha diferentes, verifique e tente novamente!";
				header('location: ../login.php');
			}
	}
?>