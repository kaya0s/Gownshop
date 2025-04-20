
<?php

function require_role($role) {
    require_once('connection_db.php'); 

    if (!isset($_SESSION['username'])) {
        header("Location: /hj_gownshop/index.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT user_type FROM users WHERE username = ?");
    if (!$stmt) {
        die("Database error: " . $conn->error);
    }

    $stmt->bind_param("i", $_SESSION['username']);
    $stmt->execute();
    $stmt->bind_result($usertype);
    $stmt->fetch();
    $stmt->close();

    if ($usertype !== $role) {
        header("Location: /hj_gownshop/customer/customer.php");
        exit();
    }
}

if (isset($_SESSION['usertype'])) {
    require_role($_SESSION['usertype']); // or 'customer' based on your requirement
} else {
    header("Location: /hj_gownshop/index.php");
    exit();
}
?>