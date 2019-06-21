<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Checkout | අල්මාරිය</title>
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
									
									if (!isset($_SESSION['cid'])) {
									header('Location: login.php?source=checkout');
									
									}
									
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
<?php

						$con = mysqli_connect("localhost", "root", "", "almariya");
							// Check connection
							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}
							
							
							if (isset($_GET['cartRemoveID'])) {
							
								$cartRemoveID=$_GET['cartRemoveID'];
								$cid = $_SESSION['cid'];
							
								$result = mysqli_query($con, "DELETE FROM `cart` WHERE cid LIKE '$cid' AND pid LIKE '$cartRemoveID'");
								
								header('Location: checkout.php');
							}
							
							if (isset($_GET['cartIncID'])) {
							
								$cartIncID=$_GET['cartIncID'];
								$cid = $_SESSION['cid'];
							
								$result = mysqli_query($con, "UPDATE `cart` SET `quantity`=(`quantity`+1) WHERE cid LIKE '$cid' AND pid LIKE '$cartIncID'");
								
								header('Location: checkout.php');
							}
							
							if (isset($_GET['cartDecID'])) {
							
								$cartDecID=$_GET['cartDecID'];
								$cid = $_SESSION['cid'];
							
								$result = mysqli_query($con, "UPDATE `cart` SET `quantity`=IF(`quantity`=1,1,`quantity`-1) WHERE cid LIKE '$cid' AND pid LIKE '$cartDecID'");
								
								header('Location: checkout.php');
							}

						?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Delivery Information</h2>
			</div>

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3" style="visibility: hidden">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form>
								<input type="text" placeholder="Display Name">
								<input type="text" placeholder="User Name">
								<input type="password" placeholder="Password">
								<input type="password" placeholder="Confirm password">
							</form>
							<a class="btn btn-primary" href="">Get Quotes</a>
							<a class="btn btn-primary" href="">Continue</a>
						</div>
					</div>
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Deliver To</p>
							<div class="form-one">
								
								<form id="forml" action="order.php">
									
									<?php
							$con = mysqli_connect("localhost", "root", "", "almariya");
							// Check connection
							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}
								
							$cid = $_SESSION['cid'];
					
							$result = mysqli_query($con, "SELECT * FROM consumer WHERE cid LIKE '$cid'");

							while ($row = mysqli_fetch_array($result)) {
									
								$name = explode(' ', $row['name']);
								$address = explode(' ', $row['address']);
								
							//	if(isset)
								
							echo '<input id="fname" type="text" placeholder="First Name *" value="'.$name[0].'">
									<input id="mname" type="text" placeholder="Middle Name" value="'.$name[1].'">
									<input id="lname" type="text" placeholder="Last Name *" value="'.$name[2].'">
									<input id="tel" type="tel" placeholder="Mobile Phone" value="'.$row['tel'].'">
									
									<img src="images/checkout/cod.png" style="width: 100%; float: right"/>
								</form>
							</div>
							<div class="form-two">
								<form >
										<input id="address1" type="text" placeholder="Address 1 *" value="'.$address[0].'">
									<input id="address2" type="text" placeholder="Address 2" value="'.$address[1].'">									
									<select id="city">
										<option>'.$address[2].'</option>
<option>Dehiwala-Mount Lavinia</option>
<option>Moratuwa</option>
<option>Sri Jayawardenapura Kotte</option>
<option>Negombo</option>
<option>Kandy</option>
<option>Kalmunai</option>
<option>Vavuniya</option>
<option>Galle</option>
<option>Trincomalee</option>
<option>Batticaloa</option>
<option>Jaffna</option>
<option>Katunayake</option>
<option>Dambulla</option>
<option>Kolonnawa</option>
<option>Anuradhapura</option>
<option>Ratnapura</option>
<option>Badulla</option>
<option>Matara</option>
<option>Puttalam</option>
<option>Chavakacheri</option>
<option>Kattankudy</option>
<option>Matale</option>
<option>Kalutara</option>
<option>Mannar</option>
<option>Panadura</option>
<option>Beruwala</option>
<option>Ja-Ela</option>
<option>Point Pedro</option>
<option>Kelaniya</option>
<option>Peliyagoda</option>
<option>Kurunegala</option>
<option>Wattala</option>
<option>Gampola</option>
<option>Nuwara Eliya</option>
<option>Valvettithurai</option>
<option>Chilaw</option>
<option>Eravur</option>
<option>Avissawella</option>
<option>Weligama</option>
<option>Ambalangoda</option>
<option>Ampara</option>
<option>Kegalle</option>
<option>Hatton</option>
<option>Nawalapitiya</option>
<option>Balangoda</option>
<option>Hambantota</option>
<option>Tangalle</option>
<option>Moneragala</option>
<option>Gampaha</option>
<option>Horana</option>
<option>Wattegama</option>
<option>Minuwangoda</option>
<option>Bandarawela</option>
<option>Kuliyapitiya</option>
<option>Haputale</option>
<option>Talawakele</option>
<option>Harispattuwa</option>
<option>Kadugannawa</option>
<option>Embilipitiya</option>

									</select>
									<input id="zip" type="number" placeholder="Postal Code *" value="'.$address[3].'">
									';
								
							}



							mysqli_close($con);
							?>
									
									
									
									
								</form>
								
								<button onclick="order()" class="btn btn-primary"  style="margin-top: 45px; width: 100%;">Place Order</button>
							</div>
						</div>
					</div>
									
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price (LKR)</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total (LKR)</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						
						
						
						<?php
							$con = mysqli_connect("localhost", "root", "", "almariya");
							// Check connection
							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}
								
							$cid = $_SESSION['cid'];
					
							$result = mysqli_query($con, "SELECT * FROM cart WHERE cid LIKE '$cid'");

							while ($row = mysqli_fetch_array($result)) {
								
								$pid = $row['pid'];
			
								$resultProduct = mysqli_query($con, "SELECT * FROM product LEFT JOIN image ON product.pid=image.pid WHERE product.pid LIKE '$pid' GROUP BY product.pid");

								while ($rowProduct = mysqli_fetch_array($resultProduct)) {
			
								
								echo '<tr>
                    <td class="cart_product">
                        <a href="product-details.php?disID='.$row['pid'].'"><img src="data:image/jpeg;base64,' . base64_encode($rowProduct['image']) . '"  style="height:150px; width:150px;"></a>
                    </td>
                    <td class="cart_description">
                        <h4><a href="product-details.php?disID='.$row['pid'].'">'.$rowProduct['category']." ".$rowProduct['type'].'</a></h4>
                        <p>ID: '.$rowProduct['pid'].'</p>
                    </td>
                    <td class="cart_price">
                        <p>'.$rowProduct['price'].'</p>
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button">
                            <a class="cart_quantity_up" href="checkout.php?cartIncID='.$row['pid'].'"> + </a>
                            <input class="cart_quantity_input" type="text" name="quantity" value="'.$row['quantity'].'" autocomplete="off"
                                   size="2">
                            <a class="cart_quantity_down" href="checkout.php?cartDecID='.$row['pid'].'"> - </a>
                        </div>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price totals">'.$rowProduct['price'] * $row['quantity'].'</p>
                    </td>
                    <td class="cart_delete">
                        <a class="cart_quantity_delete" href="checkout.php?cartRemoveID='.$row['pid'].'"><i class="fa fa-times"></i></a>
                    </td>
                </tr>';
						
							}
								
							}



							mysqli_close($con);
							?>
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td id="cart-sub">$59</td>
									</tr>
									<tr class="shipping-cost">
										<td>Delivery Cost</td>
										<td id="shipping">Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span id="full-total">$61</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="payment-options" style="visibility: hidden">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->



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
	
	var totalObjects = document.getElementsByClassName('totals');
	var fullTotal = 0;
	var totalNumbers = [totalObjects.length];
	
	for(var i=0;i<totalObjects.length;i++){
		fullTotal += parseInt(totalObjects[i].innerText);
	}
	
	document.getElementById('cart-sub').innerHTML ="LKR "+ fullTotal;
	
		var shippingCost = 500;
		
		if(fullTotal >= 5000){
			shippingCost = 0;
		}
	
	document.getElementById('shipping').innerHTML ="LKR "+ shippingCost;
	
	document.getElementById('full-total').innerHTML ="LKR "+ (shippingCost+fullTotal);
	
	
	function order () {
	 var fname =  document.getElementById('fname').value;
	 var mname =  document.getElementById('mname').value;
	 var lname =  document.getElementById('lname').value;
	 var tel =  document.getElementById('tel').value;
	 var address1 =  document.getElementById('address1').value;
	 var address2 =  document.getElementById('address2').value;
	 var city =  document.getElementById('city').value;
	 var zip =  document.getElementById('zip').value;
	  
	  var url = "order.php?"+"fname="+fname+"&mname="+mname+"&lname="+lname+"&tel="+tel+"&address1="+address1+"&address2="+address2+"&city="+city+"&zip="+zip;
	  window.location.href = url;
	}
	
</script>

</body>
</html>