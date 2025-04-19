<?php
session_start();
include('includes/sidebar.php');

// Auto logout after 10 minutes of inactivity
$timeout_duration = 600;

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: index.php?timeout=1");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();

// Check if user is logged in
if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('Please log in first.');
        window.location.href = 'index.php';
    </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dasboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .popup {
            display: none;
            position: fixed;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -30%);
            background-color: white;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
            z-index: 999;
            padding: 20px;
            text-align: center;
        }
        .popup-content p {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 15px;
        }
        .popup-content button {
            padding: 10px 20px;
            border-radius: 10px;
            margin: 0 10px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        #goBtn {
            background-color: #dc3545;
            color: white;
        }
        .popup-content button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="header">
            <h1>Welcome, <?php echo ucfirst(htmlspecialchars($_SESSION['login'])); ?></h1>
            <div class="user" style="cursor: pointer;">
                <i class="fas fa-user" style="padding-right: 15px; font-size: 23px"></i>
                <span style="font-size: 18px"><?php echo ucfirst(htmlspecialchars($_SESSION['login'])); ?></span>
            </div>
        </div>

        <div class="cards">
            <div class="card">
                <h3>Your tasks</h3>
                <p>Ongoing tasks: 15</p>
            </div>
            <div class="card">
                <h3>Completed task</h3>
                <p>Completed tasks: 95</p>
            </div>
            <div class="card">
                <h3>Incompleted task</h3>
                <p>Pending tasks: 24</p>
            </div>
        </div>

        <!-- Logout Popup -->
        <div id="popup" class="popup">
            <div class="popup-content">
                <p>Are you sure you want to logout?</p>
                <button id="goBtn">Yes</button>
                <button onclick="closePopup()">No</button>
            </div>
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
            window.location.href = 'logout.php'; // go to logout page to destroy session
        });
    </script>
</body>
</html>
