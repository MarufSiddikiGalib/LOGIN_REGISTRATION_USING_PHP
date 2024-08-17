<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $firstname = clean_input($_POST["firstname"]);
    $lastname = clean_input($_POST["lastname"]);
    $username = clean_input($_POST["username"]);
    $mobile = clean_input($_POST["mobile"]);
    $email = clean_input($_POST["email"]);
    $dob = clean_input($_POST["dob"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Initialize an array to hold errors
    $errors = [];

    // Validate first and last names
    if (empty($firstname)) {
        $errors[] = "First name is required.";
    }

    if (empty($lastname)) {
        $errors[] = "Last name is required.";
    }

    // Validate username length (5-15 characters)
    if (strlen($username) < 5 || strlen($username) > 15) {
        $errors[] = "Username must be between 5 and 15 characters.";
    }

    // Validate mobile number (11-digit number)
    if (!preg_match("/^[0-9]{11}$/", $mobile)) {
        $errors[] = "Mobile number must be an 11-digit number.";
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate date of birth
    if (empty($dob)) {
        $errors[] = "Date of birth is required.";
    }

    // Validate password strength
    $password_regex = "/^(?=.*[A-Z])(?=.*[!@#$&*]).{8,}$/";
    if (!preg_match($password_regex, $password)) {
        $errors[] = "Password must be at least 8 characters long, include at least one uppercase letter, and one special character.";
    }

    // Check if password and confirm_password match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        //Here we can hash the password before storing it


        //Change the directory to insert.php
        header('location:insert.php');

        
        
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
}

// Function to sanitize input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>