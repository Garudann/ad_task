<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login here</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="wrapper">
        <form id="login_form">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" id="Username" autocomplete="off" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="password" id="password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href='for_pass.html'>Forgot password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="ac">
                <p>Don't have account? please contact your admin.</p>
            </div>
        </form>
        <p id="loginStatus"></p>
    </div>
    <script src="js/login.js"></script>
</body>
</html>