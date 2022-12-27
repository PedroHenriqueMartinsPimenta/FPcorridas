<?php
	$titulo = "Atleta";
	include_once('config/link.php');
	include_once('content/header.php');
	include_once('content/nav.php');
	include_once('controller/conexao.php');
	$codigo = $_GET['id'];
	$sql = "SELECT * FROM usuario WHERE CODIGO = $codigo";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($query);
	?>
	<style type="text/css">
		#km{
			padding: 20px;
			font-weight: bolder;
			font-size: 20px;
		}
	</style>
	<div class="row">
		<div class="col-12">
			<img src="<?php echo $row['PERFIL'] ?>" style="display: inline-block; width: 120px; margin-right: 20px;" id="img_org">
			<h3 style="display: inline-block; margin-top: 20px"><?php echo $row['NOME'] . " " . $row['SOBRENOME'] ?></h3>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-6">
				<h5>🔒 Meus <span id="km_"></span>KMs </h5>
				<div class="row">
				<?php 
					$sql = "SELECT prova.DISTANCIA FROM usuario INNER JOIN inscrito ON inscrito.atleta_CODIGO = usuario.CODIGO INNER JOIN prova ON inscrito.prova_CODIGO = prova.CODIGO WHERE usuario.CODIGO = $codigo AND inscrito.ATIVO != 2 AND inscrito.PAGO = 1 GROUP BY prova.DISTANCIA ORDER BY prova.DISTANCIA DESC LIMIT 3";
					$query = mysqli_query($con, $sql);
					$k = 0;
					while($r = mysqli_fetch_array($query)){
						$k += $r['DISTANCIA'];
						?>
						<div id="km" class="btn btn-warning col-4">
							 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
							  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
							</svg>
							<?php echo $r['DISTANCIA'] ?>Km
						</div>
						<?php
					}
				 ?>
				 <script type="text/javascript">
				 	document.querySelector("#km_").innerHTML = <?php echo json_encode($k) ?>;
				 </script>
				</div>
		</div>	
		<div class="col-md-4 mt-4">
			<h5>Dados de contato</h5>
			<p>
				<b>E-mail: </b><?php echo $row['EMAIL'] ?><br>
				<b>Telefone: </b><?php echo $row['TELEFONE'] ?>
			</p>
		</div>
	</div>
	 <div class="row mt-5">
	 	<div class="col-12">
	 		<h6>Ajude esse atleta</h6>
	 		<b>Dados bancários: <br></b> <?php echo $row['BANCARIO']; ?>
	 	</div>
	 </div>
	<?php
	include_once('content/footer.php');
?>