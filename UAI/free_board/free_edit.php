<?php
session_start();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" 
href="../bootstrap.css">
<meta charset="utf-8">
<link rel="stylesheet" href="./style.css">
</head>
<body>
<?PHP
include "../commons/navbar.php";
include "../commons/functions.inc";
include "../commons/data_conn.inc";
$id = $_SESSION['usr'];
extract($_GET);
extract($_POST);
?>
<?PHP
$query="select name, subject, article from free_board where uid='$uid'";
$result=mysqli_query($conn,$query) or die(mysqli_error($conn));
list($name, $subject, $article)=mysqli_fetch_array($result);
              if(!isset($key)||!isset($kind)){
        $key = NULL;
        $kind = NULL;
      }
if($name != $id){
    error("작성자가 아닙니다.");
    exit;
}
mysqli_close($conn);
?>
<form name="edit_form" method="post" action="<?=dest_url_uid("./free_edit_db.php",$page,$uid,$kind,$key)?>">
<div id="container">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="30%">글쓴이</th>
                    <td width="70%"><?=$name?></td>
                </tr>
                <tr>
                    <th >제목</th>
                    <td>
                        <input type="text" name="subject" value="<?=$subject?>" class = "form-control">
                    </td>
                </tr>
                 <tr>
                    <th style = "vertical-align : top">내용</th>
                    <td>
                        <textarea class="form-control" name="article" rows="20"
                        style="text-align: left">
                        <?=$article?>      
                        </textarea>
                    </td>
                </tr>
            </thead>
    </table>
<div class="container" role="group" aria-label = "...">
<a class = "btn btn-default pull-right" href="javascript:history.back()">취소</a>
<input type="submit"  class = "btn btn-default pull-right" value="수정">
<a class = "btn btn-default pull-right" href="<?=dest_url("./free_list.php",$page,$kind,$key)?>">목록</a>
</div>
</div>
</form>
<?php include("../commons/footer.php"); ?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>