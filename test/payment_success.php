<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'hj_gownshop');

// Get payment details sent by JS
$data = json_decode(file_get_contents("php://input"), true);

$orderID = $data['orderID'];
$payerID = $data['payerID'];

// Example SQL (depends on your tables)
$sql = "INSERT INTO payments (order_id, payer_id, amount, status) VALUES ('$orderID', '$payerID', 50.00, 'Paid')";

if ($conn->query($sql) === TRUE) {
    echo "Payment recorded.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
