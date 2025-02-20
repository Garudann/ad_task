<?php
// Database credentials
$server = '127.0.0.1'; // or the database server's IP address
$dbname = 'project1';
$username = 'root';
$password = '';

try {
    $dbh = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "You are alset..!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
