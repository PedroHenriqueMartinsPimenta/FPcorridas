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
		// Cadastrar cliente
		$nome = $_POST['nome'];
		$sobrenome = $_POST['sobrenome'];
		$email = $_POST['email'];
		$nasc = $_POST['nasc'];
		$phone = $_POST['phone'];
		$sexo = $_POST['sexo'];
		$senha = md5($_POST['senha']);

		$sql = "INSERT INTO usuario (NOME, SOBRENOME, SEXO, EMAIL, NASC, PASSWORD, TELEFONE, PERMISSAO) VALUES('$nome', '$sobrenome', '$sexo', '$email', '$nasc', '$senha', '$phone', 0)";
		$query = mysqli_query($con, $sql);
		if ($query) {
			$_SESSION['sucess'] = "Cadastrado com sucesso, faça o login!";
			header('location: ../login.php');
		}else{
			$_SESSION['erro'] = "Erro: " . mysqli_error($con);
			header('location: ../cadastro.php');
		}
	}
?>