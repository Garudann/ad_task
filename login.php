<?php
session_start();
include('db.php'); // Include the database connection

if (isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate inputs (basic example)
    if (empty($username) || empty($password)) {
        echo "<script>alert('Please fill in all fields.');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
        exit();
    }

    try {
        // Prepare SQL query to fetch user details
        $sql = "SELECT username, password FROM tblusers WHERE username = :username";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if ($result && password_verify($password, $result['password'])) {
            // Login successful
            $_SESSION['login'] = $username;
            echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
            exit();
        } else {
            // Login failed
            echo "<script>alert('Invalid username or password.');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
            echo "<script>console.log ($username, $password)</script>";
            exit();
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "<script>alert('Database error: " . addslashes($e->getMessage()) . "');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
        exit();
    }
}
?>