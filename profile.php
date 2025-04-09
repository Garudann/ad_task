<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dasboard.css">
</head>
<body>
    <?php
    include ('includes/sidebar.php');
        session_start();

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
            <h1>Welcome, <?php echo isset($_SESSION['login']) ? htmlspecialchars($_SESSION['login']) : 'Guest'; ?></h1>
            <div class="user">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User Avatar">
                <span><?php echo isset($_SESSION['login']) ? htmlspecialchars($_SESSION['login']) : 'Guest'; ?></span>
            </div>
        </div>
        </div>
</body>
</html>