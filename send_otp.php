<?php
session_start();
require 'vendor/autoload.php'; // include PHPMailer
require 'db.php'; // your DB connection

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['send_otp'])) {
    $username = $_POST['username'];

    // Step 1: Get email from DB
    $stmt = $conn->prepare("SELECT email FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || empty($user['email'])) {
        echo "<script>alert('User not found or email missing'); window.history.back();</script>";
        exit();
    }

    $email = $user['email'];

    // Step 2: Generate OTP
    $otp = rand(100000, 999999);
    $_SESSION['sent_otp'] = $otp;
    $_SESSION['otp_user'] = $username;

    // Step 3: Send OTP via PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 2; // or use 3 for more info
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ad_task@gmail.com';
        $mail->Password = 'mfsx cmfh ghom zyht'; // not your real Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('ad_task@gmail.com', 'AD Task App');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "<h3>Hello $username,</h3><p>Your OTP code is <b>$otp</b>.</p>";

        $mail->send();
        echo "<script>alert('OTP sent to $email'); window.location.href = 'verify_otp.php';</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
