<?php
// Initialize the status filter (default to 'pending')
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'pending';

// Prepare and execute the query based on filter
$query = "SELECT t.id, t.date_booked, t.status, t.total_price, g.name AS gown_name, u.email 
          FROM transactions t
          JOIN gowns g ON t.gown_id = g.id
          JOIN users u ON t.user_id = u.id";

// Add filtering if needed
if ($status_filter !== 'all') {
    $query .= " WHERE t.status = '$status_filter'";
}

$query .= " ORDER BY t.date_booked DESC";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if query was successful
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

// Fetch all transactions
$transactionData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $transactionData[] = $row;
}

// Automatically update status for overdue rentals
$currentDate = new DateTime();
foreach ($transactionData as $key => $transaction) {
    if ($transaction['status'] == 'rented') {
        $dateBooked = new DateTime($transaction['date_booked']);
        $interval = $dateBooked->diff($currentDate);
        
        if ($interval->days > 5) {
            // Update status to 'unreturned' in database
            $updateQuery = "UPDATE transactions SET status = 'unreturned' WHERE id = " . $transaction['id'];
            mysqli_query($conn, $updateQuery);
            
            // Update the status in our local array too
            $transactionData[$key]['status'] = 'unreturned';
        }
    }
}
?>
<div class="row d-flex flex-wrap justify-content-start">
    <div class="d-flex gap-2 mt-4 mb-3" style="margin-left: 0px; margin-right: 20px;">
        <button class="btn btn-outline-warning <?php echo ($status_filter == 'pending') ? 'active' : ''; ?>" 
                onclick="window.location.href='?status=pending'">
            <i class="bi bi-hourglass-split"></i> Pending</button>
        <button class="btn btn-outline-info <?php echo ($status_filter == 'rented') ? 'active' : ''; ?>" 
                onclick="window.location.href='?status=rented'">
            <i class="bi bi-house-door"></i> Rented</button>
        <button class="btn btn-outline-success <?php echo ($status_filter == 'returned') ? 'active' : ''; ?>" 
                onclick="window.location.href='?status=returned'">
            <i class="bi bi-check-circle"></i> Returned</button>
        <button class="btn btn-outline-danger <?php echo ($status_filter == 'unreturned') ? 'active' : ''; ?>" 
                onclick="window.location.href='?status=unreturned'">
            <i class="bi bi-exclamation-circle"></i> Unreturned</button>
    </div>
</div>

    
<div class="table-responsive">
    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Gown</th>
                <th>Date Booked</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <?php if (empty($transactionData)): ?>
                <tr>
                    <td colspan="7" class="text-center">No transactions found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($transactionData as $transaction): ?>
                    <tr>
                        <td><?php echo $transaction['id']; ?></td>
                        <td><?php echo htmlspecialchars($transaction['email']); ?></td>
                        <td><?php echo htmlspecialchars($transaction['gown_name']); ?></td>
                        <td><?php echo $transaction['date_booked']; ?></td>
                        <td><?php echo $transaction['total_price']; ?></td>
                        <td><?php echo ucfirst($transaction['status']); ?></td>
                        <td>
                            <?php if ($transaction['status'] == 'pending'): ?>
                                <button class="btn btn-success btn-sm accept-btn" data-id="<?php echo $transaction['id']; ?>">
                                <i class="bi bi-check-circle"></i> Accept Booking
                                </button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $transaction['id']; ?>">
                                <i class="bi bi-trash"></i>  Reject Booking
                                </button>
                            <?php elseif ($transaction['status'] == 'rented'): ?>
                                <button class="btn btn-primary btn-sm return-btn" data-id="<?php echo $transaction['id']; ?>">
                                <i class="bi bi-check-circle"></i>  Mark as Returned
                                </button>
                            <?php elseif ($transaction['status'] == 'unreturned'): ?>
                                <button class="btn btn-warning btn-sm return-btn" data-id="<?php echo $transaction['id']; ?>">
                                <i class="bi bi-check-circle"></i>   Mark as Returned
                                </button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $transaction['id']; ?>">
                                <i class="bi bi-trash"></i>    Delete Booking
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    // Handle accept booking button click
    $('.accept-btn').click(function() {
        var transactionId = $(this).data('id');
        if (confirm('Are you sure you want to accept this booking?')) {
            $.ajax({
                url: 'update_transaction.php',
                type: 'POST',
                data: { 
                    id: transactionId,
                    action: 'accept'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert("An error occurred: " + error);
                }
            });
        }
    });
    
    // Handle return button click
    $('.return-btn').click(function() {
        var transactionId = $(this).data('id');
        if (confirm('Are you sure you want to mark this gown as returned?')) {
            $.ajax({
                url: 'update_transaction.php',
                type: 'POST',
                data: { 
                    id: transactionId,
                    action: 'return'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert("An error occurred: " + error);
                }
            });
        }
    });


    $('.delete-btn').click(function() {
        var transactionId = $(this).data('id');
        if (confirm('Are you sure you want to delete this transaction? This action cannot be undone.')) {
            $.ajax({
                url: 'update_transaction.php',
                type: 'POST',
                data: { 
                    id: transactionId,
                    action: 'delete'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert("An error occurred: " + error);
                }
            });
        }
    });

});</script>