<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
error_reporting(0);
//Load Composer's autoloader
require 'vendor/autoload.php';

//get data from form
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$subject = $_POST['subject'];
// preparing mail content
$messagecontent ="Name = ". $name . "<br>Email = " . $email ."<br>Mobile Number = " . $subject . "<br>Message =" . $message;


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = 0;  
            $mail->isSMTP(); 
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true; 
            $mail->Username = 'smitaswaykar@gmail.com'; 
            $mail->Password = 'edak mwfn dnfj tnhk'; 
            $mail->SMTPSecure = 'tls'; 
            
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
            $mail->Port = 587; 
   // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    
    //Recipients
    $mail->setFrom($email, 'HousesOption Inquiry '. $name);
    $mail->addAddress($email, $name);    //Add a recipient
    $mail->addAddress('housesoption.enquiry@gmail.com');
    $mail->addAddress('smitaswaykar@gmail.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    
    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   // $mail->addAttachment('photo.jpeg', 'photo.jpeg');    //Optional name
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $name.' '.$subject;
    $mail->Body    = $messagecontent;
    
    if($mail->send()){ 
        echo "OK";
    } else{
        http_response_code(500);
        echo $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}