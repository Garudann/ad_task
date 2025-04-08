<?php
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Optional: Redirect to login page with a message
echo "<script>
    // alert('You have been logged out.');
    window.location.href = 'index.php';
</script>";
exit();
?>
