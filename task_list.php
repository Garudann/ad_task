<?php
session_start();
include 'db.php';
include('includes/sidebar.php');
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

// Fetch all Tasks
$sql = "SELECT * FROM task_list";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Tasks</title>
    <link rel="stylesheet" href="css/dasboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background-color: #0b1a2f;
            font-family: 'Poppins', sans-serif;
            color: white;
        }
        .container {
            margin: 50px auto;
            width: 90%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: transperant;
            border: 2px solid #cc0000;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #39557a;
        }

        th {
            background-color:rgb(69, 108, 172);
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: transperant;
        }
        table, th, td {
        border: 1px solid rgb(151, 156, 164);
        backdrop-filter: blur(5px);
        }

        table {
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            border-collapse: collapse;
        }
        .add-user-btn {
            padding: 10px 20px;
            background-color:rgb(54, 102, 189);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s ease;
            text-decoration: none;
            text-align: center;
            height: 40px;
        }

        .add-user-btn:hover {
            background-color:rgb(0, 76, 255);
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
        <div>
            <h2 style="padding-bottom:10px;">Task List</h2>
            <table>
                <tr>
                    <th>Task ID</th>
                    <th>Author</th>
                    <th>Assigned to</th>
                    <th>Discription</th>
                    <th>Status</th>
                    <th>Update Status</th>
                    <th>Action</th>
                </tr>
                <?php if ($query->rowCount() > 0): ?>
                    <?php foreach ($results as $row): ?>
                        <?php
                        $statusLabels = [
                            0 => 'Created',
                            1 => 'In Progress',
                            2 => 'Review',
                            3 => 'Approved',
                            4 => 'Rejected',
                            5 => 'Completed'
                        ];
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($row->task_id) ?></td>
                            <td><?= ucfirst(htmlspecialchars($row->task_created_by)) ?></td>
                            <td><?= ucfirst(htmlspecialchars($row->task_assigned_to))?></td>
                            <td><?= htmlspecialchars($row->discription) ?></td>
                            <td><?= isset($statusLabels[$row->task_status]) ? $statusLabels[$row->task_status] : 'Unknown' ?></td>
                            <td>
                                <select class="status-select" data-task-id="<?= $row->task_id ?>">
                                    <?php foreach ($statusLabels as $value => $label): ?>
                                        <option value="<?= $value ?>" <?= $row->task_status == $value ? 'selected' : '' ?>>
                                            <?= $label ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><a href="edit_task.php?id=<?= $row->task_id ?>" class="btn-edit" style="color: white;"><i class="fas fa-edit"></i> Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No Records found.</td></tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <script>
    const searchInput = document.getElementById("searchInput");
    searchInput.addEventListener("keyup", function () {
        const filter = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll("table tr:not(:first-child)");

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });
</script>
<div id="popup" class="popup">
            <div class="popup-content">
                <p>Are you sure? You want to Logout?</p>
                <button id="goBtn">Yes</button>
                <button onclick="closePopup()">No!</button>
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
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to all status dropdowns
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            const taskId = this.getAttribute('data-task-id');
            const newStatus = this.value;
            
            if (taskId && confirm('Are you sure you want to update this task status?')) {
                updateTaskStatus(taskId, newStatus);
            }
        });
    });
    
    async function updateTaskStatus(taskId, status) {
        try {
            const response = await fetch('update_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `task_id=${taskId}&task_status=${status}`
            });
            
            const result = await response.text();
            
            if (response.ok) {
                alert('Status updated successfully!');
                // Optional: Update just the status display instead of full reload
                location.reload();
            } else {
                alert('Error updating status: ' + result);
                // Revert the dropdown to previous value
                const select = document.querySelector(`.status-select[data-task-id="${taskId}"]`);
                select.value = select.getAttribute('data-previous-value');
            }
        } catch (error) {
            alert('Network error: ' + error.message);
        }
    }
    
    // Store initial values in case we need to revert
    document.querySelectorAll('.status-select').forEach(select => {
        select.setAttribute('data-previous-value', select.value);
    });
});
</script>
</body>
</html>