<?php
session_start();
include('db.php');

if (isset($_POST['signin'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Please fill in all fields.';
        header('Location: index.php');
        exit();
    }

    try {
        $sql = "SELECT * FROM users WHERE username = :username";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result && $password === $result['password']) {
            $_SESSION['login'] = $result['username'];
            $_SESSION['profile'] = $result['profile'];
            header('Location: dashboard.php');
            exit();
        } else {
            $_SESSION['error'] = 'Invalid username or password.';
            header('Location: index.php');
            exit();
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $_SESSION['error'] = 'Database error occurred.';
        header('Location: index.php');
        exit();
    }
}
?>