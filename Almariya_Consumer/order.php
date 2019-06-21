<?php
print_r($_GET);

session_start();

				$con = mysqli_connect("localhost", "root", "", "almariya");
				// Check connection
					if (mysqli_connect_errno()) {
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}
				
				$cid=$_SESSION['cid'];
				
				$fname=$_GET['fname'];
				$mname=$_GET['mname'];
				$lname=$_GET['lname'];
				$tel=$_GET['tel'];
				$address1=$_GET['address1'];
				$address2=$_GET['address2'];
				$city=$_GET['city'];
				$zip=$_GET['zip'];
				
				$nextid = 1;
				
				
				$query = "SELECT SUBSTRING(oid,4) AS preid FROM `order` ORDER BY cid DESC LIMIT 1";

		$resultPre = mysqli_query($con, $query) or die(mysqli_error($connection));
		$countPre = mysqli_num_rows($resultPre);
		
		if ($countPre == 1) {
			while ($rowPre = $resultPre -> fetch_assoc()) {
				
			$nextid=$rowPre['preid']+1;
				
			}
		}
		
				
				$result = mysqli_query($con, "SELECT * FROM cart WHERE cid LIKE '$cid'");

				while ($row = mysqli_fetch_array($result)) {
								
						$pid = $row['pid'];
						$color = $row['color'];
						$qty = $row['quantity'];
			
						$resultProduct = mysqli_query($con, "SELECT * FROM product LEFT JOIN image ON product.pid=image.pid WHERE product.pid LIKE '$pid' AND color LIKE '$color'");

						while ($rowProduct = mysqli_fetch_array($resultProduct)) {
						
						$mid = $rowProduct['pmid'];
						$size = "SIZE";
						
						$query = "INSERT INTO `order`(`oid`, `cid`, `mid`, `pid`, `size`, `color`, `quantity`, `date_time`, `status`) VALUES (CONCAT('ORD','$nextid'),'$cid','$mid','$pid','$size','$color','$qty',NOW(),0)"; 
						
						print_r($query);
							mysqli_query($con,$query);
								
						}
								
				}
				 
				
				//$result = mysqli_query($con, "UPDATE `consumer` SET `cid`=$cid,`name`=CONCAT($fname,' ',$mname,' ',$lname),`tel`=$tel,`address`=CONCAT($address1,' ',$address2,' ',$city,' ',$zip) WHERE cid='$cid'");

				//while ($row = mysqli_fetch_array($result)) {
						
				//}
				
				header('Location: thanks.php');

?>