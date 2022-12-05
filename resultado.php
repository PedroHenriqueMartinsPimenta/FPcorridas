<?php
	$titulo = "Minhas corridas";
	include_once('config/link.php');
	include_once('content/header.php');
	include_once('content/nav.php');
	include_once('controller/conexao.php');
	$titulo = "Minhas corridas";
	if (!isset($_GET['codigo'])) {
	?>
	<div class="row">
		<div class="col-12">
			<form action="resultado.php" method="get">
				<label>Selecione a prova: </label>
				<select name="codigo">
					<?php
						$sql = "SELECT * FROM prova WHERE DISPONIVEL = 1";
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
	}else{
		$codigo = $_GET['codigo'];
		$sql = "SELECT CATEGORIA FROM prova WHERE CODIGO = $codigo";
		$query = mysqli_query($con, $sql);
		$is_categoria = mysqli_fetch_array($query)['CATEGORIA'];
		$premiados_m = array(0,0,0);
		$premiados_f = array(0,0,0);
		$a = 0;
		$b = 0;
	?>
	<div class="row mb-3">
		<div class="col-12">
			<form action="minhas_corridas.php" method="post">
				<div class="row">
					<div class="col-md-10">
						<input type="text" name="numero" id="numero" placeholder="Pesquisa pelo número de peito">
					</div>
					<div class="col-md-2">
						<button type="button" onclick="pesquisar()">Pesquisar</button>
						
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<h4>Masculino Geral:</h4>
			<div style=" max-width: 100%;overflow: scroll;">
				<table class="" style="">
				  <caption>Masculino geral</caption>
				  <thead>
				    <tr>
				      <th width="100px">Colocação</th>
				      <th width="100px">Número de peito</th>
				      <td width="200px">Nome</td>
				      <td width="100px">Idade</td>
				      <td width="100px">Distancia</td>
				      <td width="200px">Evento</td>
				      <td width="110px">Tempo</td>		
				      <?php
				      	if (isset($_SESSION['user'])) {
				      		?>
				      		<td width="100px">Pagamento</td>
				      		<?php
				      	}
				      ?>				
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  		
				  		$sql = "SELECT resultado.HORA, resultado.MINUTO, resultado.SEGUNDO, resultado.DATA, resultado.PAGO, resultado.PG_COMPROVANTE AS COMPROVANTE, resultado.inscrito_CODIGO AS NUMERO, inscrito.atleta_CODIGO, usuario.NOME, usuario.SOBRENOME, YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(usuario.NASC))) AS IDADE, usuario.TELEFONE, usuario.NASC, prova.NOME AS PROVA, prova.DATA AS PROVA_DIA, prova.DISTANCIA FROM resultado INNER JOIN inscrito ON resultado.inscrito_CODIGO = inscrito.CODIGO INNER JOIN usuario ON inscrito.atleta_CODIGO = usuario.CODIGO INNER JOIN prova ON inscrito.prova_CODIGO = prova.CODIGO WHERE inscrito.ATIVO = 1 AND inscrito.PAGO = 1 AND prova.CODIGO = $codigo AND usuario.SEXO = 'M' AND resultado.VALIDADO != 2 ORDER BY resultado.HORA, resultado.MINUTO, resultado.SEGUNDO ASC";
				  		$i = 0;
				  		$query = mysqli_query($con, $sql);
				  		while($row = mysqli_fetch_array($query)){
				  			$i +=1;
				  			if ($i <= 3) {
				  				$premiados_m[$a] = $row['atleta_CODIGO'];
				  				$a++;
				  			}
				  				?>
				  				
				  				<tr>
				  					<td><?php echo $i?>ª</td>
				  					<td id="numero<?php echo $row['NUMERO']?>"><?php echo $row['NUMERO']?></td>
				  					<td><?php echo $row['NOME'] . " " . $row['SOBRENOME']?></td>
				  					<td><?php echo $row['IDADE']?> anos</td>
				  					<td><?php echo $row['DISTANCIA']?>Km</td>
				  					<td><?php echo $row['PROVA']?></td>
				  					<td><?php echo $row['HORA'] . "h :" . $row['MINUTO'] . "m :" . $row['SEGUNDO'] . "s"?></td>
				  					<?php
				  						if (isset($_SESSION['user'])) {
				  							if ($i <= 3 && $row['atleta_CODIGO'] == $_SESSION['user']['codigo']) {
				  								if ($row['PAGO'] == 0 && $row['PROVA_DIA'] < date('Y-m-d')) {
				  									?>
				  									<td>Aguarde... Estamos trabalhando nisso ;)</td>
				  									<?php
				  								}else if ($row['PAGO'] == 1) {
				  									?>
				  									<td><a href="<?php echo $row['COMPROVANTE']?>"> Ver comprovante</a></td>
				  									<?php
				  								}
				  							}
				  						}
				  					?>

				  				</tr>
				  			<?php
				  		}
				  	?>
				  	
				  </tbody>
				</table> 		
			</div>
		</div>
	</div>
	<hr>

		<div class="row">
		<div class="col-12">
			<h4>Feminino Geral:</h4>
			<div style=" max-width: 100%;overflow: scroll;">
				<table class="" style="">
				  <caption>Feminino geral</caption>
				  <thead>
				    <tr>
				      <th width="100px">Colocação</th>
				      <th width="100px">Número de peito</th>
				      <td width="200px">Nome</td>
				      <td width="100px">Idade</td>
				      <td width="100px">Distancia</td>
				      <td width="200px">Evento</td>
				      <td width="110px">Tempo</td>		
				      <?php
				      	if (isset($_SESSION['user'])) {
				      		?>
				      		<td width="100px">Pagamento</td>
				      		<?php
				      	}
				      ?>				
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  		
				  		$sql = "SELECT resultado.HORA, resultado.MINUTO, resultado.SEGUNDO, resultado.DATA, resultado.PAGO, resultado.PG_COMPROVANTE AS COMPROVANTE, resultado.inscrito_CODIGO AS NUMERO, inscrito.atleta_CODIGO, usuario.NOME, usuario.SOBRENOME, YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(usuario.NASC))) AS IDADE, usuario.TELEFONE, usuario.NASC, prova.NOME AS PROVA, prova.DATA AS PROVA_DIA, prova.DISTANCIA FROM resultado INNER JOIN inscrito ON resultado.inscrito_CODIGO = inscrito.CODIGO INNER JOIN usuario ON inscrito.atleta_CODIGO = usuario.CODIGO INNER JOIN prova ON inscrito.prova_CODIGO = prova.CODIGO WHERE inscrito.ATIVO = 1 AND inscrito.PAGO = 1 AND prova.CODIGO = $codigo AND usuario.SEXO = 'F' AND resultado.VALIDADO != 2 ORDER BY resultado.HORA, resultado.MINUTO, resultado.SEGUNDO ASC";
				  		$i = 0;
				  		$query = mysqli_query($con, $sql);
				  		while($row = mysqli_fetch_array($query)){
				  			$i +=1;
				  			if ($i <= 3) {
				  				$premiados_f[$b] = $row['atleta_CODIGO'];
				  				$b++;
				  			}
				  				?>
				  				
				  				<tr>
				  					<td><?php echo $i?>ª</td>
				  					<td id="numero<?php echo $row['NUMERO']?>"><?php echo $row['NUMERO']?></td>
				  					<td><?php echo $row['NOME'] . " " . $row['SOBRENOME']?></td>
				  					<td><?php echo $row['IDADE']?> anos</td>
				  					<td><?php echo $row['DISTANCIA']?>Km</td>
				  					<td><?php echo $row['PROVA']?></td>
				  					<td><?php echo $row['HORA'] . "h :" . $row['MINUTO'] . "m :" . $row['SEGUNDO'] . "s"?></td>
				  					<?php
				  						if (isset($_SESSION['user'])) {
				  							if ($i <= 3 && $row['atleta_CODIGO'] == $_SESSION['user']['codigo']) {
				  								if ($row['PAGO'] == 0 && $row['PROVA_DIA'] < date('Y-m-d')) {
				  									?>
				  									<td>Aguarde... Estamos trabalhando nisso ;)</td>
				  									<?php
				  								}else if ($row['PAGO'] == 1) {
				  									?>
				  									<td><a href="<?php echo $row['COMPROVANTE']?>"> Ver comprovante</a></td>
				  									<?php
				  								}
				  							}
				  						}
				  					?>

				  				</tr>
				  			<?php
				  		}
				  	?>
				  	
				  </tbody>
				</table> 		
			</div>
		</div>
	</div>

	<?php
		if ($is_categoria == 1) {
			?>
			<hr>


		<div class="row">
		<div class="col-12">
			<h4>Masculino 18 - 30 anos:</h4>
			<div style=" max-width: 100%;overflow: scroll;">
				<table class="" style="">
				  <caption>Masculino 18 - 30 anos:</caption>
				  <thead>
				    <tr>
				      <th width="100px">Colocação</th>
				      <th width="100px">Número de peito</th>
				      <td width="200px">Nome</td>
				      <td width="100px">Idade</td>
				      <td width="100px">Distancia</td>
				      <td width="200px">Evento</td>
				      <td width="110px">Tempo</td>		
				      <?php
				      	if (isset($_SESSION['user'])) {
				      		?>
				      		<td width="100px">Pagamento</td>
				      		<?php
				      	}
				      ?>				
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  		
				  		$sql = "SELECT resultado.HORA, resultado.MINUTO, resultado.SEGUNDO, resultado.DATA, resultado.PAGO, resultado.PG_COMPROVANTE AS COMPROVANTE, resultado.inscrito_CODIGO AS NUMERO, inscrito.atleta_CODIGO, usuario.NOME, usuario.SOBRENOME, YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(usuario.NASC))) AS IDADE, usuario.TELEFONE, usuario.NASC, prova.NOME AS PROVA, prova.DATA AS PROVA_DIA, prova.DISTANCIA FROM resultado INNER JOIN inscrito ON resultado.inscrito_CODIGO = inscrito.CODIGO INNER JOIN usuario ON inscrito.atleta_CODIGO = usuario.CODIGO INNER JOIN prova ON inscrito.prova_CODIGO = prova.CODIGO WHERE inscrito.ATIVO = 1 AND inscrito.PAGO = 1 AND prova.CODIGO = $codigo AND usuario.SEXO = 'M' AND resultado.VALIDADO != 2  AND inscrito.atleta_CODIGO != '$premiados_m[0]' AND inscrito.atleta_CODIGO != '$premiados_m[1]' AND inscrito.atleta_CODIGO != '$premiados_m[2]'  HAVING IDADE >= 18 AND IDADE <= 30 ORDER BY resultado.HORA, resultado.MINUTO, resultado.SEGUNDO ASC ";
				  		$i = 0;
				  		$query = mysqli_query($con, $sql);
				  		while($row = mysqli_fetch_array($query)){
				  			$i +=1;
				  			if ($i <= 3) {
				  				$premiados_m[$a] = $row['atleta_CODIGO'];
				  				$a++;
				  			}
				  				?>
				  				
				  				<tr>
				  					<td><?php echo $i?>ª</td>
				  					<td id="numero<?php echo $row['NUMERO']?>"><?php echo $row['NUMERO']?></td>
				  					<td><?php echo $row['NOME'] . " " . $row['SOBRENOME']?></td>
				  					<td><?php echo $row['IDADE']?> anos</td>
				  					<td><?php echo $row['DISTANCIA']?>Km</td>
				  					<td><?php echo $row['PROVA']?></td>
				  					<td><?php echo $row['HORA'] . "h :" . $row['MINUTO'] . "m :" . $row['SEGUNDO'] . "s"?></td>
				  					<?php
				  						if (isset($_SESSION['user'])) {
				  							if ($i <= 1 && $row['atleta_CODIGO'] == $_SESSION['user']['codigo']) {
				  								if ($row['PAGO'] == 0 && $row['PROVA_DIA'] < date('Y-m-d')) {
				  									?>
				  									<td>Aguarde... Estamos trabalhando nisso ;)</td>
				  									<?php
				  								}else if ($row['PAGO'] == 1) {
				  									?>
				  									<td><a href="<?php echo $row['COMPROVANTE']?>"> Ver comprovante</a></td>
				  									<?php
				  								}
				  							}
				  						}
				  					?>

				  				</tr>
				  			<?php
				  		}
				  	?>
				  	
				  </tbody>
				</table> 		
			</div>
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="col-12">
			<h4>Feminino 18 - 30 anos:</h4>
			<div style=" max-width: 100%;overflow: scroll;">
				<table class="" style="">
				  <caption>Feminino 18 - 30 anos:</caption>
				  <thead>
				    <tr>
				      <th width="100px">Colocação</th>
				      <th width="100px">Número de peito</th>
				      <td width="200px">Nome</td>
				      <td width="100px">Idade</td>
				      <td width="100px">Distancia</td>
				      <td width="200px">Evento</td>
				      <td width="110px">Tempo</td>		
				      <?php
				      	if (isset($_SESSION['user'])) {
				      		?>
				      		<td width="100px">Pagamento</td>
				      		<?php
				      	}
				      ?>				
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  		
				  		$sql = "SELECT resultado.HORA, resultado.MINUTO, resultado.SEGUNDO, resultado.DATA, resultado.PAGO, resultado.PG_COMPROVANTE AS COMPROVANTE, resultado.inscrito_CODIGO AS NUMERO, inscrito.atleta_CODIGO, usuario.NOME, usuario.SOBRENOME, YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(usuario.NASC))) AS IDADE, usuario.TELEFONE, usuario.NASC, prova.NOME AS PROVA, prova.DATA AS PROVA_DIA, prova.DISTANCIA FROM resultado INNER JOIN inscrito ON resultado.inscrito_CODIGO = inscrito.CODIGO INNER JOIN usuario ON inscrito.atleta_CODIGO = usuario.CODIGO INNER JOIN prova ON inscrito.prova_CODIGO = prova.CODIGO WHERE inscrito.ATIVO = 1 AND inscrito.PAGO = 1 AND prova.CODIGO = $codigo AND usuario.SEXO = 'F' AND resultado.VALIDADO != 2  AND inscrito.atleta_CODIGO != '$premiados_f[0]' AND inscrito.atleta_CODIGO != '$premiados_f[1]' AND inscrito.atleta_CODIGO != '$premiados_f[2]'  HAVING IDADE >= 18 AND IDADE <= 30 ORDER BY resultado.HORA, resultado.MINUTO, resultado.SEGUNDO ASC ";
				  		$i = 0;
				  		$query = mysqli_query($con, $sql);
				  		while($row = mysqli_fetch_array($query)){
				  			$i +=1;
				  			if ($i <= 3) {
				  				$premiados_f[$b] = $row['atleta_CODIGO'];
				  				$b++;
				  			}
				  				?>
				  				
				  				<tr>
				  					<td><?php echo $i?>ª</td>
				  					<td id="numero<?php echo $row['NUMERO']?>"><?php echo $row['NUMERO']?></td>
				  					<td><?php echo $row['NOME'] . " " . $row['SOBRENOME']?></td>
				  					<td><?php echo $row['IDADE']?> anos</td>
				  					<td><?php echo $row['DISTANCIA']?>Km</td>
				  					<td><?php echo $row['PROVA']?></td>
				  					<td><?php echo $row['HORA'] . "h :" . $row['MINUTO'] . "m :" . $row['SEGUNDO'] . "s"?></td>
				  					<?php
				  						if (isset($_SESSION['user'])) {
				  							if ($i <= 1 && $row['atleta_CODIGO'] == $_SESSION['user']['codigo']) {
				  								if ($row['PAGO'] == 0 && $row['PROVA_DIA'] < date('Y-m-d')) {
				  									?>
				  									<td>Aguarde... Estamos trabalhando nisso ;)</td>
				  									<?php
				  								}else if ($row['PAGO'] == 1) {
				  									?>
				  									<td><a href="<?php echo $row['COMPROVANTE']?>"> Ver comprovante</a></td>
				  									<?php
				  								}
				  							}
				  						}
				  					?>

				  				</tr>
				  			<?php
				  		}
				  	?>
				  	
				  </tbody>
				</table> 		
			</div>
		</div>
	</div>

	<hr>


		<div class="row">
		<div class="col-12">
			<h4>Masculino 31 - 40 anos:</h4>
			<div style=" max-width: 100%;overflow: scroll;">
				<table class="" style="">
				  <caption>Masculino 31 - 40 anos:</caption>
				  <thead>
				    <tr>
				      <th width="100px">Colocação</th>
				      <th width="100px">Número de peito</th>
				      <td width="200px">Nome</td>
				      <td width="100px">Idade</td>
				      <td width="100px">Distancia</td>
				      <td width="200px">Evento</td>
				      <td width="110px">Tempo</td>		
				      <?php
				      	if (isset($_SESSION['user'])) {
				      		?>
				      		<td width="100px">Pagamento</td>
				      		<?php
				      	}
				      ?>				
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  		
				  		$sql = "SELECT resultado.HORA, resultado.MINUTO, resultado.SEGUNDO, resultado.DATA, resultado.PAGO, resultado.PG_COMPROVANTE AS COMPROVANTE, resultado.inscrito_CODIGO AS NUMERO, inscrito.atleta_CODIGO, usuario.NOME, usuario.SOBRENOME, YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(usuario.NASC))) AS IDADE, usuario.TELEFONE, usuario.NASC, prova.NOME AS PROVA, prova.DATA AS PROVA_DIA, prova.DISTANCIA FROM resultado INNER JOIN inscrito ON resultado.inscrito_CODIGO = inscrito.CODIGO INNER JOIN usuario ON inscrito.atleta_CODIGO = usuario.CODIGO INNER JOIN prova ON inscrito.prova_CODIGO = prova.CODIGO WHERE inscrito.ATIVO = 1 AND inscrito.PAGO = 1 AND prova.CODIGO = $codigo AND usuario.SEXO = 'M' AND resultado.VALIDADO != 2  AND inscrito.atleta_CODIGO != '$premiados_m[0]' AND inscrito.atleta_CODIGO != '$premiados_m[1]' AND inscrito.atleta_CODIGO != '$premiados_m[2]'  HAVING IDADE >= 31 AND IDADE <= 40 ORDER BY resultado.HORA, resultado.MINUTO, resultado.SEGUNDO ASC ";
				  		$i = 0;
				  		$query = mysqli_query($con, $sql);
				  		while($row = mysqli_fetch_array($query)){
				  			$i +=1;
				  			if ($i <= 3) {
				  				$premiados_m[$a] = $row['atleta_CODIGO'];
				  				$a++;
				  			}
				  				?>
				  				
				  				<tr>
				  					<td><?php echo $i?>ª</td>
				  					<td id="numero<?php echo $row['NUMERO']?>"><?php echo $row['NUMERO']?></td>
				  					<td><?php echo $row['NOME'] . " " . $row['SOBRENOME']?></td>
				  					<td><?php echo $row['IDADE']?> anos</td>
				  					<td><?php echo $row['DISTANCIA']?>Km</td>
				  					<td><?php echo $row['PROVA']?></td>
				  					<td><?php echo $row['HORA'] . "h :" . $row['MINUTO'] . "m :" . $row['SEGUNDO'] . "s"?></td>
				  					<?php
				  						if (isset($_SESSION['user'])) {
				  							if ($i <= 1 && $row['atleta_CODIGO'] == $_SESSION['user']['codigo']) {
				  								if ($row['PAGO'] == 0 && $row['PROVA_DIA'] < date('Y-m-d')) {
				  									?>
				  									<td>Aguarde... Estamos trabalhando nisso ;)</td>
				  									<?php
				  								}else if ($row['PAGO'] == 1) {
				  									?>
				  									<td><a href="<?php echo $row['COMPROVANTE']?>"> Ver comprovante</a></td>
				  									<?php
				  								}
				  							}
				  						}
				  					?>

				  				</tr>
				  			<?php
				  		}
				  	?>
				  	
				  </tbody>
				</table> 		
			</div>
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="col-12">
			<h4>Feminino 31 - 40 anos:</h4>
			<div style=" max-width: 100%;overflow: scroll;">
				<table class="" style="">
				  <caption>Feminino 31 - 40 anos:</caption>
				  <thead>
				    <tr>
				      <th width="100px">Colocação</th>
				      <th width="100px">Número de peito</th>
				      <td width="200px">Nome</td>
				      <td width="100px">Idade</td>
				      <td width="100px">Distancia</td>
				      <td width="200px">Evento</td>
				      <td width="110px">Tempo</td>		
				      <?php
				      	if (isset($_SESSION['user'])) {
				      		?>
				      		<td width="100px">Pagamento</td>
				      		<?php
				      	}
				      ?>				
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  		
				  		$sql = "SELECT resultado.HORA, resultado.MINUTO, resultado.SEGUNDO, resultado.DATA, resultado.PAGO, resultado.PG_COMPROVANTE AS COMPROVANTE, resultado.inscrito_CODIGO AS NUMERO, inscrito.atleta_CODIGO, usuario.NOME, usuario.SOBRENOME, YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(usuario.NASC))) AS IDADE, usuario.TELEFONE, usuario.NASC, prova.NOME AS PROVA, prova.DATA AS PROVA_DIA, prova.DISTANCIA FROM resultado INNER JOIN inscrito ON resultado.inscrito_CODIGO = inscrito.CODIGO INNER JOIN usuario ON inscrito.atleta_CODIGO = usuario.CODIGO INNER JOIN prova ON inscrito.prova_CODIGO = prova.CODIGO WHERE inscrito.ATIVO = 1 AND inscrito.PAGO = 1 AND prova.CODIGO = $codigo AND usuario.SEXO = 'F' AND resultado.VALIDADO != 2  AND inscrito.atleta_CODIGO != '$premiados_f[0]' AND inscrito.atleta_CODIGO != '$premiados_f[1]' AND inscrito.atleta_CODIGO != '$premiados_f[2]'  HAVING IDADE >= 31 AND IDADE <= 40 ORDER BY resultado.HORA, resultado.MINUTO, resultado.SEGUNDO ASC ";
				  		$i = 0;
				  		$query = mysqli_query($con, $sql);
				  		while($row = mysqli_fetch_array($query)){
				  			$i +=1;
				  			if ($i <= 3) {
				  				$premiados_f[$b] = $row['atleta_CODIGO'];
				  				$b++;
				  			}
				  				?>
				  				
				  				<tr>
				  					<td><?php echo $i?>ª</td>
				  					<td id="numero<?php echo $row['NUMERO']?>"><?php echo $row['NUMERO']?></td>
				  					<td><?php echo $row['NOME'] . " " . $row['SOBRENOME']?></td>
				  					<td><?php echo $row['IDADE']?> anos</td>
				  					<td><?php echo $row['DISTANCIA']?>Km</td>
				  					<td><?php echo $row['PROVA']?></td>
				  					<td><?php echo $row['HORA'] . "h :" . $row['MINUTO'] . "m :" . $row['SEGUNDO'] . "s"?></td>
				  					<?php
				  						if (isset($_SESSION['user'])) {
				  							if ($i <= 1 && $row['atleta_CODIGO'] == $_SESSION['user']['codigo']) {
				  								if ($row['PAGO'] == 0 && $row['PROVA_DIA'] < date('Y-m-d')) {
				  									?>
				  									<td>Aguarde... Estamos trabalhando nisso ;)</td>
				  									<?php
				  								}else if ($row['PAGO'] == 1) {
				  									?>
				  									<td><a href="<?php echo $row['COMPROVANTE']?>"> Ver comprovante</a></td>
				  									<?php
				  								}
				  							}
				  						}
				  					?>

				  				</tr>
				  			<?php
				  		}
				  	?>
				  	
				  </tbody>
				</table> 		
			</div>
		</div>
	</div>

		<hr>


		<div class="row">
		<div class="col-12">
			<h4>Masculino 41 - 59 anos:</h4>
			<div style=" max-width: 100%;overflow: scroll;">
				<table class="" style="">
				  <caption>Masculino 41 - 59 anos:</caption>
				  <thead>
				    <tr>
				      <th width="100px">Colocação</th>
				      <th width="100px">Número de peito</th>
				      <td width="200px">Nome</td>
				      <td width="100px">Idade</td>
				      <td width="100px">Distancia</td>
				      <td width="200px">Evento</td>
				      <td width="110px">Tempo</td>		
				      <?php
				      	if (isset($_SESSION['user'])) {
				      		?>
				      		<td width="100px">Pagamento</td>
				      		<?php
				      	}
				      ?>				
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  		
				  		$sql = "SELECT resultado.HORA, resultado.MINUTO, resultado.SEGUNDO, resultado.DATA, resultado.PAGO, resultado.PG_COMPROVANTE AS COMPROVANTE, resultado.inscrito_CODIGO AS NUMERO, inscrito.atleta_CODIGO, usuario.NOME, usuario.SOBRENOME, YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(usuario.NASC))) AS IDADE, usuario.TELEFONE, usuario.NASC, prova.NOME AS PROVA, prova.DATA AS PROVA_DIA, prova.DISTANCIA FROM resultado INNER JOIN inscrito ON resultado.inscrito_CODIGO = inscrito.CODIGO INNER JOIN usuario ON inscrito.atleta_CODIGO = usuario.CODIGO INNER JOIN prova ON inscrito.prova_CODIGO = prova.CODIGO WHERE inscrito.ATIVO = 1 AND inscrito.PAGO = 1 AND prova.CODIGO = $codigo AND usuario.SEXO = 'M' AND resultado.VALIDADO != 2  AND inscrito.atleta_CODIGO != '$premiados_m[0]' AND inscrito.atleta_CODIGO != '$premiados_m[1]' AND inscrito.atleta_CODIGO != '$premiados_m[2]'  HAVING IDADE >= 41 AND IDADE <= 59 ORDER BY resultado.HORA, resultado.MINUTO, resultado.SEGUNDO ASC ";
				  		$i = 0;
				  		$query = mysqli_query($con, $sql);
				  		while($row = mysqli_fetch_array($query)){
				  			$i +=1;
				  			if ($i <= 3) {
				  				$premiados_m[$a] = $row['atleta_CODIGO'];
				  				$a++;
				  			}
				  				?>
				  				
				  				<tr>
				  					<td><?php echo $i?>ª</td>
				  					<td id="numero<?php echo $row['NUMERO']?>"><?php echo $row['NUMERO']?></td>
				  					<td><?php echo $row['NOME'] . " " . $row['SOBRENOME']?></td>
				  					<td><?php echo $row['IDADE']?> anos</td>
				  					<td><?php echo $row['DISTANCIA']?>Km</td>
				  					<td><?php echo $row['PROVA']?></td>
				  					<td><?php echo $row['HORA'] . "h :" . $row['MINUTO'] . "m :" . $row['SEGUNDO'] . "s"?></td>
				  					<?php
				  						if (isset($_SESSION['user'])) {
				  							if ($i <= 1 && $row['atleta_CODIGO'] == $_SESSION['user']['codigo']) {
				  								if ($row['PAGO'] == 0 && $row['PROVA_DIA'] < date('Y-m-d')) {
				  									?>
				  									<td>Aguarde... Estamos trabalhando nisso ;)</td>
				  									<?php
				  								}else if ($row['PAGO'] == 1) {
				  									?>
				  									<td><a href="<?php echo $row['COMPROVANTE']?>"> Ver comprovante</a></td>
				  									<?php
				  								}
				  							}
				  						}
				  					?>

				  				</tr>
				  			<?php
				  		}
				  	?>
				  	
				  </tbody>
				</table> 		
			</div>
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="col-12">
			<h4>Feminino 41 - 59 anos:</h4>
			<div style=" max-width: 100%;overflow: scroll;">
				<table class="" style="">
				  <caption>Feminino 41 - 59 anos:</caption>
				  <thead>
				    <tr>
				      <th width="100px">Colocação</th>
				      <th width="100px">Número de peito</th>
				      <td width="200px">Nome</td>
				      <td width="100px">Idade</td>
				      <td width="100px">Distancia</td>
				      <td width="200px">Evento</td>
				      <td width="110px">Tempo</td>		
				      <?php
				      	if (isset($_SESSION['user'])) {
				      		?>
				      		<td width="100px">Pagamento</td>
				      		<?php
				      	}
				      ?>				
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  		
				  		$sql = "SELECT resultado.HORA, resultado.MINUTO, resultado.SEGUNDO, resultado.DATA, resultado.PAGO, resultado.PG_COMPROVANTE AS COMPROVANTE, resultado.inscrito_CODIGO AS NUMERO, inscrito.atleta_CODIGO, usuario.NOME, usuario.SOBRENOME, YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(usuario.NASC))) AS IDADE, usuario.TELEFONE, usuario.NASC, prova.NOME AS PROVA, prova.DATA AS PROVA_DIA, prova.DISTANCIA FROM resultado INNER JOIN inscrito ON resultado.inscrito_CODIGO = inscrito.CODIGO INNER JOIN usuario ON inscrito.atleta_CODIGO = usuario.CODIGO INNER JOIN prova ON inscrito.prova_CODIGO = prova.CODIGO WHERE inscrito.ATIVO = 1 AND inscrito.PAGO = 1 AND prova.CODIGO = $codigo AND usuario.SEXO = 'F' AND resultado.VALIDADO != 2  AND inscrito.atleta_CODIGO != '$premiados_f[0]' AND inscrito.atleta_CODIGO != '$premiados_f[1]' AND inscrito.atleta_CODIGO != '$premiados_f[2]'  HAVING IDADE >= 41 AND IDADE <= 59 ORDER BY resultado.HORA, resultado.MINUTO, resultado.SEGUNDO ASC ";
				  		$i = 0;
				  		$query = mysqli_query($con, $sql);
				  		while($row = mysqli_fetch_array($query)){
				  			$i +=1;
				  			if ($i <= 3) {
				  				$premiados_f[$b] = $row['atleta_CODIGO'];
				  				$b++;
				  			}
				  				?>
				  				
				  				<tr>
				  					<td><?php echo $i?>ª</td>
				  					<td id="numero<?php echo $row['NUMERO']?>"><?php echo $row['NUMERO']?></td>
				  					<td><?php echo $row['NOME'] . " " . $row['SOBRENOME']?></td>
				  					<td><?php echo $row['IDADE']?> anos</td>
				  					<td><?php echo $row['DISTANCIA']?>Km</td>
				  					<td><?php echo $row['PROVA']?></td>
				  					<td><?php echo $row['HORA'] . "h :" . $row['MINUTO'] . "m :" . $row['SEGUNDO'] . "s"?></td>
				  					<?php
				  						if (isset($_SESSION['user'])) {
				  							if ($i <= 1 && $row['atleta_CODIGO'] == $_SESSION['user']['codigo']) {
				  								if ($row['PAGO'] == 0 && $row['PROVA_DIA'] < date('Y-m-d')) {
				  									?>
				  									<td>Aguarde... Estamos trabalhando nisso ;)</td>
				  									<?php
				  								}else if ($row['PAGO'] == 1) {
				  									?>
				  									<td><a href="<?php echo $row['COMPROVANTE']?>"> Ver comprovante</a></td>
				  									<?php
				  								}
				  							}
				  						}
				  					?>

				  				</tr>
				  			<?php
				  		}
				  	?>
				  	
				  </tbody>
				</table> 		
			</div>
		</div>
	</div>

	<hr>


		<div class="row">
		<div class="col-12">
			<h4>Masculino 60+ anos:</h4>
			<div style=" max-width: 100%;overflow: scroll;">
				<table class="" style="">
				  <caption>Masculino 60+ anos:</caption>
				  <thead>
				    <tr>
				      <th width="100px">Colocação</th>
				      <th width="100px">Número de peito</th>
				      <td width="200px">Nome</td>
				      <td width="100px">Idade</td>
				      <td width="100px">Distancia</td>
				      <td width="200px">Evento</td>
				      <td width="110px">Tempo</td>		
				      <?php
				      	if (isset($_SESSION['user'])) {
				      		?>
				      		<td width="100px">Pagamento</td>
				      		<?php
				      	}
				      ?>				
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  		
				  		$sql = "SELECT resultado.HORA, resultado.MINUTO, resultado.SEGUNDO, resultado.DATA, resultado.PAGO, resultado.PG_COMPROVANTE AS COMPROVANTE, resultado.inscrito_CODIGO AS NUMERO, inscrito.atleta_CODIGO, usuario.NOME, usuario.SOBRENOME, YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(usuario.NASC))) AS IDADE, usuario.TELEFONE, usuario.NASC, prova.NOME AS PROVA, prova.DATA AS PROVA_DIA, prova.DISTANCIA FROM resultado INNER JOIN inscrito ON resultado.inscrito_CODIGO = inscrito.CODIGO INNER JOIN usuario ON inscrito.atleta_CODIGO = usuario.CODIGO INNER JOIN prova ON inscrito.prova_CODIGO = prova.CODIGO WHERE inscrito.ATIVO = 1 AND inscrito.PAGO = 1 AND prova.CODIGO = $codigo AND usuario.SEXO = 'M' AND resultado.VALIDADO != 2  AND inscrito.atleta_CODIGO != '$premiados_m[0]' AND inscrito.atleta_CODIGO != '$premiados_m[1]' AND inscrito.atleta_CODIGO != '$premiados_m[2]'  HAVING IDADE >= 60 ORDER BY resultado.HORA, resultado.MINUTO, resultado.SEGUNDO ASC ";
				  		$i = 0;
				  		$query = mysqli_query($con, $sql);
				  		while($row = mysqli_fetch_array($query)){
				  			$i +=1;
				  			if ($i <= 3) {
				  				$premiados_m[$a] = $row['atleta_CODIGO'];
				  				$a++;
				  			}
				  				?>
				  				
				  				<tr>
				  					<td><?php echo $i?>ª</td>
				  					<td id="numero<?php echo $row['NUMERO']?>"><?php echo $row['NUMERO']?></td>
				  					<td><?php echo $row['NOME'] . " " . $row['SOBRENOME']?></td>
				  					<td><?php echo $row['IDADE']?> anos</td>
				  					<td><?php echo $row['DISTANCIA']?>Km</td>
				  					<td><?php echo $row['PROVA']?></td>
				  					<td><?php echo $row['HORA'] . "h :" . $row['MINUTO'] . "m :" . $row['SEGUNDO'] . "s"?></td>
				  					<?php
				  						if (isset($_SESSION['user'])) {
				  							if ($i <= 1 && $row['atleta_CODIGO'] == $_SESSION['user']['codigo']) {
				  								if ($row['PAGO'] == 0 && $row['PROVA_DIA'] < date('Y-m-d')) {
				  									?>
				  									<td>Aguarde... Estamos trabalhando nisso ;)</td>
				  									<?php
				  								}else if ($row['PAGO'] == 1) {
				  									?>
				  									<td><a href="<?php echo $row['COMPROVANTE']?>"> Ver comprovante</a></td>
				  									<?php
				  								}
				  							}
				  						}
				  					?>

				  				</tr>
				  			<?php
				  		}
				  	?>
				  	
				  </tbody>
				</table> 		
			</div>
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="col-12">
			<h4>Feminino 60+ anos:</h4>
			<div style=" max-width: 100%;overflow: scroll;">
				<table class="" style="">
				  <caption>Feminino 60+ anos:</caption>
				  <thead>
				    <tr>
				      <th width="100px">Colocação</th>
				      <th width="100px">Número de peito</th>
				      <td width="200px">Nome</td>
				      <td width="100px">Idade</td>
				      <td width="100px">Distancia</td>
				      <td width="200px">Evento</td>
				      <td width="110px">Tempo</td>		
				      <?php
				      	if (isset($_SESSION['user'])) {
				      		?>
				      		<td width="100px">Pagamento</td>
				      		<?php
				      	}
				      ?>				
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  		
				  		$sql = "SELECT resultado.HORA, resultado.MINUTO, resultado.SEGUNDO, resultado.DATA, resultado.PAGO, resultado.PG_COMPROVANTE AS COMPROVANTE, resultado.inscrito_CODIGO AS NUMERO, inscrito.atleta_CODIGO, usuario.NOME, usuario.SOBRENOME, YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(usuario.NASC))) AS IDADE, usuario.TELEFONE, usuario.NASC, prova.NOME AS PROVA, prova.DATA AS PROVA_DIA, prova.DISTANCIA FROM resultado INNER JOIN inscrito ON resultado.inscrito_CODIGO = inscrito.CODIGO INNER JOIN usuario ON inscrito.atleta_CODIGO = usuario.CODIGO INNER JOIN prova ON inscrito.prova_CODIGO = prova.CODIGO WHERE inscrito.ATIVO = 1 AND inscrito.PAGO = 1 AND prova.CODIGO = $codigo AND usuario.SEXO = 'F' AND resultado.VALIDADO != 2  AND inscrito.atleta_CODIGO != '$premiados_f[0]' AND inscrito.atleta_CODIGO != '$premiados_f[1]' AND inscrito.atleta_CODIGO != '$premiados_f[2]'  HAVING IDADE >= 60 ORDER BY resultado.HORA, resultado.MINUTO, resultado.SEGUNDO ASC ";
				  		$i = 0;
				  		$query = mysqli_query($con, $sql);
				  		while($row = mysqli_fetch_array($query)){
				  			$i +=1;
				  			if ($i <= 3) {
				  				$premiados_f[$b] = $row['atleta_CODIGO'];
				  				$b++;
				  			}
				  				?>
				  				
				  				<tr>
				  					<td><?php echo $i?>ª</td>
				  					<td id="numero<?php echo $row['NUMERO']?>"><?php echo $row['NUMERO']?></td>
				  					<td><?php echo $row['NOME'] . " " . $row['SOBRENOME']?></td>
				  					<td><?php echo $row['IDADE']?> anos</td>
				  					<td><?php echo $row['DISTANCIA']?>Km</td>
				  					<td><?php echo $row['PROVA']?></td>
				  					<td><?php echo $row['HORA'] . "h :" . $row['MINUTO'] . "m :" . $row['SEGUNDO'] . "s"?></td>
				  					<?php
				  						if (isset($_SESSION['user'])) {
				  							if ($i <= 1 && $row['atleta_CODIGO'] == $_SESSION['user']['codigo']) {
				  								if ($row['PAGO'] == 0 && $row['PROVA_DIA'] < date('Y-m-d')) {
				  									?>
				  									<td>Aguarde... Estamos trabalhando nisso ;)</td>
				  									<?php
				  								}else if ($row['PAGO'] == 1) {
				  									?>
				  									<td><a href="<?php echo $row['COMPROVANTE']?>"> Ver comprovante</a></td>
				  									<?php
				  								}
				  							}
				  						}
				  					?>

				  				</tr>
				  			<?php
				  		}
				  	?>
				  	
				  </tbody>
				</table> 		
			</div>
		</div>
	</div>
			<?php
		}
	?>
  	<script type="text/javascript">
  		function pesquisar(){
  			var numero= document.querySelector('#numero').value;
  			document.querySelector('#numero'+numero).style.color = 'red'
  			window.location.href = "#numero" + numero;
  		}
  	</script>
			

	<?php
	}
	include_once('content/footer.php');
?>