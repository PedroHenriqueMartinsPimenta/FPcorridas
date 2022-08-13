<?php
	$titulo = "Patrocinadores";
	include_once('../../config/link.php');
	include_once('../../content/header.php');
	include_once('../../content/nav.php');
	if (isset($_SESSION['user']) && $_SESSION['user']['permissao'] == 1) {
	?>
	<div class="row">
		<div class="col-12">
			<h3>Confira nossos Patrocinadores</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="table-responsive-md">
				<table class="table">
				  <caption>Lista de usuários</caption>
				  <thead>
				    <tr>
				      <th scope="col">Codigo</th>
				      <td scope="col">Nome</td>
				      <td scope="col">Telefone</td>
				      <td scope="col">Contribuição</td>
				      <td scope="col">Prova</td>
				      <td scope="col">Remover</td>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <td scope="row">1</td>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				      <td>@mdo</td>
				      <td><button id="x">X</button></td>
				    </tr>
				    <tr>
				      <td scope="row">2</td>
				      <td>Jacob</td>
				      <td>Thornton</td>
				      <td>@fat</td>
				    </tr>
				    <tr>
				      <td scope="row">3</td>
				      <td>Larry</td>
				      <td>the Bird</td>
				      <td>@twitter</td>
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