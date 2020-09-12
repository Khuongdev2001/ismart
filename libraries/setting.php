<?php
// Các biến áp dụng bên trong 3 use
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
function send_email($name_sender, $mail_sender, $name_receiver, $mail_receiver, $subject, $content, $option = array())
{
    $Parameter = config();
    $mail = new PHPMailer(true);
    $mail->CharSet  = 'UTF-8'; // Tiếng Việt
    try {
        //Server settings
        $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER; // inra thông báo giá trị 0 sẽ tắt đi
        $mail->isSMTP(); // Send using SMTP
        $mail->Host       = $Parameter['host']; // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $Parameter['username'];                     // SMTP Tài khoản gmail
        $mail->Password   = $Parameter['password'];                               // SMTP Mật khẩu gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = $Parameter['port'];                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom($mail_sender, $name_sender); // Tên người gửi
        $mail->addAddress($mail_receiver, $name_receiver);     // Tên người nhận
        if (isset($option['more_send'])) {
            foreach ($option['more_send'] as $key => $value) {
                $mail->addAddress($value, $key);               // Name is optional
            }
        }
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        //send file
        if (isset($option['file'])) {
            $mail->addAttachment($option['file']);         // Thêm file
        }
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // File hiện tại,tên đổi
        // Content
        $mail->isHTML(true);                                  // active html content
        $mail->Subject = $subject;      // chủ đề
        $mail->Body    = $content; // Nội dung
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Gửi thất bại mã lỗi: {$mail->ErrorInfo}";
    }
}
