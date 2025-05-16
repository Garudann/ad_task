<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dasboard.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <?php
    session_start();
        include ('includes/sidebar.php');
        $timeout_duration = 600;

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit();
        }
        $_SESSION['LAST_ACTIVITY'] = time();
        

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
        <div id="popup" class="popup">
            <div class="popup-content">
                <p>Are you sure? You want to Logout?</p>
                <button id="goBtn">Yes</button>
                <button onclick="closePopup()">No!</button>
            </div>
        </div>
        <div>
          <form action="ch_password.php" method="POST">
            <table style="border= none;">
              <tr>
                <th></th>
                <th></th>
              </tr>
              <tr>
                <td><label for="username">Enter your username:</label></td>
                <td><input type="text" id="username"autocomplete="off" name="username" required value="<?php echo isset($_SESSION['login']) ? htmlspecialchars($_SESSION['login']) : ''; ?>" 
       readonly></td>
              </tr>
              <tr>
                <td><label for="Password">Enter your Password:</label></td>
                <td><input type="Password" id="Password"autocomplete="off" name="password" placeholder="Enter your Password" required></td>
              </tr>
              <tr>
                <td><label for="confirm_Password">Please re-enter Password:</label></td>
                <td><input type="Password" id="confirm_Password"autocomplete="off" name="confirm_password" placeholder="Enter your Confirm password" required></td>
              </tr>
            </table>
            <button type="submit" class="submit-btn" name="submit">SUBMIT</button>
            <script>
              console.log ('Enterred Username :', <?$entered_username?>);
              console.log('Enterred Password:', <?$new_password?>);
              console.log('New Password:', <?$new_password?>);
              console.log('Confirm password:', <?$confirm_password?>);
            </script>
          </form>
        </div>

      </div>
<script>
  const userDiv = document.querySelector('.user');
  const popup = document.getElementById('popup');
  const goBtn = document.getElementById('goBtn');

  userDiv.addEventListener('click', () => {
    popup.style.display = 'block';
  });

  function closePopup() {
    popup.style.display = 'none';
  }

  goBtn.addEventListener('click', () => {
    window.location.href = 'index.php';
    alert("You have logged out succesfully!!");
  });
</script>
</body>
</html>