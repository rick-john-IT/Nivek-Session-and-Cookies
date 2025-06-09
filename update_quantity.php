<?php
// Include the database connection file
session_start();
include_once "include/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the itemId and quantity parameters are set
    if (isset($_POST["itemId"]) && isset($_POST["quantity"])) {
        // Sanitize and validate the input
        $itemId = filter_var($_POST["itemId"], FILTER_SANITIZE_NUMBER_INT);
        $quantity = filter_var($_POST["quantity"], FILTER_SANITIZE_NUMBER_INT);

        // Fetch the product details from the cart
        $stmt = $pdo->prepare("SELECT price FROM cart_items WHERE id = :itemId");
        $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            // Convert the fetched product price to a float value
            $productPrice = floatval($row['price']);

            // Update the quantity of the item in the cart_items table
            $stmt = $pdo->prepare("UPDATE cart_items SET quantity = :quantity WHERE id = :itemId");
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);

            // Execute the statement
            if ($stmt->execute()) {
                // Calculate the updated subtotal
                $subtotal = $productPrice * $quantity;

                // Return the calculated subtotal
                echo number_format($subtotal, 2, '.', ''); // Subtotal
            } else {
                // If the update fails, return an error message
                echo "Error updating quantity.";
            }
        } else {
            // If the item details could not be fetched, return an error message
            echo "Error fetching item details.";
        }
    } else {
        // If itemId or quantity parameters are not set, return an error message
        echo "Invalid parameters.";
    }
} else {
    // If the request method is not POST, return an error message
    echo "Invalid request method.";
}
?>
