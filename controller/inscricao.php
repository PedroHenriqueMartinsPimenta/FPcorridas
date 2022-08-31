<?php
	session_start();
	require_once 'vendor/autoload.php';
	if (isset($_GET['id']) && isset($_SESSION['user'])) {
		include_once('conexao.php');
		$id = $_GET['id'];
		if ($id == 1) {
			// Adiciona novo parceiro
			$codigo = $_GET['codigo'];

			 
 
			   MercadoPago\SDK::setAccessToken("TEST-5473923467736275-083020-63facf96b61960eb7b37fc7aeacffdf7-537900891");
			 
			   $payment = new MercadoPago\Payment();
			   $payment->transaction_amount = (float)$_POST['transactionAmount'];
			   $payment->token = $_POST['token'];
			   $payment->description = $_POST['description'];
			   $payment->installments = (int)$_POST['installments'];
			   $payment->payment_method_id = $_POST['paymentMethodId'];
			   $payment->issuer_id = (int)$_POST['issuer'];
			 
			   $payer = new MercadoPago\Payer();
			   $payer->email = $_POST['email'];
			   $payer->identification = array(
			       "type" => $_POST['identificationType'],
			       "number" => $_POST['identificationNumber']
			   );
			   $payment->payer = $payer;
			 
			   $payment->save();
			 
			   $response = array(
			       'status' => $payment->status,
			       'status_detail' => $payment->status_detail,
			       'id' => $payment->id
			   );
			   echo json_encode($response);
		}
	}else{
		$_SESSION['erro'] = "Você não tem permissão!";
		header('location: ../');
	}
?>