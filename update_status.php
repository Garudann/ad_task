<?php
include 'db.php';

if (!isset($_SESSION['login'])) {
    die("Unauthorized access");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $task_id = $_POST['task_id'];
        $task_status = $_POST['task_status'];
        
        $stmt = $dbh->prepare("UPDATE task_list SET task_status = :status WHERE task_id = :id");
        $stmt->bindParam(':status', $task_status, PDO::PARAM_INT);
        $stmt->bindParam(':id', $task_id, PDO::PARAM_INT);
        $stmt->execute();
        
        echo "Status updated successfully";
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Database error: " . $e->getMessage();
    }
} else {
    http_response_code(405);
    echo "Method not allowed";
}
?>