<?php
	$titulo = "Novo parceiro";
	include_once('../../config/link.php');
	include_once('../../content/header.php');
	include_once('../../content/nav.php');
	if (isset($_SESSION['user']) && $_SESSION['user']['permissao'] == 1) {
		include_once('../../controller/conexao.php');
	?>
	<div class="row">
		<div class="col-12">
			<h3>Crie um novo brinde</h3>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<form action="../../controller/novo_brinde.php?id=1" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-12">
						<label>Informe a descrição: <span id="required">*</span></label>
						<textarea name="desc" placeholder="Descrição..."></textarea>
					</div>

					<div class="col-md-12">
						<label>Informe o valor:<span id="required">*</span></label>
						<input required type="number" name="valor" step="0.01">
					</div>					
					 <br>
					 <br>
					 <div class="col-md-12 mt-4">
					 	<button type="submit" class="col-md-3">Salvar</button>
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