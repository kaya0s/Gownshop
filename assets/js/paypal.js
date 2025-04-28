paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '499' // The price of the gown
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            alert('Transaction completed by ' + details.payer.name.given_name);

            // Optional: Call a PHP file to save payment to database
            fetch('../../test/payment_success.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    orderID: data.orderID,
                    payerID: data.payerID
                })
            })
            .then(response => response.text())
            .then(data => console.log(data));
        });
    }
}).render('#paypal-button-container');