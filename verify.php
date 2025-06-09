<?php
session_start(); // Start the session
include_once "include/conn.php"; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"]; // Retrieve the email from the form
    $password = $_POST["password"];

    // Query to check if the user exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if (!$user) {
        // User does not exist
        $_SESSION['email_error'] = "Email not found"; // Set error message
        header("Location: account.php"); // Redirect to account.php
        exit();
    } else {
        // User exists, verify password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set the session and redirect
            $_SESSION['email'] = $email; // Set the session variable
            
            // Store user_id in session
            $_SESSION['user_id'] = $user['user_id']; // Assuming 'user_id' is the column name in your users table
            
            header("Location: index.php");
            exit();
        } else {
            // Password is incorrect
            $_SESSION['password_error'] = "Incorrect password"; // Set error message
            header("Location: account.php"); // Redirect to account.php
            exit();
        }
    }
}
?>
