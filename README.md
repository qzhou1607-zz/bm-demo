A small business management platform for demo purpose. 

Shop Front Page w/ Shopping Cart : https://demo-bm.herokuapp.com/.
Click button on the top right corner to enter the order management app.

Features include:

1. Display of products
2. Shopping cart
3. Submission of orders
4. Dashboard for order management
5. List options for shipping (via Shippo API)
6. Print label and track packages

The block to display products and the shopping cart were constructed using knockout JS, so that computed values and cascading events in UI could be chained together. After finalization, the orders were submitted to DB using ajax.

TO DO:

1. Integration of Stripe to tokenize credit card, instead of saving cc_num directly
2. Inventory Update
3. Capability of editting products in store from dashboard
