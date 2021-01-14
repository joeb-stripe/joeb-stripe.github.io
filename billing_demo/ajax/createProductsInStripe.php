<?php

  // createdProductsInStripe.php
  session_start();

  require '../vendor/autoload.php';
  // This is your real test secret API key.
  // \Stripe\Stripe::setApiKey('sk_test_51HrVqWBbuMWasaUbJLEaqlHGcsiW1auktCUhXyTeMEpzLgDNS9Up3ZDLkDooK4mobCGKPQNCLWxhi1JSMOHpL3rb00aWnBaAqm');

  $stripe = new \Stripe\StripeClient(
  	'sk_test_51HrVqWBbuMWasaUbJLEaqlHGcsiW1auktCUhXyTeMEpzLgDNS9Up3ZDLkDooK4mobCGKPQNCLWxhi1JSMOHpL3rb00aWnBaAqm'
	);

	$postdata = file_get_contents("php://input");
  $request = json_decode($postdata);
  // $order = $request->order;
  $products = $request->cart;
	
  if(isset($products)){
  	$newProducts = array();

  	// Loop through products to create them in Stripe
  	foreach($products as $product){
  		try {
	    
	    	// Create the product
		    $thisProduct = $stripe->products->create([
				  'name' => $product->itemName,
				  'description' => $product->itemDescription,
				]);

		    // Add thisProduct to the array
		    $newProducts[] = $thisProduct;

		    // Create prices for thisProduct, using the Stripe product ID
		    // Loop through available pricing options for this product

		    

		    foreach($product->billingPlans as $option){

		    	// Different scheme for per_unit prices and tiered pricing
		    	if($option->billing_scheme=="tiered"){
		    		echo "Tiers:<br>";
  					echo json_encode($option->tiers);

  					$tiers = array();
  					foreach($option->tiers as $tier){
  						$tiers[] = [
					      'unit_amount' => $tier->unit_amount,
					      'up_to' => $tier->up_to,
					    ];
  					}

		    		$stripe->prices->create([
						  'product' => $thisProduct->id,
						  'currency' => $option->currency,
						  'recurring' => [
						  	'interval' => $option->interval,
						  	'usage_type' => $option->usage_type
						  ],
						  'billing_scheme' => $option->billing_scheme,
						  'tiers_mode' => $option->tiers_mode,
						  'tiers' => $tiers,
						  'expand' => ['tiers']
						]);
		    	}elseif($option->billing_scheme=="per_unit"){

		    		$stripe->prices->create([
						  'product' => $thisProduct->id,
						  'currency' => $option->currency,
						  'unit_amount' => $option->unit_amount,
						  'recurring' => [
						  	'interval' => $option->interval,
						  	'usage_type' => $option->usage_type
						  ],
						]);
		    	}
			  }

		  } catch (Error $e) {
		    http_response_code(500);
		    echo json_encode(['error' => $e->getMessage()]);
		  }
		}
	}else {
  	echo "Error: No products provided.";
  }

  echo json_encode($newProducts);




?>
