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
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" 
href="../bootstrap.css">
<link rel="stylesheet" href="./style.css">
	<title>자유게시판</title>
</head>
<body>
		<?php
    include '../commons/navbar.php';
			extract($_POST);
			extract($_GET);
      if(!isset($key)||!isset($kind)){
        $key = NULL;
        $kind = NULL;
      }
			include("./config.cfg");
			include("../commons/functions.inc");
			include("../commons/data_conn.inc");


			$query = "SELECT gid, name, subject, article, writedate, refnum FROM free_board WHERE uid='$uid'";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

			list($gid, $name, $subject, $article, $writedate, $refnum) = mysqli_fetch_array($result);

			$subject = htmlspecialchars($subject);

			if(!$tag_enable){
				$article=htmlspecialchars($article);
			}
			$article = nl2br($article);
		 ?>
	<div id="container">
		<table class="table table-striped table-bordered">
            <thead> 
            	<tr>
            		<th width="10%">글쓴이</th>
            		<td colspan= "3" width="40%"><?=$name?></td>
            		<th width="10%">날짜</th>
            		<td colspan="3" width="40%"><?=$writedate?></td>
            	</tr>
            	<tr>
            		<th>제목</th>
            		<td colspan= "3"><?=$subject?></td>
            		<th>조회 수</th>
            		<td colspan="3"><?=$refnum?></td>
              	</tr>
              	<tr height="200" valign="top">
              		<td colspan="8"><?=$article?>
              		</td>
              	</tr>
              	<tr>
              		<td colspan="8" align="right">
              			<a  class = "btn btn-default" href="<?=dest_url_uid("./free_edit.php",$page,$uid,$kind,$key)?>">수정</a>
              			<button  class = "btn btn-default" onclick="deletetext();">삭제</button>
						<a  class = "btn btn-default" href="<?=dest_url("./free_list.php",$page,$kind,$key)?>">목록</a>
					</td>
              	</tr>
              	<tr>
              		<td colspan="8">
              			댓글 목록
              		</td>
              	</tr>
              	<?php
              	    $query = "SELECT id, name, comment, pid, writedate FROM free_comment WHERE pid='$uid'";
    $result = mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($result)){
        $comment = $row['comment'];
        $name = $row['name'];
        $date = bcdiv($row['writedate'] , 1000000);
        $time = bcmod($row['writedate'] , 1000000);
	      $id = $row['id'];	
        $year = (int)($date/10000);
        $month = (int)(($date % 10000) / 100);
        $day = ($date % 100);
        $hour = (int)($time/10000);
        $minute = (int)(($time % 10000) / 100);
        $second = ($time % 100);
              	?>
              	<tr>
        <td colspan="5">
            <?=$name?>&nbsp;&nbsp;:&nbsp;&nbsp; <?=$comment?>
        </td>
        <td colspan="2">
          <?=$year."/".$month."/".$day." ".$hour.":".$minute.":".$second?>
        </td>
        <td>
            <a class= "btn btn-default" href="./free_comment_delete.php?id=<?=$id?>">x</a>
        </td>
        </tr>
        <?php } ?>
            <tr>
        <form method="post" action="./free_comment_insert.php?pid=<?=$uid?>">
            <td colspan="7">
                <input type="text" name="comment" style="width: 100%;">
            </td>
            <td>
                <input type="submit" value="작성">
            </td>
	</form>
    </tr>
              </thead>
              </table>
          </div>
<?php include("../commons/footer.php"); ?>

	<script type="text/javascript">
		function deletetext(){
			if (confirm("정말 삭제 하시겠습니까?") == true) {
				window.location.href = '<?=dest_url_uid("./free_delete_db.php",$page,$uid,$kind,$key)?>';
			}
			else{
				alert("취소 되었습니다.");
				return;
			}
		}
	</script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>