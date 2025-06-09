<?php
// Include the database connection file
include_once "include/conn.php";

// Fetch product data from the database
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Pagination variables
$limit = 12; // Number of products per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Calculate offset for SQL query
$offset = ($page - 1) * $limit;

// Fetch total number of products
$total_query = $pdo->query("SELECT COUNT(*) AS total FROM products");
$total_result = $total_query->fetch(PDO::FETCH_ASSOC);
$total_products = $total_result['total'];

// Calculate total pages
$total_pages = ceil($total_products / $limit);

// Fetch products for the current page
$stmt = $pdo->prepare("SELECT * FROM products LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-icons/font/bootstrap-icons.css">
    <title>Nivek PC</title>
    <?php include 'include/navbar.php'; ?>

    <style> 
    #pagination {
    margin-top: 50px; /* Adjust the top margin as needed */
}

#pagination a {
    margin-right: 5px; /* Adjust the right margin for spacing between pagination links */
    text-decoration: none;
    color: #333; /* Adjust link color as needed */
    padding: 5px 10px; /* Adjust padding for each pagination link */
    border: 1px solid #ccc; /* Add border for pagination links */
    border-radius: 5px; /* Add border radius for rounded corners */
}

#pagination a:hover {
    background-color: #f0f0f0; /* Change background color on hover */
}

</style>

</head>
<body>
    
   

    <section id="page-header">
        <h2>#shopathome</h2>
        <p>Save more with coupons & up to 70% off! </p>
    </section>

    <section id="product1" class="section-p1">
    <div class="pro-container">
        <?php foreach ($products as $product) : ?>
            <div class="pro">
                <img src="shop_product/<?php echo $product['product_img']; ?>" alt="">
                <div class="des">
                    <span><?php echo $product['product_name']; ?></span>
                    <h5><?php echo $product['description']; ?></h5>
                    <!-- Assuming 'rating' is not a column in your table -->
                    <!-- If it is, please replace 'rating' with the appropriate column name -->
                    <div class="star">
                        <?php for ($i = 0; $i < 5; $i++) : ?>
                            <i class="fa fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <h4>Php <?php echo $product['product_price']; ?></h4>
                </div>
                <a href="sproduct.php?id=<?php echo $product['product_id']; ?>"><i class="bi-cart-plus cart"></i></a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

    
<section id="pagination" class="section-p1">
    <?php
    // Left arrow
    if ($page > 1) {
        echo '<a href="shop.php?page=' . ($page - 1) . '"><i class="fa-solid fa-arrow-left"></i></a>';
    }

    // Generate pagination links
    for ($i = 1; $i <= $total_pages; $i++) {
        echo '<a href="shop.php?page=' . $i . '">' . $i . '</a>';
    }

    // Right arrow
    if ($page < $total_pages) {
        echo '<a href="shop.php?page=' . ($page + 1) . '"><i class="fa-solid fa-arrow-right"></i></a>';
    }
    ?>
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