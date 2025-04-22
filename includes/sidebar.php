<html>
<div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li onclick="window.location.href='dashboard.php'"><i class="fas fa-home"></i> Home</li>
            <li onclick="window.location.href='#task_list.php'"><i class="fa fa-tasks"></i> Task Manager</li>
            <li onclick="window.location.href='analystics.php'"><i class="fas fa-chart-line"></i> Analytics</li>
            <li onclick="window.location.href='profile.php'"><i class="fas fa-user"></i> User Profile</li>
            <li onclick="window.location.href='settings.php'"><i class="fas fa-cog"></i> Settings</li>
            <?php if (isset($_SESSION['profile']) && $_SESSION['profile'] == 0): ?>
            <li class="dropdown">
                <div class="dropdown-toggle" onclick="toggleDropdown()">
                    <i class="fa fa-plus-square" aria-hidden="true"></i> Manage Users
                </div>
                <ul class="dropdown-menu" id="userDropdown">
                    <li onclick="window.location.href='createuser.php'">Add User</li>
                    <li onclick="window.location.href='usersmaster.php'">View Users</li>
                    <!-- Add more submenu items here -->
                </ul>
            </li>
<?php endif; ?>

            <li onclick="window.location.href='logout.php'"><i class="fas fa-sign-out-alt"></i>Logout</li>
        </ul>
</div>
<script>
function toggleDropdown() {
    var menu = document.getElementById("userDropdown");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}
</script>
    <style>
        .sidebar {
            width: 250px;
            background: transparent;
            color: black;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .sidebar:hover {
            width: 300px;
            backdrop-filter: blur(7px);
        }

        .sidebar h2 {
            text-align: center;
            margin: 20px 0;
            font-weight: 600;
            letter-spacing: 2px;
            font-size: 24px;
            color: white;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            border-left: 5px solid transparent;
            color: white;
        }

        .sidebar ul li:hover {
            background: transparent;
            border-left: 8px solid #02416b;
            padding-left: 40px;
            font-size: 23px;
            color: white;
            backdrop-filter: blur(50px);
        }

        .sidebar ul li i {
            margin-right: 10px;
            font-size: 18px;
        }
        body{
            padding:0px
        }
        .dropdown {
            position: relative;
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            list-style: none;
            padding: 0;
            margin: 5px 0 0 20px;
            background-color: transperant;
            border-radius: 8px;
            overflow: hidden;
            z-index: 1000;
        }

        .dropdown-menu li {
            padding: 10px;
            color: white;
            cursor: pointer;
        }

        .dropdown-menu li:hover {
            background-color: #2d476c;
        }

    </style>
</html>