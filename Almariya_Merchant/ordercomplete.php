<?php

require ('connect.php');

$oid = $_GET['oid'];
$mid = $_GET['mid'];

$query = "UPDATE `order` SET `status`=1 WHERE oid='$oid' AND mid='$mid'";

						$result = mysqli_query($connection, $query) or die(mysqli_error($connection));	


header('Location: order.php');
?>