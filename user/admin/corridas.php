<?php
	$titulo = "Eventos";
	include_once('../../config/link.php');
	include_once('../../content/header.php');
	include_once('../../content/nav.php');
	include_once('../../controller/conexao.php');
	if (isset($_SESSION['user']) && $_SESSION['user']['permissao'] == 1) {
		if(isset($_GET['total_mais'])){
			$_SESSION['total'] += $_GET['total_mais'];
		}
		if (!isset($_SESSION['total'])) {
			$_SESSION['total'] = 30;
		}
		$total = $_SESSION['total'];
	?>
	<div class="row">
		<div class="col-12">
			<h3>Confira os eventos</h3>
		</div>
	</div>
	<div class="row mb-2">
		<div class="col-12">
			<a href="nova_corrida.php" class="btn btn-warning">Novo Evento</a>
		</div>
	</div>
	<div class="row mb-3">
		<div class="col-12">
			<form action="corridas.php" method="post">
				<div class="row">
					<div class="col-md-10">
						<input type="text" name="corrida" placeholder="Pesquisa pelo nome do evento">
					</div>
					<div class="col-md-2">
						<button type="submit">Pesquisar</button>
						<?php
							if (isset($_POST['corrida'])) {
								?>
									<a href="" style="font-weight: bolder;">X</a>
								<?php
							}
						?>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div style=" max-width: 100%;overflow: scroll;">
				<table class="" style="">
				  <caption>Lista de corridas</caption>
				  <thead>
				    <tr>
				      <th width="100px">Codigo</th>
				      <td width="200px">Nome</td>
				      <td width="110px">Data</td>				      
				      <td width="200px">Descrição</td>
				      <td width="110">Inicio inscrições</td>
				      <td width="110">Fim inscrições</td>
				      <td width="80">Valor</td>
				      <td width="90">Distancia</td>
				      <td width="70">Edital</td>
				      <td width="80">Elevação</td>
				      <td width="100">Inscritos</td>
				      <td width="130">Resultado</td>
				      <td width="100">Ativa/ desativa</td>
				      <td width="100">Editar</td>
				      <td width="80">Remover</td>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  		if (isset($_POST['corrida'])) {
				  			$pesquisa = $_POST['corrida'];
				  			$sql = "SELECT * FROM prova WHERE CONCAT(DESCRICAO, NOME) LIKE '%$pesquisa%' LIMIT $total";
				  		}else{
				  			$sql = "SELECT * FROM prova LIMIT $total";
				  		}
				  		$query = mysqli_query($con, $sql);
				  		while($row = mysqli_fetch_array($query)){
				  			if($row['DISPONIVEL'] == 0){
				  				?>
				  				<tr style="opacity: 0.8; color: #EB4501;">
				  				<?php
				  			}else{
				  			?>
				  				<tr>
				  			<?php } ?>
				  					<td><?php echo $row['CODIGO']?></td>
				  					<td><?php echo $row['NOME']?></td>
				  					<td><?php echo $row['DATA']?></td>
				  					<td><?php echo substr($row['DESCRICAO'], 0, 50)?>...</td>
				  					<td><?php echo $row['INSC_MIN']?></td>
				  					<td><?php echo $row['INSC_MAX']?></td>
				  					<td>R$ <?php echo $row['PRC_INSCRICAO']?></td>
				  					<td><?php echo $row['DISTANCIA']?> Km</td>
				  					<td><a href="<?php echo $row['EDITAL']?>" target="_blank">Edital</a></td>
				  					<td><?php echo $row['ELEVACAO']?></td>
				  					<td><a href="inscritos.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-warning">Inscritos</a></td>
				  					<td><a href="resultado.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-warning">Resultados</a></td>
				  					<td><a href="../../controller/corridas.php?id=2&codigo=<?php echo $row['CODIGO']?>&status=<?php echo $row['DISPONIVEL']?>" class="btn btn-warning">
											<?php 
												if($row['DISPONIVEL']){
													?>
														Ativa
													<?php
												}else{
													?>
														Desativa
													<?php
												}
											?>
				  						</a></td>
				  						<td><a href="atualizar_corrida.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-warning">Editar</a></td>
				  						<td><button id="x" onclick="remover(<?php echo $row['CODIGO']?>)">X</button></td>
				  				</tr>
				  			<?php
				  		}
				  	?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>

			
	<script type="text/javascript">
		function remover(codigo){
			var c = confirm("Realmente deseja remover essa corrida? \n - Essa ação não poderá ser desfeita");
			if (c) {
				window.location.href = "../../controller/corridas.php?id=1&codigo="+codigo;
			}
		}
	</script>
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