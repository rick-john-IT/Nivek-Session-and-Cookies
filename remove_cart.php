<?php
// Include the database connection file
include_once "include/conn.php";
session_start();

// Check if the productId is provided via POST request
if(isset($_POST['productId'])) {
    // Sanitize the productId to prevent SQL injection
    $productId = $_POST['productId'];

    // Prepare a SQL statement to delete the item from the cart_items table
    $stmt = $pdo->prepare("DELETE FROM cart_items WHERE id = ?");
    // Bind the productId parameter to the SQL statement
    $stmt->execute([$productId]);

    // Check if the deletion was successful
    if($stmt->rowCount() > 0) {
        // If deletion was successful, return a success message
        echo "Item removed successfully";
    } else {
        // If no rows were affected, return an error message
        echo "Error: Item not found or already removed";
    }
} else {
    // If productId is not provided, return an error message
    echo "Error: ProductId not provided";
}
?>
