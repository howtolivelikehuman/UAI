<?php @session_start();
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
	<title><?=$name?></title>
	
</head>
<body>
	<?php include("../commons/navbar.php");
	extract($_GET);
	include("../commons/data_conn.inc");
	include("../commons/functions.inc");
	$query = "select name, place, start_date, fin_date, info, up_filename from board where uid='$uid'";
	$result = mysqli_query($conn,$query);
	list($name,$place,$start_date,$fin_date,$info,$up_filename) = mysqli_fetch_array($result);
	$place = htmlspecialchars($place);
	$info = htmlspecialchars($info);
	$start_year = $start_date/10000;
	settype($start_year,'int');
	$start_month = ($start_date - $start_year * 10000) / 100;
	settype($start_month,'int');
	if($start_month < 10){
		$start_month = "0".$start_month;
	}
	$start_day = ($start_date - ($start_year * 10000) - ($start_month * 100));
	if($start_day < 10){
		$start_day = "0".$start_day;
	}
	$fin_year = $fin_date/10000;
	settype($fin_year,'int');
	$fin_month = ($fin_date - $fin_year * 10000) / 100;
	settype($fin_month,'int');
	if($fin_month < 10){
		$fin_month = "0".$fin_month;
	}
	$fin_day = ($fin_date - ($fin_year * 10000) - ($fin_month * 100));
	if($fin_day < 10){
		$fin_day = "0".$fin_day;
	}
	$period = $start_year."/".$start_month."/".$start_day." ~ ".$fin_year."/".$fin_month."/".$fin_day;
	$img_link = "http://localhost/project/exhibition_info/pictures/".$up_filename;
		if(!isset($key)||!isset($kind)){
		$key = NULL;
		$kind = NULL;
	}

		if(!isset($my_date)){
		$my_date = $start_date;
	}
?>
	<div id="container">
	<table class = "table table-striped table-bordered">
		<thead>
			<tr>
				<th width="10%" colspan="2">전시 제목</th>
				<td   colspan="6"><?=$name?></td>
			</tr>
			<tr>
				<th  colspan="2">전시 장소</th>
            	<td  colspan="6"><?=$place?></td>
			</tr>
			<tr>
				<th   colspan="2">전시 기간</th>
            	<td  colspan="6"><?=$period?></td>
			</tr>
			<tr height="300" valign="top">
				<td id = "imgclass" colspan="2">
					<img src="<?=$img_link?>" width = "300px" height = "400px">
					<br>
				</td>
				<td colspan="6"><?=$info?></td>	
			</tr>
			<tr>
				<td colspan="8">
					<form method="post" action ="<?=dest_url("../cart.php",$page,$kind,$key)?>">
					<a class = "libtn btn btn-default" href="./exhibition_list.php">목록 </a>
					<input type="hidden" name="uid" value="<?=$uid?>">
					<input type="hidden" name="name" value="<?=$name?>">
					<input type="hidden" name="my_date" value="<?=$my_date?>">
					<input type="hidden" name="place" value="<?=$place?>">
					<input type="hidden" name="start_date" value="<?=$start_date?>">
					<input type="hidden" name="fin_date" value="<?=$fin_date?>">
					<input class = "libtn btn btn-default" type="submit" value="관심"></form>
					<?php if ($_SESSION['is_admin']) { ?>
						<a class = "libtn btn btn-default" href="./exhibition_delete.php?uid=<?=$uid?>">삭제 </a>
					<?php } ?>
					<span>※달력으로 접근하지 않으시면, 관심표시한 날짜는 전시 시작날로 설정 됩니다.</span>
				</td>
			</tr>
			              	<tr>
              		<td colspan="8">
              			댓글 목록
              		</td>
              	</tr>
              	<?php
              	    $query = "SELECT id, name, comment, pid, writedate FROM comment WHERE pid='$uid'";
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
            <a class= "btn btn-default" href="./comment_delete.php?id=<?=$id?>">x</a>
        </td>
        </tr>
        <?php } ?>
            <tr>
        <form method="post" action="./comment_insert.php?pid=<?=$uid?>">
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
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>]
</html>