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
	<title><?=$subject?></title>
</head>
<body>
	<?php
	include("../commons/navbar.php");
	extract($_GET);
	include("../commons/data_conn.inc");
	$query = "select name, place, start_date, fin_date, info, up_filename, is_checked, is_accepted, rejectreason from board where uid='$uid'";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	$row = mysqli_fetch_array($result);
	list($name,$place,$start_date,$fin_date,$info,$up_filename,$is_checked,$is_accepted,$rejectreason) = $row;
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
				<th width="10%" colspan = "2">전시 제목</th>
				<td colspan="6"><?=$name?></td>
			</tr>
			<tr>
				<th colspan = "2">전시 장소</th>
            	<td colspan="6"><?=$place?></td>
			</tr>
			<tr>
				<th colspan = "2">전시 기간</th>
            	<td colspan="6"><?=$period?></td>
			</tr>
			<tr height="300" valign="top">
				<td id = "imgclass">
					<img src="<?=$img_link?>" width = "300px" height = "400px">
					<br>
				</td>
				<td colspan="6"><?=$info?></td>	
			</tr>
			<tr>
				
					<?php
					if($is_checked){
						if($is_accepted){ ?>
						<td colspan="8" align="right">
							<a class = "btn btn-default"> 승인 확인</a>
							<a class = "btn btn-default" href="./exhibition_user_check_list.php"> 목록 </a>	
				</td>
			</tr>
						<?php }
						else{ ?>
			<tr>
							<th width="10%" colspan="2">반려 사유</th>
							<td colspan="6">//반려 확인 버튼을 누르시면 삭제됩니다.<br><?=$rejectreason?></td>
			</tr>
						<td colspan="8" align="right">
							<a class = "btn btn-default" href="./exhibition_user_check_delete.php?uid=<?=$uid?>"> 반려 확인 </a>
							<a class = "btn btn-default" href="./exhibition_user_check_list.php"> 목록 </a>
				</td>
			</tr>

						<?php	}
						}
					else{ ?>
					<td colspan="8" align="right">
						<a class = "btn btn-default"> 검토중 </a>	
				</td>
			</tr>
				<?php	} ?>
		</thead>
	</table>
</div>
<?php include("../commons/footer.php"); ?>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>