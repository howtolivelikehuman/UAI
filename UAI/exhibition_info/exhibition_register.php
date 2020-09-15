<?php
session_Start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<?php
		include("../commons/navbar.php");
		if(!isset($_SESSION['is_usrloggedin'])){
			$_SESSION['is_usrloggedin'] = false;
			echo("not logged in");
		}
		include ("../commons/data_conn.inc");
		extract($_POST);
		extract($_SESSION);

		$name = addslashes($name);
		$place = addslashes($place);
		$info = addslashes($info);
		$is_checked = false;
		$is_accepted = false;
//file upload
		$img_dir = $_SERVER['DOCUMENT_ROOT']."/project/exhibition_info/pictures"; //저장 디렉토리
		$img_tmp = $_FILES['upfile']['tmp_name']; //임시 파일명
		$img_type = $_FILES['upfile']['type']; //저장가능 이미지 타입
		$img_name = $_FILES['upfile']['name']; //파일명(ex: xxxx.jpg)
 
		$filename = explode(".",$img_name); //파일명 및 확장자를 분리한 배열
		$extension = strtoupper($filename[sizeof($filename)-1]); //확장자 추출

 
// 기존의 파일과 이름이 같을 경우 filename 을 2_filename 과 같이 rename
		$now_count = 0;
		$echo_now_count = "";
		$original_file_name = $img_name;
 
		while( 1 ){
    		$up_filename = $echo_now_count.$original_file_name; // 파일이름 변경
    		if(!file_exists("$img_dir/$up_filename")) break;
      
   	 		if($now_count) $now_count++;
        	else $now_count=2;
    		$echo_now_count = $now_count."_";
		}
 
		$save_name = $img_dir."/".$up_filename; //copy시 전체경로 및 파일명
 
		if(copy($img_tmp, $save_name)) { //파일 업로드
    		unlink($img_tmp); //임시파일삭제
		}
		else {
   			unlink($img_tmp);
    		echo("script will be here.");
    		exit;
		}
//SQL 명령을 이용해 입력받은 내용MySQL에 입력
		$sql = "INSERT into board (usr,name,place,start_date,fin_date,info,save_name,up_filename,is_checked,is_accepted)";
		$sql .= "values('$usr','$name','$place','$start_date','$fin_date','$info','$save_name','$up_filename','$is_checked','$is_accepted')";

		$result = mysqli_query($conn,$sql);
		if($result){
			mysqli_close($conn);
			$msg = "전시회 업로드 신청이 완료되었습니다.";
			echo " <html><head>
			<script name=javascript>
			self.window.alert('$msg');
			location.href='./exhibition_list.php?';
			</script>
			</head>
			</html> ";
		}
		else{
			mysqli_close($conn);
			$msg = "전시회 업로드 신청이 실패하였습니다.";
			echo " <html><head>
			<script name=javascript>
			self.window.alert('$msg');
			location.href='./exhibition_list.php?';
			</script>
			</head>
			</html> ";
		}
	include("../commons/footer.php");
	?>
</body>
</html>