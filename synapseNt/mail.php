<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendEmail($to,$subject,$body){
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try{
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'saadelkelkha@gmail.com';                     //SMTP username
        $mail->Password   = 'ozhn gjaa bxsw avhk';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->setFrom('saadelkelkha@gmail.com','Synapse');
        $mail->addAddress($to);             
        
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        
            
        $mail->send();
        echo 'mail is sent';
        return true;
    }
    catch(Exception $e){
        echo $mail->ErrorInfo;
    }
}





    
?>