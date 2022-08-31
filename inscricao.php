<?php
	$titulo = "Nova corrida";
	include_once('config/link.php');
	include_once('content/header.php');
	include_once('content/nav.php');
	$codigo = $_GET['codigo'];
	if (isset($_SESSION['user'])) {
		include_once('controller/conexao.php');
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
					<h5>Confirmação e pagamento de inscrição</h5>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<style>
								    #form-checkout {
								      display: flex;
								      flex-direction: column;
								      max-width: 600px;
								    }

								    .container_pagamento {
								    	height: 40px;
								      display: inline-block;
								      border: 1px solid rgba(118, 118, 118,0.5);
								      border-radius: 2px;
								      margin-bottom: 10px;
								      padding-left: 10px;
								    }
								  </style>
					<form id="form-checkout">
						<?php 
						if ($row['PRC_INSCRICAO'] > 0) {
							?>
								  
								    <div id="form-checkout__cardNumber" class="container_pagamento"></div>
								    <div id="form-checkout__expirationDate" class="container_pagamento"></div>
								    <div id="form-checkout__securityCode" class="container_pagamento"></div>
								    <input type="text" id="form-checkout__cardholderName" />
								    <select id="form-checkout__issuer"></select>
								    <select id="form-checkout__installments"></select>
								    <select id="form-checkout__identificationType"></select>
								    <input type="text" id="form-checkout__identificationNumber" />
								    <input type="email" id="form-checkout__cardholderEmail" />

								    <progress value="0" class="progress-bar">Carregando...</progress>
								  
								  <script type="text/javascript">
								  	const valor = <?php echo json_encode($row['PRC_INSCRICAO'])?>;
								  	const codigo = <?php echo json_encode($codigo)?>;
								  </script>
								  <script src="https://sdk.mercadopago.com/js/v2"></script>
								  <script src="script/mercadopago.js"></script>
							<?php
						}else{
							?>
								<h5>Esse eventos é gratuito :)</h5>
								
							<?php
						}
					?>
					<br>
					<br>
					<label for="confirm"><input type="checkbox" name="confirm" id="confirm" required>
					Estou de acordo com os <a href="termos.php" style="color: #EB4501">termos</a></label>
					<br>
					<input type="submit" id="form-checkout__submit" value="Increve-se" class="col-md-3">
					</form>
					
				</div>
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