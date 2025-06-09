<?php
session_start();
include_once "include/conn.php";

if(isset($_POST['productId'], $_POST['quantity'])) {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];
    $clientId = $_SESSION['user_id']; // Retrieve client_id from session

    // Retrieve product details from the database
    $stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if($product) {
        // Insert cart item into the database with client_id
        $stmt = $pdo->prepare("INSERT INTO cart_items (client_id, product_name, price, quantity, image) VALUES (?, ?, ?, ?, ?)");
        $success = $stmt->execute([$clientId, $product['product_name'], $product['product_price'], $quantity, $product['product_img']]);
        
        if ($success) {
            // Assuming the product has been successfully added to the cart
            echo 'success';
        } else {
            echo 'error';
            // Log the error message
            error_log("Error adding product to cart: " . print_r($stmt->errorInfo(), true));
        }
    } else {
        echo 'error';
        // Log the error message
        error_log("Product with ID $productId not found.");
    }
} else {
    echo 'error';
    // Log the error message
    error_log("Invalid request parameters.");
}
?>
