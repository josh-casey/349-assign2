var Shop = (function () {
    "use strict";

    var pub = {};
    var cartData = window.localStorage.getItem('cart');
    var customer;

    function placeOrder() {
        var i;
        $("#order").click(function() {
            customer = {}
            customer.name = $("#name").val();
            customer.email = $("#email").val();
            customer.address = $("#address").val();
            customer.items = "";
            customer.price = 0;

            cartData = JSON.parse(cartData);
            for (i = 0; i < cartData.length; i++) {
                customer.items += "[" + cartData[i].id + ": " + cartData[i].name + "],";
                customer.price += parseFloat(cartData[i].price);
            }
            customer.price = Math.round(customer.price * 100) / 100; // rounding
            var formData = {
                'name': customer.name,
                'email': customer.email,
                'address': customer.address,
                'items': customer.items,
                'price': customer.price
            }

            console.log(formData);
            $.ajax({
                type: 'POST',
                data: formData,
                dataType: 'text',
                url: 'private/processCartContents.php',
                success:function(resultData) {
                    window.localStorage.clear();
                    window.location.reload();
                },
                error: function(data){
                    alert("Ajax Failed");
                }
            });
        })

    }


    pub.setup = function() {
        placeOrder();
    };

    return pub;
}());

$(document).ready(Shop.setup)