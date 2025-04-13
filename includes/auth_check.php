<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /hj-gownshop/auth/login.php");
    exit();
}

// Optional: Restrict access by role (admin or customer)
function require_role($role) {
    if ($_SESSION['role'] !== $role) {
        header("Location: /hj-gownshop/index.php");
        exit();
    }
}
?>