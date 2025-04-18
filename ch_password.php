<?php
session_start();
include('db.php'); // your PDO connection

if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('Please log in first.');
        window.location.href = 'index.php';
    </script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize input
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>
            alert('Passwords do not match.');
            window.history.back();
        </script>";
        exit();
    }

    try {
        // Update password using PDO
        $stmt = $dbh->prepare("UPDATE users SET password = :password WHERE username = :username");
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':username', $username);

        if ($stmt->execute()) {
            echo "<script>
                alert('Password updated successfully.');
                window.location.href = 'profile.php';
            </script>";
        } else {
            echo "<script>
                alert('Error updating password. Please try again.');
                window.history.back();
            </script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
