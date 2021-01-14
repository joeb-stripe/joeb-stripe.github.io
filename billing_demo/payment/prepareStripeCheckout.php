<?php 
  session_start();

	require_once('./configNew.php'); 

	// Price is number of cents, so $9.50 is 950
	// $description = "Order Ahead | " . $_SESSION['restaurant_name'];

	$postdata = file_get_contents("php://input");
  $request = json_decode($postdata);
  $cart = $request->cart;
  $plan = $request->plan;
  $customer = $request->customer;


  $subtotal = $cart->subtotal;
  $total = $cart->total;

  // // Set customer session variables
  $_SESSION['priceId'] = $plan->priceId; 
  $_SESSION['customerName'] = $customer->name; 
  $_SESSION['customerEmail'] = $customer->email; 
  $_SESSION['customerId'] = $customer->id; 
  $_SESSION['cart'] = $cart; 
  $_SESSION['subtotal'] = $subtotal; 
  $_SESSION['total'] = $total; 

  // // Stripe Price is number of cents, so $9.50 is 950
  // $_SESSION['stripeTotal'] = floatval($total)*100; 

  // echo $_SESSION['stripeTotal'];

  // Create array for Stripe Checkout line items
  $lineItems = [];

  // TODO: should put in the order to generate the order id here, but I don't have any of the contact info there yet
  // $orderId = $_SESSION['orderId'];

  // Loop through all items to insert into DB
  $items = $cart->cartItems;

  for($x=0; $x<count($items); $x++){

    $itemName = stripslashes($items[$x]->itemName);
    $itemPrice = stripslashes($items[$x]->itemPrice);
    $cartCount = stripslashes($items[$x]->cartCount);

    $itemName = addslashes($items[$x]->itemName);
    $itemPrice = addslashes($items[$x]->itemPrice);
    $cartCount = addslashes($items[$x]->cartCount);


    // Add menu items to the $lineItems array for Stripe Checkout
    $thisPrice = floatval($itemPrice) * 100;
    $thisPrice = intval($thisPrice);

    $thisItem = [
      'price_data' => [
        'currency' => 'usd',
        'product_data' => [
          'name' => $itemName,
        ],
        'unit_amount' => $thisPrice,
      ],
      'quantity' => $cartCount,
    ];

    array_push($lineItems, $thisItem);
  }

  

  // will need to include tax and fees as line items
  // I could create line items for Subtotal, fees, and tax

  // set the $lineItems above in loop with each item
  // add lineItems for fees, tax, tip, etc.


  $fees = intval($fees);

  $addSalesTax = [
      'price_data' => [
        'currency' => 'usd',
        'product_data' => [
          'name' => 'Sales Tax',
        ],
        'unit_amount' => $salesTax,
      ],
      'quantity' => 1,
    ];

  array_push($lineItems, $addSalesTax);

  $statementRestaurant = str_replace("'", "", $_SESSION['restaurant_name']);
  $descriptor = substr($statementRestaurant . " Online Order", 0, 22);
  $statementDescription = $statementRestaurant . " " . $orderType . " Order powered by DASH/Pronto. Contact: orders@dinewithdash.com";


  


  $session = \Stripe\Checkout\Session::create([
    // 'customer_email' => $customerEmail,
    'payment_method_types' => ['card'],
    'payment_intent_data' => [
      'setup_future_usage' => 'off_session',
    ],
    'line_items' => $lineItems,
    'payment_intent_data' => [
      'application_fee_amount' => $prontoFee,
      // 'on_behalf_of' => 'acct_1Dvg2sEoGKHO3Z7S',
      // 'transfer_data' => [
      //   'destination' => 'acct_1HrCU4RSwWlyAgC2'
      // ]
    ],
    'metadata' => [
      'statement_descriptor_suffix' => $descriptor,
      'description' => $statementDescription,
      'restaurant_id' => $_SESSION['restaurant_id'],
      'restaurant_name' => $_SESSION['restaurant_name']
    ],
    'mode' => 'payment',
    'allow_promotion_codes' => true,
    'success_url' => 'https://caterpronto.com/payment/ajax/executeOrder.php',
    'cancel_url' => 'https://caterpronto.com/#/cancel',
  ], ['stripe_account' => $stripeId]); // Will need to pull and update the connected accound ID here

  $_SESSION['stripeSessionId'] = $session->id;

  // Return the sessionId, public key, and stripe connected account ID
  $results = [
    'sessionId' => $session->id,
    'stripePK' => $stripe['publishable_key'],
    'stripeId' => $stripeId
  ];

  echo $json_response = json_encode($results);

?>