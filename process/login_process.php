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

       if (isset($_POST['login'])){ //select login

      $username = $_POST['username'];
      $password = $_POST['password'];

       }

       
       $query = "SELECT * FROM `info` WHERE `username` = '$username' AND `password` = '$password'";
       
       $result = mysqli_query($con, $query);

       if(!$result){
        die("query Failed".mysqli_error($con)); //display error in proper way
     }
     else{
          $row = mysqli_num_rows($result);

          if($row == 1){
             $_SESSION['username'] = $username;
             header('location: ../home.php');
          }
          else{
            header('location: ../index.php?error_msg=Incorrect username or password'); //trow the mesaage from url
          }

     }
?>


</body>
</html>