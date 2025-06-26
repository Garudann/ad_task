<?php include 'db.php'; // your DB connection file ?>
<?php session_start();?>
<?php include ('includes/sidebar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Task</title>
    <link rel="stylesheet" href="css/dasboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
        <style>
        .popup {
            display: none;
            position: fixed;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -30%);
            background-color: transperant;
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
<div class="main-content">
        <div class="header">
            <h1>Welcome, <?php echo isset($_SESSION['login']) ? ucfirst(htmlspecialchars($_SESSION['login'])) : 'Guest'; ?></h1>
            <div class="user">
                <i class="fas fa-user" style= "padding-right: 15px; font-size: 23px"></i>
                <span style= "font-size: 18px"><?php echo isset($_SESSION['login']) ? ucfirst(htmlspecialchars($_SESSION['login'])) : 'Guest'; ?></span>
            </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const taskStatusSelect = document.getElementById('task_status');
            const statusOptions = [
                { value: '0', text: 'Created' },
                { value: '1', text: 'In Progress' },
                { value: '2', text: 'On Hold' },
                { value: '3', text: 'Completed' },
                { value: '4', text: 'Cancelled' }
            ];

            statusOptions.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option.value;
                opt.textContent = option.text;
                taskStatusSelect.appendChild(opt);
            });
        });
    </script>
    <div id="popup" class="popup">
        <div class="popup-content">
            <p>Are you sure you want to logout?</p>
            <button id="goBtn">Yes</button>
            <button onclick="closePopup()">No</button>
        </div>
    </div>
    <h2 style="color: white;">Create New Task</h2>
    <form action="create_task.php" method="POST">
        <label>Task Created By:</label><br>
        <input type="text" name="task_created_by" class="author" 
       value="<?php echo isset($_SESSION['login']) ? htmlspecialchars($_SESSION['login']) : ''; ?>" 
       readonly><br><br>
       <label>Task Assigned To:</label><br>
       <select name="task_assigned_to" class="author" required>
            <option value="">Select User</option>
            <?php
                try {
                    $stmt = $dbh->prepare("SELECT Employee_name FROM users");
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . htmlspecialchars($row['Employee_name']) . '">' . htmlspecialchars($row['Employee_name']) . '</option>';
                    }
                } catch (PDOException $e) {
                    echo '<option disabled>Error: ' . $e->getMessage() . '</option>';
                }
            ?>
        </select><br><br>


        <label>Task Status:</label><br>
        <select name="task_status" id="task_status" class="author" required></select><br><br>


        <label>Description:</label><br>
        <textarea name="discription" rows="10" cols="200" id="dis" style="background-color: transparent; color: white;backdrop-filter: blur(4px);"></textarea><br><br>

        <input type="submit" name="submit" value="Create Task" class="submit-btn">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $task_created_by = $_POST['task_created_by'];
        $task_assigned_to = $_POST['task_assigned_to'];
        $task_status = $_POST['task_status'];
        $description = $_POST['discription'];

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
            window.location.href = 'logout.php';
        });
    </script>
</body>
</html>
