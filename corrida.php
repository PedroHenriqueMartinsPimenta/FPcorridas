<?php
	$titulo = "Inicio";
	include_once('config/link.php');
	include_once('content/header.php');
	include_once('content/nav.php');
	include_once('controller/conexao.php');
	if (isset($_GET['codigo'])) {
		$codigo = $_GET['codigo'];
		$sql = "SELECT prova.CODIGO, prova.NOME, prova.DESCRICAO, prova.DATA, prova.INSC_MIN, prova.INSC_MAX, prova.PRC_INSCRICAO AS PRECO, prova.CATEGORIA, prova.EDITAL, midia.LINK FROM prova INNER JOIN midia ON prova.CODIGO = midia.prova_CODIGO WHERE prova.CODIGO = $codigo";
		$query = mysqli_query($con, $sql);
		if (mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_array($query);

			if (isset($_SESSION['user'])) {
				$user_codigo = $_SESSION['user']['codigo'];
				$sql = "SELECT CODIGO FROM inscrito WHERE prova_CODIGO = $codigo AND atleta_CODIGO = $user_codigo";
				$query = mysqli_query($con, $sql);
				$qtd_ins = mysqli_num_rows($query);
				$codigo_ins = mysqli_fetch_array($query);
			}else{
				$qtd_ins = 0;
			}
			?>
			<div class="row">
				<div class="col-md-12">
					<h2>
						<?php echo $row['NOME']?>
					</h2>
				</div>
			</div>

			<div class="row mt-2">
				<div class="col-md-6 mb-2">
					<img src="<?php echo $row['LINK']?>">
				</div>
				<div class="col-md-6 mb-2">
				
				<?php
					$hoje = date("Y-m-d");
					if ($qtd_ins > 0) {
						?>
						<a href="resultado.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-warning col-md-3">Acompanhar</a>
						<?php
					}else if($row['INSC_MAX'] < $hoje){
						?>
						<b  style="position: relative; top: -10px; background-color: red; color: white; padding: 10px; border-radius: 0px 0px 10px 10px; width: 100%; display: inline-block; text-align: center;">Incrições encerradas</b> <br>
						<a href="resultado.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-warning col-md-3">Resultado</a>

						<?php
					}else{
						?>
						<a href="inscricao.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-warning col-md-3">Increva-se</a>
						<?php
					}
				?>
				<br> <br>
				<b>Valor inscrição: R$ <?php echo $row['PRECO']?></b><br>
				<b>Dia do evento: <?php echo substr($row['DATA'], 8,2) . "/" . substr($row['DATA'], 5,2) . "/" . substr($row['DATA'], 0,4)?></b><br>
				<b>Inscrições: <?php echo substr($row['INSC_MIN'], 8,2) . "/" . substr($row['INSC_MIN'], 5,2) . "/" . substr($row['INSC_MIN'], 0,4)?> - <?php echo substr($row['INSC_MAX'], 8,2) . "/" . substr($row['INSC_MAX'], 5,2) . "/" . substr($row['INSC_MAX'], 0,4)?></b>
				<p>
					<?php echo $row['DESCRICAO']?>
				</p>
				<br>
				<h4>Premiação:</h4>
				<?php if ($row['PRECO'] > 0){ 
					?>
					<b style="color: red;position: absolute; margin-top: -20px; margin-left: 10px;">Tem premiação financeira!</b>
					<?php
				 } ?>
				<ul>
					<li>1ª,2ª e 3ª geral</li>
					<li>1ª,2ª e 3ª geral feminino</li>
				</ul>
				
					<?php
						if ($row['CATEGORIA'] == 1) {
							?>
							<b>Categorias:</b>
							<ul>
								<li>1ª de 18 - 30 anos</li>
								<li>1ª de 31 - 40 anos</li>
								<li>1ª de 41 - 60 anos</li>
								<li>1ª de +60 anos</li>

							</ul>
							<?php
						}
					?>
				<p>
					<b>Regulamento: </b><a href="<?php echo $row['EDITAL']?>" target="_blank">Clique aqui</a>
				</p>
				</div>
			</div>

			<div class="row mb-2">
				<div class="col-md-12" align="right">
					<img src="<?php echo $url?>layout/layout_files/images/FP.png" width="100px" style="display: inline-block; margin-right: 10px;">
					<?php 
						$sql = "SELECT * FROM parceria WHERE prova_CODIGO = $codigo";
						$query = mysqli_query($con, $sql);
						while ($row_parceiro = mysqli_fetch_array($query)) {
							?>
							<img src="<?php echo $row_parceiro['LOGO']?>" style="display: inline-block; margin-right: 10px; height: 100px;">
							<?php
						}
					?>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<?php
					if ($qtd_ins > 0) {
						?>
						<a href="resultado.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-warning col-12" style="padding: 30px">Acompanhar</a>
						<?php
					}else if($row['INSC_MAX'] < $hoje){
						?>
						<b>Incrições encerradas</b>
						<a href="resultado.php?codigo=<?php echo $row['CODIGO']?>" class="btn btn-warning col-12" style="padding: 30px">Resultado</a>
						<?php
					}else{
						?>	
						<a href="inscricao.php?codigo=<?php echo $codigo?>" class="btn btn-warning col-12" style="padding: 30px">Inscreva-se</a>
						<?php
					}
				?>

					
				</div>
			</div>
			
			<?php
		}else{
			?>
			<div class="row">
				<div class="col-md-12">
					<h2>
						Corrida não encontrada! 
					</h2>
				</div>
			</div>
			<?php
		}
	}else{
	?>
		<div class="row">
			<div class="col-md-12">
				<h2>
					Corrida não encontrada! 
				</h2>
			</div>
		</div>
		
		
		
	<?php
	}
	include_once('content/footer.php');
?>