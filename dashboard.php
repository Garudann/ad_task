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
    ?>
    <div class="main-content">
        <div class="header">
            <h1>Welcome, Gokul K</h1>
            <div class="user">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User Avatar">
                <span>Gokul</span>
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
</body>
</html>