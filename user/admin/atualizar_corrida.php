<?php
	$titulo = "Nova corrida";
	include_once('../../config/link.php');
	include_once('../../content/header.php');
	include_once('../../content/nav.php');
	include_once('../../controller/conexao.php');
	if (isset($_SESSION['user']) && $_SESSION['user']['permissao'] == 1) {
		$codigo = $_GET['codigo'];
		$sql = "SELECT * FROM prova WHERE CODIGO = $codigo";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
	?>
	<div class="row">
		<div class="col-12">
			<h3>Editando o evento: <?php echo $row['NOME']?></h3>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<form action="../../controller/atualizar_corrida.php?id=1&codigo=<?php echo $row['CODIGO']?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<label>Informe o nome da corrida: <span id="required">*</span></label>
						<input required type="text" name="nome" maxlength="45" value="<?php echo $row['NOME']?>">
					</div>

					<div class="col-md-6">
						<label>Informe o dia do evento:<span id="required">*</span></label>
						<input required type="date" name="dia" required value="<?php echo $row['DATA']?>">
					</div>

					 <div class="col-md-12">
					 	<label>Descreva o evento: <span id="required">*</span></label>
					 	<textarea name="desc" required><?php echo str_replace("<br>", "\n", $row['DESCRICAO'])?></textarea>
					 </div>

					 <div class="col-md-4">
					 	<label>Inicio das inscrições: <span id="required">*</span></label>
					 	<input required type="date" name="ins_inicio" value="<?php echo $row['INSC_MIN']?>">
					 </div>

					 <div class="col-md-4">
					 	<label>Fim das inscrições: <span id="required">*</span></label>
					 	<input required type="date" name="ins_fim" value="<?php echo $row['INSC_MAX']?>">
					 </div>
					 <div class="col-md-4">
					 	<label>Valor das inscriçoes:<span id="required">*</span> </label>
					 	<input required type="number" name="preco" step="0.01" value="<?php echo $row['PRC_INSCRICAO']?>">
					 </div>
					 <div class="col-md-4">
					 	<label>Distancia (Km):<span id="required">*</span> </label>
					 	<input required type="number" name="distancia" step="0.01" value="<?php echo $row['DISTANCIA']?>">
					 </div>
					 <div class="col-md-4">
					 	<label>Variação de elevação máxima: </label>
					 	<input type="number" name="elevacao" value="<?php echo $row['ELEVACAO']?>">
					 </div>
				 	 <div class="col-md-4">
					 	<label>Categoria: </label>
					 	<select name="categoria" id="cat">
					 		<option value="0">Geral</option>
					 		<option value="1">Com categoria de idade</option>
					 	</select>
					 	<script type="text/javascript">
					 		document.querySelector('#cat').value = <?php echo json_encode($row['CATEGORIA'])?>
					 	</script>
					 </div>
					 <div class="col-md-12 mt-4">
					 	<button type="submit" class="col-md-3">Salvar</button>
					 </div>
				</div>
			</form>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<form action="../../controller/atualizar_corrida.php?id=2&codigo=<?php echo $row['CODIGO']?>" method="post" enctype="multipart/form-data">
				<div class="col-12">
				 		<hr>
				 		<h3>Arquivos</h3>
				 	 </div>
				 	 <div class="col-md-12">
				 		<label>Selecione o banner da corrida: </label>
				 		<input type="file" name="midia">
				 		<br>
					 </div>

					 <div class="col-md-4">
					 	<label>Edital: </label>
					 	<input type="file" name="edital">
					 </div>
					 <br>
					 <br>
				 <div class="col-md-12 mt-4">
				 	<button type="submit" class="col-md-3">Salvar</button>
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