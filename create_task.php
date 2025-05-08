<?php include ('includes/sidebar.php'); ?>
<?php include 'db.php'; // your DB connection file ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Task</title>
    <link rel="stylesheet" href="css/dasboard.css">
    <!-- <link rel="stylesheet" href="css/createuser.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="main-content">
        <div class="header">
            <h1>Welcome, <?php echo isset($_SESSION['login']) ? ucfirst(htmlspecialchars($_SESSION['login'])) : 'Guest'; ?></h1>
            <div class="user">
                <i class="fas fa-user" style= "padding-right: 15px; font-size: 23px"></i>
                <span style= "font-size: 18px"><?php echo isset($_SESSION['login']) ? ucfirst(htmlspecialchars($_SESSION['login'])) : 'Guest'; ?></span>
            </div>
    </div>
    <h2>Create New Task</h2>
    <form action="create_task.php" method="POST">
        <label>Task Created By:</label><br>
        <input type="text" name="task_created_by" required><br><br>

        <label>Task Assigned To:</label><br>
        <input type="text" name="task_assigned_to" required><br><br>

        <label>Task Status:</label><br>
        <input type="number" name="task_status" min="0" max="9" required><br><br>

        <label>Description:</label><br>
        <textarea name="discription" rows="4" cols="50"></textarea><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select><br><br>

        <input type="submit" name="submit" value="Create Task">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $task_created_by = $_POST['task_created_by'];
        $task_assigned_to = $_POST['task_assigned_to'];
        $task_status = $_POST['task_status'];
        $description = $_POST['discription'];
        $status = $_POST['status'];

        $sql = "INSERT INTO tasks (task_created_by, task_assigned_to, task_status, discription, status)
                VALUES ('$task_created_by', '$task_assigned_to', '$task_status', '$description', '$status')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            echo "<p>Task created successfully. Task ID is: <strong>$last_id</strong></p>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>
