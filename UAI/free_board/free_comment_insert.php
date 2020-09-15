<?php
    @session_start();
    extract($_POST);
    extract($_GET);
    extract($_SESSION);
    if(!trim($comment)){
        echo "<script type=\"text/javascript\">window.alert('내용을 입력하세요.');history.back();</script>";
    }
    else{
        include("../commons/data_conn.inc");
        strtr($comment,array("<"=>"&lt",">"=>"&gt"));
        $now = date('Y').date('m').date('d').date('H').date('i').date('s');
        $query = "INSERT into free_comment (pid,name,comment,writedate) VALUES ('$pid','$usr','$comment',$now)";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

        $query = "update free_board set comment_count = comment_count + 1 where uid = '$pid'";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
        echo "<script type=\"text/javascript\">history.back();</script>";
    }
?>