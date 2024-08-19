<?php 

include('config/dbcon.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validation
    if ($newPassword !== $confirmPassword) {
        $error_msg = "Passwords do not match.";
    } else {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Assume $userId is retrieved from session or query string
        $userId = $_SESSION['user_id']; // Or however you are identifying the user

        // Update the password in the database
        $query = "UPDATE `info` SET `password` = '$hashedPassword' WHERE `id` = $userId";
        if (mysqli_query($con, $query)) {
            $success_msg = "Password updated successfully.";
        } else {
            $error_msg = "Failed to update password. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <link rel="stylesheet" href="style/update_password.css">
</head>
<body>
    <div class="update-container">
        <h2>Update Password</h2>
        <?php if (isset($error_msg)): ?>
            <p class="text-danger"><?php echo htmlspecialchars($error_msg); ?></p>
        <?php endif; ?>
        <?php if (isset($success_msg)): ?>
            <p class="text-success"><?php echo htmlspecialchars($success_msg); ?></p>
        <?php endif; ?>
        <form action="update_password.php" method="post">
            <div class="form-group">
                <label for="new_password">Create New Password</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn">Update Password</button>
        </form>
        <a href="index.php">Back to Login</a>
    </div>
</body>
</html>
