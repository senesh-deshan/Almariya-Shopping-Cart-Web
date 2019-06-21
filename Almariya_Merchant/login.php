<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>අල්මාරිය Log In</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >


<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
	body {
		background-color: #ffffff;
	}
	
	button {
		background: #c55bfd;
    color: #ffffff;
	}

	.form-signin {
		max-width: 350px;
		padding: 15px;
		margin: 0 auto;
		vertical-align: middle;
	}
	.form-signin .form-signin-heading, .form-signin .checkbox {
		margin-bottom: 10px;
	}
	.form-signin .checkbox {
		font-weight: normal;
	}
	.form-signin .form-control {
		position: relative;
		height: auto;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		padding: 10px;
		font-size: 16px;
	}
	.form-signin .form-control:focus {
		z-index: 2;
	}
	.form-signin input[type="email"] {
		margin-bottom: -1px;
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0;
	}
	.form-signin input[type="password"] {
		margin-bottom: 10px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
	}
</style>

</head>

<body>

<div style="vertical-align: middle">
<center >
	<img style="padding-top: 100px" src="images/login/logo.png" width="20%"/>
	    <h3 class="form-signin-heading" style="color: #b4b1ab">Data Entry Interface</h3>
	    <h2 class="form-signin-heading" style="color: #b4b1ab">Please log in to continue</h2>
	    
</center>
<form class="form-signin" method="POST">
	<h5 id="warning" style="color: #ff0000; border: solid 1px red; padding: 5px; visibility: hidden">Please check your email address and password.</h5>
        <input type="email" name="email" class="form-control" placeholder="Email" required>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-block" type="submit">Log In</button>
</form>
</div>

<?php 
	session_start();
	require ('connect.php');
	
	if (isset($_POST['email']) and isset($_POST['password'])) {
		
		$email = $_POST['email'];
		$password = $_POST['password'];

		
		$query = "SELECT * FROM `merchant` WHERE email LIKE '$email' and password LIKE '$password'";

		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		$count = mysqli_num_rows($result);
		
		if ($count == 1) {
			while ($row = $result -> fetch_assoc()) {
				$_SESSION['email'] = $row['email'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['mid'] = $row['mid'];
			}
		} else {
				
			alert();
		}
	}
	
	if (isset($_SESSION['name'])) {
		$name = $_SESSION['name'];
		$email = $_SESSION['email'];
		echo "You have logged as " . $name . " ";
		echo "using " . $email . " ";
		echo "<a href='logout.php'>Logout</a>";
		header('Location: core.php');

	} else {
		
	}

	function alert() {
		echo '<script>
		
		document.getElementById("warning").style.visibility="visible";
		
		</script>';
	}
?>

</body>
</html>
