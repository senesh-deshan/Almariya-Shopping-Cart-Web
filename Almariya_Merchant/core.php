<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>අල්මාරිය Web App</title>

	


		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
			body {

				background-color: #eee;
			}

			.image-product{
				max-width: 200px;
		 		max-height: 200px;
			}

			 input {
				margin-bottom: 1px;
				border-top-left-radius: 0;
				border-top-right-radius: 0;
			}
		</style>

		</style>
	</head>
	<body style="overflow: scroll;position: absolute">

		<div id="navbar">
			<button id="btnSignOut" onclick="location.href = 'logout.php'" style="float: right;">
				Signout
			</button>
			<button id="btnOrders" onclick="location.href = 'order.php'" style="float: right">
				Orders
			</button>
			<table>

				<tr>

					<?php
					session_start();
					require ('connect.php');

					// print_r($_POST);

					if (isset($_POST['delete'])) {
						
						$deleteID = $_POST['delete'];
						
						$query = "DELETE FROM `product` WHERE pid='$deleteID'";

						$result = mysqli_query($connection, $query) or die(mysqli_error($connection));	
						
						$query = "DELETE FROM `image` WHERE pid='$deleteID'";

						$result = mysqli_query($connection, $query) or die(mysqli_error($connection));	

						header('Location: core.php');
					}
					
					
						if (isset($_POST['add'])) {
						
						$ID = $_POST['id'];
						$category = $_POST['category'];
						$type = $_POST['type'];
						$material = $_POST['material'];
						$price = $_POST['price'];
						$sizes = $_POST['sizes'];
						$qty_ava = $_POST['qty_ava'];

						
						$mid = $_SESSION['mid'];
						
						
						
						if($ID!=""){
						$query = "INSERT INTO `product`(`pid`, `category`, `type`, `material`, `price`, `pmid`, `qty_ava`) VALUES ('$ID','$category','$type','$material','$price','$mid','$qty_ava')";

						$result = mysqli_query($connection, $query) or die(mysqli_error($connection));	
						}
						

						header('Location: core.php');


					}
					
						
						if (isset($_FILES['images']['tmp_name'])) {
							
				$imageCount = count($_FILES['images']['tmp_name']);
							
							$colorArray = explode(',', $_POST['colors']);

			
			$ID = $_POST['id'];

			
			foreach ($_FILES['images']['tmp_name'] as $key => $value) {
						
				 $color = $colorArray[$key];
				
				$file = addslashes(file_get_contents($value));

				
				$query = "INSERT INTO `image`(`pid`, `color`, `image`) VALUES ('$ID','$color','$file')";

				$result = mysqli_query($connection, $query) or die(mysqli_error($connection));	
			
			}
						
							
			
						
						if (isset($_POST['reset'])) {
							header('Location: core.php');
						}else{
							
						}

					}
						
						
					

					if (isset($_SESSION['name'])) {
						$name = $_SESSION['name'];
						$email = $_SESSION['email'];
						$mid = $_SESSION['mid'];

						$query = "SELECT * FROM `merchant` WHERE email='$email'";
						$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
						$count = mysqli_num_rows($result);

						if ($count == 1) {
							while ($row = $result -> fetch_assoc()) {

								echo "<td><img id='merchantImage' src=' data:image/jpeg;base64," . base64_encode($row['logo']) . "' height='100'></td>";
								echo "<td style='padding: 10px ;'><h3 id='hdName' style='line-height: 20px'>" . $row['name'] . "</h3><h4 id='hdEmail' style='line-height: 10px'>" . $row['email'] . "</h4><h5 id='hdID' style='line-height: 5px'>" . $row['mid'] . "</h5></td>";
						
							}
						}

					} else {
						header('Location: login.php');
					}
					?>
				</tr>
			</table>


		</div>
		<hr>
		<div id="content">

			<table>
				<tr>
					
					<td style="vertical-align: top">
					<h2 class="title text-center">Add Product</h2>	
					<div id="divEditor"
					style="margin: 10px ;width: 550px; height:500px;  padding: 20px ;">



						<table>

							<tr style="border-right: 1px solid black">
								<td style="border-right: 1px solid black; vertical-align: top " >
								<div style="width: 200px">

									<form  method="POST" enctype="multipart/form-data">									

									<br>
									<br>
									ID:
									<input type="text" name="id" style="width: 100px"	maxlength="10">
									</input>
									<br>
									<br>
									Category: <select name="category">
						<?php				
										$query = "SELECT * FROM `category`";
						$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
						$count = mysqli_num_rows($result);


							while ($row = $result -> fetch_assoc()) {

								echo "<option>". $row['category'] ."</option>";


							}
						
							?>			
									</select>
									<br>
									<br>
									Type: <select name="type">
										
											<?php				
										$query = "SELECT * FROM `type`";
						$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
						$count = mysqli_num_rows($result);


							while ($row = $result -> fetch_assoc()) {

								echo "<option>". $row['type'] ."</option>";


							}
						
							?>	
										
									</select>
									<br>
									<br>
									Material: <select name="material">
											<?php				
										$query = "SELECT * FROM `material`";
						$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
						$count = mysqli_num_rows($result);


							while ($row = $result -> fetch_assoc()) {

								echo "<option>". $row['material'] ."</option>";


							}
						
							?>	
									</select>
									<br>
									<br>
									Price:
									<input type="number" name="price" style="width: 100px"
									oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
									maxlength="6">
									</input>
									<br>
									<br>
									Sizes:
									<div >	
										
										<input type='hidden' name='sizes[]' value=null  checked ></input>
										
										<?php				
										$query = "SELECT * FROM `size`";
						$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
						$count = mysqli_num_rows($result);


							while ($row = $result -> fetch_assoc()) {

								echo "<input type='checkbox' name='sizes[]' value=". $row['sizes'] ."> ". $row['sizes'] ." </input>";


							}
						
							?>	</div>
									<br>
									<br>
									Available quantity:
									<input type="number" name="qty_ava" style="width: 100px" maxlength="6">
									</input>
									<br>
									<br>
									<input type='hidden' name='add' value='TRUE' ></input>
									<button type="submit"  class="btn btn-danger">
										Add
									</button>
									<br>
									<br>
									<input type="checkbox" name="reset" id="resetEnabled">
									Reset on update
									</input>
									<br>
									
									
								</div></td>

								<td style="vertical-align: top ">
								<div style="margin: 10px ">
									
									<input id="imageChooser" type="file" name="images[]" onchange="previewImages()"  accept="image/*" multiple/>
									
									<br/>
									<div style="overflow: scroll; height: 600px;width:inherit">
										
									<select  id="color_list"  style="visibility: hidden">	
										<?php				
										$query = "SELECT * FROM `color`";
						$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
						$count = mysqli_num_rows($result);


							while ($row = $result -> fetch_assoc()) {

								echo "<option> ". $row['color'] ." </option>";


							}
						
							?>
							</select>
										<input  id="colors" name="colors" style="visibility: hidden">
										<table id="imagesPreview">

										</table>
										</form>
									</div>
								</div></td>
							</tr>

						</table>

					</div></td>
					<td >
							<h2 class="title text-center">Current Products</h2>
							
					<div style="overflow: scroll; height: 600px;width:inherit">
						
							<?php
							
						$query = 'SELECT * FROM product WHERE pmid="'.$_SESSION['mid'].'"';
						$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
						$count = mysqli_num_rows($result);

							while ($row = mysqli_fetch_array($result)) {
								
								

			
								
								echo '<div class="col-sm" style="padding: 10px;">
								<div class="product-image-wrapper">
									<div class="single-products" style="border: solid black 1px">
										<div class="productinfo text-left">
										<table>
										<tr>
										
										<td style="padding: 10px;">
											<form method="POST">
											<input type="hidden" name="delete" value="'.$row['pid'].'">
											<button class="btn btn-primary " type="submit">X</button>
											</form>
										</td>
										
										<td style="padding: 10px; min-width:200px">
											<table>
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
											<td>Price</td><td>LKR'.$row['price'].'
											</td>
											</tr>
											
											<tr>
											<td>Quantity Available</td><td>'.$row['qty_ava'].'
											</td>
											</tr>
											
											</table>
										</td>
							
										<td >';
										

								$query = 'SELECT * FROM image WHERE pid="'.$row['pid'].'"';
						$resultImg = mysqli_query($connection, $query) or die(mysqli_error($connection));
						$countImg = mysqli_num_rows($result);

						echo '<table><tr>';
						
							while ($rowImg = mysqli_fetch_array($resultImg)) {
								
								echo '<td> <img src="data:image/jpeg;base64,' . base64_encode($rowImg['image']) . '" class="img-thumnail image-product" />';
								
								echo '<p class="text-center">' . ($rowImg['color']) . '</p> </td>';
							}									
						
						echo '</tr></table>';
										
									echo '</td>
										
										</tr>
										</table>
										</div>
									</div>

								</div>
							</div>';
								
								
						
							}
							


							mysqli_close($connection);
							?>

						
					</div></td>
				</tr>
			</table>
		</div>

		<script src="js/coreScript.js"></script>

	</body>
</html>