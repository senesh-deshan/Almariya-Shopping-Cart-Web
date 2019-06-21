<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Product Details | අල්මාරිය</title>
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
	<header id="header"><!--header-->
		
		<div class="header-middle"><!--header-middle-->
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
	
		<div class="header-bottom"><!--header-bottom-->
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
								<li><a href="index.php">Home</a></li>
								<li><a href="shop.php">Shop</a></li>
								<li><a href="contact-us.php">Contact Us</a></li>
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
				
				<div class="col-sm-9 padding-right" style="width: 100%">
					<div class="product-details"><!--product-details-->
			
						<div class="col-sm-5">
							<div class="view-product">
								<center>
									<?php 
						
						$pid = $_GET['disID']; 
						
						$con = mysqli_connect("localhost", "root", "", "almariya");
							// Check connection
							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}

							$result = mysqli_query($con, "SELECT * FROM image WHERE pid='$pid' LIMIT 1");

							while ($row = mysqli_fetch_array($result)) {
								
								echo '<img id="big_image" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" />';
								
							}
						
						?>
							</center>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
											<?php 
						
						$pid = $_GET['disID']; 
						
						$con = mysqli_connect("localhost", "root", "", "almariya");
							// Check connection
							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}

							$result = mysqli_query($con, "SELECT * FROM image WHERE pid='$pid'");

							while ($row = mysqli_fetch_array($result)) {
								
								echo '<img id="'.$row['color'].'" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" onclick="imagePreview(this)"/>';
								
							}
						
						?>
										 
										 </div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev" style="visibility: hidden">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next" style="visibility: hidden">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
						
						
						<?php 
						
						$pid = $_GET['disID']; 
						
						$con = mysqli_connect("localhost", "root", "", "almariya");
							// Check connection
							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}

							$result = mysqli_query($con, "SELECT * FROM product left join merchant on product.pmid=merchant.mid WHERE product.pid='$pid'");

							while ($row = mysqli_fetch_array($result)) {
								
								echo '
								
								<table>
								<col width="200">
								
								<tr><td><h2 id="pid">'.$row['pid'].'</h2></td></tr>
					
								<tr><td><span><span>LKR '.$row['price'].'</span></span></td></tr>
								
								<tr><td><p><b>Availability:</b></td><td> '.$row['qty_ava'].'</p></td></tr>
				
								<tr><td><p><b>Brand:</b></td><td> <img id="'.$row['pid'].'" src="data:image/jpeg;base64,' . base64_encode($row['logo']) . '" style="width : 100px" /> </p></td></tr>
									
									</table>
								<br><hr><br>
									
									<table>
									
									<col width="100">
									
								<tr><td><label>Quantity:</label></td><td>
									<input id="qty" onchange="update()" type="number" value="1" style="width:100px"/></td></tr>
									
								<tr><td><label>Color:</label></td><td>
									<select id="color" onchange="update()" id="color_chooser" style="width:100px" >';
									
								$pid = $_GET['disID']; 
						
						$con = mysqli_connect("localhost", "root", "", "almariya");
							// Check connection
							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}

							$resultColors = mysqli_query($con, "SELECT * FROM image WHERE pid='$pid'");

							while ($rowColor = mysqli_fetch_array($resultColors)) {
								
								echo '<option>'.$rowColor['color'].'</option>';
								
							}
								
							
								echo	'</select></td></tr>
									
								<tr><td><br></td></tr>
									
								<tr><td></td><td><a id="cart-btn" type="button" href="cart.php?cartAddID='.$row['pid'].'" class="btn btn-default cart"><i class="fa fa-shopping-cart"></i> Add
											to cart</a></td></tr>
								
								
								</table>
								
								
								';
								
								
							}
						
						?>
						
								

							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab"><b>Details</b></a></li>
								<li ><a href="#measurements" data-toggle="tab"><b>Measurements Guide</b></a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<?php 
						
						$pid = $_GET['disID']; 
						
						$con = mysqli_connect("localhost", "root", "", "almariya");
							// Check connection
							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}

							$result = mysqli_query($con, "SELECT * FROM product left join merchant on product.pmid=merchant.mid WHERE product.pid='$pid'");

							while ($row = mysqli_fetch_array($result)) {
								
								echo '<table>
											<tr>
											<th style="width : 120px" >ID</th><th>'.$row['pid'].'</th>
											</tr>
											
											<tr><td>Category</td><td>'.$row['category'].'
											<td>
											</tr>
											
											<tr><td>Type</td><td>'.$row['type'].'
											</td>
											</tr>
											
											<tr>
											<td>Material</td><td>'.$row['material'].'
											</td>
											</tr>
											
											<tr>
											<td>Price</td><td>LKR '.$row['price'].'
											</td>
											</tr>
											
											<tr>
											<td>Quantity Available</td><td>'.$row['qty_ava'].'
											</td>
											</tr>
											
											</table>';
								
								
							}
						
						?>
							</div>
							
							
							<div class="tab-pane fade" id="measurements" >
								<div class="col-sm-12">
									
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					
					
				</div>
			</div>
		</div>
	</section>

	<footer id="footer"><!--Footer-->

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2018 අල්මාරිය All rights reserved.</p>
				</div>
			</div>
		</div>

	</footer><!--/Footer-->
	
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>

<script>
	function imagePreview (source) {
	   
	   var destination = document.getElementById("big_image");
	  
	  destination.src = source.src;
	  
	  
	}
	
	function update() {
	  var pid = document.getElementById("pid").innerText;
	  var qty = document.getElementById("qty").value;
	  var color = document.getElementById("color").value;
	  
	  document.getElementById("cart-btn").href="cart.php?cartAddID="+pid+"&quantity="+qty+"&color="+color;
	  
	  imagePreview(document.getElementById(color));
	  	
	 
	}
</script>

</body>
</html>