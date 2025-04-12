<?php
session_start();
include 'db.php';
include('includes/sidebar.php');
if (!isset($_SESSION['login'])) {
    // User is not logged in, redirect to login page
    echo "<script>
        alert('Please log in first.');
        window.location.href = 'index.php';
    </script>";
    exit();
}

// Fetch all users
$sql = "SELECT * FROM users";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Users</title>
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
            border: 2px solid #cc0000; /* 🔥 This adds the outside border */
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #39557a; /* 👈 Cell borders */
        }

        th {
            background-color: #1c2e4a;
            color: #cc0000;
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

        <div class="container">
        <input type="text" id="searchInput" placeholder="Search by name, code, username..." style="
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #39557a;
            background-color: #112240;
            color: white;
            font-size: 16px;
        ">
            <h2>All Users</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Employee Name</th>
                    <th>Employee Code</th>
                    <th>Username</th>
                    <th>Profile</th>
                </tr>
                <?php if ($query->rowCount() > 0): ?>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row->ID) ?></td>
                            <td><?= ucfirst(htmlspecialchars($row->Employee_name)) ?></td>
                            <td><?= htmlspecialchars($row->EMP_code) ?></td>
                            <td><?= htmlspecialchars($row->Username) ?></td>
                            <td><?= $row->profile == 0 ? 'Admin' : 'User' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No users found.</td></tr>
                <?php endif; ?>
            </table>
        </div>
        <a href="createuser.php" class="add-user-btn">Create User</a>
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

</body>
</html>
