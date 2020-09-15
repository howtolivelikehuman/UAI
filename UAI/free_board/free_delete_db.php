<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
		<?php
		include "config.cfg";
		include "../commons/functions.inc";
		include "../commons/data_conn.inc";

		$uid = $_GET['uid'];
		$page = $_GET['page'];
		$query = "select name, gid from free_board where uid='$uid'";
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		list($name,$gid) = mysqli_fetch_array($result);
		$id = $_SESSION['usr'];
		      if(!isset($key)||!isset($kind)){
        $key = NULL;
        $kind = NULL;
      }
/*
		if(strcmp($id, $name)) {
			error("Invalid User");
			exit;
		}
		*/

		$query = "delete from free_board where gid='$gid'";
		$result = mysqli_query($conn,$query);
		if($result){
            $msg = '';
		}
		else{
			mysqli_close($conn);
			echo "<br>failed";	
		}
		$query2 = "delete from free_comment where pid='$uid'";
		$result = mysqli_query($conn,$query2);
		if($result){
            $msg = '';
		}
		else{
			mysql_close($conn);
			$msg = 'failed';
		}
		$query3 = "update free_board set gid = gid -1 where gid > '$gid'";
		$result = mysqli_query($conn,$query3);
				if($result){
            $msg = '';
		}
		else{
			mysql_close($conn);
			$msg = 'failed';
		}
 
	if ($msg=='') {
    	$msg = "성공적으로 삭제되었습니다";
     echo " <html><head>
	<script name=javascript>
	if('$msg' != '') {
	self.window.alert('$msg');
	}
	location.href='".dest_url("./free_list.php",$page,$kind,$key)."';
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
