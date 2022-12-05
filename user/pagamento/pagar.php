<?php
	$titulo = "Enviar prova";
	include_once('../../config/link.php');
	include_once('../../content/header.php');
	include_once('../../content/nav.php');
	if (isset($_SESSION['user']['codigo'])) {
		include_once('../../controller/conexao.php');
		$codigo = $_GET['codigo'];
		$hoje = date('Y-m-d');
		// SDK do Mercado Pago
		require __DIR__ .  '/vendor/autoload.php';
		// Adicione as credenciais
		MercadoPago\SDK::setAccessToken('TEST-1267818241403213-110514-8688039de135c690ed22b9e7ba91803e-537900891');
		// Cria um objeto de preferência
		$preference = new MercadoPago\Preference();

		// Cria um item na preferência
		$item = new MercadoPago\Item();
		$item->title = 'Fp Corridas';
		$item->quantity = 1;
		$item->unit_price = 10;
		$preference->items = array($item);
		$preference->save();
	?>
	<script src="https://sdk.mercadopago.com/js/v2"></script>
	<div class="cho-container"></div>
	<script>
	  const mp = new MercadoPago('TEST-7323df1a-a75c-4056-a0dc-74a57bafdc57', {
	    locale: 'pt-BR'
	  });

	  mp.checkout({
	    preference: {
	      id: ''
	    },
	    render: {
	      container: '.cho-container',
	      label: 'Pagar',
	    }
	  });
	</script>

	<?php
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../../login.php');
	}
	include_once('../../content/footer.php');
?>