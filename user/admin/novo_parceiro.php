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
			<h3>Crie um novo evento</h3>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<form action="../../controller/novo_parceiro.php?id=1" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<label>Informe o nome: <span id="required">*</span></label>
						<input required type="text" name="nome" maxlength="45">
					</div>

					<div class="col-md-6">
						<label>Informe o número de contato:<span id="required">*</span></label>
						<input required type="text" name="telefone" required>
					</div>

					<div class="col-md-6">
						<label>Informe a contribuição:<span id="required">*</span></label>
						<input required type="number" name="contribuicao" required step="0.01">
					</div>

					<div class="col-md-6">
						<label>Selecione o logo:<span id="required">*</span></label>
						<input required type="file" name="logo">
					</div>
					<div class="col-12">
						<label>Selecione a corrida: <span id="required">*</span></label>
						<select name="corrida">
							<?php
								$sql = "SELECT * FROM prova WHERE DISPONIVEL = 1  ORDER BY CODIGO DESC";
								$query = mysqli_query($con, $sql);
								while($row = mysqli_fetch_array($query)){
									?>
										<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
									<?php
								}
							?>
						</select>
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