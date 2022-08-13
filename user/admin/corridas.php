<?php
	$titulo = "Corridas";
	include_once('../../config/link.php');
	include_once('../../content/header.php');
	include_once('../../content/nav.php');
	if (isset($_SESSION['user']) && $_SESSION['user']['permissao'] == 1) {
	?>
	<div class="row">
		<div class="col-12">
			<h3>Confira as corridas</h3>
		</div>
	</div>
	<div class="row mb-2">
		<div class="col-12">
			<a href="nova_corrida.php" class="btn btn-warning">Nova corrida</a>
		</div>
	</div>
	<div class="row mb-3">
		<div class="col-12">
			<form action="corridas.php" method="post">
				<div class="row">
					<div class="col-md-10">
						<input type="text" name="corrida" placeholder="Pesquisa pelo nome da corrida">
					</div>
					<div class="col-md-2">
						<button type="submit">Pesquisar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div style=" max-width: 100%;overflow: scroll;">
				<table class="table-responsive-md">
				  <caption>Lista de corridas</caption>
				  <thead>
				    <tr>
				      <th>Codigo</th>
				      <td>Nome</td>
				      <td>Telefone</td>
				      <td>Contribuição</td>
				      <td>Prova</td>
				      <td>Remover</td>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <td>1</td>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td><button id="x">X</button></td>
				    </tr>
				    <tr>
				      <td>1</td>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td><button id="x">X</button></td>
				    </tr>
				    <tr>
				      <td>1</td>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td><button id="x">X</button></td>
				    </tr>
				  </tbody>
				</table>
			</div>

			<table style="">
				<div id="table">
					<thead>
						<tr>
							<th width="10%">Codigo</th>
							<td>
							<td>Telefone</td>
							<td>Logo</td>
							<td>Contribuição</td>
							<td>Prova</td>
							<td>Remover</td>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>Codigo</td>
							<td>Nome</td>
							<td>Telefone</td>
							<td>Logo</td>
							<td>Contribuição</td>
							<td>Prova</td>
							<td><button id="x">X</button></td>
						</tr>
					</tbody>
				</div>
			</table>
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