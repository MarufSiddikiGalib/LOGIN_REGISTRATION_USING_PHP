<?php 
include('../config/dbcon.php'); 



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
       
       if(mysqli_query($con, $query)){
        
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

