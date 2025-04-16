<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dasboard.css">
    <!-- <link rel="stylesheet" href="css/createuser.css"> -->
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
        <div id="popup" class="popup">
            <div class="popup-content">
                <p>Are you sure? You want to Logout?</p>
                <button id="goBtn">Yes</button>
                <button onclick="closePopup()">No!</button>
            </div>
        </div>
        <div>
          <table style="border= none;">
            <form method="POST" action="change_password.php">
            <tr>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <label for="current_password">Current Password:</label>
                <input type="password" name="current_password" required>
            </tr>
            <tr>
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" required>
            </tr>
            <tr>
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" name="confirm_password" required>
            </tr>
                <button type="submit" name="change_password">Change Password</button>
            </form>
          </table>
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