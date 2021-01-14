# Section 1: Setup HomesCool products

## Sections

[Challenge Overview](/README.md)

[Section 1: Setup HomesCool products](/README-pt1-setupproducts.md)

[Section 2: Get a flat rate plan & upgrade it](/README-pt2-flatplan.md)

[Section 3: Create an Invoice for Consulting Services](/README-pt3-invoiceschools.md)

[Section 4: Get a per-seat plan & update seats](/README-pt4-perseatplan.md)

[Section 5: Get a metered rate plan and report usage](/README-pt5-meteredplan.md)

## Getting started

The goal of this section of the challenge is to complete the endpoints needed to set up the landing page so customers can purchase a subscription to a curriculum service.

1. Read this document to understand both the section requirements and the repository contents.
2. Complete this section and when you’ve finished push it back to the repo.
3. Move onto the next section of the challenge.

## Section Overview

HomesCool has developed a set of curriculum they would like to offer as a subscription to individual families.  

- In this section of the challenge you must set up the products that will be used in following sections of the challenge.
- Allow customers to sign up. 
- Based on the type of customer that logs into the system you should present the family plans or the school products.

## Requirements

The codebase we’ve provided includes a script to generate a simple DB with a couple of `default products` that we expect you to set up on Stripe.  

To create the local DB, please read `./code/server/README.md` to check the specific step in the language of your choice.

Complete the endpoints that create these products on Stripe, updating the default products on the local DB of the project as an actual system would do to avoid API rate limits.

### Product Characteristics

- **Single Subject Product**
  - For families
  - 30 day trials
  - Billing Intervals: Monthly and Annually
  - Subjects: Math, Language or Spanish.
- **Core Subjects Product**
  - For families
  - 30 day trials
  - Billing Intervals: Monthly and Annually.
  - Subjects: Math, Language, Arts and Science.
- **Classroom Product**
  - For Schools
  - Billing Intervals: Monthly and Yearly Intervals
  - The cost will be adjust to the quantity of seat in each classroom:
    - Up to 5 seats
    - Up to 10 seats
    - 11 or more seats
  - Description: Price per seat used
  - A product tax percentage must be specified
- **School Product**
  - For Schools
  - Billing Interval: Monthly Interval
  - The cost will depend on resource usage
  - Description: Pay only for what you use
  - A product tax percentage must be specified

Complete the endpoints and page to allow customers to `Sign up` and `Log in` on the web application. (For Sign up: create the Customer on Stripe and save on DB, for Login check if user exists on DB)

### Your solution should deliver the following

- Products must be created once in Stripe and persisted to DB.
- Taxes should be created in Stripe and persisted to DB.
- If a price changes, the old price should be deactivated in the Stripe Dashboard.
- Customer should be able to sign up and log in with the following information:
  - Name
  - Email address
  - Customer type (Family or School).
- When a customer signs up, the customer should be added to the Stripe Dashboard.
- Customers should be able to log in with their email address if previously signed up.
- Customers should see products according to their customer type (School or Family).

## Using the provided starter code

Here's an overview of what's provided in the repo for this section of the challenge:

**Existing Frontend Stacks:**

Click the link for the stack you are using:

- [Vanilla](#vanilla-stack)

- [React](#react-client)

### Vanilla Stack

- `/client/pages/pricing.html` → the page shown in the screen shots above. (actually /server/public/pages/pricing.html)

- `/client/index.html` → the page where a user signs up or logs in.

- `/client/assets/js/pricing.js` → This file contains the functionality for displaying products on the page. Feel free to modify this file as you integrate Checkout. The client directory contains additional CSS, JavaScript and image files in the assets directory, we don't expect you to need to modify any of these files.

- `/client/assets/js/index.js` → This file contains the login and signup functionality.

[Server Code](#server)

### React Client

- `/client/src/pages/Login.js` → Page where users can log in or sign up.

- `/client/src/pages/Pricing.js` → Page where users can see product available to them.

- `/client/src/pages/ProductDisplay.js` → Component that sets up anything related to presenting the products in the `Pricing` page.

- `/client/src/pages/ProductCard.js` → Component that presents the information of any subscription available as a Card in the `Pricing` page.

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

- `/server/src/routes/product` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/controllers/productController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls. 

- `/server/src/routes/customer` -> this file contains the existing routes for each endpoint to manage customers, you can create or update endpoints as you need.

- `/server/src/controllers/customerController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls. 

- `/server/src/routes/views` -> this file contains the existing routes for each endpoint that present and setup each page, you can create or update endpoints as you need.

- `/server/src/controllers/viewsController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

[Continue](#running-locally)

### Python

- `/server/src/product/controller` → this file contains the routes for each endpoint to manage plans, you can create or update endpoints as you need.

- `/server/src/product/service` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/src/customer/controller` -> this file contains the existing routes for each endpoint to manage customers, you can create or update endpoints as you need.

- `/server/src/customer/service` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/src/db/controller` -> the file where helper methods will be available to manipulate the local Database.

- `/server/src/views/controller` -> this file contains the existing routes for each endpoint that present and setup each page, you can create or update endpoints as you need.

- `/server/src/views/service` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

[Continue](#running-locally)

### PHP

- `/server/app/Models` -> The folder with Model definitions that are available to manipulate the local Database.

- `/server/routes/web` → this file contains the routes for all the endpoints already given, you can create or update endpoints as you need.

- `/server/app/Http/Controllers/ProductController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/app/Http/Controllers/CustomerController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/app/Http/Controllers/WebhookController` -> this file contains the code and logic regarding each endpoints of the file above, communication with DB and Stripe APIs calls.

- `/server/app/Http/Controllers/ViewsController` -> this file contains the existing routes for each endpoint that present and setup each page, you can create or update endpoints as you need.

[Continue](#running-locally)

## Running Locally

As a first step in completing the challenge we recommend you get your local server up and running. See the main README info on getting up and running with our server implementations.  

With your server running the page for this section the Family products page should look like this:  

![Family Subscriptions](screenshots/billing-family-plans.png)

If the customer has type of “School” the Products page should look like this:  

![School Subscriptions](screenshots/billing-school-products.gif)

## Push Your Challenge

When you are done with this section and checked that your code works locally, push your changes to the branch you are working on. You can open a PR per section completed or a single PR to merge the solution for all of the sections.

## Next

[Section 2: Get a flat rate plan & upgrade it](README-pt2-flatplan.md)
