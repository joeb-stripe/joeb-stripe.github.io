# Section 3: Create an Invoice for Consulting Services

## Sections

[Challenge Overview](/README.md)

[Section 1: Setup HomesCool products](/README-pt1-setupproducts.md)

[Section 2: Get a flat rate plan & upgrade it](/README-pt2-flatplan.md)

[Section 3: Create an Invoice for Consulting Services](/README-pt3-invoiceschools.md)

[Section 4: Get a per-seat plan & update seat](/README-pt4-perseatplan.md)

[Section 5: Get a metered rate plan and report usage](/README-pt5-meteredplan.md)

## Getting started

The goal of this section of the challenge is to Sign up as a School and acquire a Consulting service from HomesCool platform.

1. Read this document to understand both the section requirements and the repository contents.
2. Complete this section and when you’ve finished push it back to the repo.
3. Move onto the next section of the challenge.

## Section Overview

HomesCool is releasing their new product, a consulting service for school customers.

To acquire a consulting service, school customers request a consulting engagement from the pricing page. They will receive the consulting service online and after the consulting is provided, the HomesCool Admin will create an invoice for the customer based on the number of hours that were used in the consulting engagement.

For consulting services, they must have the following constraints:

- After the consulting service an invoice should be sent from the `HomesCool Admin /admin`  with the number of hours and price per hour to the school user's email.
- The invoice should be listed on the "Invoices" section of `/my-account` for the invoiced customer.
- Customers should be able to see a link “Pay”, that lets them pay their invoices.

A School customer can order a Consulting Service from the Products page that should look like this:

![Consulting Service Request](screenshots/billing-invoice-request.gif)

From `/admin` a HomeScool Admin can create an Invoice for the customer.
A customer with an Invoice can see it in `/my-account` and can see a link to pay it. It should look like this:

![Invoice Creation](screenshots/billing-admin-invoice.gif)

## Requirements

Your challenge for this section is to allow a customer to sign up and login as a School type user. School customers are able to receive a consulting service which will be invoiced after delivery and when an invoice is received the customer should be able to check the invoice and pay it. 

An Admin of HomeSchool should be able to create an invoice for a school customer based on the hours of consultation. As a price-per-hour is created, that price must be created and saved as default for upcoming invoices to avoid the creation of many prices.

Your solution should deliver the following:

- A mock login via the DB for a school customer.
- Homeschool admin should be able to create invoices for school customers.
- Homeschool admin should be able to change the price-per-hour and it should be reflected on the local DB.
- Customers should be able to see their invoices with status in the “Invoice” section in my-account page. 
- Customers should be able to pay their invoice after clicking on the “Pay” link.
- After the payment is completed, the invoice status should be changed and reflected on local DB as well.

## Using the provided starter code

Here's an overview of what's provided in the repo for this section of the challenge:

**Existing Frontend Stacks:**

Click the link for the stack you are using:

- [Vanilla](#vanilla-stack)

- [React](#react-client)

### For Vanilla Stack

- `/client/index.html` → the page where a user signs up or logs in.

- `/client/pages/pricing.html` → the page where product information is displayed.

- `/client/pages/successful-invoice.html` → the page shown after a successful invoice order is completed.

- `/client/pages/my-account.html` → the page for user to check their invoices and additional informaction.

- `/client/assets/js/pricing.js` → This file contains the functionality for displaying products on the page. Feel free to modify this file as you integrate Checkout. The client directory contains additional CSS, JavaScript and image files in the assets directory, we don't expect you to need to modify any of these files.

- `/client/assets/js/index.js` → This file contains the login and signup functionality.

- `/client/assets/js/my-account.js` → This file contains my account functionality.

[Server Code](#server)

### React Client

- `/client/src/pages/Login.js` → Page where users can log in or sign up.

- `/client/src/pages/Pricing.js` → Page where users see product available to them.

- `/client/src/pages/ConfirmOrder.js` → Page where users confirm they want to acquire a consulting service.

- `/client/src/pages/SuccessInvoice.js` → Page where users get a confirmation for their invoice.

- `/client/src/pages/AccountDetail.js` → Page where users see their invoice information and link to pay it.

- `/client/src/pages/ProductDisplay.js` → Component that sets up anything related to presenting the products in the `Pricing` page.

- `/client/src/pages/ProductCard.js` → Component that presents the information of any subscription available as a Card in the `Pricing` page.

- `/client/src/pages/InvoiceTable.js` → Component that sets up and present the Invoice Listings in the `My Account` page.

- `/client/src/pages/InvoiceTableRecord.js` → Component that presents the individual information of an Invoice in the Invoice Table.

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

- `/server/src/routes/invoice` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/controllers/invoiceController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/routes/webhook` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/controllers/webhookController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/routes/views` -> this file contains the existing routes for each endpoint that present and setup each page, you can create or update endpoints as you need.

- `/server/src/controllers/viewsController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

[Continue](#running-locally)

### Python

- `/server/src/db/controller` -> the file where helper methods will be available to manipulate the local Database.

- `/server/src/invoice/controller` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/invoice/service` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/webhook/controller` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/webhook/service` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/views/controller` -> this file contains the existing routes for each endpoint that present and setup each page, you can create or update endpoints as you need.

- `/server/src/views/service` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

[Continue](#running-locally)

### PHP

- `/server/app/Models` -> The folder with Model definitions that are available to manipulate the local Database.

- `/server/routes/web` → this file contains the routes for all the endpoints already given, you can create or update endpoints as you need.

- `/server/app/Http/Controllers/InvoiceController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/app/Http/Controllers/WebhookController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/app/Http/Controllers/ViewsController` -> this file contains the existing routes for each endpoint that present and setup each page, you can create or update endpoints as you need.

[Continue](#running-locally)

## Running Locally

As a first step in completing the challenge we recommend you get your local server up and running. See the main README info on getting up and running with our server implementations.

With your server running your page should look like the gifs above.

## Push Your Challenge

When you are done with this section and checked that your code works locally, push your changes to the branch you are working on. You can open a PR per section completed or a single PR to merge the solution for all of the sections.

## Next

[Section 4: Get a per-seat plan & update seat](/README-pt4-perseatplan.md)