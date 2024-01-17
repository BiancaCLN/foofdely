<?php
require_once('mailer/class.phpmailer.php');
require_once('mailer/mail_config.php');

// În caz că vre-un rând depășește N caractere, trebuie să utilizăm
// wordwrap()

function send_mail($destinatar, $resetLink){
  $message = "<p>Pentru a seta parola, accesați următorul link: 
  <a href='$resetLink'>$resetLink</a></p>";
  //var_dump( $message);
  
  $mail = new PHPMailer(true); 
  //var_dump($mail);
  $mail->SMTPDebug = 2; // Nivel maxim de depanare

  $mail->IsSMTP();
  try {
 
    $mail->SMTPDebug  = 0;                     
    $mail->SMTPAuth   = true; 
  
    $nume='Firma de Transport';
  
    $mail->SMTPSecure = "ssl";                 
    $mail->Host       = "smtp.gmail.com";      
    $mail->Port       = 465;                   
    $mail->Username='biancamaria11112222@gmail.com';
    $mail->Password='llsi jscy zubu zjby';
    $mail->AddReplyTo('biancamaria11112222@gmail.com', 'Inregistrare');
    $mail->AddAddress($destinatar, $nume);
   
    $mail->SetFrom('biancamaria11112222@gmail.com', 'Inregistrare');
    $mail->Subject = 'Inregistrare Firma de Transport';
    $mail->AltBody = 'To view this post you need a compatible HTML viewer!'; 
    $mail->Body=$message;
    $mail->Send();
    echo "<h3>Mesaj Trimis cu Succes!</h3>\n";
  } catch (phpmailerException $e) {
    echo $e->errorMessage(); //error from PHPMailer
  } catch (Exception $e) {
    echo $e->getMessage(); //error from anything else!
  }
}
