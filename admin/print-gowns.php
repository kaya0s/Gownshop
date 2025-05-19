<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['print'])) {
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../includes/connection_db.php';

    $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);

    header('Content-Type: application/pdf');

    // Query to get all gowns (both available and unavailable)
    $result = mysqli_query($conn, "SELECT 
        categories.id AS category_id,
        categories.name AS category_name,
        gowns.id AS gown_id,
        gowns.name AS gown_name,
        gowns.price as price,
        gowns.available as status
        FROM categories 
        LEFT JOIN gowns 
        ON categories.id = gowns.category_id");

    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }
    $all_gowns = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    // Separate available and unavailable gowns
    $available_gowns = array_filter($all_gowns, function($gown) {
        return $gown['status'] == 1;
    });
    
    $unavailable_gowns = array_filter($all_gowns, function($gown) {
        return $gown['status'] == 0;
    });

    $html = '
    <html>
    <head>
        <style>
            body {
                font-family: "Times New Roman", Times, serif;
                margin: 40px;
                font-size: 12pt;
                color: #000;
            }

            .header {
                text-align: center;
                border-bottom: 2px solid #333;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }

            .company-name {
                font-size: 20pt;
                font-weight: bold;
                color: #222;
                text-transform: uppercase;
            }

            .report-title {
                font-size: 14pt;
                font-weight: normal;
                margin-top: 5px;
                color: #444;
            }
            
            .section-title {
                font-size: 14pt;
                font-weight: bold;
                margin-top: 20px;
                margin-bottom: 10px;
                color: #333;
                border-bottom: 1px solid #999;
                padding-bottom: 5px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
                margin-bottom: 30px;
            }

            th, td {
                border: 1px solid #444;
                padding: 8px;
                text-align: center;
            }

            th {
                background-color: #dcdcdc;
                font-weight: bold;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            .signature-section {
                margin-top: 60px;
                text-align: left;
                padding-right: 80px;
            }

            .signature p {
                margin: 4px 0;
                font-size: 12pt;
            }

            .signature .name {
                text-decoration: underline;
                font-weight: bold;
            }

            .footer {
                text-align: left;
                font-size: 10px;
                color: #888;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="company-name">HJ Gown Shop</div>
            <div class="report-title">Product Inventory Report</div>
        </div>

        <div class="section-title">Available Gowns</div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gown Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>';

    if (count($available_gowns) > 0) {
        foreach ($available_gowns as $gown) {
            $html .= '
                <tr>
                    <td>'. $gown['gown_id'] . '</td>
                    <td>' . htmlspecialchars($gown['gown_name']) . '</td>
                    <td>' . htmlspecialchars($gown['category_name']) . '</td>
                    <td>₱' . number_format($gown['price'], 2) . '</td>
                    <td>AVAILABLE</td>
                </tr>';
        }
    } else {
        $html .= '
            <tr>
                <td colspan="5" style="text-align: center;">No available gowns found</td>
            </tr>';
    }

    $html .= '
            </tbody>
        </table>

        <div class="section-title">Unavailable Gowns</div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gown Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>';

    if (count($unavailable_gowns) > 0) {
        foreach ($unavailable_gowns as $gown) {
            $html .= '
                <tr>
                    <td>'. $gown['gown_id'] . '</td>
                    <td>' . htmlspecialchars($gown['gown_name']) . '</td>
                    <td>' . htmlspecialchars($gown['category_name']) . '</td>
                    <td>₱' . number_format($gown['price'], 2) . '</td>
                    <td>UNAVAILABLE</td>
                </tr>';
        }
    } else {
        $html .= '
            <tr>
                <td colspan="5" style="text-align: center;">No unavailable gowns found</td>
            </tr>';
    }

    $html .= '
            </tbody>
        </table>
        <div class="signature-section">
            <div class="signature">
                <p class="name">Honey Java</p>
                <p>General Manager</p>
            </div>
        </div>
    </body>
    </html>';

    $mpdf->SetHTMLFooter('<div class="footer">Page {PAGENO} of {nbpg}</div>');
    $mpdf->WriteHTML($html);
    $mpdf->Output('', 'I');
    exit;
}
?>