<?php 
include('../config/dbcon.php'); 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    


<?php
       //select login using POST method
       if (isset($_POST['login'])){ 

      $username = $_POST['username'];
      $password = $_POST['password'];

       }

       //Select login info from database
       $query = "SELECT * FROM `info` WHERE `username` = '$username' AND `password` = '$password'";
       
       $result = mysqli_query($con, $query);

       if(!$result){
         //Display error in proper way
        die("query Failed".mysqli_error($con));
     }
     else{ 
          //Selecting row
          $row = mysqli_num_rows($result);

          //Get username with the session variable and change the directory to home.php
          if($row == 1){
             $_SESSION['username'] = $username;
             header('location: ../home.php');
          }
          else{
            //Throw error message to the url and change the directory to index.php
            header('location: ../index.php?error_msg=Incorrect username or password'); 
          }

     }
?>


</body>
</html>