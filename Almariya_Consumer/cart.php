<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cart | අල්මාරිය</title>
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
									
											$con = mysqli_connect("localhost", "root", "", "almariya");
							// Check connection
							if (mysqli_connect_errno()) {
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}
									
									
									session_start();
									
									if (!isset($_SESSION['cid'])) {
									header('Location: login.php?source=cart');
									
									}
									
									
									if (isset($_GET['cartAddID'])) {
								
								
							
								$cartAddID=$_GET['cartAddID'];
								$pid = $cartAddID;
								$cid = $_SESSION['cid'];
								$qty = 1;
								$color = null;
								
								if (isset($_GET['quantity'])) {
									$qty=$_GET['quantity'];
								}
								
								if (isset($_GET['color'])) {
									$color=$_GET['color'];
								}else{
									
									$resultColor = mysqli_query($con, "SELECT color FROM product LEFT JOIN image ON product.pid=image.pid WHERE product.pid LIKE '$pid' GROUP BY product.pid");
							
									while ($rowColor = mysqli_fetch_array($resultColor)) {
										$color = $rowColor['color'];
									}
								}	
							
								$result = mysqli_query($con, "INSERT INTO `cart`(`cid`, `pid`, `quantity`, `color`) VALUES ('$cid','$cartAddID','$qty','$color')");
								
								if (isset($_GET['return'])) {
								header('Location: favourite.php');
								}else{
								header('Location: cart.php');
								}
							}
							
							if (isset($_GET['cartRemoveID'])) {
							
								$cartRemoveID=$_GET['cartRemoveID'];
								$cid = $_SESSION['cid'];
							
								$result = mysqli_query($con, "DELETE FROM `cart` WHERE cid LIKE '$cid' AND pid LIKE '$cartRemoveID'");
								
								header('Location: cart.php');
							}
							
							if (isset($_GET['cartIncID'])) {
							
								$cartIncID=$_GET['cartIncID'];
								$cid = $_SESSION['cid'];
							
								$result = mysqli_query($con, "UPDATE `cart` SET `quantity`=(`quantity`+1) WHERE cid LIKE '$cid' AND pid LIKE '$cartIncID'");
								
								header('Location: cart.php');
							}
							
							if (isset($_GET['cartDecID'])) {
							
								$cartDecID=$_GET['cartDecID'];
								$cid = $_SESSION['cid'];
							
								$result = mysqli_query($con, "UPDATE `cart` SET `quantity`=IF(`quantity`=1,1,`quantity`-1) WHERE cid LIKE '$cid' AND pid LIKE '$cartDecID'");
								
								header('Location: cart.php');
							}
							
									
									
							
									if (isset($_SESSION['name'])) {
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

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
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
                    <td>Remove from Cart</td>
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
								$color = $row['color'];
			
								$resultProduct = mysqli_query($con, "SELECT * FROM product LEFT JOIN image ON product.pid=image.pid WHERE product.pid LIKE '$pid' AND color LIKE '$color'");

								while ($rowProduct = mysqli_fetch_array($resultProduct)) {
			
								
								echo '<tr>
                    <td class="cart_product">
                        <a href="product-details.php?disID='.$row['pid'].'"><img src="data:image/jpeg;base64,' . base64_encode($rowProduct['image']) . '"  style="height:150px; width:150px;"></a>
                    </td>
                    <td class="cart_description">
                        <h4><a href="product-details.php?disID='.$row['pid'].'">'.$rowProduct['category']." ".$rowProduct['type'].'</a></h4>
                        <p>ID: '.$rowProduct['pid'].'</p>
                        <p>'.$row['color'].'</p>
                    </td>
                    <td class="cart_price">
                        <p>'.$rowProduct['price'].'</p>
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button">
                            <a class="cart_quantity_up" href="cart.php?cartIncID='.$row['pid'].'"><i class="fa fa-plus"></i></a>
                            <input class="cart_quantity_input" type="text" name="quantity" value="'.$row['quantity'].'" autocomplete="off"
                                   size="2">
                            <a class="cart_quantity_down" href="cart.php?cartDecID='.$row['pid'].'"><i class="fa fa-minus"></i></a>
                        </div>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price totals">'.$rowProduct['price'] * $row['quantity'].'</p>
                    </td>
                    <td class="cart_delete">
                        <a class="cart_quantity_delete" href="cart.php?cartRemoveID='.$row['pid'].'"><i class="fa fa-times"></i></a>
                    </td>
                </tr>';
						
							}
								
							}



							mysqli_close($con);
							?>
              
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>Cart Summary</h3>
        </div>
        <div class="row">
            
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span id="cart-sub"></span></li>
                        <li>Delivery Cost <span id="shipping"></span></li>
                        <li>Total <span id="full-total"></span></li>
                    </ul>
                    <a style="visibility: hidden" class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="checkout.php">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

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
</script>

</body>
</html>