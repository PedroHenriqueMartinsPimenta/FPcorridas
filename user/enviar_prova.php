<?php
	$titulo = "Enviar prova";
	include_once('../config/link.php');
	include_once('../content/header.php');
	include_once('../content/nav.php');
	if (isset($_SESSION['user']['codigo'])) {
		include_once('../controller/conexao.php');
		$codigo = $_GET['codigo'];
		$hoje = date('Y-m-d');
		$sql = "SELECT * FROM inscrito INNER JOIN prova ON inscrito.prova_CODIGO = prova.CODIGO WHERE inscrito.CODIGO = $codigo AND prova.DATA >= '$hoje'";
		$query = mysqli_query($con,$sql);
		if (mysqli_num_rows($query) > 0) {
	?>
	<div class="row">
		<div class="col-md-12">
			<form action="../controller/resultado.php?id=1&codigo=<?php echo $codigo?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6 mb-5">
						<label>Informe o seu tempo (HH:MM:SS):</label>
						<input type="time" name="tempo" step="1" required>
					</div>
					<div class="col-md-6 mb-5">
						<label>Selecione o treino: </label>
						<input type="file" name="arquivo" required>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-md-12">
						<button type="submit" class="col-md-3">Enviar</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<?php
	}else{
		?>
		<div class="row">
			<div class="col-12">
				<h3>Envio dos resultados encerrados :(</h3>
				<a href="minhas_corridas.php" class="btn btn-warning">Voltar</a>
			</div>
		</div>
		<?php
	}
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../login.php');
	}
	include_once('../content/footer.php');
?>