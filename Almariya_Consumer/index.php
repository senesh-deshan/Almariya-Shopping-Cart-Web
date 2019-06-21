<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Home | අල්මාරිය</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/prettyPhoto.css" rel="stylesheet">
		<link href="css/price-range.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href="css/responsive.css" rel="stylesheet">
		<link rel="shortcut icon" href="images/ico/favicon.ico">
	</head><!--/head-->

	<body>
		<header id="header">
			<!--header-->

			<div class="header-middle">
				<!--header-middle-->
				<div class="container">
					<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav">
								<li><a href="checkout.php"><i class="fa fa-money"></i> Checkout</a></li>
								<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li><a href="favourite.php"><i class="fa fa-heart"></i> Favourites</a></li>
								
								<?php
									
									session_start();
									
									$con = mysqli_connect("localhost", "root", "", "almariya");
							// Check connection
							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}
									if (isset($_SESSION['cid'])) {
										echo '<li><a href="logout.php"><i class="fa fa-lock"></i> Signout</a></li>';
										if (isset($_SESSION['cid'])) {
											
										$cid=$_SESSION['cid'];
											
										$result = mysqli_query($con, "SELECT * FROM consumer WHERE cid LIKE '$cid'");

										while ($row = mysqli_fetch_array($result)) {
											
											$name = explode(' ', $row['name']);
											
											echo '<li><a href="account.php"><img  src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" class="img-thumnail" style=" max-width: 32px; border: solid 1px;" />
										'.$name[0].'</a></li>';
										}
									}
									} else {
										echo '<li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>';
									}
									
								?>
							</ul>
						</div>
					</div>
				</div>
				</div>
			</div><!--/header-middle-->

			<div class="header-bottom">
				<!--header-bottom-->
				<div class="container">
					<div class="row">
						<div class="col-sm-9">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse"
								data-target=".navbar-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="mainmenu pull-left">
								<ul class="nav navbar-nav collapse navbar-collapse">
									<li>
										<a href="index.php" class="active">Home</a>
									</li>
									<li>
										<a href="shop.php">Shop</a>
									</li>
									<li>
										<a href="contact-us.php">Contact Us</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-sm-3">
						<div class="search_box pull-right">
							<form id="search" method="POST" action="shop.php">
							<input type="text" name="search" onchange="document.getElementById('search').submit" placeholder="Search"/>
							</form>
						</div>
					</div>
					</div>
				</div>
			</div><!--/header-bottom-->
		</header><!--/header-->

		<section id="slider">
			<!--slider-->
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div id="slider-carousel" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
								<li data-target="#slider-carousel" data-slide-to="1"></li>
								<li data-target="#slider-carousel" data-slide-to="2"></li>
							</ol>

							<div class="carousel-inner">
								<div class="item active">
									<div class="col-sm-6">
										<h1>අල්මාරිය</h1>
										<h2>Latest Designs</h2>
										<p>
											We update with new designs and fashion trends everyday. So you can see all the
											designs around the Sri Lanka in one place.
										</p>
										<button type="button" class="btn btn-default get">
											Get it now
										</button>
									</div>
									<div class="col-sm-6">
										<img src="images/home/girl1.jpg" class="girl img-responsive" alt=""/>
										<img src="images/home/pricing.png" class="pricing" alt=""/>
									</div>
								</div>
								<div class="item">
									<div class="col-sm-6">
										<h1>අල්මාරිය</h1>
										<h2>Bigger Collection</h2>
										<p>
											We are here to give you the best online shopping experience in Sri Lanka, with a wide
											range of selections to choose from.
										</p>
										<button type="button" class="btn btn-default get">
											Get it now
										</button>
									</div>
									<div class="col-sm-6">
										<img src="images/home/girl2.jpg" class="girl img-responsive" alt=""/>
										<img src="images/home/pricing.png" class="pricing" alt=""/>
									</div>
								</div>

								<div class="item">
									<div class="col-sm-6">
										<h1>අල්මාරිය</h1>
										<h2>Cheaper Price</h2>
										<p>
											Do wallet friendly shopping with අල්මාරිය, and be amazed with our competitive prices
											and discounts.
										</p>
										<button type="button" class="btn btn-default get">
											Get it now
										</button>
									</div>
									<div class="col-sm-6">
										<img src="images/home/girl3.jpg" class="girl img-responsive" alt=""/>
										<img src="images/home/pricing.png" class="pricing" alt=""/>
									</div>
								</div>

							</div>

							<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev"> <i class="fa fa-angle-left"></i> </a>
							<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next"> <i class="fa fa-angle-right"></i> </a>
						</div>

					</div>
				</div>
			</div>
		</section><!--/slider-->

		<section>
			<div class="container">
				<div class="row">

					<div class="col-sm-9 padding-right" style="width: 100%">
						<div class="features_items">
							<!--features_items-->
							<h2 class="title text-center">Featured Items</h2>

							<?php
							

							$result = mysqli_query($con, "SELECT * FROM product left join merchant on product.pmid=merchant.mid left join image on product.pid=image.pid GROUP BY product.pid LIMIT 6");

							while ($row = mysqli_fetch_array($result)) {
			
								
								echo '<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
										<a href="product-details.php?disID='.$row['pid'].'">
											<img id="'.$row['pid'].'" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" class="img-thumnail" />
										</a>
											<h2>LKR '.$row['price'].'</h2>
											<p>
												<img title="'.$row['name'].'" src="data:image/jpeg;base64,' . base64_encode($row['logo']) . '" style="width : 100px" />
											</p>
											
											<a href="cart.php?cartAddID='.$row['pid'].'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i> Add
											to cart</a>
										</div>
									</div>
									<div class="choose">
										<ul class="nav nav-pills nav-justified">
											<li>
												<a href="favourite.php?cartAddID='.$row['pid'].'"><i class="fa fa-heart"></i>Add to favourites</a>
											</li>
										</ul>
									</div>
								</div>
							</div>';
								
								
								
						
							}



							mysqli_close($con);
							?>

						</div><!--features_items-->

						<div class="recommended_items">
							<!--recommended_items-->
							<h2 class="title text-center">recommended items</h2>

							<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
										
										<?php
							$con = mysqli_connect("localhost", "root", "", "almariya");
							// Check connection
							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}

							$result = mysqli_query($con, "SELECT * FROM product left join merchant on product.pmid=merchant.mid left join image on product.pid=image.pid GROUP BY product.pid LIMIT 3");

							while ($row = mysqli_fetch_array($result)) {
			
								
								echo '<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
										<a href="product-details.php?disID='.$row['pid'].'">
											<img id="'.$row['pid'].'" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" class="img-thumnail" />
										</a>
											<h2>LKR '.$row['price'].'</h2>
											<p>
												<img title="'.$row['name'].'" src="data:image/jpeg;base64,' . base64_encode($row['logo']) . '" style="width : 100px" />
											</p>
											
											<a href="cart.php?cartAddID='.$row['pid'].'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i> Add
											to cart</a>
										</div>
									</div>
									<div class="choose">
										<ul class="nav nav-pills nav-justified">
											<li>
												<a href="favourite.php?cartAddID='.$row['pid'].'"><i class="fa fa-heart"></i>Add to favourites</a>
											</li>
										</ul>
									</div>
								</div>
							</div>';
								
								
								
						
							}



							mysqli_close($con);
							?>
							


								</div>
								<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev"> <i class="fa fa-angle-left"></i> </a>
								<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next"> <i class="fa fa-angle-right"></i> </a>
							</div>
						</div><!--/recommended_items-->

					</div>
				</div>
			</div>
		</section>

		<footer id="footer">
			<!--Footer-->

			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<p class="pull-left">
							Copyright © 2018 අල්මාරිය All rights reserved.
						</p>
					</div>
				</div>
			</div>

		</footer><!--/Footer-->

		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>

	</body>
</html>