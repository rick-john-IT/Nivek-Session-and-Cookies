<?php
// Include the database connection file
include_once "include/conn.php";

// Check if the product ID is set in the URL
if(isset($_GET['id'])) {
    // Retrieve the product ID from the URL
    $product_id = $_GET['id'];
    
    // Fetch product data from the database based on the product ID
    $stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Check if the product exists
    if(!$product) {
        // Redirect to index.php or display an error message if the product doesn't exist
        header("Location: index.php");
        exit();
    }
    
    // Retrieve the available stock for the product
    $stock = $product['stock'];
} else {
    // Redirect to index.php or display an error message if no product ID is provided
    header("Location: index.php");
    exit();
}

// Fetch product data from the database
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the product ID is set and is a valid integer
if(isset($_POST['product_id']) && filter_var($_POST['product_id'], FILTER_VALIDATE_INT)) {
    // Retrieve the product ID from the POST data
    $product_id = $_POST['product_id'];
    
    // Check if the cart array exists in the session
    if(isset($_SESSION['cart'])) {
        // Check if the product is already in the cart
        if(isset($_SESSION['cart'][$product_id])) {
            // Increment the quantity of the existing product in the cart
            $_SESSION['cart'][$product_id]++;
        } else {
            // Add the product to the cart with a quantity of 1
            $_SESSION['cart'][$product_id] = 1;
        }
    } else {
        // Create a new cart array and add the product to it
        $_SESSION['cart'] = array($product_id => 1);
    }
    
    // Update the cart count in the session
    $_SESSION['cart_count'] = array_sum($_SESSION['cart']);
    
    // Redirect back to the previous page or wherever you want
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <title>Nivek PC</title>
    <?php include 'include/navbar.php'; ?>

    <style>
        /* Customize the appearance of the SweetAlert dialog */
.my-popup-class {
  width: 300px; /* Set the width */
  height: auto; /* Let the height adjust to content */
  border-radius: 10px; /* Rounded corners */
}

/* Customize the appearance of the success icon */
.my-icon-class {
  width: 50px; /* Adjust the width of the icon */
}

/* Customize the appearance of the title */
.my-title-class {
  font-size: 18px; /* Adjust the font size of the title */
}

        #prodetails .single-pro-details input {
            width: 60px;
        }

        @media only screen and (max-width: 768px) {
    /* Styles for screens smaller than 768px width */
    #prodetails .single-pro-image {
        width: 100%;
    }

    #prodetails .single-pro-details {
        margin-top: 20px;
    }

    #prodetails .single-pro-details input {
        width: 100%;
        margin-bottom: 10px;
    }

    #prodetails .single-pro-details button {
        width: 100%;
    }
}

@media only screen and (max-width: 576px) {
    /* Styles for screens smaller than 576px width */
    /* Add additional responsive styles as needed */
}
    </style>
</head>
<body>
    
<section id="prodetails" class="section-p1">
    <div class="single-pro-image">
        <img src="shop_product/<?php echo $product['product_img']; ?>" width="100%" id="MainImg" alt="">
    </div>

    <div class="single-pro-details" class="section-p1">
        <h4><?php echo $product['product_name']; ?></h4>
        <h2>₱ <?php echo $product['product_price']; ?></h2>
        <input type="number" value="1" max="<?php echo $stock; ?>" min="1" id="quantityInput">
        <button class="normal" onclick="addToCart(<?php echo $product_id; ?>)">Add To Cart</button>
        <button class="normal" onclick="buyNow(<?php echo $product_id; ?>)">Buy Now</button>
        <h4>Product Details</h4>
        <span class="hello"><?php echo $product['description']; ?></span>
    </div>
</section>


<section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p>Summer Collection New Modern Design</p>
    <div class="pro-container">
        <?php
        $counter = 0; // Initialize counter
        // Fetch and loop through product data to display each product
        foreach ($products as $product) {
            if ($counter < 8) { // Check if the counter is less than 8
                echo '<div class="pro">';
                echo '<img src="shop_product/' . $product['product_img'] . '" alt="' . $product['product_name'] . '">';
                echo '<div class="des">';
                echo '<span>' . $product['product_name'] . '</span>';
                echo '<h5>' . $product['description'] . '</h5>';
                echo '<h4>₱ ' . $product['product_price'] . '</h4>';
                echo '</div>';
                echo '<a href="sproduct.php?id=' . $product['product_id'] . '"><i class="bi-cart-plus cart"></i></a>';
                echo '</div>';
                $counter++; // Increment the counter
            } else {
                break; // Exit the loop once 8 products are displayed
            }
        }
        ?>
    </div>
</section>

<section id="newsletter" class="section-p1 section-m2">
        <div class="newstext">
            <h4>Sign Up For Updates</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span>
            </p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign Up</button>
        </div> 
    </section> 

<?php include 'include/footer.php'; ?>
<script>
    function validateQuantity(input, maxQuantity) {
        if (input.value > maxQuantity) {
            alert('The quantity cannot exceed the available stock');
            input.value = maxQuantity;
        }
        if (input.value < 1) {
            alert('The quantity cannot be less than 1');
            input.value = 1;
        }
    }

    function addToCart(productId) {
    // Check if the user is logged in
    <?php if (!isset($_SESSION['email'])): ?>
        // If user is not logged in, display a message
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'Please log in first to add a product to the cart',
            showConfirmButton: false,
            timer: 2000,
            customClass: {
                popup: 'my-popup-class',
                icon: 'my-icon-class',
                title: 'my-title-class'
            }
        });
        return; // Exit the function
    <?php endif; ?>

    var quantityInput = document.getElementById("quantityInput");
    validateQuantity(quantityInput, <?php echo $stock; ?>);

    // Send an AJAX request to add the product to the cart
    $.ajax({
        url: 'add_to_cart.php',
        method: 'POST',
        data: { productId: productId, quantity: quantityInput.value },
        success: function(response) {
            // Update the notification count on the navbar
            updateCartNotification();
            // Display notification that product has been added to the cart
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Product added to cart',
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    popup: 'my-popup-class',
                    icon: 'my-icon-class',
                    title: 'my-title-class'
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}





    function updateCartNotification() {
        // Send an AJAX request to fetch the current cart count
        $.ajax({
            url: 'get_cart_count.php',
            method: 'GET',
            success: function(response) {
                // Update the cart notification count on the navbar
                $('#cart-notification').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }


    function buyNow(productId) {
    // Check if the user is logged in
    <?php if (!isset($_SESSION['email'])) : ?>
        // If not logged in, redirect to the login page
        window.location.href = 'account.php';
    <?php else : ?>
        // If logged in, proceed with the "Buy Now" logic
        var quantityInput = document.getElementById("quantityInput");
        validateQuantity(quantityInput, <?php echo $stock; ?>);
        
        // Send an AJAX request to add the product to the cart
        $.ajax({
            url: 'add_to_cart.php',
            method: 'POST',
            data: { productId: productId, quantity: quantityInput.value },
            success: function(response) {
                // Redirect to the cart page after adding the product to the cart
                window.location.href = 'cart.php';
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    <?php endif; ?>
}


</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="script.js"></script>

</body>
</html>
