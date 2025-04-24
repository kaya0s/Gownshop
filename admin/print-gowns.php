<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['print'])) {
    // Corrected path to autoload.php
    require_once __DIR__ . '/../vendor/autoload.php'; // Correct path to autoload
    require_once __DIR__ . '/../includes/connection_db.php'; // Correct path to connection_db.php
    
    $mpdf = new Mpdf\Mpdf(['orientation' => 'L']); // Ensure the Mpdf class is loaded
    
    header('Content-Type: application/pdf');


    $result = mysqli_query($conn, "SELECT * FROM gowns");
  if(!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $count = 1; // Initialize count for numbering
    $html = '
    <html>
    <head>
        <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1, h4 { text-align: center; color: #333; } /* added h4 */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f0f0f0; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
    </head>
    <body>
        <h4>List of Products</h4>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>';

    foreach ($products as $product) {
        $html .= '
                <tr>
                    <td>' . $count++ . '</td>
                    <td>' . htmlspecialchars($product['name']) . '</td>
                    <td>' . htmlspecialchars($product['category_id']) . '</td>
                    <td>' . htmlspecialchars($product['price']) . '</td>
                    <td>' . htmlspecialchars($product['color']) . '</td>
                </tr>';
    }

    $html .= '
            </tbody>
        </table>
        <div class="signature-section">
            <div class="signature">
                <p style="text-decoration: underline;"><strong>Juswa</strong></p>
                <p><strong> General Manager</strong></p>
            </div> 
        </div>
    </body> 
    </html>';

    $mpdf->SetHTMLFooter('
        <div style="text-align: left; font-size: 10px; color: #aaa;">
            Page {PAGENO}/{nbpg}
        </div>');

    $mpdf->WriteHTML($html);
    $mpdf->Output('', 'I');
    exit;
}

?>
