# Section 4: Get a per-seat plan & update seats

## Sections

[Challenge Overview](/README.md)

[Section 1: Setup HomesCool products](/README-pt1-setupproducts.md)

[Section 2: Get a flat rate plan & upgrade it](/README-pt2-flatplan.md)

[Section 3: Create an Invoice Consulting Services](/README-pt3-invoiceschools.md)

[Section 4: Get a per-seat plan & update seats](/README-pt4-perseatplan.md)

[Section 5: Get a metered rate plan and report usage](/README-pt5-meteredplan.md)

## Getting started

The goal of this section of the challenge is to sign in as a school user and subscribe to a classroom plan from HomesCool platform, with pricing based on a number of seats.

- Read this document to understand both the section requirements and the repository contents.
- Complete this section and when you’ve finished push it back to the repo.
- Move onto the next section of the challenge.

## Section Overview

HomesCool would like to allow school type users to sign up users in bulk, by the number of seats. A school can subscribe to a number of seats for their students and pay for those seats monthly or yearly. This plan includes tiered pricing so a school customer can qualify for lower priced seats if they buy enough of them.  

This classroom plan must have the following constraints:

- The price per seat must be reflected on the total subscription price, based on the tiered pricing.
- The school also has the ability to add a coupon to get a discount.
- A school type customer should be able to sign in and start a classroom subscription using an ACH payment.
- Once subscription is started a customer should be able to review subscription and update the number of seats.

![Classroom subscription](screenshots/billing-per-seat.gif)

Updating the number of seats of an ongoing subscription should look like this:

![Classroom subscription update](screenshots/billing-per-seat-update.gif)

## Requirements

An endpoint should exist that creates the classroom product and prices with the option to have multiple tiers and a simple tax setup.
After a customer has successfully subscribed to a Classroom plan they should be able to modify the number of seats of their subscription.

Your solution should deliver the following:

- Products page should list the option to subscribe to a classroom plan that shows a price based on usage.
- To pay the subscription customers have different scenarios:
  - **Customer doesn’t have a payment method stored:** Customers should be able to add a card or bank account (ACH) to pay for the subscription. The new payment method should be attached to the user and registered in the local DB.
  - **Customer has one payment method stored:** This payment method should be displayed as default to pay for the subscription.
  - **Customer has more than one payment method:** All stored payment methods should be displayed and the customer may select one to complete the payment.

- When a customer has completed a classroom subscription it should be displayed on /my-account
- Customers should be able to update the number of seats in the subscription. That should be reflected in both Stripe and the local database.
- Customers should be able to cancel their subscription. That should be reflected in both Stripe and the local database.

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

## Next

[Section 5: Get a metered rate plan and report usage](/README-pt5-meteredplan.md)