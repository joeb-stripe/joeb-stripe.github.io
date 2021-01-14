<?php
	// setStripePaymentID.php
	// This file gets the Stripe Payment Intent ID (starts with "pi_") and stores it on the PHP Session.
  	session_start();
  	require '../vendor/autoload.php';

	$email = $_GET["email"];

	$stripe = new \Stripe\StripeClient(
	  'sk_test_51HrVqWBbuMWasaUbJLEaqlHGcsiW1auktCUhXyTeMEpzLgDNS9Up3ZDLkDooK4mobCGKPQNCLWxhi1JSMOHpL3rb00aWnBaAqm'
	);

	if($email=="joebeut@gmail.com"){
		$customerId = "cus_Ii7VEERexkC9HN";
	}else if($email=="joeb@stripe.com"){
		$customerId = "cus_Ii9915RfHLUWQk";
	}

	$customer = $stripe->customers->retrieve(
	  $customerId,
	  []
	);

	echo json_encode($customer);

?>