<?php
session_start();

// Destroy session data
session_unset();
session_destroy();

// Clear cookies (if you stored login info in them)
if (isset($_COOKIE['username'])) {
    setcookie('username', '', time() - 3600, '/');
}
if (isset($_COOKIE['password'])) {
    setcookie('password', '', time() - 3600, '/');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Here</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="wrapper">
        <form id="login_form" method="POST" action="login.php">
            <h1>Login</h1>
            <div class="input-box">
                <label for="Username"></label>
                <input type="text" name="username" id="Username" placeholder="Username" autocomplete="off" autocorrect="off" autocapitalize="none">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <label for="Password"></label>
                <input type="password" name="password" id="Password" placeholder="Password">
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href='for_pass.html'>Forgot password?</a>
            </div>
            <button type="submit" name="signin" class="btn">Login</button>
            <div class="ac">
                <p>Don't have an account? Please contact your admin.</p>
            </div>
        </form>
        <p id="loginStatus"></p>
    </div>
</body>
</html>
