$(document).ready(function() {
    $('.toDetails').on('click', function() {
        self = $(this);
        $('.details').load('../ajax/details.php', {'customer_id': self.attr('id')});
            $.magnificPopup.open({
                items: {
                    src: $('.details'),
                    type:'inline'
                }
              });
        return false;
    });
});

$(document).ready(function() {
    $('.toShippingDetails').on('click', function() {
        self = $(this);
        $('.shipping-details').load('../ajax/shipping-details.php', {'customer_id': self.attr('id'), 'shop_id':self.attr('data-shop-id')});
            $.magnificPopup.open({
                items: {
                    src: $('.shipping-details'),
                    type:'inline'
                }
              });
        return false;
    });
});
    








