<?php
	$titulo = "Nova corrida";
	include_once('../../config/link.php');
	include_once('../../content/header.php');
	include_once('../../content/nav.php');
	if (isset($_SESSION['user']) && $_SESSION['user']['permissao'] == 1) {
	?>
	<div class="row">
		<div class="col-12">
			<h3>Crie um novo evento</h3>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<form>
				<div class="row">
					<div class="col-md-6">
						<label>Informe o nome da corrida: </label>
						<input type="text" name="nome" required>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
	}else{
		$_SESSION['erro'] = "Você não tem permissão";
		?>
			<script type="text/javascript">
				history.back()
			</script>
		<?php
	}
	include_once('../../content/footer.php');
?>