<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dasboard.css">
    <link rel="stylesheet" href="css/createuser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <?php
    session_start();
        include ('includes/sidebar.php');
        

        if (!isset($_SESSION['login'])) {
        // User is not logged in, redirect to login page
        echo "<script>
            alert('Please log in first.');
            window.location.href = 'index.php';
        </script>";
        exit();
        }
    ?>
    <div class="main-content">
        <div class="header">
            <h1>Welcome, <?php echo isset($_SESSION['login']) ? ucfirst(htmlspecialchars($_SESSION['login'])) : 'Guest'; ?></h1>
            <div class="user">
                <i class="fas fa-user" style= "padding-right: 15px; font-size: 23px"></i>
                <span style= "font-size: 18px"><?php echo isset($_SESSION['login']) ? ucfirst(htmlspecialchars($_SESSION['login'])) : 'Guest'; ?></span>
            </div>
        </div>
        <form class="get-user" method="POST" onsubmit="return validatePasswords()">
    <table style="border= none;">
        <tr>
            <th>Labels</th>
            <th>Provide Your Details</th>
        </tr>
        <!-- <tr>
            <td><label for="id">ID</label></td>
            <td><input type="number" id="id" name="id" autocomplete="off" required></td>
        </tr> -->
        <tr>
            <td><label for="firstName">First Name</label></td>
            <td><input type="text" id="firstName" name="firstName" autocomplete="off" required></td>
        </tr>
        <tr>
            <td><label for="employeeCode">Employee Code</label></td>
            <td><input type="text" id="employeeCode" name="employeeCode" autocomplete="off" required></td>
        </tr>
        <tr>
            <td><label for="username">Username</label></td>
            <td><input type="text" id="username" name="username" autocomplete="off" required></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td><input type="password" id="password" name="password" autocomplete="off" required></td>
        </tr>
        <tr>
            <td><label for="confirmPassword">Confirm Password</label></td>
            <td><input type="password" id="confirmPassword" name="confirmPassword" autocomplete="off" required></td>
        </tr>
        <tr>
            <td><label for="profile">Profile Settings</label></td>
            <td><select name="profile" id="profile">
                <option value="1" selected>User</option>
                <option value="0">Admin</option>
            </select></td>
        </tr>
    </table>
    <button type="submit" class="submit-btn" name="submit">SUBMIT</button>
    <script>
    function validatePasswords() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (password !== confirmPassword) {
            alert('Passwords do not match. Please try again.');
            return false; // Prevents form submission
        }
        return true; // Allows form submission if passwords match
    }
</script>
</form>
    </div>
</body>
</html>
<?php
// session_start();
// include 'db.php';
error_reporting(0);
if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $employeeCode = $_POST['employeeCode'];
    $username = $_POST['username'];
    $password = $_POST['password']; // plain text (not secure)
    $profile = $_POST['profile'];

    $sql = "INSERT INTO users (firstName, employeeCode, username, password, profile)
            VALUES (:firstName, :employeeCode, :username, :password, :profile)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $query->bindParam(':employeeCode', $employeeCode, PDO::PARAM_STR);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':profile', $profile, PDO::PARAM_STR);

    $query->execute();
    $lastinsert = $dbh->lastInsertId();

    if ($lastinsert) {
        $_SESSION['msg'] = 'You have registered successfully';
    } else {
        $_SESSION['msg'] = 'Something went wrong, please try again.';
        return;
    }
}
?>