<?php include('config/dbcon.php');  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login here</title>
    <link rel="stylesheet" href="style/style.css">

</head>
<body>
    
<?php 

if (isset($_GET['error_msg'])){   // extract the message from url

    echo "<h4 class='text-danger'>" . htmlspecialchars($_GET['error_msg']) . "</h4>";

  }

?>

      <div class="login-container">
    <h2>wellcome back</h2>
    <form action="process/login_process.php" method="post">

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" name= "login" class="btn">Login</button>
    </form>
</div>



</body>
</html>