<?php
session_start();
include('db.php');

if (isset($_POST['signin'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "<script>alert('Please fill in all fields.');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
        exit();
    }

    try {
            $sql = "SELECT Username, Password FROM users WHERE Username = :Username";
            $query = $dbh->prepare($sql);
            $query->bindParam(':Username', $username, PDO::PARAM_STR);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($password, $result['password'])) {
                $_SESSION['login'] = $username;
                echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
                exit();
            } 
            else {
                echo "<script>alert('Invalid username or password.');</script>";
                echo "<script>window.location.href = 'index.php';</script>";
                exit();
            }
    } catch (PDOException $e) {
        echo "<script>alert('Database error: " . addslashes($e->getMessage()) . "');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
        exit();
    }
}
?>
