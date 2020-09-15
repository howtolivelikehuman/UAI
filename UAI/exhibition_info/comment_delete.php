<?php
    @session_start();
    extract($_SESSION);
    extract($_GET);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<?php
    include("../commons/data_conn.inc");
    $query = "select name from comment where id='$id'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    if($row['name']!=$usr){
        echo "<script type=\"text/javascript\">alert('자신의 댓글만 지울 수 있습니다.');history.back();</script>";
    }
    else{
        $result = mysqli_query($conn,"delete from comment where id='$id'") or die(mysqli_error($conn));
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
        echo "<script type=\"text/javascript\">history.back();</script>";
    }
?>
</body>
</html>
