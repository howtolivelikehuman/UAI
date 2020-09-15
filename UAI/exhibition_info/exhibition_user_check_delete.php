<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<?php
	extract($_GET);
	include '../commons/data_conn.inc';
	$query = "select up_filename from board where uid='$uid'";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	list($up_filename) = mysqli_fetch_array($result);
	$query = "delete from board where uid='$uid'";
	if($result = mysqli_query($conn,$query) or die(mysqli_error($conn))){
		unlink("./pictures/".$up_filename);
		echo " <html><head>
			<script name=javascript>
			self.window.alert('성공');
			location.href='./exhibition_user_check_list.php';
			</script>
			</head>
			</html> ";
	}
?>
</body>
</html>
