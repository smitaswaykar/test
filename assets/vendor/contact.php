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
$messagecontent ="Name = ". $name . "<br>Email = " . $email ."<br>Subject = " . $subject . "<br>Message =" . $message;


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = 0;  
            $mail->isSMTP(); 
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true; 
            $mail->Username = 'dhanashree.tikone@gmail.com'; 
            $mail->Password = 'mrjf eujr nofq qjjk'; 
            $mail->SMTPSecure = 'tls'; 
            $mail->Port = 587; 
   // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    
    //Recipients
    $mail->setFrom('dhanashree.tikone@gmail.com', 'Website Visator Capital');
    $mail->addAddress($email, $name);    //Add a recipient
    $mail->addAddress('dhanashree.tikone@gmail.com');
    $mail->addAddress('smitaswaykar@gmail.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    
    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   // $mail->addAttachment('photo.jpeg', 'photo.jpeg');    //Optional name
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $messagecontent;
    
    if($mail->send()){
        echo 'ok';
    } else{
        echo "Email sending Failed";
    }
} catch (Exception $e) {
   // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}