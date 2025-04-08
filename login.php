<?php
session_start();
include('db.php');
function password_verification($inputPassword, $storedPassword) {
    return hash_equals($inputPassword, $storedPassword);
}



if (isset($_POST['signin'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Debugging (before anything else)
    echo "<script>
        console.log('Username: " . addslashes($username) . "');
        console.log('Password: " . addslashes($password) . "');
    </script>";

    if (empty($username) || empty($password)) {
        echo "<script>alert('Please fill in all fields.');</script>";
        echo "<script>
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 2000);
        </script>";
        exit();
    }

    try {
        $sql = "SELECT Username, Password FROM users WHERE Username = :Username";
        $query = $dbh->prepare($sql);
        $query->bindParam(':Username', $username, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);



        if ($result && password_verification($password, $result['Password'])) {
            $_SESSION['login'] = $username;
            echo "<script>
                console.log('Login successful for user: " . addslashes($username) . "');
                setTimeout(() => {
                    window.location.href = 'dashboard.php';
                }, 1000);
            </script>";
            exit();
        } else {
            echo "<script>
                alert('Invalid username or password.');
                console.log('Failed login for user: " . addslashes($username) . "');
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 2000);
            </script>";
            exit();
        }
    } catch (PDOException $e) {
        echo "<script>
            alert('Database error occurred.');
            console.error('" . addslashes($e->getMessage()) . "');
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 2000);
        </script>";
        exit();
    }
}
?>
