<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

    function smtp_mailer($to,$subject,$msg){
        //Server settings
        $mail = new PHPMailer(true);
	    $mail->SMTPDebug = SMTP::DEBUG_OFF;                       //Enable verbose debug output
	    $mail->isSMTP();                                            //Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	    $mail->Username   = 'kp95889@gmail.com';                     //SMTP username
	    $mail->Password   = 'svsuwxbxdfavlnzi';                               //SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
	    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = 
        $mail->IsHTML(true);
		$mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
		$mail->Body = $msg;
		// $mail->Body =  html_entity_decode($msg);
		$mail->AddAddress($to);
        if(!$mail->Send()){
			return array('status'=>false, "message"=>$mail->ErrorInfo);
		}else{
			return array('status'=>true, "message"=>"Mail sent successfully.");
		}
    }
?>