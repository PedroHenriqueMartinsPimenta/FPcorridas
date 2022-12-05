<?php
	$titulo = "Nova corrida";
	include_once('../../config/link.php');
	include_once('../../content/header.php');
	include_once('../../content/nav.php');
	include_once('../../controller/conexao.php');
	if (isset($_SESSION['user']) && $_SESSION['user']['permissao'] == 1) {
		$codigo = $_GET['codigo'];
		$sql = "SELECT * FROM resultado WHERE inscrito_CODIGO = $codigo";
		$query = mysqli_query($con, $sql);
		while($row = mysqli_fetch_array($query)){
			?>
				<div class="row">
					<div class="col-md-10">
						<h4><?php echo $row['HORA'] . "H: " . $row['MINUTO'] . "M: " . $row['SEGUNDO'] . "S" ?> <?php echo $row['DATA'] ?></h4>
					</div>
					<div class="col-md-2">
						<select id="status<?php echo $row['CODIGO'] ?>" onchange="alter_status(<?php echo $row['CODIGO'] ?>)">
  							<option value="1">Validado</option>
  							<option value="0">Pendente</option>
  							<option value="2">Negado</option>
  						</select>
  						<script type="text/javascript">
  							document.querySelector("#status<?php echo $row['CODIGO']; ?>").value = <?php echo $row['VALIDADO']; ?>
  						</script>
					</div>
				</div>

				<div class="row mt-2">
					<div class="col-12">
						<img src="<?php echo $row['LINK'] ?>" class="col-md-12">
					</div>
				</div>
					<hr>
				<div class="row">
					<div class="col-12">
						<h4>Pagamento</h4>
					</div>
				</div>

				<?php 
					if ($row['PAGO'] == 1) {
						?>
							<div class="row">
								<div class="col-12">
									<img src="<?php echo $row['PG_COMPROVANTE'] ?>" class="col-md-6">
								</div>
							</div>
						<?php
					}else{
						?>
							<div class="row">
								<div class="col-12">
									<form action="../../controller/pg_resultado.php?codigo=<?php echo $row['CODIGO'] ?>&num=<?php echo $codigo?>" method="post" enctype="multipart/form-data">
										<label>Selecione o comprovante: </label>
										<input type="file" name="pg" required><br>
										<input type="submit" value="Enviar">
									</form>
								</div>
							</div>
						<?php
					}
				?>
				<script type="text/javascript">
				function alter_status(codigo) {
					var status = document.querySelector("#status" + codigo).value;
					var result = post("../../controller/status_resultado.php", {codigo: codigo,status: status}, "post");
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