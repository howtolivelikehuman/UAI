<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<?php
	extract($_POST);
	include("../commons/data_conn.inc");
	$query = "update board set is_checked='1' where uid='$uid'";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	$query = "update board set is_accepted='1' where uid='$uid'";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	if($result){
			mysqli_close($conn);
			$msg = "전시회 승인이 완료되었습니다.";
			echo " <html><head>
			<script name=javascript>
			self.window.alert('$msg');
			location.href='./exhibition_admin_check_list.php?';
			</script>
			</head>
			</html> ";
		}
		else{
			mysqli_close($conn);
			$msg = "전시회 승인이 실패하였습니다.";
			echo " <html><head>
			<script name=javascript>
			self.window.alert('$msg');
			location.href='./exhibition_admin_check_list.php?';
			</script>
			</head>
			</html> ";
		}
?>
</body>
</html>
