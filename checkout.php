<?php
// Include the necessary files and initialize the cartItems variable
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "include/conn.php";

// Initialize $cartItems as an empty array
$cartItems = [];

// Check if 'cart_data' is set in the URL parameter
if (isset($_GET['cart_data'])) {
    // Unserialize the cart data and assign it to $cartItems
    $cartItems = unserialize(urldecode($_GET['cart_data']));
} else {
    // Handle the case where cart data is not available
    echo "Error: Cart data not found.";
    exit();
}

// Function to calculate the subtotal
function calculateSubtotal($cartItems) {
    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    return $subtotal;
}

// Initialize address and phone variables
$address = "";
$phone = "";

// Check if the user is logged in (you need to have stored the user ID in session)
if (isset($_SESSION['user_id'])) {
    // Prepare and execute query to fetch user details
    $stmt = $pdo->prepare("SELECT username, address, phone FROM users WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    // Assign username, address, and phone from the user details
    $username = $userDetails['username'];
    $address = $userDetails['address'];
    $phone = $userDetails['phone'];

    // Store user details in session variables
    $_SESSION['username'] = $username;
    $_SESSION['address'] = $address;
    $_SESSION['phone'] = $phone;
}

// Function to insert an order into the database and clear cart items
function insertOrder($pdo, $username, $address, $phone, $cartItems) {
    // Prepare the SQL statement to insert the order
    $stmtOrder = $pdo->prepare("INSERT INTO order_list (username, address, phone, date_ordered, payment_status, total, payment_method, order_status, date_created, date_updated) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Prepare the SQL statement to remove all cart items
    $stmtDelete = $pdo->prepare("DELETE FROM cart_items");

    // Get the current date and time
    $dateOrdered = date('Y-m-d H:i:s');
    $dateCreated = $dateOrdered;
    $dateUpdated = $dateOrdered;

    // Calculate subtotal
    $subtotal = calculateSubtotal($cartItems);

    // Insert the order into the database
    $paymentStatus = 'pending'; // Set payment status to pending initially
    $paymentMethod = 'Unknown'; // You can update this based on the selected payment method
    $orderStatus = 'processing'; // Set order status to processing initially
    $stmtOrder->execute([$username, $address, $phone, $dateOrdered, $paymentStatus, $subtotal, $paymentMethod, $orderStatus, $dateCreated, $dateUpdated]);

    // Clear cart items from the session
    unset($_SESSION['cart_data']);

    // Delete all cart items from the database
    $stmtDelete->execute();

    // Redirect to another page after placing the order
    header("Location: cart.php");
    exit(); // Exit after sending the header
}

// Check if the form is submitted to place the order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    // Insert the order into the database
    insertOrder($pdo, $username, $address, $phone, $cartItems);
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="checkout.css">
    <style>
        /* Style adjustments for better layout */
        .order-table {
            max-height: 300px; /* Adjust the height as needed */
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <?php include 'include/navbar.php'; ?>

    <div class="container">
        <div class="title">
            <h2>Checkout</h2>
        </div>
        <div class="d-flex">
            <form method="post">
                <?php if (isset($_SESSION['user_id'])): ?>
                <label>
                    <span>Username</span>
                    <input type="text" name="username" placeholder="Your username" value="<?php echo $_SESSION['username']; ?>" readonly>
                </label>
                <?php endif; ?>
                <label>
                    <span>Address <span class="required">*</span></span>
                    <input type="text" name="address" placeholder="House number and street name" required value="<?php echo $address; ?>"readonly>
                </label>
                <label>
                    <span>Phone <span class="required">*</span></span>
                    <input type="tel" name="city" required value="<?php echo $phone; ?>"readonly> 
                </label>
            </form>
            <div class="Yorder">
                <table class="order-table">
                    <tr>
                        <th colspan="2">Your order</th>
                    </tr>
                    <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td><?php echo $item['product_name']; ?> x <?php echo $item['quantity']; ?> (Qty)</td>
                        <td>₱ <?php echo $item['price']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <!-- Display subtotal -->
                    <tr>
                        <td>Subtotal</td>
                        <td>₱ <?php echo calculateSubtotal($cartItems); ?></td>
                    </tr>
                    <!-- Hardcoded shipping fee -->
                    <tr>
                        <td>Shipping</td>
                        <td>Free shipping</td>
                    </tr>
                </table><br>
                <!-- Your payment options -->
                <div>
                    <input type="radio" name="payment" value="cod"> Cash on Delivery
                </div>
                <div>
                    <input type="radio" name="payment" value="gcash"> Gcash <span>
                    <img src="https://safehouse.com.ph/images/pay-with-gcash-v2.png" alt="" width="50">
                    </span>
                </div>
                <form method="post">
                <button type="submit" name="place_order">Place Order</button>
                </form>
            </div><!-- Yorder -->
        </div>
    </div>

    <?php include 'include/footer.php'; ?>

    <script>
        // You can remove the JavaScript function if not needed
        // It was used previously to process payment methods, but now the PHP functions handle that logic
        // You can use JavaScript for client-side validation or other purposes as needed
        function placeOrder() {
            // Submit the form to process the order
            document.querySelector('form').submit();
        }
    </script>
</body>
</html>
