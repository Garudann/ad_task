<?php
session_start();
include('db.php'); // Include the database connection

if(isset($_POST['signin']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT username, password FROM tblusers WHERE username = :username";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->execute();
    
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if($result && password_verify($password, $result['password']))
    {
        $_SESSION['login'] = $username;
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    }
    else
    {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>
<script>
    console.log('Username: ' + '<?php echo $username; ?>');
    console.log('Password: ' + '<?php echo $password; ?>');
</script>
