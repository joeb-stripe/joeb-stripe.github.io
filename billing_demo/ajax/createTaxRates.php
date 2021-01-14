<?php

  // createTaxRates.php - provided by Stripe Payment API, passes order total from Session to create a paymentIntent and return the client secret.
  session_start();

  require '../vendor/autoload.php';
  // This is your real test secret API key.
  // \Stripe\Stripe::setApiKey('sk_test_51HrVqWBbuMWasaUbJLEaqlHGcsiW1auktCUhXyTeMEpzLgDNS9Up3ZDLkDooK4mobCGKPQNCLWxhi1JSMOHpL3rb00aWnBaAqm');

  \Stripe\Stripe::setApiKey('sk_test_51HrVqWBbuMWasaUbJLEaqlHGcsiW1auktCUhXyTeMEpzLgDNS9Up3ZDLkDooK4mobCGKPQNCLWxhi1JSMOHpL3rb00aWnBaAqm');


  $newTaxRates = array();

  $newTaxRates[] = \Stripe\TaxRate::create([
    'display_name' => 'Sales Tax',
    'description' => 'CA Sales Tax',
    'jurisdiction' => 'CA',
    'percentage' => 8.5,
    'inclusive' => false,
  ]);

  $newTaxRates[] = \Stripe\TaxRate::create([
    'display_name' => 'Sales Tax',
    'description' => 'TX Sales Tax',
    'jurisdiction' => 'TX',
    'percentage' => 8.25,
    'inclusive' => false,
  ]);

  echo json_encode($newTaxRates);

?>
