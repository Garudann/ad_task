<?php
session_start();  // This was missing - needed for session verification
include 'db.php';

// Debugging headers - remove in production
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain");

// Verify request method FIRST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST', true, 405);
    exit("Only POST requests allowed");
}

// Then check authentication
if (!isset($_SESSION['login'])) {
    http_response_code(401);
    exit("Unauthorized access");
}

// Get raw POST data
$input = file_get_contents('php://input');
parse_str($input, $_POST);

// Validate inputs
$task_id = filter_input(INPUT_POST, 'task_id', FILTER_VALIDATE_INT);
$task_status = filter_input(INPUT_POST, 'task_status', FILTER_VALIDATE_INT);

if (!$task_id || !$task_status) {
    http_response_code(400);
    exit("Invalid input parameters");
}

try {
    $stmt = $dbh->prepare("UPDATE task_list SET task_status = :status WHERE task_id = :id");
    $stmt->bindParam(':status', $task_status, PDO::PARAM_INT);
    $stmt->bindParam(':id', $task_id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        http_response_code(200);
        echo "Status updated successfully";
    } else {
        http_response_code(500);
        echo "Update failed - no rows affected";
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo "Database error: " . $e->getMessage();
}
?>