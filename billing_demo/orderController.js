angular.module('stripeApp').controller('orderController', function ($scope, $http, $window, $location) {
  
  // Function loaded on page load
  checkPage();

  // Scope Variables (defaults)
  $scope.confirmation = {};
  $scope.selectedCustomerType = "Family";
  $scope.selectedProduct = {};
  $scope.selectedPlan = {};
  $scope.customer = {
    "name": "Joe Beutler",
    "email": "joebeut@gmail.com",
    "id": "",
    "customer_type": $scope.selectedCustomerType
  }

  // Object to store item objects as cart and cart attributes
  $scope.cart = {
    "subtotal": 0,
    "salesTax": 0,
    "total": 0,
    "itemCount": 0,
    "cartItems": []
  }; 

  // Array of item objects to populate the store - could pull from DB or JSON
  /*
  $stripe->prices->create([
    'unit_amount' => 2000,
    'currency' => 'usd',
    'recurring' => ['interval' => 'month'],
    'product' => 'prod_IaKPt5Q5bGu9Fp',
  ]);
  */

  $scope.customerTypes = [
    {
      "name": "Family"
    },
    {
      "name": "Schools"
    }
  ];

  $scope.products = [
    {
      "itemId": 0,
      "itemName": "Single Subject Product",
      "itemDescription": "Single Subject Product includes your choice of 1 subject from the following: Math, Language or Spanish.",
      "customerType": "Family",
      "billingPlans": [
        {
          "interval": "month",
          "currency": "usd",
          "unit_amount": 1000,
          "usage_type": "licensed",
          "billing_scheme": "per_unit",
          "description": "$10 per month",
          "priceId": "price_1I6fzXBbuMWasaUbuYjlF2BJ"
        },
        {
          "interval": "year",
          "currency": "usd",
          "unit_amount": 10000,
          "usage_type": "licensed",
          "billing_scheme": "per_unit",
          "description": "$100 per year",
          "priceId": "price_1I6fzXBbuMWasaUbdnhftoQr"
        },
      ],
      "subjects": ["Math", "Language", "Spanish"],
      "trial": "30 days"
    },
    {
      "itemId": 1,
      "itemName": "Core Subjects Product",
      "itemDescription": "Core Subjects Product includes all of the following: Math, Language, Arts and Science.",
      "customerType": "Family",
      "billingPlans": [
        {
          "interval": "month",
          "currency": "usd",
          "unit_amount": 2000,
          "usage_type": "licensed",
          "billing_scheme": "per_unit",
          "description": "$20 per month",
          "priceId": "price_1I6fzXBbuMWasaUbcOQBO70j"
        },
        {
          "interval": "year",
          "currency": "usd",
          "unit_amount": 20000,
          "usage_type": "licensed",
          "billing_scheme": "per_unit",
          "description": "$200 per year",
          "priceId": "price_1I6fzYBbuMWasaUbcgAO7W01"
        },
      ],
      "subjects": ["Math", "Language", "Arts", "Science"],
      "trial": "30 days"
    },
    {
      "itemId": 2,
      "itemName": "Classroom Product",
      "itemDescription": "The cost will be adjust to the quantity of seat in each classroom.",
      "customerType": "Schools",
      "billingPlans": [
        {
          "interval": "month",
          "currency": "usd",
          "usage_type": "licensed",
          "billing_scheme": "tiered",
          "description": "Tiered pricing, billed monthly",
          "priceId": "price_1I6fzYBbuMWasaUbZrKKAFnv",
          "tiers": [
            {
              "unit_amount": 10000,
              "up_to": "5"
            },
            {
              "unit_amount": 9500,
              "up_to": "10"
            },
            {
              "unit_amount": 9000,
              "up_to": "inf"
            }
          ],
          "tiers_mode": "volume", // graduated or volume based. In volume-based tiering, the maximum quantity within a period determines the per unit price, in graduated tiering pricing can successively change as the quantity grows.
        },
        {
          "interval": "year",
          "currency": "usd",
          "usage_type": "licensed",
          "billing_scheme": "tiered",
          "description": "Tiered pricing, billed yearly",
          "priceId": "price_1I6fzYBbuMWasaUbY6hkc5vI",
          "tiers": [
            {
              "unit_amount": 100000,
              "up_to": "5"
            },
            {
              "unit_amount": 95000,
              "up_to": "10"
            },
            {
              "unit_amount": 90000,
              "up_to": "inf"
            }
          ],
          "tiers_mode": "volume",
        },
      ],
      "subjects": ["Math", "Language", "Arts", "Science"],
      "trial": "30 days",
    },
    {
      "itemId": 3,
      "itemName": "School Product",
      "itemDescription": "The cost will depend on resource usage.",
      "customerType": "Schools",
      "billingPlans": [
        {
          "interval": "month",
          "currency": "usd",
          "unit_amount": 1000, // $10 per user 
          "usage_type": "metered", // metered billing means based on actual usage
          "billing_scheme": "per_unit",
          "priceId": "price_1I6fzZBbuMWasaUbzP6ZLliE",
        }
      ],
      "subjects": ["Math", "Language", "Arts", "Science"],
      "trial": "30 days",
    }
  ];


  /***** Scope Functions -- Able to call these in HTML *****/

  function createProductsInStripe() {
    console.log("Entered createProductsInStripe");
    // Add items in Stripe
    var request = $http({
        method: "post",
        url: "./ajax/createProductsInStripe.php",
        data: {
            cart: $scope.products
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    });

    request.success(function (data) {
        console.log("Success data transfer ");
        console.log(data);
    });
  };


  $scope.addToCart = function(item, plan) {

    console.log("Item added to cart:");
    console.log(item);
    console.log("Plan added to cart:");
    console.log(plan);

    // Add item to cart, stored on the JS controller - could extend to use Ajax calls to store in DB, etc.
    var addItem = item;
    $scope.selectedPlan = plan;
    addItem.itemId = $scope.cart.itemCount;

    // Add item price to subtotal, ensure float type match, round to 2 decimals
    $scope.cart.subtotal = parseFloat($scope.cart.subtotal) + parseFloat($scope.selectedPlan.unit_amount)/100;
    $scope.cart.subtotal = parseFloat($scope.cart.subtotal).toFixed(2);

    console.log("Subtotal: " + $scope.cart.subtotal);

    // Add sales tax, using Texas rate a default
    $scope.cart.salesTax = 0;
    // $scope.cart.salesTax = parseFloat($scope.cart.salesTax) + parseFloat(addItem.itemPrice)*.0825;
    // $scope.cart.salesTax = parseFloat($scope.cart.salesTax).toFixed(2);

    // Add item subtotal and tax for this item to the running cart total
    $scope.cart.total = parseFloat($scope.cart.subtotal) + parseFloat($scope.cart.salesTax);
    $scope.cart.total = parseFloat($scope.cart.total).toFixed(2);

    // Increment cart count
    $scope.cart.itemCount = $scope.cart.itemCount+1;

    // Push this item to the cart item array
    $scope.cart.cartItems.push(addItem);
  };

  $scope.removeFromCart = function(item) {
    var removeItem = item;

    // Subtract item price from subtotal, ensure float type match, round to 2 decimals
    $scope.cart.subtotal = parseFloat($scope.cart.subtotal) - parseFloat(removeItem.itemPrice);
    $scope.cart.subtotal = parseFloat($scope.cart.subtotal).toFixed(2);

    // Subtract item sales tax from cart sales tax
    $scope.cart.salesTax = parseFloat($scope.cart.salesTax) - parseFloat(removeItem.itemPrice)*.0825;
    $scope.cart.salesTax = parseFloat($scope.cart.salesTax).toFixed(2);

    // Add updated subtotal and tax for the new running cart total
    $scope.cart.total = parseFloat($scope.cart.subtotal) + parseFloat($scope.cart.salesTax);
    $scope.cart.total = parseFloat($scope.cart.total).toFixed(2);

    // Decrement cart count
    $scope.cart.itemCount = $scope.cart.itemCount-1;

    // Loop through cart to find the item that needs to be removed
    var index = 0;
    for (var i in $scope.cart.cartItems) {
      if ($scope.cart.cartItems[i].itemId == removeItem.itemId) {
          index = i;
          $scope.cart.cartItems.splice(index, 1);
          break; //Stop this loop, we found it!
      }
    }
  }

  $scope.sendToPayment = function(customer, cart){

    // Post the cart variables to add to the php session
    var request = $http({
        method: "post",
        url: "./ajax/addCartToSession.php", // this only adds the session to cart for Stripe Elements payment flow
        data: {
            cart: $scope.cart,
            plan: $scope.selectedPlan,
            customer: $scope.customer
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    });

    // This handles paymentIntent flow
    // request.success(function (data) {
    //     console.log("Success data transfer ");
    //     console.log(data);
    //     $scope.stripePaymentIntent = data;

    //     $window.location.href = "./payment/checkout.html"; // this redirects to page with Stripe Elements
    // });

    // This handles Checkout flow
    request.success(function (data) {
        console.log("Stripe session data");
        console.log(data);

        $scope.paymentIntentId = data;
        $scope.paymentIntentId = $scope.paymentIntentId.trim();
        
        console.log("paymentIntentId");
        console.log($scope.paymentIntentId);

        $scope.goToStripeCheckout();

    });
  };

  $scope.goToStripeCheckout = function() {
    // Initialize Stripe.js with the same connected account ID used when creating
    // the Checkout Session.
    // Verify not using a demo restaurant
    var stripe = Stripe('pk_test_51HrVqWBbuMWasaUbOh7yyWrZ3YGQZPNCnFTArWDA0rSfNwzK2c4e2JOLZcZxHQUDTx7dPkqylDV8FQZ75fL7ghwK00Ti3DNxY7', {
      // stripeAccount: $scope.paymentData.stripeId // this is to add the Connect account ID
      stripeAccount: 'acct_1HrVqWBbuMWasaUb'
    });
    

    // var checkoutButton = document.getElementById('checkout-button');

    stripe.redirectToCheckout({
        // Make the id field from the Checkout Session creation API response
        // available to this file, so you can provide it as argument here
        // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
        sessionId: $scope.paymentIntentId
      }).then(function (result) {
        // If `redirectToCheckout` fails due to a browser or network
        // error, display the localized error message to your customer
        // using `result.error.message`.
      });

    // checkoutButton.addEventListener('click', function() {
    //   stripe.redirectToCheckout({
    //     // Make the id field from the Checkout Session creation API response
    //     // available to this file, so you can provide it as argument here
    //     // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
    //     sessionId: $paymentIntentId
    //   }).then(function (result) {
    //     // If `redirectToCheckout` fails due to a browser or network
    //     // error, display the localized error message to your customer
    //     // using `result.error.message`.
    //   });
    // });
  }

  // $scope.prepareStripeCheckout = function(customer, cart){

  //   // Prepare Stripe Checkout
  //   var request = $http({
  //       method: "post",
  //       url: "./payment/ajax/prepareStripeCheckout.php",
  //       data: {
  //           cart: $scope.cart,
  //           plan: $scope.selectedPlan,
  //           customer: $scope.customer
  //       },
  //       headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
  //   });

  //   // Check for successful request, redirect to login/contact info page
  //   request.success(function (data) {
  //       $scope.paymentData = data;
  //       console.log("Stripe session data");
  //       console.log(data);
  //       $scope.paymentIntentId = $scope.paymentData.sessionId;
  //       $scope.paymentIntentId = $scope.paymentIntentId.trim();



  //       console.log("paymentIntentId");
  //       console.log($scope.paymentIntentId);

  //       $scope.changeMenuPage('login');
  //       $location.path('/takeout/contactInfo', false);
  //   });
  // }

  $scope.createCustomer = function(name, email, type){

    // Post the cart variables to add customer in Stripe
    $http.post("./ajax/createCustomer.php?name="+name+"&email="+email+"&type="+type.name).success(function(data){

      console.log(data); // returns Stripe customer object
    });

  };

  $scope.login = function(email){

    // Pass email to Stripe API to retrieve customer id and customer_type
    $http.post("./ajax/login.php?email="+email).success(function(data){

      console.log(data); // returns Stripe customer object
      console.log(data.metadata); // returns Stripe customer object
      var metadata = data.metadata;
      console.log(metadata.customer_type); // returns Stripe customer object
      $scope.selectedCustomerType = metadata.customer_type;

      if($scope.selectedCustomerType == "School"){
        $scope.selectedCustomerType = "Schools";
      }

      $scope.customer = {
        "name": data.name,
        "email": data.email,
        "id": data.id,
        "customer_type": $scope.selectedCustomerType
      }

      console.log("Selected Customer Type: " + $scope.selectedCustomerType);

      // Redirect to products page, and show the correct products for the customer type
      $scope.changePage("order");

    });

  };

  $scope.changePage = function(page){
    // Toggle page views based on user action
    $scope.page = page;

    if(page=="order"){
      $location.path('/order', false);
    }
    else if(page=="cart"){
      $location.path('/cart', false);
    }
  }


  /***** Local Functions -- usable only locally in this controller *****/

  function getConfirmation() {
    $http.post("./ajax/getConfirmation.php").success(function(data){

      console.log(data);
      console.log(data.orderItems);
      console.log(data.orderItems.cartItems);

      // Populate the confirmation object with data stored on the PHP session variables
      $scope.confirmation = {
        "stripePaymentId": data.stripePaymentId,
        "stripeChargeId": data.stripeChargeId,
        "orderSubtotal": data.orderSubtotal,
        "orderTotal": data.orderTotal,
        "orderItems": data.orderItems.cartItems
      }
    });
  }

  // Make sure we load the correct view based on the url
  function checkPage(){

    if($location.path()=="/home"){
      $scope.page='order';
      $location.path('/order'); // redirects /home to /order
    }
    else if($location.path()=="/admin-setup"){
      $scope.page='admin-setup';
      createProductsInStripe();
    }
    else if($location.path()=="/signup"){
      $scope.page='signup';
    }
    else if($location.path()=="/login"){
      $scope.page='login';
    }
    else if($location.path()=="/order"){
      $scope.page='order';
    }
    else if($location.path()=="/cart"){
      $scope.page='cart';
    }
    else if($location.path()=="/confirmation"){
      getConfirmation(); // call function to retrieve confirmation variables
      $scope.page='confirmation';
    }
    else{
      $scope.page='order';
    }
  };

});