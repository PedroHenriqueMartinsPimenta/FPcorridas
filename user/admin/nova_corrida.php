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
			<form action="../../controller/nova_corrida.php?id=1" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<label>Informe o nome da corrida: <span id="required">*</span></label>
						<input required type="text" name="nome" maxlength="45">
					</div>

					<div class="col-md-6">
						<label>Informe o dia do evento:<span id="required">*</span></label>
						<input required type="date" name="dia" required>
					</div>

					 <div class="col-md-12">
					 	<label>Descreva o evento: <span id="required">*</span></label>
					 	<textarea name="desc" required></textarea>
					 </div>

					 <div class="col-md-4">
					 	<label>Inicio das inscrições: <span id="required">*</span></label>
					 	<input required type="date" name="ins_inicio">
					 </div>

					 <div class="col-md-4">
					 	<label>Fim das inscrições: <span id="required">*</span></label>
					 	<input required type="date" name="ins_fim">
					 </div>
					 <div class="col-md-4">
					 	<label>Valor das inscriçoes:<span id="required">*</span> </label>
					 	<input required type="number" name="preco" step="0.01">
					 </div>
					 <div class="col-md-4">
					 	<label>Distancia (Km):<span id="required">*</span> </label>
					 	<input required type="number" name="distancia" step="0.01">
					 </div>

					 <div class="col-md-4">
					 	<label>Edital:<span id="required">*</span> </label>
					 	<input required type="file" name="edital">
					 </div>

					 <div class="col-md-4">
					 	<label>Variação de elevação máxima: </label>
					 	<input type="number" name="elevacao">
					 </div>
				 	 <div class="col-12">
				 		<hr>
				 		<h3>Mídia da corrida</h3>
				 	 </div>
				 	 <div class="col-md-12">
				 		<label>Selecione o banner da corrida: <span id="required">*</span></label>
				 		<input type="file" name="midia">
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