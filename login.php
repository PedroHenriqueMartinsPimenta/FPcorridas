<?php
	$titulo = "Login";
	include_once('config/link.php');
	include_once('content/header.php');
	include_once('content/nav.php');
	?>
	<div class="row">
		<div class="col-12">
			<h3>Faça o login</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form action="controller/login.php?id=1" method="post">
						<div class="col-md-6">
							<label>Informe seu E-mail:</label>
							<input type="email" name="email" class="form-control">
						</div>

						<div class="col-md-6">
							<label>Informe uma senha:</label>
							<input type="password" name="senha" class="form-control">
						</div>

						<div class="col-12">
							<button type="submit" class="col-md-2">Entrar</button>
						</div>

					</form>
					<br>
					<br>
						<div class="col-12 mb-3" style="display: inline-block; text-align: right;">
							<a href="esqueci_senha.php">Esqueci minha senha</a>
						</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php
	include_once('content/footer.php');
?>