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
		if ($total < 30) {
			$total = 30;
			$_SESSION['total'] = 30;
		}
	?>
	<div class="row">
		<div class="col-12">
			<h3>Confira os parceiros</h3>
		</div>
	</div>
	<div class="row mb-2">
		<div class="col-12">
			<a href="novo_parceiro.php" class="btn btn-warning">Novo Parceiro</a>
		</div>
	</div>
	<div class="row mb-3">
		<div class="col-12">
			<form action="parceiros.php" method="post">
				<div class="row">
					<div class="col-md-10">
						<input type="text" name="pesquisa" placeholder="Pesquisa pelo nome do parceiro">
					</div>
					<div class="col-md-2">
						<button type="submit">Pesquisar</button>
						<?php
							if (isset($_POST['pesquisa'])) {
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
				      <td width="110px">Telefone</td>				      
				      <td width="110px">Contribuição</td>
				      <td width="200px">Logo</td>
				      <td width="110">Corrida</td>
				      <td width="80">Remover</td>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  		if (isset($_POST['pesquisa'])) {
				  			$pesquisa = $_POST['pesquisa'];
				  			$sql = "SELECT prova.NOME AS PROVA, parceria.NOME, parceria.TELEFONE, parceria.LOGO, parceria.CONTRIBUICAO, parceria.CODIGO  FROM prova INNER JOIN parceria ON prova.CODIGO = parceria.prova_CODIGO WHERE prova.DISPONIVEL = 1 AND parceria.NOME LIKE '%$pesquisa%' ORDER BY parceria.CODIGO DESC LIMIT $total";
				  		}else{
				  			$sql = "SELECT prova.NOME AS PROVA, parceria.NOME, parceria.TELEFONE, parceria.LOGO, parceria.CONTRIBUICAO, parceria.CODIGO  FROM prova INNER JOIN parceria ON prova.CODIGO = parceria.prova_CODIGO WHERE prova.DISPONIVEL = 1 ORDER BY parceria.CODIGO DESC LIMIT $total";
				  		}
				  		$query = mysqli_query($con, $sql);
				  		while($row = mysqli_fetch_array($query)){
				  			?>
				  				<tr>
				  					<td><?php echo $row['CODIGO']?></td>
				  					<td><?php echo $row['NOME']?></td>
				  					<td><?php echo $row['TELEFONE']?></td>
				  					<td>R$ <?php echo $row['CONTRIBUICAO']?></td>
				  					<td><img src="<?php echo $row['LOGO']?>" width="100px"></td>
				  					<td><?php echo $row['PROVA']?></td>
				  					<td><button id="x" onclick="remover(<?php echo $row['CODIGO']?>)">X</button></td>
				  				</tr>
				  			<?php
				  		}
				  	?>
				  	
				  </tbody>
				</table>
				<?php
  			if ($total > 30) {
  				?>
  				<div class="col-md-1">
  					<a href="corridas.php?total_mais=-30"  class="btn btn-warning">Menos</a>
  				</div>
  				<?php
  			}
  		?>
  		<div class="col-md-1">
  					<a href="corridas.php?total_mais=30" class="btn btn-warning">Mais</a>
  				</div>
			</div>
		</div>
	</div>
	<div class="row">
  		
  	</div>
			
	<script type="text/javascript">
		function remover(codigo){
			var c = confirm("Realmente deseja remover essa corrida? \n - Essa ação não poderá ser desfeita");
			if (c) {
				window.location.href = "../../controller/parceiros.php?id=1&codigo="+codigo;
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