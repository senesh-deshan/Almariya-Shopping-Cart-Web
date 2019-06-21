<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Contact | අල්මාරිය</title>
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
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="mainmenu pull-left">
								<ul class="nav navbar-nav collapse navbar-collapse">
									<li>
										<a href="index.php">Home</a>
									</li>
									<li>
										<a href="shop.php">Shop</a>
									</li>
									<li>
										<a href="contact-us.php" class="active">Contact Us</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div><!--/header-bottom-->
		</header><!--/header-->

		<div id="contact-page" class="container">
			<div class="bg">
				<div class="row">
					<div class="col-sm-12">
						<h2 class="title text-center"><strong>Contact Us</strong></h2>
						<center>
						<div id="gmap" class="contact-map" style="position: relative; overflow: hidden;">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.3770866845384!2d79.93427201426746!3d6.845317721238724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae250799e3dd38f%3A0xf3161192fd56fd2c!2sLNBTI+-+Lanka+Nippon+BizTech+Institute!5e0!3m2!1sen!2slk!4v1545279577362" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
						</center>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8">
						<div class="contact-form">
							<h2 class="title text-center">Get In Touch</h2>
							<div class="status alert alert-success" style="display: none"></div>
							<form id="main-contact-form" class="contact-form row" name="contact-form" method="post" action="senddata.php">
								<div class="form-group col-md-6">
									<input type="text" name="name" class="form-control" required="required" placeholder="Name">
								</div>
								<div class="form-group col-md-6">
									<input type="email" name="email" class="form-control" required="required" placeholder="Email">
								</div>
								<div class="form-group col-md-12">
									<input type="text" name="subject" class="form-control" required="required" placeholder="Subject">
								</div>
								<div class="form-group col-md-12">
									<textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
								</div>
								<div class="form-group col-md-12">
									<input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
								</div>
							</form>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="contact-info">
							<h2 class="title text-center">Contact Info</h2>
							<address>
								<p>
									Almariya
								</p>
								<p>
									LNBTI - Lanka Nippon BizTech Institute
								</p>
								<p>
									No: 278,High Level Road,
								</p>
								<p>
									Maharagama.
								</p>
								<p>
									Mobile: +9477 33 60000
								</p>
								<p>
									Tel: +9411 3020 103
								</p>
								<p>
									Email: info@almariya.com
								</p>
							</address>
						</div>
					</div>
				</div>
			</div>
		</div><!--/#contact-page-->

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