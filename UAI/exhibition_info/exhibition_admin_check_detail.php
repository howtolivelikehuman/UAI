<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" 
	href="../bootstrap.css">
	<link rel="stylesheet" href="./style.css">
	<style type="text/css">
	 #imgclass{
    	border-right: 0;
    }
	</style>
	<title><?=$subject?></title>
</head>
<body>
	<?php
	include("../commons/navbar.php");

	extract($_GET);
	include("../commons/data_conn.inc");
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
?>
	<div id="container">
	<table class = "table table-striped table-bordered">
		<thead>
			<tr>
				<th width="10%">전시 제목</th>
				<td  width="30%"><?=$name?></td>
			</tr>
			<tr>
				<th  width="10%">전시 장소</th>
            	<td  width="30%"><?=$place?></td>
			</tr>
			<tr>
				<th  width="10%">전시 기간</th>
            	<td  width="30%"><?=$period?></td>
			</tr>
			<tr height="300" valign="top">
				<td id = "imgclass">
					<img src="<?=$img_link?>" width = "300px" height = "300px">
					<br>
				</td>
				<td><?=$info?></td>	
			</tr>
			<tr>
				<th width="10%">반려 사유</th>
				<form method="post" action="./reject.php" style="display: inline;">
				<td>
				<input type="text" name="rejectreason" class = "form-control">
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right">
					<input type="hidden" name="uid" value="<?=$uid?>">
					<input type="submit" value="반려" class = "btn btn-default">
				</form>
				<form method="post" action="./accept.php" style="display: inline;">
				<input type="hidden" name="uid" value="<?=$uid?>">
				<input type="submit" value="승인" class = "btn btn-default">
	
				<a class = "btn btn-default" href="./exhibition_admin_check_list.php">목록 </a>
				</td>
				</form>
			</tr>
		</thead>
	</table>
</div>
<?php include("../commons/footer.php"); ?>
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>