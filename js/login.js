document.getElementById('login_form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const username = document.getElementById('Username').value;
    const password = document.getElementById('password').value;
  
    if (username === 'sindhu' && password === 'Gokul#123') {
        document.getElementById('loginStatus').textContent = 'Login successful!';
        document.getElementById('loginStatus').style.color = 'green';
        //if logged int succesfully, it will redirect to this page.
        window.location.href='dashboard.php'
    } else {
        document.getElementById('loginStatus').textContent = 'Invalid username or password.';
        document.getElementById('loginStatus').style.color = 'red';
    }
  });


//   <!-- <?php
// session_start();
// if(isset($_POST['signin']))
// {
// $usenamr=$_POST['username'];
// $password=md5($_POST['password']);
// $sql ="SELECT username,Password FROM tblusers WHERE username=:username and Password=:password";
// $query= $dbh -> prepare($sql);
// $query-> bindParam(':username', $username, PDO::PARAM_STR);
// $query-> bindParam(':password', $password, PDO::PARAM_STR);
// $query-> execute();
// $results=$query->fetchAll(PDO::FETCH_OBJ);
// if($query->rowCount() > 0)
// {
// $_SESSION['login']=$_POST['username'];
// echo "<script type='text/javascript'> document.location = 'package-list.php'; </script>";
// } else{
	
// 	echo "<script>alert('Invalid Details');</script>";

// }
// } -->