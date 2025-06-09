
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-icons/font/bootstrap-icons.css">
    <title>Nivek PC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <?php
// Include the database connection file
include_once "include/conn.php";



// Fetch product data from the database
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

    <?php include 'include/navbar.php'; ?>
    
    <style>
        a {
    text-decoration: none; /* Remove underline from all anchor tags */
}

</style>

</head>
<body>
    

    <section id="hero">
        <h4>Best Deals In Town!</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>Save more with vouchers & up to 30% off! </p>
        <button>Shop Now</button>
    </section>

    <section id="feature" class="section-p2">
        <div class="fe-box">
            <img src="images/f1.png" alt="">
            <h6>Free Shipping</h6>
        </div>

        <div class="fe-box">
            <img src="images/f2.png" alt="">
            <h6>Online Order</h6>
        </div>

        <div class="fe-box">
            <img src="images/f3.png" alt="">
            <h6>Save Money</h6>
        </div>

        <div class="fe-box">
            <img src="images/f4.png" alt="">
            <h6>Installment</h6>
        </div>

        <div class="fe-box">
            <img src="images/f5.png" alt="">
            <h6>Fast Transaction</h6>
        </div>

        <div class="fe-box">
            <img src="images/f6.png" alt="">
            <h6>24/7 Support</h6>
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
                echo '<a href="sproduct.php?id=' . $product['product_id'] . '">';
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



    <section id="banner" class="section-m1">
        <h4>Repair Services </h4>
        <h2><span>24/7</span> Assistance - Fast and Reliable Repair</h2>
        <button class="normal">Explore More</button>
    </section> 

    <section id="product1" class="section-p1">
    <h2>New Arrivals</h2>
    <p>For a Better Gaming Experience</p>
    <div class="pro-container">
        <?php
        $counter = 0; // Initialize counter for the loop
        $displayed = 0; // Initialize a counter for displayed products
        
        // Loop through product data to display each product
        foreach ($products as $product) {
            if ($counter < 8) { // Check if the counter is less than 8
                // Skip the first 8 products since they were already displayed in the Featured Products section
                $counter++;
                continue;
            }
            
            if ($displayed >= 8) { // Check if 8 products have been displayed
                break; // Exit the loop if 8 products have been displayed
            }
            
            // Display the product as a new arrival
            echo '<div class="pro">';
            echo '<a href="sproduct.php?id=' . $product['product_id'] . '">';
            echo '<img src="shop_product/' . $product['product_img'] . '" alt="' . $product['product_name'] . '">';
            echo '<div class="des">';
            echo '<span>' . $product['product_name'] . '</span>';
            echo '<h5>' . $product['description'] . '</h5>';
            echo '<h4>Php ' . $product['product_price'] . '</h4>';
            echo '</div>';
            echo '<a href="sproduct.php?id=' . $product['product_id'] . '"><i class="bi-cart-plus cart"></i></a>';
            echo '</div>';

            $displayed++; // Increment the displayed counter
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

    <script src="script.js"></SCript>
</body>
</html>

