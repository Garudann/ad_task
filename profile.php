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
          <form action="#">
            <table style="border= none;">
              <tr>
                <th></th>
                <th></th>
              </tr>
              <tr>
                <td><label for="email">Enter your Email:</label></td>
                <td><input type="text" id="email"autocomplete="off" placeholder="Enter your Email" required></td>
              </tr>
              <tr>
                <td><label for="Password">Enter your Password:</label></td>
                <td><input type="Password" id="Password"autocomplete="off" placeholder="Enter your Password" required></td>
              </tr>
              <tr>
                <td><label for="confirm_Password">Please re-enter Password:</label></td>
                <td><input type="Password" id="confirm_Password"autocomplete="off" placeholder="Enter your Confirm password" required></td>
              </tr>
            </table>
            <button type="submit" class="submit-btn" name="submit">SUBMIT</button>
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