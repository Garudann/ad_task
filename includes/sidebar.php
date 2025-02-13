<html>
<div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li onclick="window.location.href='Dashboard.html'"><i class="fas fa-home"></i> Home</li>
            <li onclick="window.location.href='analystics.php'"><i class="fas fa-chart-line"></i> Analytics</li>
            <li onclick="window.location.href='profile.html'"><i class="fas fa-user"></i> User Profile</li>
            <li onclick="window.location.href='Settings.html'"><i class="fas fa-cog"></i> Settings</li>
            <li onclick="window.location.href='index.php'"><i class="fas fa-sign-out-alt"></i> Logout</li>
        </ul>
    </div>
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
            backdrop-filter: blur(5px);
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
    </style>
</html>