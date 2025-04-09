<?php
session_start();
include('db.php');

function password_verification($inputPassword, $storedPassword) {
    return hash_equals($inputPassword, $storedPassword);
}

if (isset($_POST['signin'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Just basic debugging (optional)
    echo "<script>
        console.log('Username: " . addslashes($username) . "');
        console.log('Password: " . addslashes($password) . "');
        console.log('Profile Value: " . addslashes($_SESSION['profile']) . "');
    </script>";

    if (empty($username) || empty($password)) {
        echo "<script>alert('Please fill in all fields.');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
        exit();
    }

    try {
        $sql = "SELECT * FROM users WHERE Username = :Username";
        $query = $dbh->prepare($sql);
        $query->bindParam(':Username', $username, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verification($password, $result['Password'])) {
            // ✅ Set session values *after* you get the DB result
            $_SESSION['login'] = $result['Username'];
            $_SESSION['profile'] = $result['profile'];

            // Optional: display on-screen for testing
            echo "<h1>" . htmlspecialchars($result['Username']) . "</h1>";
            echo "<h1>Profile: " . htmlspecialchars($result['profile']) . "</h1>";

            echo "<script>
                console.log('Login successful for user: " . addslashes($username) . "');
                window.location.href = 'dashboard.php';
            </script>";
            exit();
        } else {
            echo "<script>
                alert('Invalid username or password.');
                window.location.href = 'index.php';
            </script>";
            exit();
        }
    } catch (PDOException $e) {
        echo "<script>
            alert('Database error occurred.');
            console.error('" . addslashes($e->getMessage()) . "');
            window.location.href = 'index.php';
        </script>";
        exit();
    }
}
?>
