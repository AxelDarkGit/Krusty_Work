<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_ALL);
ini_set('display_errors', 1);
// this->http://localhost/Dist/Krusty_Work/Front/psw_recovery/token_page.html
// Sends the email.

header('Content-Type: text/html; charset=UTF-8');

function EmailScript() {
require 'C:/xampp/htdocs/Dist/Krusty_Work/Front/psw_recovery/e-mail/PHPMailer/src/Exception.php';
require 'C:/xampp/htdocs/Dist/Krusty_Work/Front/psw_recovery/e-mail/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/Dist/Krusty_Work/Front/psw_recovery/e-mail/PHPMailer/src/SMTP.php';

/*
if($_POST["Submit"]=="Submit"){

    $idcode=$_POST['idcode'];
    $_SESSION['idcode'] = $post['idcode'];
   
    $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
   
    $stmt = $pdo->prepare($sql);
   
    $stmt->bindValue(':id_usuario ', $idcode);
   
   
    $stmt->execute();
   
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
   
   
   
    if(!empty($result)){
    $email = $result['usuario_correo'];
    //echo $email;
   
   
    $token = generateToken();
    //echo $token;
   
   
    $sql = "UPDATE reinicio_contra SET reinicio_token = :reinicio_token WHERE usuario_correo = :usuario_correo";
    $stmt = $pdo->prepare($sql);
   
    $stmt->execute(array(
    ':reinicio_token' => $token,
    ':usuario_correo' => $email
    ));
   
   
    $result1 = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!empty($result)){
   
    {
   // $email and $message are the data that is being
   // posted to this page from our html contact form
   $email = $_REQUEST['usuario_correo'] ;
*/


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
    $mail->Body = "Here is your link: (http://localhost/Dist/Krusty_Work/Front/psw_recovery/new_psw.html?token=".$_GET["token"]."&email=".$_GET["email"].")";
// |                   (Provisional)                     |                       
// |      Token page tiene que heredarle el Token        |
// | --------------------------------------------------- |

// |        Variable para identificar el correo          |
         $mail->AddAddress($_GET["email"]);
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
      
 