<?php
	$titulo = "Login";
	include_once('config/link.php');
	include_once('content/header.php');
	include_once('content/nav.php');
	?>
	<div class="row">
		<div class="col-12">
			<h3>Faça o login para se inscrever</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="col-12 mb-2" style="position: relative;text-align:right; display: inline-block;">
				<button onclick="cad()" style="padding: 7px; font-size: 10px;">Ainda não tenho cadastro</button>
			</div>
			<div class="card">
				<div class="card-body">
					<form action="controller/login.php?id=1" method="post" id="form">
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
	<script type="text/javascript">
		function cad() {
			window.location.href = "cadastro.php";
		}
	</script>
	<?php
	include_once('content/footer.php');
?>