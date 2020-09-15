<?php
    @session_start();
    extract($_POST);
    extract($_GET);
    extract($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<?php
    if(!trim($comment)){
        echo "<script type=\"text/javascript\">window.alert('내용을 입력하세요.');history.back();</script>";
    }
    else{
        include("../commons/data_conn.inc");
        $commet = htmlspecialchars($comment);
        $now = date('Y').date('m').date('d').date('H').date('i').date('s');
        $query = "INSERT into comment (pid,name,comment,writedate) VALUES ('$pid','$usr','$comment',$now)";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
        echo "<script type=\"text/javascript\">history.back();</script>";
    }
?>
</body>
</html>
