<?php
	$titulo = "Minhas corridas";
	include_once('../config/link.php');
	include_once('../content/header.php');
	include_once('../content/nav.php');
	if (isset($_SESSION['user']['codigo'])) {
		include_once('../controller/conexao.php');
		$titulo = "Minhas corridas";
		$codigo = $_SESSION['user']['codigo'];
	?>
	<div class="row mb-3">
		<div class="col-12">
			<form action="minhas_corridas.php" method="post">
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
				      <th width="100px">Número de peito</th>
				      <td width="200px">Nome</td>	
				      <td width="250px">Andamento</td>
				      <td width="110px">Data do evento</td>		
				      <td width="110px">Data de inscrição</td>	
				      <td width="150px">Resultados</td>	
				      <td width="250px">Cancelamento</td>				
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  		if (isset($_POST['corrida'])) {
				  			$pesquisa = $_POST['corrida'];
				  			$sql = "SELECT inscrito.CODIGO, inscrito.PAGO, inscrito.brinde_CODIGO, inscrito.DATA AS DT_INSCRICAO, inscrito.ATIVO, prova.CODIGO AS PROVA_CODIGO,prova.NOME,prova.DATA, prova.PG_LINK FROM prova INNER JOIN inscrito ON prova.CODIGO = inscrito.prova_codigo WHERE inscrito.atleta_CODIGO = $codigo AND prova.NOME LIKE '%$pesquisa%' ORDER BY inscrito.CODIGO DESC LIMIT 10";
				  		}else{
				  			$sql = "SELECT inscrito.CODIGO, inscrito.PAGO, inscrito.brinde_CODIGO, inscrito.DATA AS DT_INSCRICAO, inscrito.ATIVO, prova.CODIGO AS PROVA_CODIGO,prova.NOME,prova.DATA, prova.PG_LINK FROM prova INNER JOIN inscrito ON prova.CODIGO = inscrito.prova_codigo WHERE inscrito.atleta_CODIGO = $codigo ORDER BY inscrito.CODIGO DESC LIMIT 10";
				  		}
				  		$query = mysqli_query($con, $sql);
				  		while($row = mysqli_fetch_array($query)){
				  			if($row['ATIVO'] == 0){
				  				?>
				  				<tr style="opacity: 0.8; color: #EB4501;">
				  				<?php
				  			}else{
				  			?>
				  				<tr>
				  			<?php } ?>
				  					<td><?php echo $row['CODIGO']?></td>
				  					<td><?php echo $row['NOME']?></td>
				  					<td>
				  						<?php
				  							if ($row['PAGO'] == 0) {
				  								?>
				  									<a href="<?php echo $row['PG_LINK']?>" target="_blank" class="btn btn-success">Confirmar com o pagamento</a>
				  								<?php
				  							}else if($row['PAGO'] == 1){
				  								$hoje = date('Y-m-d');
				  								if ($row['DATA'] == $hoje) {
					  								$inscrito = $row['CODIGO'];
					  								$sql = "SELECT * FROM resultado WHERE inscrito_CODIGO = $inscrito";
					  								$query_inscrito = mysqli_query($con, $sql);
					  								if (mysqli_num_rows($query_inscrito) == 0 && $row['DATA'] >= date('Y-m-d')) {
					  									?>
					  									<a href="enviar_prova.php?codigo=<?php echo $inscrito?>" class="btn btn-warning">Envie seu resultado!</a>
					  									<?php
					  								}else{
					  									?>
					  									<p style="color: red">Agora é só aguardar o resultado :)</p>
					  									<?php
					  								}
					  							}else if($row['DATA'] > $hoje){
					  								?>
				  										<p style="color: red">O evento está se aproximando! Fique atento!</p>
				  									<?php
					  							}else{
					  								?>
				  										<p style="color: red">Evento encerrado</p>
				  									<?php
					  							}
					  						}
				  						?>
				  					</td>
				  					<td><?php echo substr($row['DATA'], 8,2) . "/" . substr($row['DATA'], 5,2) . "/" . substr($row['DATA'], 0,4)?></td>
				  					<td><?php echo $row['DT_INSCRICAO']?></td>
				  					<td><a href="../resultado.php?codigo=<?php echo $row['PROVA_CODIGO']?>" class="btn btn-warning">Resultados</a></td>
				  					<td>
				  						<?php
				  							if($row['PAGO'] == 0){
				  								?>
				  									<button style="font-size: 13px;" onclick="cancelar(<?php echo $row['CODIGO']?>)">Cancelar</button>
				  								<?php
				  							}
				  						?>
				  					</td>
				  					
				  				</tr>
				  			<?php
				  		}
				  	?>
				  	
				  </tbody>
				</table> 		
			</div>
		</div>
	</div>
	<div class="row">
  		
  	</div>
			
	<script type="text/javascript">
		function cancelar(codigo){
			var c = confirm("Realmente deseja cancelar essa corrida? \n - Essa ação não poderá ser desfeita");
			if (c) {
				window.location.href = "../controller/inscricao.php?id=2&codigo="+codigo;
			}
		}
	</script>

	<?php
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../login.php');
	}
	include_once('../content/footer.php');
?>