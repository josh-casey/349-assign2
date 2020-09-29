var Ship = (function () {
    "use strict";

    var pub = {};
    function toggleShip() {
        $(document).on("click","#toggleShip", function() {
            var formData = {
                'shipped': $(this).closest("tr").children('td:eq(5)').text(),
                'order-id': $(this).closest("tr").children('td:eq(0)').text()
            }
            $.ajax({
                type: 'POST',
                data: formData,
                dataType: 'text',
                url: 'private/toggleShip.php',
                success:function(resultData) {
                    window.location.reload();
                },
                error: function(data){
                    alert("Ajax Failed");
                }
            });
        })

    }


    pub.setup = function() {
        toggleShip();
    };

    return pub;
}());

$(document).ready(Ship.setup)