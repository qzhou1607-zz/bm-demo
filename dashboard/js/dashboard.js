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
    




