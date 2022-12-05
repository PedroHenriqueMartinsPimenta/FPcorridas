<?php
	$titulo = "Nova corrida";
	include_once('config/link.php');
	include_once('content/header.php');
	include_once('content/nav.php');
	$codigo = $_GET['codigo'];
	if (isset($_SESSION['user'])) {
		include_once('controller/conexao.php');
		$user = $_SESSION['user']['codigo'];
		$sql = "SELECT * FROM inscrito WHERE prova_CODIGO = $codigo AND atleta_CODIGO = $user";
		$query = mysqli_query($con, $sql);
		if(mysqli_num_rows($query) > 0) {
			$_SESSION['sucess'] = "Você já está inscrito :)";
			?>
			<script type="text/javascript">
				window.location.href = "<?php echo $url ?>user/minhas_corridas.php";
			</script>
			<?php
		}
		$sql = "SELECT * FROM prova WHERE CODIGO = $codigo";
		$query = mysqli_query($con, $sql);
		if (mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_array($query);
			?>
			
			<div class="row">
				<div class="col-md-12">
					<h4>Inscrição na <?php echo $row['NOME']?></h4>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<h5>Confirmação de inscrição</h5>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<form action="controller/inscricao.php?id=1&codigo=<?php echo $codigo?>" method="post">
						<?php
							if($row['PRC_INSCRICAO'] == 0){
								?>
									<h5>Esse evento é gratuito :)</h5>
								<?php
							}
						?>
						<h5 id="valor">Total: R$ <?php echo $row['PRC_INSCRICAO']?></h5>
						<label>Kit</label>
						<select name="kit" id="kit" onchange="atualiza(this)">
							<?php
								$sql = "SELECT * FROM brinde";
								$query = mysqli_query($con,$sql);
								$brindes = array();
								while($row_brinde = mysqli_fetch_array($query)){
									$brindes[$row_brinde['CODIGO']] = $row_brinde['VALOR'];
									?>
									<option value="<?php echo $row_brinde['CODIGO']?>"><?php echo $row_brinde['DESCRICAO'] . " - R$" . $row_brinde['VALOR']?></option>
									<?php
								}
							?>
						</select>
						<br>
						<label for="confirm"><input type="checkbox" id="confirm" required>
						Estou de acordo com os <a href="termos.php" style="color: #EB4501">termos</a></label>
						<br>
						<br>
						<input type="submit" id="form-checkout__submit" value="Increve-se" class="col-md-3">
					</form>
				</div>
				<script type="text/javascript">
					function atualiza(input) {
						var valor = parseInt(<?php echo json_encode($row['PRC_INSCRICAO'])?>);
						var brindes = <?php echo json_encode($brindes)?>;
						document.querySelector('#valor').innerHTML = "Total: R$" + (valor + parseInt(brindes[input.value]));
					}
				</script>
			</div>
			<?php
		}else{
			?>
			<div class="row">
				<div class="col-md-12">
					<h4>Evento não encontrado!</h4>
				</div>
			</div>
			<?php
		}
	
	}else{
		$_SESSION['erro'] = "Faça o login antes :)";
		?>
			<div class="row">
		<div class="col-12">
			<h3>Faça o login para se inscrever na corrida</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="col-12 mb-2" style="position: relative;text-align:right; display: inline-block;">
				<button onclick="cad()" style="padding: 7px; font-size: 10px;">Ainda não tenho cadastro</button>
			</div>
			<div class="card">
				<div class="card-body">
					<form action="controller/login.php?id=2&codigo=<?php echo $codigo?>" method="post">
						<div class="col-md-6">
							<label>Informe seu E-mail:</label>
							<input type="email" name="email" id="email" class="form-control">
						</div>

						<div class="col-md-6">
							<label>Informe uma senha:</label>
							<input type="password" name="senha" id="senha" class="form-control">
						</div>
						<div class="col-12 mb-3" style="display: inline-block; text-align: right;">
							<a href="esqueci_senha.php">Esqueci minha senha</a>
						</div>
						<div class="col-12">
							<button type="submit" class="col-md-2">Entrar</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-12">
			<h3>Cadastre-se e inscreva-se nas corridas</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form action="controller/cadastro.php?id=2&codigo=<?php echo $codigo?>" method="post" id="form">
						
						<div class="row">
							<div class="col-md-6">
								<label>Informe seu primeiro nome:</label>
								<input type="text" name="nome" class="form-control">
							</div>

							<div class="col-md-6">
								<label>Informe seu sobrenome:</label>
								<input type="text" name="sobrenome" class="form-control">
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<label>Informe seu E-mail:</label>
								<input type="email" name="email" id="email1" class="form-control">
							</div>

							<div class="col-md-6">
								<label>Confirme seu E-mail:</label>
								<input type="email" name="conf_email" id="conf_email" class="form-control">
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-8">
								<label>Informe um telefone para contato:</label>
								<input type="tel" name="phone" id="phone" class="form-control">
							</div>

							<div class="col-md-4">
								<label>Informe seu sexo: </label> <br>
								<input type="radio" name="sexo" id="sm" value="M"><label for="sm">Masculino</label> <br>
								<input type="radio" name="sexo" id="sf" value="F"><label for="sf">Feminino</label>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<label>Informe sua data de nascimento:</label>
								<input type="date" name="nasc" class="form-control">
							</div>

							<div class="col-md-4">
								<label>Informe uma senha:</label>
								<input type="password" name="senha" id="senha1" minlength="6" class="form-control">
							</div>

							<div class="col-md-4">
								<label>Confirme sua senha:</label>
								<input type="password" name="conf_senha" id="conf_senha" minlength="6" class="form-control">
							</div>
						</div>

						

						
						<div class="col-12">
							<button onclick="enviar()" type="button" class="col-md-2">Cadastre-se</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		function cad() {
			window.location.href = "cadastro.php";
		}
		function enviar(){
			console.log(document.querySelector("#email1").value)
			if(document.querySelector("#email1").value == document.querySelector("#conf_email").value){
				if(document.querySelector("#senha1").value == document.querySelector("#conf_senha").value){
					if(document.querySelector("#senha1").value.length >= 6){
						document.querySelector("#form").submit();
					}else{
						alert("A senha precisa ter no mínimo 6 caracteres");
					}
				}else{
					alert("Senhas incompativeis!");
				}
			}else{
				alert("E-mails incompativeis!");
			}
		}
	</script>
		<?php
	}
	include_once('content/footer.php');
?>