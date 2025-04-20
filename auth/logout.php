<?php
// Start session (only once at the beginning)
session_start();

// Clear all session data
$_SESSION = array();

// delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}

// Finally, destroy the session
session_destroy();

// Start a new session for the logout message
session_start();
$_SESSION['successmsg'] = "You have successfully logged out.";

// Redirect (use absolute URL for reliability)
header("Location: ../index.php");
exit(); // Always exit after header redirect
?>