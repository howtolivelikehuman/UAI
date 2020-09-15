<?php
session_start();
$id = $_SESSION['usr'];
?>
<html>
<head> <meta charset = "utf-8"></head>
<body>
<?php
include ("./commons/data_conn.inc");
include( "./commons/functions.inc");
extract($_POST);
extract($_GET);

$query = "SELECT pageid FROM mypage where name = '$id'";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$count=mysqli_num_rows($result);

		for ($i=0; $i<$count; $i++) {
			list($pageid) = mysqli_fetch_array($result);
			//이미 저장된 것이면
			if($pageid == $uid){ 
				error("이미 저장 됨");
				exit;
    		 }

		}


//이미 저장 된 것이 아니면 SQL 명령을 이용해 이 페이지의 정보를 서버에 저장.
$sql = "INSERT into mypage (pageid,name,subject,my_date,place,start_date,fin_date)";
$sql .= "values('$uid','$id','$name','$my_date','$place','$start_date','$fin_date')";

$result = mysqli_query($conn, $sql);
		if($result){
			mysqli_close($conn);
            $msg == '';
		}
		else{
			mysqli_close($conn);
			echo "<br>failed";	
		}


//관심 완료시 다시 리스트로
 
if ($msg=='') {
    $msg = "관심 표시 성공";
     echo " <html><head>
<script name=javascript>
if('$msg' != '') {
self.window.alert('$msg');
}
history.go(-1);
</script>
</head>
</html> ";

}  else {
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
