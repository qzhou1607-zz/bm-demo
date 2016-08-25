A small business management platform for demo purpose. Features include:

1. Display of products
2. Shopping cart
3. Submission of orders
4. Dashboard for orders management

The block to display products and the shopping cart were constructed using knockout JS, so that computed values and cascading events in UI could be chained together. After finalization, the orders were submitted to DB using ajax.

TO DO:

1. Integration of Stripe to tokenize credit card, instead of saving cc_num directly
2. Shipping management by integrating with Shippo API
3. Capability of editting products from dashboard
