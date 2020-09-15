<?php 
	$host = 'localhost';
	$user = 'root';
	$pw = 'apmsetup';
	$dbName = 'myservice';
	$conn = mysqli_connect($host, $user, $pw, $dbName) or die(mysqli_connect_error());

	mysqli_query($conn,"set session character_set_connection=utf8;") or die(mysqli_error($conn));
	mysqli_query($conn,"set session character_set_results=utf8;") or die(mysqli_error($conn));
	mysqli_query($conn,"set session character_set_client=utf8;") or die(mysqli_error($conn));
?>