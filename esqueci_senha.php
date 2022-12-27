<?php
	$titulo = "Login";
	include_once('config/link.php');
	include_once('content/header.php');
	include_once('content/nav.php');
	if(isset($_GET['code']) && $_GET['code'] == $_SESSION['senha']['code']){
		?>
			<div class="row">
				<div class="col-md-12">
					<h3>Alterar senha</h3>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<form action="controller/esqueci_senha.php?id=2&code=<?php echo $_GET['user'] ?>" method="post">
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
	?>
		<div class="row">
			<div class="col-12">
				<h3>Esqueci minha senha :(</h3>
				<p>Informe seu e-mail que vamos te enviar um e-mail para você alterar a senha com isso!</p>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<form action="controller/esqueci_senha.php?id=1" method="post" id="form">
							<div class="row">
								<div class="col-md-12">
									<label>Informe seu e-mail</label>
									<input type="email" name="email" required>
									<input type="submit" value="Enviar">
								</div>

								
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	include_once('content/footer.php');
?>