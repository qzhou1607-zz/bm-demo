function AppViewModel() {
    var self = this;
    self.orders_array = ko.observableArray();
    self.remove_item = function() {
        self.orders_array.remove(this);
        self.get_product_by_id(this.product_id()).added('');
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
    
    //customer
    self.customer = ko.observable(new Customer());
    
    //sample customers
    self.sample_customers = ko.observableArray();
    self.generate_mock_data = function() {
        $.post('includes/ajax/generate-mock-data.php'
                ,function(customer) {
                    customer = JSON.parse(customer);
                    data.customer().first_name(customer.first_name);
                    data.customer().last_name(customer.last_name);
                    data.customer().email(customer.email);
                    data.customer().address_1(customer.address_1);
                    data.customer().city(customer.city);
                    data.customer().state(customer.state);
                    data.customer().country(customer.country);
                    data.customer().postal_code(customer.postal_code);
                    data.customer().cc_first_name(customer.first_name);
                    data.customer().cc_last_name(customer.last_name);
                    data.customer().cc_num(customer.cc_num);
                    data.customer().cc_month(customer.cc_month);
                    data.customer().cc_year(customer.cc_year);
                    data.customer().cc_cvv(customer.cc_cvv);
                    data.customer().phone(customer.phone);
                });   
    };
}

function Order(product_id,quantity) {
        var self = this;
            //self.order_id = ko.observable();
            self.product_id = ko.observable(product_id);
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

function Customer() {
    var self = this;
    self.customer_id = ko.observable();
    self.first_name = ko.observable();
    self.last_name = ko.observable();
    self.address_1 = ko.observable();
    self.address_2 = ko.observable('');
    self.city = ko.observable();
    self.country = ko.observable();
    self.state = ko.observable();
    self.postal_code = ko.observable();
    self.email = ko.observable();
    self.phone = ko.observable();
    self.same_address = ko.observable(false);
    self.cc_first_name = ko.observable();
    self.cc_last_name = ko.observable();
    self.cc_num = ko.observable();
    self.cc_month = ko.observable();
    self.cc_year = ko.observable();
    self.cc_cvv = ko.observable();
    self.billing_address_1 = ko.observable();
    self.billing_address_2 = ko.observable('');
    self.billing_city = ko.observable();
    self.billing_state = ko.observable();
    self.billing_country = ko.observable();
    self.billing_postal_code = ko.observable();
    self.copy_address = ko.computed(function() {
        if (self.same_address() == true) {
            self.billing_address_1(self.address_1());
            self.billing_address_2(self.address_2());
            self.billing_city(self.city());
            self.billing_country(self.country());
            self.billing_postal_code(self.postal_code());
            self.billing_state(self.state());
        } else {
            self.billing_address_1('');
            self.billing_address_2('');
            self.billing_city('');
            self.billing_postal_code('');
            self.billing_state('');
            self.billing_country('');
        }
    });
}



data = new AppViewModel();
//lookup = new Products();

//ko.applyBindings(data);

$.getScript('includes/get_products.php');

function send_data(data) {
    send = {};
    //customer data
    for (entry in data.customer()) {
        send[entry] = data.customer()[entry]();
    };
    send.orders= [];
    //order data
    for (entry in data.orders_array()) {
        order = data.orders_array()[entry];
        send.orders.push({
            //'customer_id':order.customer_id(),
            'product_id':order.product_id(),
            'quantity':order.quantity(),
            'total':order.total()
        });
    }
    $.post('includes/ajax/submit.php'
                ,send
                ,function(response) {
                    if (JSON.parse(response).success) {
                        swal('Orders Submitted!', 'Thank You for Your Purchase.', 'success');
                    } else {
                        swal('Sorry!', 'Something Went Wrong.', 'warning');
                    }
                });   
}



