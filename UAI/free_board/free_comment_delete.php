<?php
    @session_start();
    extract($_GET);
	extract($_SESSION);
    include("../commons/data_conn.inc");
    $query = "select name, pid from free_comment where id='$id'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    list($name, $pid) = $row;
    if($row['name']!=$usr){
		echo "<script type=\"text/javascript\">alert('자신의 댓글만 지울 수 있습니다.');history.back();</script>";
    }
    else{
    	$result = mysqli_query($conn,"delete from free_comment where id='$id'") or die(mysqli_error($conn));
        $query = "update free_board set comment_count = comment_count - 1 where uid = '$pid'";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    	echo "<script type=\"text/javascript\">alert('댓글 삭제 완료');history.back();</script>";
    }
?>