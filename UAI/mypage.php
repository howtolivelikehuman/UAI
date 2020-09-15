<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./bootstrap.css">
	<link rel="stylesheet" href="./free_board/style.css">
</head>
<body>
	<?php
	extract($_GET);
		if(!isset($yyyy)){
		$yyyy = date('Y');
	}
	if(!isset($mm)){
		$mm = date('m');
	}
	if(strlen($mm) == 1){
		$mm = "0".$mm;
	}
	if(!isset($dd)){
		$dd = date('d');
	}
	if(strlen($dd) == 1){
		$dd = "0".$dd;
	}
	$date = $yyyy.$mm.$dd;
	$id = $_SESSION['usr'];
	include "./commons/navbar.php";
	include "./commons/data_conn.inc";
	include "./commons/functions.inc";
		$query = "SELECT pageid, subject, my_date, place, start_date, fin_date from mypage where name='$id' and start_date <= '$date' and fin_date >= '$date' ORDER BY start_date";
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		?>

	<div class="container">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th colspan="2" width="100%"><?=$date?>일 관심 표시한 목록
					</th>
				</tr>
			</thead>
				<?php while($row = mysqli_fetch_array($result)){
						list($pageid,$subject,$my_date,$place,$start_date,$fin_date) = $row;
						$place = htmlspecialchars($place);
						$subject = htmlspecialchars($subject);				
						?>
		<tbody>
			
			<tr>
				<th>전시 제목</th>
			</tr>
			<tr>
				<td><a href="<?=dest_url_uid("./exhibition_info/exhibition_detail.php",$page,$uid,$kind,$key,$yyyy,$mm,$dd)?>"><?=$subject?></td>
			</tr>
			<tr>
				<th>전시 장소</th>
			</tr>
			<tr>
				<td><?=$place?></td>
			</tr>
			<tr>
				<th>전시 기간</th>
			</tr>
			<tr>
				<td><?=$start_date?>~<?=$fin_date?></td>
			</tr>
			</a>
		</tbody>
		<?php } ?>
		</table>
		<a class = "btn btn-default pull-right"  href="./main.php">메인 </a>		
	</div>
	  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>