<?php
session_start();
include_once 'php/config.php';

if (!isset($_SESSION['unique_id'])) {
    header('location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user ID from the session
    $user_id = $_SESSION['unique_id'];

    // Sanitize and validate the new password
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if (empty($new_password) || empty($confirm_password)) {
        $_SESSION['message'] = "Both fields are required.";
    } elseif ($new_password !== $confirm_password) {
        $_SESSION['message'] = "Passwords do not match.";
    } else {
        // Hash the new password before updating it in the database
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update the password in the database
        $update_query = "UPDATE users SET password = '$hashed_password' WHERE unique_id = '$user_id'";
        mysqli_query($conn, $update_query);

        $_SESSION['message'] = "Password updated successfully.";
    }

    header('location: users.php');
    exit();
} else {
    header('location: resetPassword.php');
    exit();
}
?>
