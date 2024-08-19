<?php 
include('../config/dbcon.php'); 

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use PHPMailer\PHPMailer\OAuth;
//Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;



 function sendMail($email, $reset_token){
    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';

    // Load Composer's autoloader
    require '../vendor/autoload.php'; 

    //Create object of php mailer and passed true
    $mail = new PHPMailer(true);


    
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    
            // OAuth 2.0 settings
            
            //$email = 'noreply06969@gmail.com';
    
            $provider = new Google([
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
            ]);
    
            $mail->setOAuth(new OAuth([
                'provider' => $provider,
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'refreshToken' => $refreshToken,
                'userName' => $email,
            ]));
    
            // Recipients
            $mail->setFrom('noreply06969@gmail.com', '');
            $mail->addAddress($toEmail); // Add a recipient
    
            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
    
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    
    
    // Example usage
    sendEmail('recipient@example.com', 'Test Email Subject', 'This is the email body content.');
    



 }

if (isset($_POST['email'])){

    $email = $_POST['email'];
   

    $query = "SELECT * FROM `info` WHERE `email` = '$email'";
    $result = mysqli_query($con, $query);

   if($result){

    if(mysqli_num_rows($result) == 1){
            
       $reset_token = bin2hex(random_bytes(16));
       date_default_timezone_set('Asia/Dhaka');
       $date = date("Y-m-d");

       $query = "UPDATE `info` SET `resetToken`='$reset_token',`resetTokenExpire`='$date' WHERE `email` = '$email'";
       //$result = mysqli_query($con, $query);
       
       //email and reset token stored in sendmail function when the query run
       if(mysqli_query($con, $query) && sendMail($email, $reset_token)){
        
           //Throw error message to the url and change the directory to index.php
           header("location:../password_reset.php?error_msg5=password reset link sent to mail"); 
           exit();

       }

         }
         else{
            //Throw error message to the url and change the directory to index.php
            header('location: ../password_reset.php?error_msg3=Password reset failed'); 
            exit();
         }
   
   } else{
      //Throw error message to the url and change the directory to index.php
      header('location: ../index.php?error_msg4=Email not found'); 
      exit();

   }

}


?>

