<?php
	$titulo = "Quero ser parceiro";
	include_once('config/link.php');
	include_once('content/header.php');
	include_once('content/nav.php');
	?>
	<div class="row">
		<div class="col-12">
			<h3>Venha nos ajudar a fazer história!</h3>
			<span>Solicite o contato e nos conte um pouco sobre você ;)</span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="controller/parceiro.php" method="post">
				<div class="row">
					<div class="col-md-12">
						<label>Informe o seu e-mail:</label>
						<input type="email" name="email" required>
					</div>

					<div class="col-md-12">
						<label>Informe um assunto:</label>
						<input type="text" name="assunto" required>
					</div>

					<div class="col-md-12">
						<label>Escreva a sua mensagem, estamos ansiosos!</label>
						<textarea name="message" required></textarea><br>
						<input type="submit" value="Enviar">
					</div>

				</div>
			</form>
		</div>
	</div>
	<?php
	include_once('content/footer.php');
?>