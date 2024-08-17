<?php include('../config/dbcon.php');  ?>

<?php 

   //select resister using POST method
   if (isset($_POST['resister'])){

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $password = $_POST['password'];

        // Insert the user into the database
        $query = "INSERT INTO `info` (`first_name`, `last_name`, `username` , `mobile_number` , `email` , `dob` , `Password`) VALUES ('$firstname', '$lastname', '$username' , '$mobile' , '$email' , '$dob' , '$password ')";

        $result = mysqli_query($con, $query);

        if(!$result){
            die ("Query failed" . mysqli_error($con));
        }
        
        else{
            //Throw success message to the url and open to index.php
            header("location: ../index.php?success_msg=Resistration complete. please login" );
        }

   }


?>