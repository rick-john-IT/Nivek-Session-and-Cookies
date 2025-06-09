<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="service.css">
   <?php include 'include/navbar.php'; ?>
</head>
<body>
 
    

<section class="section-services">
		<div class="container">
			<div class="row justify-content-center text-center">
				<div class="col-md-10 col-lg-8">
					<div class="header-section">
						<h2 class="title">Exclusive <span>Services</span></h2>
						<p class="description">We offer professional and reliable repair services for all your PC and laptop needs. Whether you're experiencing hardware issues, software problems, or need an upgrade, our team of experts is here to help.</p>
            <a href="build.html" class="btn btn-primary btn-lg">Explore Our Builds</a>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- Start Single Service -->
				<div class="col-md-6 col-lg-4">
					<div class="single-service">
						<div class="part-1">
							<i class="fas fa-shopping-cart service-icon"></i>
							<h3 class="title">Build</h3>
						</div>
						<div class="part-2">
							<p class="description">We build custom PCs at very fair prices at any price point! Our PCs contain high quality, upgradable parts.</p>
							<a href="build.html"><i class="fas fa-arrow-circle-right"></i>Read More</a>
						</div>
					</div>
				</div>
				<!-- / End Single Service -->
				<!-- Start Single Service -->
				<div class="col-md-6 col-lg-4">
					<div class="single-service">
						<div class="part-1">
							<i class="fas fa-laptop service-icon"></i>
							<h3 class="title">Upgrade</h3>
						</div>
						<div class="part-2">
							<p class="description">Is your computer getting slower? We got you! We can upgrade Desktop Computers or Laptops for cheap prices!</p>
							<a href="shop.html"><i class="fas fa-arrow-circle-right"></i>Read More</a>
						</div>
					</div>
				</div>
				<!-- / End Single Service -->
				<!-- Start Single Service -->
				<div class="col-md-6 col-lg-4">
					<div class="single-service">
						<div class="part-1">
							<i class="fas fa-wrench service-icon"></i>
							<h3 class="title">Fix</h3>
						</div>
						<div class="part-2">
							<p class="description">Computers don't always work properly. We can replace broken parts, move data, or remove viruses from computers!</p>
							<a href="fix.html"><i class="fas fa-arrow-circle-right"></i>Read More</a>
						</div>
					</div>
				</div>
				<!-- / End Single Service -->
				<!-- Start Single Service -->
				<div class="col-md-6 col-lg-4">
					<div class="single-service">
						<div class="part-1">
							<i class="fas fa-user-shield service-icon"></i>
							<h3 class="title">Antivirus</h3>
						</div>
						<div class="part-2">
							<p class="description">We provide antivirus solutions to protect your computer from malicious software.</p>
							<a href="virus.html"><i class="fas fa-arrow-circle-right"></i>Read More</a>
						</div>
					</div>
				</div>
				<!-- / End Single Service -->
				<!-- Start Single Service -->
				<div class="col-md-6 col-lg-4">
					<div class="single-service">
						<div class="part-1">
							<i class="fas fa-network-wired service-icon"></i>
							<h3 class="title">Connectivity Services</h3>
						</div>
						<div class="part-2">
							<p class="description">We provide comprehensive connectivity solutions for your technical needs.</p>
							<a href="connectivity.html"><i class="fas fa-arrow-circle-right"></i>Read More</a>
						</div>
					</div>
				</div>
				<!-- / End Single Service -->
				<!-- Start Single Service -->
				<div class="col-md-6 col-lg-4">
					<div class="single-service">
						<div class="part-1">
							<i class="fas fa-laptop-code service-icon"></i>
							<h3 class="title">Laptop Repair</h3>
						</div>
						<div class="part-2">
							<p class="description">We provide comprehensive laptop repair services for your technical needs.</p>
							<a href="laptop.html"><i class="fas fa-arrow-circle-right"></i>Read More</a>
						</div>
					</div>
				</div>
				<!-- / End Single Service -->
			</div>
		</div>
	</section>

	<?php include 'include/footer.php'; ?>

	<script src="script.js"></script>
</body>
</html>
