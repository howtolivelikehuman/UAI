<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../bootstrap.css">
	<link rel="stylesheet" href="./style.css">
	<style type="text/css">
	 img{
    	width: 150px;
    	height: 200px;
    }
	</style>

	<title>전시회 등록 신청 확인페이지</title>
</head>
<body>
	<?php
	include("../commons/navbar.php");
		extract($_SESSION);
	if(!$_SESSION['is_usrloggedin']){
		$msg = "로그인을 하셔야 이용하실 수 있습니다";
			echo " <html><head>
			<script name=javascript>
			self.window.alert('$msg');
			location.href='../account/login.php?';
			</script>
			</head>
			</html> ";
	}
	extract($_GET);
	include ("./config.cfg");
	include ("../commons/functions.inc");
	include ("../commons/data_conn.inc");
	if(!isset($page)){
		$page = 1;
	}
	$condition = "where usr='$usr'";
	$query = "select count(case when usr='$usr' then 1 end) total_rows from board";
		$key = NULL;
		$kind = NULL;

	$result = mysqli_query($conn,$query)or die(mysqli_error($conn));
	$total_rows = current (mysqli_fetch_array($result));

	$total_pages = ceil($total_rows/$rows_page);
	$start_row = $rows_page *($page-1);
	$pre_page = $page >1 ? $page-1 : NULL;
	$next_page = $page < $total_pages ? $page+1 : NULL;
	$start_page = (ceil($page/$direct_page)-1)*$direct_page +1;
	$end_page = $total_pages >= $start_page + $direct_page?
	$start_page+$direct_page-1:$total_pages;?>
	<div class="container">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<th colspan="2">"<?=$usr?>"님이 등록신청하신 전시회</th>
			</thead>
		<?php
			$query = "select uid, name, place, start_date, fin_date, up_filename from board $condition order by start_date asc, uid asc limit $start_row,$rows_page";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
			while($row = mysqli_fetch_array($result)){
				list($uid,$name,$place,$start_date,$fin_date,$up_filename) = $row;
				$place = htmlspecialchars($place);
				$img_link = "http://localhost/project/exhibition_info/pictures/".$up_filename;
				?>
		<tbody>
			<tr>
				<td id="imgclass" width = "15%" rowspan="6">
					<img src="<?=$img_link?>">
				</td>
				<th>전시 제목</th>
			</tr>
			<tr>
				<td><a href="exhibition_user_check_detail.php?uid=<?=$uid?>"><?=$name?></a></td>
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
	<div class="container">
    <a class = "btn btn-default pull-right"  href="../main.php">메인 </a>
    <a class = "btn btn-default pull-right"  href="./exhibition_user_check_list.php">목록 </a>
</div>
<div class="paging2">
  <ul class="pagination">
		<?php
         if($pre_page)
            echo ("<li><a href =\"".dest_url("./exhibition_user_check_list.php",$pre_page,$kind,$key)."\">이전</a></li>");

         if($next_page)
            echo("<li><a href = \"".dest_url("./exhibition_user_check_list.php",$next_page,$kind,$key)."\">다음</a></li>");

   extract($_POST);
      if($start_page > 1)
         echo ("<li><a href =\"".dest_url("./exhibition_user_check_list.php",$start_page-1,$kind,$key)."\">pre</a></li>");

      for ($dest_page=$start_page; $dest_page <=$end_page ; $dest_page++) 
         echo ("<li><a href=\"".dest_url("./exhibition_user_check_list.php",$dest_page,$kind,$key)."\">$dest_page</a></li>");

      if($end_page < $total_pages)
         echo("<li><a href =\"".dest_url("./exhibition_user_check_list.php",$end_page+1,$kind,$key)."\">next</a></li>");
?>
    </ul>
</div>
</div>
<?php 	include("../commons/footer.php"); ?>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>