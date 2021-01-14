<?php
	// setStripePaymentID.php
	// This file gets the Stripe Payment Intent ID (starts with "pi_") and stores it on the PHP Session.
  	session_start();
  	require '../vendor/autoload.php';


	$name = $_GET["name"];
	$email = $_GET["email"];
	$type = $_GET["type"];

	$stripe = new \Stripe\StripeClient(
	  'sk_test_51HrVqWBbuMWasaUbJLEaqlHGcsiW1auktCUhXyTeMEpzLgDNS9Up3ZDLkDooK4mobCGKPQNCLWxhi1JSMOHpL3rb00aWnBaAqm'
	);

	$customer = $stripe->customers->create([
	  'name' => $name,
	  'email' => $email,
	  'description' => $type,
	  'metadata' => ["customer_type" => $type]
	]);

	echo json_encode($customer);

?>