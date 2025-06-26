<?php
// Database credentials
$server = '127.0.0.1';
$dbname = 'task_tracker';
$username = 'root';
$password = '1234';

try {
    $dbh = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "You are alset..!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
