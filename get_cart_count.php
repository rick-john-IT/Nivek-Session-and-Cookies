<?php
// Include the database connection file
include_once "include/conn.php";

// Start the session (if not started already)
session_start();

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // Fetch cart items count from the database
    $userId = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM cart_items WHERE client_id = ?");
    $stmt->execute([$userId]);
    $count = $stmt->fetchColumn();

    // Return the count
    echo $count;
} else {
    // User is not logged in, return 0
    echo 0;
}
?>
