<?php
// this->http://localhost/Dist/Krusty_Work/Front/psw_recovery/e-mail/email.php
// Sends the email.

header('Content-Type: text/html; charset=UTF-8');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/Dist/Krusty_Work/Front/psw_recovery/e-mail/PHPMailer/src/Exception.php';
require 'C:/xampp/htdocs/Dist/Krusty_Work/Front/psw_recovery/e-mail/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/Dist/Krusty_Work/Front/psw_recovery/e-mail/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->isHTML();
$mail->Username = 'electro.shop.dist@gmail.com';
$mail->Password = '2021_shop';
$mail->SetFrom('not-reply@electroshop.com');
$mail->Subject = 'Electro Shop.';


// | Seccion donde aparecera el link con el random token |
            $mail->Body = 'Here is your link:';
// |                                                     |
// |      Token page tiene que heredarle el Token        |
// | --------------------------------------------------- |

// |        Variable para identificar el correo          |
         $mail->AddAddress('axelhumano@gmail.com');
// |                                                     |
// |                                                     |
// | --------------------------------------------------- |


$mail->Send();

?>
      
 