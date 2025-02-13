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
<!-- <?php
    
    // session_start();
    // if(isset($_POST['signin']))
    // {
    // $Username=$_POST['Username'];
    // $password=md5($_POST['password']);
    // $sql ="SELECT Username,Password FROM tblusers WHERE Username=:Username and Password=:password";
    // $query= $dbh -> prepare($sql);
    // $query-> bindParam(':Username', $Username, PDO::PARAM_STR);
    // $query-> bindParam(':password', $password, PDO::PARAM_STR);
    // $query-> execute();
    // $results=$query->fetchAll(PDO::FETCH_OBJ);
    // if($query->rowCount() > 0)
    // {
    // $_SESSION['login']=$_POST['Username'];
    // echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    // } else{
        
    //     echo "<script>alert('Invalid Details');</script>";
    
    // } 
    
    // }
?> -->