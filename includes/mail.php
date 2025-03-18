<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php'; 

function sendPasswordResetEmail($toEmail, $resetToken) {
    $mail = new PHPMailer(true);

    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'groupfmak@gmail.com'; 
        $mail->Password = 'xjbd zuoa abjz ueov'; // Your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; 

        // Email Headers
        $mail->setFrom('groupfmak@gmail.com', 'Inno Tech');
        $mail->addAddress($toEmail);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "Password Reset Request";
        $mail->Body    = "<p>Your password reset token is: <strong>$resetToken</strong></p>
                          <p>This token will expire in 1 hour. Please enter it in the form to reset your password.</p>";

        // Send email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
