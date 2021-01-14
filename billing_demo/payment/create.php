<?php
  // create.php - provided by Stripe Payment API, passes order total from Session to create a paymentIntent and return the client secret.
  session_start();

  require '../vendor/autoload.php';
  // This is your real test secret API key.
  \Stripe\Stripe::setApiKey('sk_test_51HrVqWBbuMWasaUbJLEaqlHGcsiW1auktCUhXyTeMEpzLgDNS9Up3ZDLkDooK4mobCGKPQNCLWxhi1JSMOHpL3rb00aWnBaAqm');

  // Payment intent mode for one-time payment
  // try {
    
  //   $paymentIntent = \Stripe\PaymentIntent::create([
  //     'amount' => $_SESSION['stripeTotal'],
  //     'currency' => 'usd',
  //     'customer' => $_SESSION['customerId'],
  //   ]);
  //   $output = [
  //     'clientSecret' => $paymentIntent->client_secret,
  //   ];
  //   echo json_encode($output);

  // } catch (Error $e) {
  //   http_response_code(500);
  //   echo json_encode(['error' => $e->getMessage()]);
  // }

  // Subscription mode with Stripe Billing
  try {
    // See https://stripe.com/docs/api/checkout/sessions/create
    // for additional parameters to pass.
    // {CHECKOUT_SESSION_ID} is a string literal; do not change it!
    // the actual Session ID is returned in the query parameter when your customer
    // is redirected to the success page.
    $checkout_session = \Stripe\Checkout\Session::create([
      'success_url' => 'https://example.com/success.html?session_id={CHECKOUT_SESSION_ID}',
      'cancel_url' => 'https://example.com/canceled.html',
      'payment_method_types' => ['card'],
      'mode' => 'subscription',
      'line_items' => [[
        'price' => $body->priceId,
        // For metered billing, do not pass quantity
        'quantity' => 1,
      ]],
    ]);

    $output = [
      'sessionId' => $checkout_session['id'],
    ];

    echo json_encode($output);
  } catch (Exception $e) {
    $error = [
        'message' => $e->getError()->message,
    ];

    echo json_encode($error);
  }


?>