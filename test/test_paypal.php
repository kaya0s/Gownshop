<!DOCTYPE html>
<html>
<head>
    <title>PayPal Test Payment</title>
</head>
<body>

<h2>Book Gown Payment</h2>
<p>Gown Name: Elegant Wedding Gown</p>
<p>Price: $50.00</p>

<!-- Load PayPal SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=AQPRUGHYzhVZLSyPxDrChkh_Q9JH5j_asBVjKg13bLDsO4b4QIbB1f8gsZKw0PRfIs_ICB6AggeZ0dd8&currency=PHP"></script>

<!-- PayPal Button -->
<div id="paypal-button-container"></div>

<script>
paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '50.00' // The price of the gown
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            alert('Transaction completed by ' + details.payer.name.given_name);

            // Optional: Call a PHP file to save payment to database
            fetch('payment_success.php', {
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
</script>

</body>
</html>
