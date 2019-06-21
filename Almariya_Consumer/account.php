<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Account | අල්මාරිය</title>
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
								<a href="index.php"><img src="images/home/logo.png" alt=""/></a>
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
										<a href="index.php">Home</a>
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
					</div>
				</div>
			</div><!--/header-bottom-->
		</header><!--/header-->

		<section>
			<div class="container">
				<div class="row">

					<div class="col-sm-9" style="width: 100%">
						<div class="blog-post-area">
							<h2 class="title text-center">My Account</h2>

						</div><!--/blog-post-area-->

						<!--/Response-area-->
						<div class="replay-box">

							<div class="row">



					<?php
					require ('connect.php');
					
					$cid = $_SESSION['cid'];
					$name;
					$address;
					$tel;
					$pic;
					
					$newUser = TRUE;

						$query = "SELECT * FROM `consumer` WHERE cid='$cid'";
						$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
						$count = mysqli_num_rows($result);

						if ($count == 1) {
							while ($row = $result -> fetch_assoc()) {
								
								if ($row['image']!=null) {
									$newUser=FALSE;
								}
								
								
								$name =  $row['name'];
								$address = $row['address'];
								$tel = $row['tel'];

								$pic=$row['image'];

							}
						}


					?>


								<div class="col-sm-4">
									
										<h2>Edit Account Information</h2>
										
										<img id="profile" src="<?php if (!$newUser) {
											 echo "data:image/jpeg;base64,".base64_encode($pic); 
										}
											else {
												echo "images/account/pic.png";
											}?>" height="200" width="200" style="border: #000000 5px">
										<p>
											Edit Photo
										</p>
										<form action="savedata.php" method="POST" accept="image/*" enctype="multipart/form-data">
										<input onchange="previewImages()" type="file" id="file" name="file" <?php if (!$newUser) {
											  
										}
											else {
												echo ' value="D:/Softwares/XAMPP/htdocs/almariya/images/account/pic.png" ';
											}?> >
																			
										<div class="blank-arrow">
											<label>Your Name</label>
										</div>

										<input name="name"  type="text" placeholder="write your name..." value="<?php if (!$newUser) { echo $name; } ?>">
										<div class="blank-arrow">
											<label>Contact No.</label>
										</div>

										<input name="tel" type="tel" placeholder="your contact number..." value="<?php if (!$newUser) { echo $tel; } ?>">

									
								</div>
								<div class="col-sm-8">
											<div class="text-area" style="margin-top: 295px;">
												<div class="blank-arrow">
													<label>Your Addrres</label>
												</div>
												<textarea name="address" name="address" rows="5" placeholder="your address..." ><?php if (!$newUser) { echo $address; } ?></textarea>												

												<input class="btn btn-primary" type="submit" value="Save" style="margin-top: 50px;"></input>
											</div>
								</div>
								</form>
							</div>

						</div><!--/Repaly Box-->
					</div>
				</div>
			</div>
		</section>
		
		<br />

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
		<script src="js/account.js"></script>

	</body>
</html>