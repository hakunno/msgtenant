<?php
include 'db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $message = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hidalgosapartment@gmail.com';
        $mail->Password = 'qtbkqxtbnuuvfjnq';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('hidalgosapartment@gmail.com');
        $mail->addAddress($email);                      

        $mail->isHTML(true); //messages from admin to tenant
        $mail->Subject = 'Feedback From admin';
        $mail->Body    = "<p>You have received a message from the admin:<br></p>
                          <p><strong>Hello! $full_name</p>
                          <p><strong>Message:</strong> $message</p>";
        $mail->send();
        $mail->clearAddresses();

        echo "
         <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
         <p hidden>idunno script above me need any text to work</p>
        <script>
            Swal.fire({
                title: 'Thank you!',
                text: 'Your message has been sent successfully!',
                icon: 'success'
            });
        </script>";
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
    }
}

?>
<form method="post" action="" data-aos="fade-up">
    <h3>Message a tenant</h3>
    <div class="mb-1">
        <label for="exampleInputEmail1" class="form-label">tenant email</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="full_name" class="form-control" id="exampleInputPassword1" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Message</label>
        <textarea class="form-control" name="message" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary d-flex justify-content-start">Send</button>
</form>
