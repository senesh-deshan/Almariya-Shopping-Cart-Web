<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>account update | අල්මාරිය</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
</head><!--/head-->

<body style="background-color: #eee;">
	<br>
	<br>
	<br>
	<div class="container text-center">
		<div class="content-404">
			<img src="images/account/account_update.png" class="img-responsive" alt="" />
			
				
				<?php
session_start();

//print_r($_POST);

//print_r($_FILES);

if (!empty($_POST)){
	
	$host = "localhost";
	$dbusername = "root";
	$password = "";
	$dbname = "almariya";
	
	$cid=$_SESSION['cid'];
	
	$name ="  ";
	if (isset($_POST['name'])) {
	$name = $_POST['name'];
	}
	$address ="  ";
	if (isset($_POST['address'])) {
	$address = $_POST['address'];
	}
	$tel ="";
	if (isset($_POST['tel'])) {
	$tel = $_POST['tel'];
	}
	$file =null;
	if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name']!=null) {
	$file = addslashes(file_get_contents($_FILES['file']['tmp_name']));
	}
	
	//create connection
	$conn = new mysqli($host, $dbusername, $password, $dbname);
	
	if(mysqli_connect_error()){
		die('Connection Error ('.mysqli_connect_errno().')'.mysqli_connect_error());
	}
	else {
		$sql = "UPDATE consumer SET `name`='$name', `address`='$address', `tel`='$tel'";
		
		if($file!=null){
		$sql .= ",`image`='$file'";
		}
		
		$sql .=  " WHERE cid = '$cid'";
		
		//print_r($sql);
		
		if($conn -> query($sql)){
			echo "<h1><b>Your account is updated</b></h1>";
		}
		else{
			echo "Error: ".$sql ."<br>". $conn->error;
		}
		$conn->close();
	}
}
else {
	echo "<h1><b><font color='red'>Fields should not be empty!</font></b></h>";
	die();
}
//header('location: account.php');
?>

			
		</div>
	</div>

  
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
  
</body>
</html>


