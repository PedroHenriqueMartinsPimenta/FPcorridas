<?php
	$id = 0;
	if (isset($_GET['id'])) {
		session_start();
		include_once("conexao.php");
		$id = $_GET['id'];
	}else{
		?>
			<h1>Erro 404 - Página não encontrada</h1>
		<?php
	}
	if ($id == 1) {
		// Entrar / login
		$email = $_POST['email'];
		$senha = md5($_POST['senha']);

		$sql = "SELECT * FROM usuario WHERE EMAIL = '$email' AND PASSWORD = '$senha' LIMIT 1";

		$query = mysqli_query($con, $sql);
		echo mysqli_error($con);
		if ($query) {
			if (mysqli_num_rows($query) > 0) {
				$dados = mysqli_fetch_array($query);
				$_SESSION['user']['codigo'] = $dados['CODIGO'];
				$_SESSION['user']['nome'] = $dados['NOME'];
				$_SESSION['user']['sobrenome'] = $dados['SOBRENOME'];
				$_SESSION['user']['email'] = $dados['EMAIL'];
				$_SESSION['user']['nasc'] = $dados['NASC'];
				$_SESSION['user']['telefone'] = $dados['TELEFONE'];
				$_SESSION['user']['permissao'] = $dados['PERMISSAO'];
				$_SESSION['user']['ativo'] = $dados['ATIVO'];
				$_SESSION['sucess'] = "Login feito com sucesso";
				header("location: ../user/");
			}else{
				$_SESSION['erro'] = "Erro: E-mail ou senha incorretos";
				header('location: ../login.php');
			}
			
		}else{
			$_SESSION['erro'] = "Erro: " . mysqli_error($con);
			header('location: ../login.php');
		}
	}else if ($id == 2) {
		// Entrar / login
		$email = $_POST['email'];
		$senha = md5($_POST['senha']);
		$codigo = $_GET['codigo'];

		$sql = "SELECT * FROM usuario WHERE EMAIL = '$email' AND PASSWORD = '$senha' LIMIT 1";

		$query = mysqli_query($con, $sql);
		echo mysqli_error($con);
		if ($query) {
			if (mysqli_num_rows($query) > 0) {
				$dados = mysqli_fetch_array($query);
				$_SESSION['user']['codigo'] = $dados['CODIGO'];
				$_SESSION['user']['nome'] = $dados['NOME'];
				$_SESSION['user']['sobrenome'] = $dados['SOBRENOME'];
				$_SESSION['user']['email'] = $dados['EMAIL'];
				$_SESSION['user']['nasc'] = $dados['NASC'];
				$_SESSION['user']['telefone'] = $dados['TELEFONE'];
				$_SESSION['user']['permissao'] = $dados['PERMISSAO'];
				$_SESSION['user']['ativo'] = $dados['ATIVO'];
				$_SESSION['sucess'] = "Login feito com sucesso";
				header("location: ../inscricao.php?codigo=". $codigo);
			}else{
				$_SESSION['erro'] = "Erro: E-mail ou senha incorretos";
				header('location:  ../inscricao.php?codigo='. $codigo);
			}
			
		}else{
			$_SESSION['erro'] = "Erro: " . mysqli_error($con);
			header('location: ../inscricao.php?codigo='. $codigo);
		}
	}
?>