<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change password</title>
    <link rel="stylesheet" href="css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <form action=" send_otp.php" method="POST">
            <h3>change your password</h3>
            <div class="input-box">
                <input type="text" name="username" placeholder="Enter your username" required>
                <i class='bx bxs-user'></i>
            </div>
            <button type="submit" class="btn1">submit</button>
        </form>
    </div>
</body>
</html>