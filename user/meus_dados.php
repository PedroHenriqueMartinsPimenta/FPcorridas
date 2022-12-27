<?php
	$titulo = "Área do atleta";
	include_once('../config/link.php');
	include_once('../content/header.php');
	include_once('../content/nav.php');
	include_once('../controller/conexao.php');
	if (isset($_SESSION['user']['codigo'])) {
		$codigo = $_SESSION['user']['codigo'];
		$sql = "SELECT * FROM usuario WHERE CODIGO = $codigo";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
	?>
	<h2><img src="<?php echo($row['PERFIL']); ?>" width="70px" style="display: inline-block; width: 70px;" id="img_org"> Meus dados</h2>
	<div class="row">
		<div class="col-12">
			<form action="../controller/meus_dados.php?id=1" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<label>Nome:</label>
						<input type="text" name="nome" value="<?php echo $row['NOME']?>" required>
					</div>
					<div class="col-md-6">
						<label>Sobrenome:</label>
						<input type="text" name="sobrenome" value="<?php echo $row['SOBRENOME']?>" required>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8">
						<label>E-mail:</label>
						<input type="email" name="email" value="<?php echo $row['EMAIL']?>" required>
					</div>
					<div class="col-md-4">
						<label>Sexo</label> <br>
						<input type="radio" name="sexo" value="M" id="m" required> <label for="m">Masculino</label><br>
						<input type="radio" name="sexo" value="F" id="f" required> <label for="f">Feminino</label>
						<script type="text/javascript">
							var sexo = <?php echo json_encode($row['SEXO']) ?>;
							if (sexo == "M") {
								document.querySelector("#m").checked = true;
							}else{
								document.querySelector("#f").checked = true;
							}
						</script>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label>Data de nascimento: </label>
						<input type="date" name="nasc" value="<?php echo $row['NASC'] ?>" required>
					</div>
					<div class="col-md-4">
						<label>Telefone: </label>
						<input type="tel" name="tel" value="<?php echo $row['TELEFONE'] ?>" required>
					</div>
					<div class="col-md-4">
						<label>Dados Bancário (para possíveis premiações): </label>
						<textarea name="bancario"><?php echo($row['BANCARIO']) ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8">
						<label>Foto de perfil: </label>
						<input type="file" name="perfil">
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-md-12">
						<input type="submit" value="Atualizar" class="btn btn-warning col-md-3">
					</div>
				</div>
			</form>
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="col-md-12">
			<h3>Alterar senha</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<form action="../controller/meus_dados.php?id=2" method="post">
				<div class="row">
					<div class="col-md-6">
						<label>Informar uma nova senha</label>
						<input type="password" name="senha" required>
					</div>
					<div class="col-md-6">
						<label>Confirmar senha</label>
						<input type="password" name="senha_c" required>
					</div>

					<div class="row">
						<div class="col-md-12">
							<input type="submit" value="Atualizar">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
		
	<?php
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../login.php');
	}
	include_once('../content/footer.php');
?>