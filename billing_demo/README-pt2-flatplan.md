# Section 2: Get a flat rate plan & upgrade it

## Sections

[Challenge Overview](/README.md)

[Section 1: Setup HomesCool products](/README-pt1-setupproducts.md)

[Section 2: Get a flat rate plan & upgrade it](/README-pt2-flatplan.md)

[Section 3: Create an Invoice for Consulting Services](/README-pt3-invoiceschools.md)

[Section 4: Get a per-seat plan & update seat](/README-pt4-perseatplan.md)

[Section 5: Get a metered rate plan and report usage](/README-pt5-meteredplan.md)

## Getting started

The goal of this section of the challenge is to Sign up as a Family customer and subscribe to a single subject plan from HomesCool via Stripe Checkout, and then upgrade it to a core subjects plan.

- Read this document to understand both the section requirements and the repository contents.
- Complete this section and when you’ve finished push it back to the repo.
- Move on to the next challenge section.

## Section Overview

HomesCool is an online learning platform. They want to sell their course subscriptions to families to continue learning from home. Homeschool wants to implement an easy flow for families to checkout and start testing their products, for that reason  they decide to use Stripe Checkout.

They plan to have two family plans; single subject and core subjects. Family users can subscribe monthly or annually to these plans.

For the family checkout, they must have the following constraints:

- Two plans: single subject and Core subjects.

- After purchasing a single subject, the customer can upgrade their subscription to a core subjects plan.

- HomesCool will not refund payments.

The flow for the family single subject plan using Checkout should look like this:

![Single Subject](screenshots/billing-single-product.gif)

Update single subject subscription to core subjects subscription.

![Update to Core Subjects](screenshots/billing-upgrade-core.gif)

## Requirements

Information returned by Stripe should be stored on the local DB as well. A customer should be able to sign in with a family account and choose one of those products and subscribe to any of the plans via Stripe Checkout. If a customer subscribed to the single subject they should be able to upgrade the subscription to the next tier.

### Your solution should deliver the following:

- A signup via the DB, that creates the Stripe customer and on the local DB.
- A mock login via the DB.
- When the checkout button is clicked the customer should be redirected to the checkout page to complete the transaction.
- The session should be created and include:
  - The price and interval selected by the customer
  - 30 days of trial period
  - Accept only card
- After the payment is completed, the customer should be redirected to the success page.
- If a customer clicks “Back” on a Checkout session, the Products page should be presented correctly.
- Customers should be able to see their subscription in `/my-account` page. This page should retrieve the saved subscription from the local DB.
- Customers with Single Subject Subscription should be able to upgrade their subscription to core subjects.

## Using the provided starter code

Here's an overview of what's provided in the repo for this section of the challenge:

**Existing Frontend Stacks:**

Click the link for the stack you are using:

- [Vanilla](#vanilla-stack)

- [React](#react-client)

### Vanilla Stack

- `/client/index.html` → the page where a user signs up or logs in.

- `/client/pages/pricing.html` → the page where product information is displayed.

- `/client/pages/successful-order.html` → the page shown after a successful order is completed.

- `/client/pages/my-account.html` → the page for user to check their subscriptions and additional informaction.

- `/client/assets/js/pricing.js` → This file contains the functionality for displaying products on the page. Feel free to modify this file as you integrate Checkout. The client directory contains additional CSS, JavaScript and image files in the assets directory, we don't expect you to need to modify any of these files.

- `/client/assets/js/index.js` → This file contains the login and signup functionality.

- `/client/assets/js/my-account.js` → This file contains my account functionality.

- `/client/assets/js/my-subscription.js` → This file contains the functionality to get my subscription.

[Server Code](#server)

### React Client

- `/client/src/pages/Login.js` → Page where users can log in or sign up.

- `/client/src/pages/Pricing.js` → Page where users see product available to them.

- `/client/src/pages/ProductDisplay.js` → Component that sets up anything related to presenting the products in the `Pricing` page.

- `/client/src/pages/ProductCard.js` → Component that presents the information of any subscription available as a Card in the `Pricing` page.

- `/client/src/pages/AccountDetail.js` → Page where users see their subscriptions.

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

- `/server/src/routes/checkout` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/controllers/checkoutController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/routes/subscription` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/controllers/subscriptionController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/routes/webhook` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/controllers/webhookController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/routes/views` -> this file contains the existing routes for each endpoint that present and setup each page, you can create or update endpoints as you need.

- `/server/src/controllers/viewsController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

[Continue](#running-locally)

### Python

- `/server/src/db/controller` -> the file where helper methods will be available to manipulate the local Database.

- `/server/src/checkout/controller` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/checkout/service` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/subscription/controller` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/subscription/service` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/webhook/controller` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/webhook/service` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/views/controller` -> this file contains the existing routes for each endpoint that present and setup each page, you can create or update endpoints as you need.

- `/server/src/views/service` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

[Continue](#running-locally)

### PHP

- `/server/app/Models` -> The folder with Model definitions that are available to manipulate the local Database.

- `/server/routes/web` → this file contains the routes for all the endpoints already given, you can create or update endpoints as you need.

- `/server/app/Http/Controllers/CheckoutController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/app/Http/Controllers/SubscriptionController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/app/Http/Controllers/WebhookController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/app/Http/Controllers/ViewsController` -> this file contains the existing routes for each endpoint that present and setup each page, you can create or update endpoints as you need.

[Continue](#running-locally)

## Running Locally

As a first step in completing the challenge we recommend you get your local server up and running. See the main README info on getting up and running with our server implementations.

With your server running your page should look like the gifs above.

## Push Your Challenge

When you are done with this section and checked that your code works locally, push your changes to the branch you are working on. You can open a PR per section completed or a single PR to merge the solution for all of the sections.

## Next

[Section 3: Get a custom curriculum](/README-pt3-invoiceschools.md)