<?php 
  // addCartToSession.php
  // This will store all required variables from the shopping cart on the PHP Session so they can be retrieved in other scripts.
  session_start();

  require '../vendor/autoload.php';
  \Stripe\Stripe::setApiKey('sk_test_51HrVqWBbuMWasaUbJLEaqlHGcsiW1auktCUhXyTeMEpzLgDNS9Up3ZDLkDooK4mobCGKPQNCLWxhi1JSMOHpL3rb00aWnBaAqm');


  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);
  $customer = $request->customer;
  $cart = $request->cart;
  $plan = $request->plan;

  // Prevent basic XSS for user inputed values
  // $customerName = stripslashes($order->customerName);
  // $customerEmail = stripslashes($order->customerEmail);
  $subtotal = stripslashes($cart->subtotal);
  $total = stripslashes($cart->total);

  // $customerName = addslashes($order->customerName);
  // $customerEmail = addslashes($order->customerEmail);
  $subtotal = addslashes($cart->subtotal);
  $total = addslashes($cart->total);


  // REPLACE THE ASCII CODE WITH THE @ FOR EMAILS.....
  // $customerEmail = str_replace("%64", "@", $customerEmail);

  // Set customer session variables
  $_SESSION['priceId'] = $plan->priceId; 
  $_SESSION['customerName'] = $customer->name; 
  $_SESSION['customerEmail'] = $customer->email; 
  $_SESSION['customerId'] = $customer->id; 
  $_SESSION['cart'] = $cart; 
  $_SESSION['subtotal'] = $subtotal; 
  $_SESSION['total'] = $total; 

  // Stripe Price is number of cents, so $9.50 is 950
  $_SESSION['stripeTotal'] = floatval($total)*100; 

    // 'success_url' => 'https://localhost:8000/checkout/success.php?session_id={CHECKOUT_SESSION_ID}',
  $checkout_session = \Stripe\Checkout\Session::create([
    'success_url' => 'https://localhost:8000/#/cart',
    'cancel_url' => 'https://joebeutler.com/checkout/cancel.html',
    'payment_method_types' => ['card'],
    'mode' => 'subscription',
    'line_items' => [[
      'price' => $_SESSION['priceId'],
      // For metered billing, do not pass quantity
      'quantity' => 1,
    ]],
  ]);

  // Add this to the page where Checkout redirects upon success. It should pull the subscription and add a 30 day trial.
  // Pull subscription
  // $stripe = new \Stripe\StripeClient(
  //   'sk_test_51HrVqWBbuMWasaUbJLEaqlHGcsiW1auktCUhXyTeMEpzLgDNS9Up3ZDLkDooK4mobCGKPQNCLWxhi1JSMOHpL3rb00aWnBaAqm'
  // );

  // $nowTime = time();
  // $thirtyDaysSeconds = 30 * 86400;
  // $thirtyDays = $nowTime + $thirtyDaysSeconds;


  // $stripe->subscriptions->update(
  //   $checkout_session->subscription->id,
  //   ['trial_start' => $nowTime, 'trial_end' => $thirtyDays]
  // );

  // Add 30 day trial to the subscription

  $_SESSION['checkout_session'] = $checkout_session->id;
  echo $_SESSION['checkout_session'];
?>



