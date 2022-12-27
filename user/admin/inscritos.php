<?php
	$titulo = "Nova corrida";
	include_once('../../config/link.php');
	include_once('../../content/header.php');
	include_once('../../content/nav.php');
	include_once('../../controller/conexao.php');
	if (isset($_SESSION['user']) && $_SESSION['user']['permissao'] == 1) {
		if (isset($_POST['codigo'])) {
			$codigo = $_POST['codigo'];
				?>
				<div class="row mb-3">
					<div class="col-12">
						<form action="inscritos.php" method="post">
							<div class="row">
								<div class="col-md-10">
									<input type="text" name="pesquisa" placeholder="Pesquisa pelo nome do atleta ou número de peito">

									<input type="text" name="codigo" value="<?php echo $codigo?>" readonly style="display: none;">
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
							<table class="" style="">
							  <caption>Lista de corridas</caption>
							  <thead>
							    <tr>
							      <th width="100px">Inscrição</th>
							      <td width="200px">Nome</td>
							      <td width="150px">Telefone</td>				      
							      <td width="310px">E-mail</td>
							      <td width="200px">Data</td>
							      <td width="110">Distancia</td>
							      <td width="210">Pagamento</td>
							      <td width="210">Status</td>
							      <td width="110">Resultato</td>
							    </tr>
							  </thead>
							  <tbody>
							  	<?php
							  		if (isset($_POST['pesquisa'])) {
							  			$pesquisa = $_POST['pesquisa'];
							  			$sql = "SELECT usuario.CODIGO AS USER_CODIGO, inscrito.CODIGO, inscrito.DATA, inscrito.PAGO, inscrito.ATIVO, usuario.NOME, usuario.SOBRENOME, usuario.TELEFONE, usuario.EMAIL, prova.DISTANCIA, inscrito.ATIVO FROM inscrito INNER JOIN usuario ON usuario.CODIGO = inscrito.atleta_CODIGO INNER JOIN prova ON inscrito.prova_CODIGO = prova.CODIGO WHERE inscrito.prova_codigo = $codigo AND CONCAT(inscrito.CODIGO, CONCAT(usuario.NOME, usuario.SOBRENOME)) LIKE '%$pesquisa%' ORDER BY CONCAT(usuario.NOME, usuario.SOBRENOME) ASC";
							  		}else{
							  			$sql = "SELECT usuario.CODIGO AS USER_CODIGO, inscrito.CODIGO, inscrito.DATA, inscrito.PAGO, inscrito.ATIVO, usuario.NOME, usuario.SOBRENOME, usuario.TELEFONE, usuario.EMAIL, prova.DISTANCIA, inscrito.ATIVO FROM inscrito INNER JOIN usuario ON usuario.CODIGO = inscrito.atleta_CODIGO INNER JOIN prova ON inscrito.prova_CODIGO = prova.CODIGO WHERE inscrito.prova_codigo = $codigo ORDER BY CONCAT(usuario.NOME, usuario.SOBRENOME) ASC";
							  		}
							  		$query = mysqli_query($con, $sql);
							  		while($row = mysqli_fetch_array($query)){
							  			?>
							  				<tr>
							  					<td><?php echo $row['CODIGO']?></td>
							  					<td><?php echo $row['NOME']. " " . $row['SOBRENOME']?></td></td>
							  					<td><a href="tel: <?php echo $row['TELEFONE']?>"><?php echo $row['TELEFONE']?></a></td>
							  					<td><a href="mailto: <?php echo $row['EMAIL']?>"><?php echo $row['EMAIL']?></a></td>
							  					<td><?php echo $row['DATA']?></td>
							  					<td><?php echo $row['DISTANCIA']?> Km</td>
							  					<td>
							  						<?php 
							  							if ($row['PAGO'] == 1) {
							  								echo "Já foi pago :)";
							  							}else{
							  								?>
							  								<a href="../../controller/pagar.php?codigo=<?php echo $row['CODIGO'] ?>" class="btn btn-success">Confirmar pagamento</a>
							  								<?php
							  							}
							  						 ?>
							  					</td>
							  					<td>
							  						<select id="status<?php echo $row['CODIGO'] ?>" onchange="alter_status(<?php echo $row['CODIGO'] ?>)">
							  							<option value="1">Ativo</option>
							  							<option value="0">Cancelada</option>
							  						</select>
							  						<script type="text/javascript">
							  							document.querySelector("#status<?php echo $row['CODIGO']; ?>").value = <?php echo $row['ATIVO']; ?>
							  						</script>
							  					</td>
							  					<td>
							  						<a href="resultado.php?codigo=<?php echo $row['CODIGO']; ?>" class="btn btn-warning">Resultado</a>
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
				<script type="text/javascript">
				function alter_status(codigo) {
					var status = document.querySelector("#status" + codigo).value;
					var result = post("../../controller/status.php", {codigo: codigo,status: status}, "post");
					if (result == 0) {
						alert("Erro ao atualizar status\nTente novamente mais tarde!");
					}
					
				}
				function post(url, data, metodo){
					var dados = "codigo="+encodeURIComponent(data.codigo)+"&status="+encodeURIComponent(data.status);
					var ajax = new XMLHttpRequest();

					// Seta tipo de requisição: Post e a URL da API
					ajax.open("POST", url, true);
					ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

					// Seta paramêtros da requisição e envia a requisição
					ajax.send(dados);

					// Cria um evento para receber o retorno.
					ajax.onreadystatechange = function() {
					  
					  // Caso o state seja 4 e o http.status for 200, é porque a requisiçõe deu certo.
						if (ajax.readyState == 4 && ajax.status == 200) {
							var result = JSON.parse(ajax.responseText);
							return result;
							
					    // Retorno do Ajax
						}
					}
				}
			</script>
				<?php
		}else{
			?>
			<div class="row">
				<div class="col-12">
					<h3>Inscrições</h3>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<form method="post">
						<label>Selecione a prova: </label>
						<select name="codigo">
						<?php
							$sql = "SELECT * FROM prova WHERE DISPONIVEL = 1  ORDER BY CODIGO DESC";
							$query = mysqli_query($con, $sql);
							while ($row = mysqli_fetch_array($query)) {
								?>
								<option value="<?php echo $row['CODIGO']?>"><?php echo $row['NOME']?></option>
								<?php
							}
						?>
					</select>
					<input type="submit" value="Ver">
					</form>
				</div>
			</div>

			<?php
		}
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