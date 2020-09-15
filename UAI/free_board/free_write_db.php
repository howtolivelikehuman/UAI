<?php 
	session_start();
	$id = $_SESSION['usr'];
?>
<html>
<head>
	<meta charset="utf-8">
	<title>자유게시판 입력</title>
</head>
<body>
<?php
	extract($_POST);
	extract($_GET);
	include "config.cfg";
	include "../commons/functions.inc";
	include "../commons/data_conn.inc";
	$writedate = date("Y-m-d");
	$article = trim($article);

	if(!$id||!$subject||!$article){
		//error("입력값이 부족합니다.");
		//exit;
	}

	$query = "select MAX( gid ) as gid from free_board";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	$gid = current(mysqli_fetch_array($result));
	$gid = $gid +1;

	$query = "insert into free_board (gid, name,subject, article, writedate) 
					values ($gid, '$id','$subject', '$article', '$writedate')";
	$result = mysqli_query($conn,$query);
		if($result){
			mysqli_close($conn);
            $msg = '';
		}
		else{
			mysqli_close($conn);
			echo "<br>failed";	
		}
	if ($msg=='') {
    	$msg = "성공적으로 등록되었습니다";
     	echo " <html><head>
		<script name=javascript>
		if('$msg' != '') {
		self.window.alert('$msg');
		}
		location.href='./free_list.php?';
		</script>
		</head>
		</html> ";

	} else {
     	echo " <html><head>
		<script name=javascript>
		if('$msg' != '') {
		self.window.alert('$msg');
		}
		history.go(-1);
		</script>
		</head>
		</html> ";
	}
 ?>
</body>
</html>
