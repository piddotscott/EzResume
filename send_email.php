<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user data and file
    $companyName = $_POST['companyName'];
    $recipientEmail = $_POST['recipientEmail'];
    $resumeFile = $_FILES['resume']['tmp_name'];
    $coverLetter = file_get_contents('cover_letter.txt');

    // Initialize PHPMailer
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = 'smtp.example.com'; // Configure your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'your_email@example.com';
    $mail->Password = 'your_email_password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('your_email@example.com', 'Your Name');
    $mail->addAddress($recipientEmail, 'Company Name');
    $mail->addAttachment($resumeFile);
    $mail->Subject = 'Application for Internship at ' . $companyName;
    $mail->Body = $coverLetter;

    // Send the email
    if ($mail->send()) {
        echo 'Email sent successfully.';
    } else {
        echo 'Email could not be sent.';
    }
} else {
    // Handle GET requests or other HTTP methods
    echo 'Invalid request';
}
?>
