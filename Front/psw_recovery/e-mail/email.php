<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// this->http://localhost/Dist/Krusty_Work/Front/psw_recovery/token_page.html
// Sends the email.

header('Content-Type: text/html; charset=UTF-8');

function EmailScript() {
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
$mail->Subject = 'Prueba 123 Electro Shop.';

//   El TOKEN generado se manda al correo como un link 
// | Seccion donde aparecera el link con el random token |
    $mail->Body = 'Here is your link: (C:/xampp/htdocs/Dist/Krusty_Work/Front/psw_recovery/new_psw.html)';
// |                   (Provisional)                     |                       
// |      Token page tiene que heredarle el Token        |
// | --------------------------------------------------- |

// |        Variable para identificar el correo          |
         $mail->AddAddress('axelhumano@gmail.com');
// |                                                     |
// |                                                     |
// | --------------------------------------------------- |

if ($mail->Send() ) {
	echo "¡El correo a sido enviado!";	
}
else{
	echo "Error..!";
}

$mail->smtpClose();

}


EmailScript();
?>
      
 