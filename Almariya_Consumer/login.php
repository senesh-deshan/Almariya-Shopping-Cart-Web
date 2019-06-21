<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Log In | අල්මාරිය</title>
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
	
	<?php
	session_start();
	
	$alertl=FALSE;
	$alertr=FALSE;

	
	if (isset($_SESSION['cid'])) {
		
		signedIn();

	} else {
		
	}
	
	
	require ('connect.php');
	
	if (isset($_POST['login'])){
	
	if (isset($_POST['email']) and isset($_POST['password'])) {
		
		$email = $_POST['email'];
		$password = $_POST['password'];

		
		$query = "SELECT * FROM `consumer` WHERE email LIKE '$email' and password LIKE '$password'";

		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		$count = mysqli_num_rows($result);
		
		if ($count == 1) {
			while ($row = $result -> fetch_assoc()) {
				$_SESSION['email'] = $row['email'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['cid'] = $row['cid'];
			}
			
			signedIn();
		} else {
				
			$alertl=TRUE;
		}
	}
	
	}
	
	if (isset($_POST['signup'])){
	
	if (isset($_POST['email']) and isset($_POST['password'])) {
		
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$image = '0x89504e470d0a1a0a0000000d49484452000000c8000000c808030000009a865eac00000033504c54450a304effffff8497a6f0f2f4193d5947647a667e91c2cbd3a3b1bce0e5e9294a64d1d8de38576f577186b2bec7768b9c93a4b15bbd16270000097249444154789ced9dd7b6ab3a0c45b3e924a1fcffd79e109a0d2e2acb9071c75d4ffbe19ce0892dc945328fbfff881e773700a5ff41e2caebbac93e1aca8fa63fb2a6aef3544f4b01d2d659553e1f1ebdcb614cc00306c9fbac2c7c08a68a32c3d20041f2bef27683a773861ef67414c86b7cf3205675630b690004e43530bbe2d03108163d482eed0b5365a335182d485de929be2aaad77d2079a31a524795cd3d20794672b41c3de5234c0c920063529109518420893066940b41d2614c7a4a6c4502d2434ddca5b2be00a42d53634caab8a6c206493baa7615ccf1c5047901a23855256be2c203c9aec3f8a8181381b41776c7ac8e6e290c90e622eb305590dd171d04353b648a1a1ea920d70fab55c4e1450479dd30ac56bd49f37b1a48731fc68368282490e1568e8f08c191027293999b8a9b7c1c24efeea69854a941f2dbdc95ad18490ce45738a2241190dfe1889184417e8923421206f9298e304910e407fcaead4106f2731ca1c8180019ef6eb54bde73083f487f779b9d2a7c33482fc89df3dd909e9e59bd0f244fbe772555c903f98909965b6ed7e501b976bb8429a7c1bb41eabbdb1a54e1daf07282fcae81cc72998913046420c5d0d775fd97d723f7dc3a26c73acb05828920f6e140db4061ced1c401922322886b0ffa35c258de1410c4c01a3c614b7922bfeb34b8ce20008f15dcbf01b11c3dd70904e0b1cad8de6003382b3a7aae13883e1446373c2614fdeb3a84c52348abb6740ac7a7e3d59b7e87d9e31144bd98a2717c546b5f996def0710b5a59339f4c77885d5250710ad15be3987b1da3d1aeba5d920da0ef1aedf3c7da21c5da60bb641b41dc2cdbe50be38b34b1ec0df7d3c991cea030ba34b2c106d87f0734894f33aa34b4c90eb3b441d7f77df6282686348601fd0ab5cf7c8dd280d9056c9e1582410a49b6b172e10eda4a17034332ee539eb6696068876cae0d9708a48390eb615d60ea23e8266cc4e4c29dfdf3a9e7710f51a41968ba87deefafa3610b5a9df04b25ae606a23f441082685772fd0144bf64bb09a4b3415e6a8ebb4096e8fe40fddc7d20bd050238bf1582a8b7d12a1344efb3a40151eff60b130491902504d18f85da00416c934a66f1530bd4ca0c10c8c9a78803e02edf3b08e0d71ee7ed589210833adf4030b901fc12833f4c9a61bf81608ea83819e09b10793bd90682490e100512c483cb150411451e924d1410c86305c11c1aca16569054dcd70282490f9095ab29b75166f50b08c4d685811d32b6b2050472a8772748b980207ecb71627c1dc87b06c1c475616926c663ce20a0141a59f533e6e1ed170494d324ab7dc63cbc4682c8e208a63cb3f98280928164eb11ccb3b32f08aa6655328d07e5b262413a0108e8d9e517049618cb377754eee40c02fa31c1090964a235090cc2b6125812281a847b830e2e2b170cc23d0ec5d5f883419813479889c0419846022c884083f01c3030011f0dc21a5bc0910507618d2d6425011c84310586244aaf828314f4bd14640d570107a16f37423b041dd91f9ee20e97a0b5363308b626826825a06dda4525743db28876ba807d689702c4576067095cad39af10d1a5ac84c105da4adb942177517645272af022aefe0b022fca8de531e3cbe46be44ea3a1880fc69765e75f10ac27fc2a98239fa0bc1cb91b6febeded933cc1d56fcb6e7c921b117c7692e436a50e79627594fb12b93e497579063d43dcb4b6f57ca1549ba8287b3d43c4baade2b5d6851ceef3dcafdbacc0fdd22e20c835e7d7385e6bc02b86cd54facd59153df876c16987733e300306dad9c80dd7f4ecbe57aeefffe2ebd0a0572b751b08ceb36f972b7aed6e5d79d53837bce7a2a06e34333d95fbaa50e316c91ce663ea0d0433193dded57b7ee79dbd56694123e16f03411889ebca61abc0d87519798bf05fa501a27e354fdfcdc9af26abca8fbd7befed6fd4663f1a204a23515dcbfd972baba95f068826923c07fdfdf56d261fdcf369f29a78217d274585fa3c82b85bac4c6cd92a1147f1d54b66a9766ebc6071d54129beca1bfed4653981dd727ab8bfd0613e5271123be05707109edf7a8a727c691a79a1a53e80b0fc16e3666481588bc83503664f1763589ab0508f2cced4789d83ee20f4934949ce099384de27aba91a097cd490c438cb118b3c8bdd5eaa01420d25a21478aea8037d0b010608f1084958efc214bb31fc7a76d5fc902e5aaaf9de18138414ddafe91062630af70d03a42e1116e9f1c56c8c0542790b896626671136db4cff69e74fc7df42fa18b2291e0eccd16183c4bbe422539f1435772ba01d32da635d22bbd741a66850b4ccf50012eb920b4756746c3d43b739c536e62f1c59d1b165b7e5081289a8174cb37685fdd62135ec54f5115c60498b5d840a821c9676e7f295d0525372a98e42a165c9714d740609390bfc76435081f9f8692de128280ad8fba526123492d32b755546799767179b48c048ce61c005e21d5c179b88df5e1d8b5467ad9a6f705d1a4526f92289c356dd45779ec1a5fbaaa7409e58e0dac57183782e024ddb6a87dc83dc99d9e6699c736f485ac4aa107d60f8deb26b74a6de9773c865ed6e4bf50e17c74f5cb6cadde55856785ea717c491ad9770e3daa7b3fff4c532bf019f2f1abddc693962bb378535e0894e069fa4a9611ddd963f5b32d4ba8317bf7c8232893cba83afd91ea13778dfe3723730b5088f17cb695c3ed39a541239222016c90dded76e4070aa17b360e3872e5e55cdca881c511083e48630622e122353efb84fdd486e08234620892d2108c1619d76411ac6554de4a080acf1e4f265d5a4793c1471fb24bde7e5d3c0ec2f74abb5e478526e71a70d9865de45fb302c4ef51c0efd79f68688237f39f8e67e6b5ca7c5f5d2d22ca8269c579c5f4568cd5225c661ba2f5a0c856077102da935e4af68339cea9a069e2ac1c97ad6d21df48fcd73a2c3faf113d607e025da529b19d33b5e985bab3fde49a72beb776f584e9219afb704247a9f73b5a5d0f166dbec8947bd2e75aa24285b463d3766f167507b6e3e1e654b96e79ba1642ab817186151f6bc4cdf87c90292cd69f74796b0b0b267ca8aec4f3a39efb75d816706e89676d876d14a994794af328c8f83758d6ae262a62d0b31342056ae7151495972b3eca293c727ddbacfca66ef1c852eb1ff3f1a474a85ca756817b0b9f5b1c667d590ddff6becccdde5b76e78aa413eaaedf2a2a2ccfa084ddd0cf6a9c573502fd9305b0afda954ea5d0e595fdb433eafeb261bcae37905a67803b637d2fb3f3cf92c4b6faace5bdf17b3909b3cdc2fb5bec5aece21f46e55db67fed76f7452e72f839329c9b65b5e8f9967381565973529563369f70feb8fc6ecab71fa3be1a3fe01cdf46bcdbea0b99f0000000049454e44ae426082';
		
		$query = "SELECT * FROM `consumer` WHERE email LIKE '$email'";

		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		$count = mysqli_num_rows($result);

		if ($count == 0) {
			
		$query = "SELECT SUBSTRING(cid,4) AS preid FROM `consumer` ORDER BY cid DESC LIMIT 1";

		$resultPre = mysqli_query($connection, $query) or die(mysqli_error($connection));
		$countPre = mysqli_num_rows($resultPre);
		
		if ($countPre == 1) {
			while ($rowPre = $resultPre -> fetch_assoc()) {
				
			$nextid=$rowPre['preid']+1;
				
			$_SESSION['cid'] = "CON$nextid";
			
		$query = "INSERT INTO `consumer`(`cid`, `email`, `password`, `image`) VALUES (CONCAT('CON','$nextid'),'$email','$password',$image)";

		$resultNew = mysqli_query($connection, $query) or die(mysqli_error($connection));
			
			}
		}else{

		$query = "INSERT INTO `consumer`(`cid`, `email`, `password`, `image`) VALUES (CONCAT('CON','1'),'$email','$password',$image)";

		$resultNew = mysqli_query($connection, $query) or die(mysqli_error($connection));
		}
		
		
			
			signedUp();
		} else {
				
			$alertr=TRUE;
		}
	}
	
	}
	
	function signedIn()
	{
		header('Location: index.php');
	}
	
	function signedUp()
	{
		header('Location: account.php');
	}
	
	?>
	
	
	<header id="header"><!--header-->
		
		
	
	<?php
	
	if (!isset($_SESSION['name'])) {
		
		if (isset($_GET['source'])) {
			
			if ($_GET['source']=="cart") {
		
		echo "<center>
	<h2><font color=red>Please log in to view your cart!!!</font></h2>
	</center>";
	
			}if ($_GET['source']=="favourite") {
		
		echo "<center>
	<h2><font color=red>Please log in to view your favourites!!!</font></h2>
	</center>";
	
			}if ($_GET['source']=="checkout") {
		
		echo "<center>
	<h2><font color=red>Please log in to proceed to checkout!!!</font></h2>
	</center>";
	
			}
			
		}
	}
	
	?>
	
	<br>
	<br>
	<br>
	
	<section id="form"><!--form-->
		
		<div class="container">
			<div class="row">
				
				<img src="images/login/lock_small.png" class="col-sm-4 img-responsive" style=" max-width: 35%;" alt="" />
				
				<div class="col-sm-4">
					<div class="login-form"><!--login form-->
						<center><h2>Log in to your account</h2></center>
						<form method="POST">
							<h5 id="warningl" style="color: #ff0000; border: solid 1px red; padding: 5px; visibility: hidden">Please check your email address and password.</h5>
							<input type="email" name="email" placeholder="Email" />
							<input type="password" name="password" placeholder="Password" />
							<input type="hidden" name="login" value="true" />
							<center><button type="submit" class="btn btn-default">Log In</button></center>
						</form>
					</div><!--/login form-->
				</div>
				
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<center><h2>New user sign up!</h2></center>
						<form method="POST">
							<h5 id="warningr" style="color: #ff0000; border: solid 1px red; padding: 5px; visibility: hidden">Please check your email address and password.</h5>
							<input type="email" name="email" placeholder="Email Address"/>
							<input type="password" name="password" placeholder="Password"/>
							<input type="hidden" name="signup" value="true" />
							<center><button type="submit" class="btn btn-default">Sign Up</button></center>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
	

<?php 
	
		if($alertl) {
		echo '<script>
		document.getElementById("warningl").style.visibility="visible";
		document.getElementById("warningr").style.visibility="hidden";
		</script>';
		}
		
		if($alertr) {
		echo '<script>
		document.getElementById("warningl").style.visibility="hidden";
		document.getElementById("warningr").style.visibility="visible";
		</script>';
		}
?>


<br>
<br>
<br>
<br>



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

</body>
</html>