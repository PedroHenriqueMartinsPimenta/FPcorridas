<?php
	$titulo = "Área do atleta";
	include_once('../config/link.php');
	include_once('../content/header.php');
	include_once('../content/nav.php');
	if (isset($_SESSION['user']['codigo'])) {
		$titulo = $_SESSION['user']['nome'];
	?>
	
	<?php
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../login.php');
	}
	include_once('../content/footer.php');
?>