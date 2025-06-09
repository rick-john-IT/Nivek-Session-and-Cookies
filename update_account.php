<?php
include_once "include/conn.php"; // Include the database connection file
session_start(); // Start the session

if(isset($_POST['update'])) {
    // Retrieve new values from the form
    $newUsername = $_POST['new_username'];
    $newEmail = $_POST['new_email'];
    $newPhone = $_POST['new_phone'];

    // Check if user_id is set in session
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
    } else {
        // Handle the case where user_id is not set
        // You may redirect the user to the login page or display an error message
        echo "User ID not found. Please log in again.";
        exit; // Stop execution
    }

    // Validate the data (You can add more validation here)
    if(!empty($newUsername) && !empty($newEmail) && !empty($newPhone)) {
        // Update the database
        $sql = "UPDATE users SET username=?, email=?, phone=? WHERE user_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$newUsername, $newEmail, $newPhone, $user_id]); // Assuming $user_id is the user's ID
        
        // Check if the update was successful
        if($stmt->rowCount() > 0) {
            // Update successful
            echo "Account updated successfully!";
            header("Location: index.php"); // Redirect to the account management page
        } else {
            // Update failed
            echo "Failed to update account. Please try again.";
        }
    } else {
        // Invalid data
        echo "Please fill in all fields.";
    }
}

?>
