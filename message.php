<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'machariachris90@gmail.com'; // Your email
        $mail->Password = 'YOUR_APP_PASSWORD'; // Use an app password, not your real password!
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Content
        $mail->setFrom($email, $name);
        $mail->addAddress('machariachris90@gmail.com'); // Your inbox
        $mail->Subject = $subject;
        $mail->Body    = "Name: $name\nEmail: $email\n\n$message";

        // Send Email
        $mail->send();
        echo "<script>alert('Message sent successfully!');window.location.href='index.html';</script>";
    } catch (\Exception $e) {
        echo "<script>alert('Message could not be sent.');window.history.back();</script>";
    }
}
?>