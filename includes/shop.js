function AppViewModel() {
    var self = this;
    self.orders_array = ko.observableArray();
    self.remove_item = function() {
        self.orders_array.remove(this);
    }
    self.add_item = function(product_id,quantity, customer_id) {
        self.orders_array.push(new Order(product_id,quantity,customer_id));
    };
    self.subtotal = ko.computed(function() {
        if (self.orders_array().length == 0) {
            return 0;
        } else {
            var sub = 0;
            for (i=0;i<self.orders_array().length;i++) {
                    sub += self.orders_array()[i].total()*1;
                }
            return sub.toFixed(2);
        }
    });
    
    //product
    self.products_array = ko.observableArray();
    self.get_product_by_id = function(id) {
        for(i=0;i<self.products_array().length;i++) {
            if (self.products_array()[i].product_id() == id) {
                return self.products_array()[i];
            }
        }
    }
}

function Order(product_id,quantity,customer_id) {
        var self = this;
            //self.order_id = ko.observable();
            self.product_id = ko.observable(product_id);
            self.customer_id = ko.observable(customer_id);
            self.quantity = ko.observable(quantity);
            self.total = ko.computed(function() {
                return (self.quantity()*data.get_product_by_id(self.product_id()).product_price()).toFixed(2);
            });
        
}

function Product() {
    var self = this;
    self.product_id = ko.observable();
    self.product_name = ko.observable();
    self.product_price = ko.observable();
    self.product_inventory = ko.observable();
    self.product_img_url = ko.observable();
    self.quantity = ko.observable();
    self.added = ko.observable();
    self.dropdown = ko.observableArray();
}



data = new AppViewModel();
//lookup = new Products();

//ko.applyBindings(data);

$.getScript('includes/get_products.php');
