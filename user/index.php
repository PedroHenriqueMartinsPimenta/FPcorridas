<?php
	$titulo = "Área do atleta";
	include_once('../config/link.php');
	include_once('../content/header.php');
	include_once('../content/nav.php');
	if (isset($_SESSION['user']['codigo'])) {
		$titulo = $_SESSION['user']['nome'];
	?>
	<h2>Seja bem vindo(a) <?php echo $_SESSION['user']['nome'] ?>!</h2>
	<div class="row">
		<div class="col-12">
			<a href="minhas_corridas.php" class="btn btn-warning">Minhas provas</a>
		</div>
	</div>
	<?php
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../login.php');
	}
	include_once('../content/footer.php');
?>