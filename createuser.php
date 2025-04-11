<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User | Create    </title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dasboard.css">
    <link rel="stylesheet" href="css/createuser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    
    <?php
        session_start();
        include 'db.php';
        include ('includes/sidebar.php');
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
                    <th></th>
                    <th></th>
                </tr>
                <!-- <tr>
                    <td><label for="id">ID</label></td>
                    <td><input type="number" id="id" name="id" autocomplete="off" required></td>
                </tr> -->
                <tr>
                    <td><label for="firstName">First Name</label></td>
                    <td><input type="text" id="firstName" name="firstName" autocomplete="off" placeholder="Enter your name" required></td>
                </tr>
                <tr>
                    <td><label for="employeeCode">Employee Code</label></td>
                    <td><input type="text" id="employeeCode" name="employeeCode" autocomplete="off" placeholder="Enter Employee code" required></td>
                </tr>
                <tr>
                    <td><label for="username">Username</label></td>
                    <td><input type="text" id="username" name="username" autocomplete="off" placeholder="Enter Username" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td><input type="password" id="password" name="password" autocomplete="off" placeholder="Enter Password" required></td>
                </tr>
                <tr>
                    <td><label for="confirmPassword">Confirm Password</label></td>
                    <td><input type="password" id="confirmPassword" name="confirmPassword" autocomplete="off" placeholder="Enter Confirm Password" required></td>
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
    </div>
    <script>
    function validatePasswords() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (password !== confirmPassword) {
            alert('Passwords does not match. Please try again.');
            return false; // Prevents form submission
        }
        return true; // Allows form submission if passwords match
    }
</script>
</form>
</body>
</html>
<?php
    error_reporting(0);
    if (isset($_POST['submit'])) {
        $firstName = $_POST['firstName'];
        $employeeCode = $_POST['employeeCode'];
        $username = $_POST['username'];
        $password = $_POST['password']; // plain text (not secure)
        $profile = $_POST['profile'];

        $sql = "INSERT INTO users (Employee_name, EMP_code, Username, Password, profile)
        VALUES (:firstName, :employeeCode, :username, :password, :profile)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':firstName', $firstName, PDO::PARAM_STR);     // -> Employee_name
        $query->bindParam(':employeeCode', $employeeCode, PDO::PARAM_STR); // -> EMP_code
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':profile', $profile, PDO::PARAM_STR);        

        $query->execute();
        $lastinsert = $dbh->lastInsertId();

        if ($lastinsert) {
            echo "<script>alert('User created successfully!');</script>";
        } else {
            echo "<script>alert('Somwthing went wrong. Please try again.');</script>";
            return;
        }
    }
?>