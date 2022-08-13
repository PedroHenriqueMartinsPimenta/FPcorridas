<?php
	$titulo = "Cadastre-se";
	include_once('config/link.php');
	include_once('content/header.php');
	include_once('content/nav.php');
	?>
	<div class="row">
		<div class="col-12">
			<h3>Cadastre-se e inscreva-se nas corridas</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form action="controller/cadastro.php?id=1" method="post" id="form">
						
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
								<input type="email" name="email" id="email" class="form-control">
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
								<input type="password" name="senha" id="senha" minlength="6" class="form-control">
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
	<script type="text/javascript" src="script/cadastro.js"></script>
	<?php
	include_once('content/footer.php');
?>