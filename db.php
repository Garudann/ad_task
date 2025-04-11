<?php
// Database credentials
$server = '127.0.0.1';
$dbname = 'project1';
$username = 'root';
$password = '';

try {
    $dbh = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "You are alset..!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
