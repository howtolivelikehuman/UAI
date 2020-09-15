<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<?php
session_start();
extract($_POST);
$id = $_SESSION['usr'];
include "../commons/functions.inc";
include "../commons/data_conn.inc";
$query="update account set name='$name', byear='$byear', bmonth='$bmonth', bdate='$bdate',email='$email' where id='$id'"; 
mysqli_query($conn,$query) or die (mysqli_error($conn));
forward(dest_url_uid("./edit_profile.php",$page,$uid,$kind,$key));
?>
</body>
</html>