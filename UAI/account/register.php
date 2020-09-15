<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register</title>
</head>
<body>
	<script type="text/javascript">
		function signin_success(){
			alert("회원 가입이 완료되었습니다.\n메일로 전송된 링크를 클릭해 이메일 인증을 해주세요.");
			window.location.replace("./login.php");		
		}
		function signin_failure(){
			alert("이미 사용중인 아이디입니다.");
			window.history.back();
		}
		function signin_error(){
			alert("회원 가입에 실패했습니다. 관리자에게 문의해주세요.\n관리자 메일 : gcvzkf3888@gmail.com");
			window.location.replace("./sign_up.html");
		}
	</script>
	<?php 
		include("../commons/data_conn.inc");
		extract($_POST);
		$confirmed = false;
		$isadmin = false;

		$query = "select count(case when id='$id' then 1 end) sameid from account";
		$result = mysqli_query($conn,$query);
		$sameid = current(mysqli_fetch_array($result));
		if(!$sameid){
			print("<script>signin_success()</script>");
			$query = "INSERT into account (id, name, pw, gender, byear, bmonth, bdate, email, isadmin) values ('$id','$name','$pw','$gender','$byear','$bmonth','$bdate','$email','$isadmin')";
			if(!($result = mysqli_query($conn,$query) or die(mysqli_error($conn)))){
				print("<script>signin_error()</script>");
			}
		}
		else{
			print("<script>signin_failure()</script>");
		}
	 ?>
</body>
</html>