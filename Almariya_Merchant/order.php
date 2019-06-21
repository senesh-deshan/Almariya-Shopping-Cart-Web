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
			
			tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:#666B85;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}
			
			th {
  color:#D5DDE5;;
  background:#1b1e24;
  border-bottom:4px solid #9ea7af;
  border-right: 1px solid #343a45;
  font-size:23px;
  font-weight: 100;
  padding:10px;
  text-align:left;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  vertical-align:middle;
  white-space: nowrap;
}

td {

  padding:5px;
  text-align:left;
  vertical-align:middle;
  font-weight:300;
  font-size:18px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #C1C3D1;
  white-space: nowrap;
}



		</style>

		</style>
	</head>
	<body style="overflow: scroll;position: absolute">

		<div id="navbar">
			<button id="btnSignOut" onclick="location.href = 'logout.php'" style="float: right;">
				Signout
			</button>
			<button id="btnProducts" onclick="location.href = 'core.php'" style="float: right">
				Products
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
		
		<div id="content" style="padding-left: 500px;">
			
			<h2 class="title text-center">All Orders</h2>
							
					<div style="overflow: scroll; width:inherit; ">
						
						<table>
							<tr><th>Order ID</th><th></th><th>Placed date/time</th><th>Status</th></tr>
							<?php
							
							$mid = $_SESSION['mid'];
							
						$query = "SELECT `oid`, `cid`, `mid`, `pid`, `size`, `color`, `quantity`, `date_time`,`status` FROM `order` WHERE mid LIKE '$mid'  GROUP BY oid ORDER BY status";
						
						$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
						$count = mysqli_num_rows($result);

							while ($row = mysqli_fetch_array($result)) {
									
							echo '<tr style="';	
										
							if($row['status']==0){
							echo 'background-color: lightpink;';
							}if($row['status']==1){
							echo 'background-color: lightgreen;';
							}
								
								
								
								echo '"><td>'.$row['oid'].'</td> <td><table><tr><th>Product ID</th><th>Size</th><th>Color</th><th>Quantity</th></tr>';
								
								$query = "SELECT * FROM `order` WHERE mid LIKE '$mid' GROUP BY pid";
						
						$resultProduct = mysqli_query($connection, $query) or die(mysqli_error($connection));
						$countProduct = mysqli_num_rows($resultProduct);

							while ($rowProduct = mysqli_fetch_array($resultProduct)) {
						
								
								
								echo '<tr>
								<td>'.$rowProduct['pid'].'</td>
								<td>'.$rowProduct['size'].'</td>
								<td>'.$rowProduct['color'].'</td>
								<td>'.$rowProduct['quantity'].'</td>
								</tr>';
								
								
							}
							
							echo '</table>
							
							<td>'.$row['date_time'].'</td>';
							
							if($row['status']==0){
							echo '<td>&#10032 NEW</td>';
							echo '<td> <a title="Mark as completed" href="ordercomplete.php?oid='.$row['oid'].'&mid='.$row['mid'].'">&#10010 Mark as completed</a></td>';
							}if($row['status']==1){
							echo '<td><a >&#9989</a> COMPLETED</td>';
							}
							
							echo '</tr>';
							
							}
							


							mysqli_close($connection);
							?>

						</table>
					</div>
		</div>

		<script src="js/coreScript.js"></script>

	</body>
</html>