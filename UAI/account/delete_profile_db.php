<?php
session_start();
$id = $_SESSION['usr'];
include "../commons/functions.inc";
include "../commons/data_conn.inc";
extract($_POST);

 $query="select pw from account where id='$id'";
 $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
 list($pw) = mysqli_fetch_array($result);

 echo "<html>
<head>
<script name = javascript>
var test= confirm('정말 탈퇴하시겠습니까?');
if(test==false)
{
	document.write('회원탈퇴를 취소하겠습니다.');
	window.location.href='./delete_profile.php';
}
</script>
</head>
</html>";

 
 if(strcmp($lastpw, $pw))
 {
 	$msg = "기존의 비밀번호와 일치하지 않습니다.";
 	echo " <html><head>
		<script name=javascript>
		self.window.alert('$msg');
		window.location.href='./delete_profile.php';
		</script>
		</head>
		</html> ";
		exit;
 }
else{
 $query="delete from account where id='$id'"; 
	mysqli_query($conn,$query) or die (mysqli_error($conn));
 $query="delete from mypage where name='$id'";
	mysqli_query($conn,$query) or die (mysqli_error($conn));
	mysqli_close($conn);
	session_destroy();
	$msg = "회원탈퇴를 완료하였습니다.";
 	echo " <html><head>
		<script name=javascript>
		self.window.alert('$msg');
		window.location.href='../main.php';
		</script>
		</head>
		</html> ";
}
?>

