# Welcome to HomesCool!

## This is a custom implementation of the Stripe Billing and Subscription Challenge

# Billing and Subscription Challenge Overview

## Sections

[Challenge Overview](/README.md)

[Section 1: Setup HomesCool products](/README-pt1-setupproducts.md)

[Section 2: Get a flat rate plan & upgrade it](/README-pt2-flatplan.md)

[Section 3: Create an Invoice Consulting Services](/README-pt3-invoiceschools.md)

[Section 4: Get a per-seat plan & update seat](/README-pt4-perseatplan.md)

[Section 5: Get a metered rate plan and report usage](/README-pt5-meteredplan.md)

## Getting started

The goal of this coding challenge is to complete the app started in this repo, a website for a homeschool curriculum service.  
To start:  

- Read all of the instructions to get an overview of how the challenge is set up and what you will be expected to complete.
- Complete all five sections of the challenge. When you've finished, deploy your solution, test all sections and push it back to this repo and merge it to the master branch.

## Challenge Overview

Looking to grow their business, a US-based curriculum developer wants to expand their online presence to sell their digital subscription service to families and schools. They offer their curriculum as a monthly subscription, in a per seat allocation to schools, and in a metered billing arrangement. They also offer a consulting service to develop a custom curriculum for their school customers. 

**Navigation**
[Section 1: Setup HomesCool products](/README-pt1-setupproducts.md)


# Implementation Notes

## Section 1: Setup Products

### Your solution should deliver the following

- Products must be created once in Stripe and persisted to DB. // DB not implemented
- Taxes should be created in Stripe and persisted to DB.
- If a price changes, the old price should be deactivated in the Stripe Dashboard. // Not implemented
- Customer should be able to sign up and log in with the following information:
  - Name
  - Email address
  - Customer type (Family or School).
- When a customer signs up, the customer should be added to the Stripe Dashboard.
- Customers should be able to log in with their email address if previously signed up.
- Customers should see products according to their customer type (School or Family).

### Implementation:
- No DB connection is currently implemented
- Product data structures created in JSON in orderController.js
- Hit /admin-setup to setup the following:
	- All of the products and their prices/billing plans in Stripe (see /ajax/createProductsInStripe.php)
	- Tax rates (just a few) (see /ajax/createTaxRates.php)
- Create account (see /signup)
- Login (/login) - returns Stripe customer ID and customer_type

## Section 2: Get a flat rate plan & upgrade it

### Your solution should deliver the following:

- A signup via the DB, that creates the Stripe customer and on the local DB. (N/A)
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

### Implementation:
- A mock login via the DB - this uses Stripe customer object for login.
- Checkout is implemented
- Is it possible to create a trial on the subscription at the time of Checkout session creation? When I tried to pull the "subscription" field of the newly created Checkout session it returned null. I could pull the subscription and add the 30 day trial after the checkout session is successful. Otherwise I would need to add the trial to the price, which says it's been deprecated.
- 


