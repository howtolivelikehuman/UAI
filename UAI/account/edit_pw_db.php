<?php
session_start();
$id = $_SESSION['usr'];
include "../commons/functions.inc";
include "../commons/data_conn.inc";
extract($_POST);

 $query="select pw from account where id='$id'";
 $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
 list($pw) = mysqli_fetch_array($result);
 if(strcmp($lastpw, $pw))
 {
 	$msg = "기존의 비밀번호와 일치하지 않습니다.";
 	echo " <html><head>
		<script name=javascript>
		self.window.alert('$msg');
		history.go(-1);;
		</script>
		</head>
		</html> ";
		exit;
 }


 $query="update account set pw='$newpw' where id='$id'"; 
	mysqli_query($conn,$query) or die (mysqli_error($conn));
	mysqli_close($conn);

	forward(dest_url_uid("./edit_pw.php",$page,$uid,$kind,$key));
?>

