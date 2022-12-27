<?php
	$titulo = "Inicio";
	include_once('config/link.php');
	include_once('content/header.php');
	include_once('content/nav.php');
	include_once('controller/conexao.php');
	if (!isset($_SESSION['qtd_pes'])) {
		$_SESSION['qtd_pes'] = 8;
	}
	if (isset($_GET['mais'])) {
		$_SESSION['qtd_pes'] += $_GET['mais'];
	}
	if ($_SESSION['qtd_pes'] < 8) {
		$_SESSION['qtd_pes'] = 8;
	}
	$qtd = $_SESSION['qtd_pes'];
	?>
		<div class="row">
			<div class="col-md-12">
				<h2>
					Confira algumas corridas 
				</h2>
			</div>
		</div>
		<div class="row mb-3">
		<div class="col-12">
			<form action="" method="post">
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
			<?php 
				if (isset($_POST['corrida'])) {
					$pes = $_POST['corrida'];
					$sql = "SELECT prova.CODIGO, prova.NOME, prova.DESCRICAO, prova.DATA, prova.INSC_MIN, prova.INSC_MAX, prova.PRC_INSCRICAO AS PRECO, midia.LINK FROM prova INNER JOIN midia ON prova.CODIGO = midia.prova_CODIGO WHERE prova.DISPONIVEL = 1 AND CONCAT(prova.NOME, prova.DESCRICAO) LIKE '%$pes%' ORDER BY prova.CODIGO DESC LIMIT $qtd";
				}else{
					$sql = "SELECT prova.CODIGO, prova.NOME, prova.DESCRICAO, prova.DATA, prova.INSC_MIN, prova.INSC_MAX, prova.PRC_INSCRICAO AS PRECO, midia.LINK FROM prova INNER JOIN midia ON prova.CODIGO = midia.prova_CODIGO WHERE prova.DISPONIVEL = 1 ORDER BY prova.CODIGO DESC LIMIT $qtd";
				}
				$query = mysqli_query($con, $sql);
				$eventos_num = mysqli_num_rows($query);
				$hoje = date('Y-m-d');
				if( $eventos_num > 0){
					while ($row = mysqli_fetch_array($query)) {
						?>
						<div class="col-md-3 mb-5">
							<div class="card corrida">
							  <img class="card-img-top" src="<?php echo $row['LINK']?>" alt="Card image cap" width="500px">
							  <?php 
							  	if ($row['INSC_MAX'] < $hoje) {
							  		?>
							  		<b  style="position: relative; top: -10px; background-color: red; color: white; padding: 10px; border-radius: 0px 0px 10px 10px; width: 100%; display: inline-block; text-align: center;">Incrições encerradas</b>
							  		<?php
							  	}
							   ?>
							  <div class="card-body">
							    <h5 class="card-title"><?php echo $row['NOME']?></h5>
							    <p class="card-text"><?php echo substr($row['DESCRICAO'], 0, 100)?></p>
							    <p class="card-text btn-warning" style="text-align: right; display: inline-block;" id="infos"><b><?php echo substr($row['DATA'], 8,2) . "/" . substr($row['DATA'], 5,2) . "/" . substr($row['DATA'], 0,4)?></b></p>
							    <a href="corrida.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-warning col-12">Saiba mais</a>
							  </div>
							</div>
						</div>
						<?php
					}
				}else{
					?>
					<div class="col-12">
						<h4>Nenhum evento encontrado!</h4>
					</div>
					<?php
				}
			?>
			


		</div>
		<div class="row">
			<div class="col-12">
				<?php
					if (isset($_GET['mais']) && $_SESSION['qtd_pes'] > 8) {
						?>
							<a href="?mais=-8" class="btn btn-warning">Ver Menos</a>
						<?php
					}
				?>
				<a href="?mais=8" class="btn btn-warning">Ver mais</a>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<h4>Organizadores</h4>
			</div>
		</div>
			
		<div class="row" style="position: relative;">
			<div class="col-md-4 card" style="margin: 0 auto;">
				<div class="row card-body" align="center">
					<div class="col-12">
						<img src="<?php echo $url?>layout/layout_files/images/org2.jpg" id="img_org">
					</div>
					<div class="col-12 mt-3">
						<h5>Fabiana Oliveira da Silva</h5>
					</div>
					<div class="col-12">
						<p>
							Profissional de Educação Física, cursando no IFCE, atleta de alto rendimento e premiada nas corridas regionais, estaduais, nacionais e internacionais.
						</p>
					</div>
				</div>
			</div>
			
			<div class="col-md-4 card"  style="margin: 0 auto;">
				<div class="row card-body" align="center">
					<div class="col-12">
						<img src="<?php echo $url?>layout/layout_files/images/org1.jpg" id="img_org">
					</div>
					<div class="col-12 mt-3">
						<h5>Pedro Henrique Martins Pimenta</h5>
					</div>
					<div class="col-12">
						<p>
							Profissional em TI, analista de dados, cursando Sistemas de Informação no IFCE, desenvolvedor e criador de soluções digitais.
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 card" style="margin: 0 auto;">
				<div class="row card-body" align="center">
					<div class="col-12">
						<img src="<?php echo $url?>layout/layout_files/images/org3.png" id="img_org">
					</div>
					<div class="col-12 mt-3">
						<h5>Marcos Ribeiro Ferreira</h5>
					</div>
					<div class="col-12">
						<p>
							Profissional em Educação Física, cursando fiseoterapia e atleta de alto rendimento, premiado em provas regionais, estaduais, nacionais e internacionais.
						</p>
					</div>
				</div>
			</div>
		</div>
		
	<?php
	include_once('content/footer.php');
?>