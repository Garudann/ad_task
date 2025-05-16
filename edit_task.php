<?php include 'db.php'; ?>
<?php session_start(); ?>
<?php include ('includes/sidebar.php'); ?>

<?php
$_SESSION['LAST_ACTIVITY'] = time();

// Check if user is logged in
if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('Please log in first.');
        window.location.href = 'index.php';
    </script>";
    exit();
}
$task = null;
if (isset($_GET['id'])) {
    try {
        $stmt = $dbh->prepare("SELECT * FROM task_list WHERE task_id = :id");
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();
        $task = $stmt->fetch(PDO::FETCH_OBJ);
        
        if (!$task) {
            die("Task not found");
        }
    } catch (PDOException $e) {
        die("Error fetching task: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    try {
        $sql = "UPDATE task_list SET 
                task_assigned_to = :assigned_to,
                task_status = :status,
                discription = :description
                WHERE task_id = :id";
        
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $_POST['task_id'], PDO::PARAM_INT);
        $stmt->bindParam(':assigned_to', $_POST['task_assigned_to']);
        $stmt->bindParam(':status', $_POST['task_status'], PDO::PARAM_INT);
        $stmt->bindParam(':description', $_POST['discription']);
        
        if ($stmt->execute()) {
            echo "<script>alert('Task updated successfully!'); window.location.href='task_list.php';</script>";
            exit;
        }
    } catch (PDOException $e) {
        $error = "Error updating task: " . $e->getMessage();
        echo "<script>alert('$error');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
    <link rel="stylesheet" href="css/dasboard.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .popup {
            display: none;
            position: fixed;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -30%);
            background-color: rgba(255,255,255,0.1);
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
        .main-content {
            padding: 20px;
        }
        #discription {
            height: 150px;
            resize: vertical;
        }
        .submit-btn {
            background-color:rgb(206, 117, 218);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .submit-btn:hover {
            background-color:rgb(149, 69, 160);
        }
        label {
            color: white;
            margin-bottom: 5px;
            display: block;
        }
    </style>
</head>
<body>
<div class="main-content">
    <div class="header">
        <h1>Welcome, <?php echo isset($_SESSION['login']) ? ucfirst(htmlspecialchars($_SESSION['login'])) : 'Guest'; ?></h1>
        <div class="user">
            <i class="fas fa-user" style="padding-right: 15px; font-size: 23px"></i>
            <span style="font-size: 18px"><?php echo isset($_SESSION['login']) ? ucfirst(htmlspecialchars($_SESSION['login'])) : 'Guest'; ?></span>
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

            // Clear existing options
            taskStatusSelect.innerHTML = '';
            
            // Add new options
            statusOptions.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option.value;
                opt.textContent = option.text;
                taskStatusSelect.appendChild(opt);
            });
            
            // Enable the select after populating
            taskStatusSelect.disabled = false;
        });
    </script>

    <div id="popup" class="popup">
        <div class="popup-content">
            <p>Are you sure you want to logout?</p>
            <button id="goBtn">Yes</button>
            <button onclick="closePopup()">No</button>
        </div>
    </div>

    <h2 style="color: white; padding-bottom: 10px;">Edit Task <?= htmlspecialchars($task->task_id ?? '') ?></h2>

    <form method="POST">
        <input type="hidden" name="task_id" class="author" value="<?= htmlspecialchars($task->task_id ?? '') ?>">
        
        <label>Task Created By:</label>
        <input type="text" class="author" value="<?= htmlspecialchars($task->task_created_by ?? '') ?>" readonly>
        
        <label>Task Assigned To:</label>
        <select name="task_assigned_to" class="author" required>
            <option value="">Select User</option>
            <?php
                try {
                    $stmt = $dbh->prepare("SELECT Employee_name FROM users");
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $selected = ($task->task_assigned_to ?? '') == $row['Employee_name'] ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($row['Employee_name']) . '" ' . $selected . '>' 
                            . htmlspecialchars($row['Employee_name']) . '</option>';
                    }
                } catch (PDOException $e) {
                    echo '<option disabled>Error: ' . $e->getMessage() . '</option>';
                }
            ?>
        </select>
        
        <label>Task Status:</label>
        <select name="task_status" id="task_status" class="author" required disabled>
        </select>
        
        <label>Description:</label>
        <textarea name="discription" id="discription" class="author" required><?= htmlspecialchars($task->discription ?? '') ?></textarea>
        
        <input type="submit" name="update" value="Update Task" class="submit-btn">
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const currentStatus = "<?= $task->task_status ?? '' ?>";
                if (currentStatus) {
                    document.getElementById('task_status').value = currentStatus;
                }
            }, 100);
        });

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
</div>
</body>
</html>