<?php
session_start();
include 'db.php'; // This must define $dbh

if (isset($_POST['change_password'])) {
    $entered_username = $_POST['username']; // From form
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $session_username = $_SESSION['login'];

    // Check if new passwords match
    if ($new_password !== $confirm_password) {
        echo "New passwords do not match.";
        exit;
    }

    // Compare entered username with session username
    if ($entered_username === $session_username) {
        echo $session_username;
        // Update password
        $stmt = $dbh->prepare("UPDATE users SET password = :new_password WHERE username = :username");
        $stmt->bindParam(':new_password', $new_password, PDO::PARAM_STR);
        $stmt->bindParam(':username', $session_username, PDO::PARAM_STR);
        $stmt->execute();

        echo "Password changed successfully.";
    } else {
        echo "Entered username does not match your session.";
    }
}
?>
