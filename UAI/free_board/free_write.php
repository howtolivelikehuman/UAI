<?php
session_start();
if(!isset($_SESSION['is_usrloggedin']) || !isset($_SESSION['usr'])){
        $msg = "로그인을 하고 이용해주세요";
        echo " <html><head>
        <script name=javascript>
        self.window.alert('$msg');
        location.href='http://localhost/project/account/login.php';
        </script>
        </head>
        </html> ";
    }   
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" 
    href="../bootstrap.css">
    <meta charset="utf-8">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <?php 
include("../commons/navbar.php");
include("../commons/functions.inc");


extract($_GET);
if(!isset($key)||!isset($kind)){
    $key = NULL;
    $kind = NULL;
}
?>
<form name="write_form" method="post" action="free_write_db.php">
<div id="container">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="30%">글쓴이</th>
                    <td width="70%"><?=$usr?></td>
                </tr>
                <tr>
                    <th>제목</th>
                    <td>
                        <input type="text" name="subject" class = "form-control">
                    </td>
                </tr>
                <tr>
                    <th style = "vertical-align : top"> 내용</th>
                    <td>
                        <textarea class="form-control" name="article" rows="20">
                        </textarea>
                    </td>
                </tr>
            </thead>
    </table>
<div class="container">
<a class = "btn btn-default pull-right" href="./free_list.php">목록</a>
<input type="submit"  class = "btn btn-default pull-right" value="입력">
</div>
</div>
</form>
<?php include"../commons/footer.php"; ?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>