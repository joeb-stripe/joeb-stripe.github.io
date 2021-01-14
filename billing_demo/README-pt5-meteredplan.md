# Section 5: Get a metered rate plan and report usage

## Sections

[Challenge Overview](/README.md)

[Section 1: Setup HomesCool products](/README-pt1-setupproducts.md)

[Section 2: Get a flat rate plan & upgrade it](/README-pt2-flatplan.md)

[Section 3: Create an Invoice for Consulting Services](/README-pt3-invoiceschools.md)

[Section 4: Get a per-seat plan & update seat](/README-pt4-perseatplan.md)

[Section 5: Get a metered rate plan and report usage](/README-pt5-meteredplan.md)

## Getting started

The goal of this section of the challenge is to sign in as a school user and subscribe to the time of use plan from HomesCool platform.

- Read this document to understand both the section requirements and the repository contents.
- Complete this section and when you’ve finished push it back to the repo.

## Section Overview

HomesCool would like to offer a subscription plan that schools only pay for what they use.

For school users, they must have the following constraints:

- After you get the school plan time of use plan, you will need to simulate the usage in the “Subscriptions” section in My Account.
- The school also has the possibility to add a coupon to get a discount.
- A School customer should be able to Sign in and start a School subscription with any stored method or by providing a new one.
- When confirming the order the customer should be able to enter a coupon to receive a discount.
- Once subscription is started the customer should be able to review the subscription and simulate usage of the subscription.

Creating a metered subscription should look like this:

![Metered Subscription Creation](screenshots/billing-create-metered.gif)

Reporting random usage should look like this: (and it should be reflected on the Stripe Dashboard)

![Metered Subscription Usage Report](screenshots/billing-metered-report.gif)

## Requirements

Your challenge will be to allow a customer to subscribe to a School plan and then mock some usage of the subscription to update the subscription.

Your solution should deliver the following:

- An endpoint to create a metered subscription product and prices that allows a simple tax rate as well. It should only use monthly pricing.
- A Products page should list the option to subscribe to a school plan that shows a price based on usage.
- If the user has a payment method stored, display that as default payment method to complete the subscription, otherwise present the option to add a credit card or collect the Bank information to create an ACH charge.
- When a customer has a School subscription that should be displayed in `/my-account`
- Customers should be able to “Report usage” to mock a random number of hours of their subscription and that should be reflected in the Stripe dashboard. To complete this please use the provided function `reportUsageCall` that’s already defined on the frontend. Add your solution code to the corresponding backend service.

## Using the provided starter code

Here's an overview of what's provided in the repo for this section of the challenge:

**Existing Frontend Stacks:**

Click the link for the stack you are using:

- [Vanilla](#vanilla-stack)

- [React](#react-client)

### For Vanilla Stack

- `/client/index.html` → the page where a user signs up or logs in.

- `/client/pages/pricing.html` → the page where product information is displayed.

- `/client/pages/confirm-order.html` → the page where an order is completed, it should show the payment information and the plan information.

- `/client/pages/successful-order.html` → the page shown after a successful order is completed.

- `/client/pages/my-account.html` → the page for user to check their subscriptions, invoices and additional informaction.

- `/client/assets/js/pricing.js` → This file contains the functionality for displaying products on the page. Feel free to modify this file as you integrate Checkout. The client directory contains additional CSS, JavaScript and image files in the assets directory, we don't expect you to need to modify any of these files.

- `/client/assets/js/confirm-order.js` → This file contains the functionality for displaying the plan information and fields requiered to complete the order, also capture or show the payment method information.

- `/client/assets/js/index.js` → This file contains the login and signup functionality.

- `/client/assets/js/my-account.js` → This file contains my account functionality.

[Server Code](#server)

### React Client

- `/client/src/pages/Login.js` → Page where users can log in or sign up.

- `/client/src/pages/Pricing.js` → Page where users see product available to them.

- `/client/src/pages/ConfirmOrder.js` → Pge where an order is completed, it should show the payment information and the plan information.

- `/client/src/pages/SuccessOrder.js` → Paage shown after a successful order is completed.

- `/client/src/pages/AccountDetail.js` → Page where users see their subscriptions, invoices and payment method information.

- `/client/src/pages/ProductDisplay.js` → Component that sets up anything related to presenting the products in the `Pricing` page.

- `/client/src/pages/ProductCard.js` → Component that presents the information of any subscription available as a Card in the `Pricing` page.

- `/client/src/pages/SubscriptionListings.js` → Component that sets up and present the Subscriptions of a User in `My Account` page.

- `/client/src/pages/SubscriptionListing.js` → Component that presents the individual information of the Subscription of a User in `My Account` page.

[Server Code](#server)

### Server

On the server side we've defined a couple routes, you are welcome to modify the code in the routes.  

It is expected that you will add additional routes to the server, the names can be whatever you choose.  

#### **Existing Routes and Controllers**

Click the link for the backend language you are using:

- [NodeJS](#node-js)

- [Python](#python)

- [PHP](#php)

### Node JS

- `/server/src/models/` -> Folder for models where helper methods will be available to manipulate the local Database.

- `/server/src/routes/subscription` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/controllers/subscriptionController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/routes/webhook` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/controllers/webhookController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/routes/paymentMethod` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/controllers/paymentMethodController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/routes/views` -> this file contains the existing routes for each endpoint that present and setup each page, you can create or update endpoints as you need.

- `/server/src/controllers/viewsController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

[Continue](#running-locally)

### Python

- `/server/src/db/controller` -> the file where helper methods will be available to manipulate the local Database.

- `/server/src/subscription/controller` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/subscription/service` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/webhook/controller` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/webhook/service` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/paymethod/controller` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/paymethod/service` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/views/controller` -> this file contains the existing routes for each endpoint that present and setup each page, you can create or update endpoints as you need.

- `/server/src/views/service` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

[Continue](#running-locally)

### PHP

- `/server/app/Models` -> The folder with Model definitions that are available to manipulate the local Database.

- `/server/routes/web` → this file contains the routes for all the endpoints already given, you can create or update endpoints as you need.

- `/server/app/Http/Controllers/SubscriptionController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/app/Http/Controllers/PaymentMethodController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/app/Http/Controllers/WebhookController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/app/Http/Controllers/ViewsController` -> this file contains the existing routes for each endpoint that present and setup each page, you can create or update endpoints as you need.

[Continue](#running-locally)

## Running Locally

As a first step in completing the challenge we recommend you get your local server up and running. See the main README info on getting up and running with our server implementations.

With your server running your page should look like the gifs above.

## Push Your Challenge

When you are done with this section and checked that your code works locally, push your changes to the branch you are working on. You can open a PR per section completed or a single PR to merge the solution for all of the sections.

## Navigation

[Challenge Overview](/README.md)