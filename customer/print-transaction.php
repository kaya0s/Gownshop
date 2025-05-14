<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['print'])) {
    require_once __DIR__ . '/../vendor/autoload.php'; // Autoload
    require_once __DIR__ . '/../includes/connection_db.php'; // Database connection

    $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']); // Portrait orientation

    header('Content-Type: application/pdf');

    // Query to fetch user-specific transactions
    $query = "SELECT t.id as id,user_id, price, payment_method, status, name
              FROM transactions t 
              INNER JOIN gowns g ON t.gown_id = g.id 
              WHERE t.id =" . $_GET['id'];
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    $transaction = mysqli_fetch_assoc($result);

    // Start building the receipt layout
    $html = '
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 40px;
                line-height: 1.5;
                color: #333;
            }
            .header, .footer {
                text-align: center;
            }
            .header h1 {
                margin: 0;
                font-size: 24px;
                color: #2c3e50;
            }
            .header p {
                margin: 5px 0;
                font-size: 14px;
            }
            .receipt-title {
                text-align: center;
                margin-top: 20px;
                font-size: 18px;
                color: #008080;
                font-weight: bold;
            }
            .billed-to, .receipt-info {
                margin-top: 20px;
                font-size: 14px;
                display: inline-block;
                width: 48%;
                vertical-align: top;
            }
            .receipt-info {
                text-align: right;
            }
            .table-container {
                margin-top: 20px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f4f4f4;
                color: #333;
            }
            .notes {
                margin-top: 20px;
                font-size: 14px;
                color: #555;
            }
            .notes p {
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h1>HJ Gown Shop</h1>
            <p>1234 Gown St.<br>Fashion Town, ST 12345</p>
        </div>

        <div class="receipt-title">Transaction Report</div>

        <div>
            <div class="billed-to">
                <strong>Billed To</strong><br>
                '.$_SESSION['fullname'].'<br>
                1234 Customer St.<br>
                Customer Town, ST 12345
            </div>
            <div class="receipt-info">
                <strong>Receipt Date:</strong> ' . date('d-m-Y') . '<br>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>';
    

        $html .= '
                    <tr>
                        <td>' . htmlspecialchars($transaction['name']) . '</td>
                        <td>' . htmlspecialchars($transaction['price']) . '</td>
                        <td>' . htmlspecialchars($transaction['payment_method']) . '</td>
                        <td>' . htmlspecialchars($transaction['status']) . '</td>
                    </tr>';


    $html .= '
                </tbody>
            </table>
        </div>

        <div class="notes">
            <p><strong>Notes</strong></p>
            <p>Thank you for your business!</p>
        </div>

        <div class="footer">
            <p>© 2025 HJ Gown Shop. All Rights Reserved.</p>
        </div>
    </body>
    </html>';

    // Footer with page numbers
    $mpdf->SetHTMLFooter('
        <div style="text-align: left; font-size: 10px; color: #aaa;">
            Page {PAGENO}/{nbpg}
        </div>');

    // Generate PDF
    $mpdf->WriteHTML($html);
    $mpdf->Output('receipt.pdf', 'I'); // Display inline in browser
    exit;
}
?>
