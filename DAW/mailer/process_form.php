<?php
require_once('class.phpmailer.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["nume"];
    $email = $_POST["email"];
    $message = $_POST["mesaj"];
    $to = "biancamaria11112222@gmail.com";
    $subject = "New Contact Form Submission";

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Set up SMTP
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "biancamaria11112222@gmail.com";
        $mail->Password = "llsi jscy zubu zjby";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;

        // Set email content
        $mail->setFrom($email, $email);  // Set both email address and name as the sender
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Send email
        $mail->send();
        header("location: /DAW/confirmare.html");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
