<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap.css">
	<link rel="stylesheet" href="./style.css">
	<style type="text/css">
	img{
    	width: 300px;
    	height: 300px;
    }
	</style>
  </style>
	<title>전시회 리스트</title>
</head>
<body>
	<?php
	extract($_GET);
	include ("../commons/navbar.php");
	include ("./config.cfg");
	include ("../commons/functions.inc");
	include ("../commons/data_conn.inc");
	if(!isset($page)){
		$page = 1;
	}
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
	$condition = "where (start_date <= '$date') and (fin_date >= '$date') and (is_accepted ='1')";
	$query = "select count(case when (start_date <= '$date') and (fin_date >= '$date') and (is_accepted ='1') THEN 1 END) total_rows from board";
	if(isset($key)&&isset($kind)){
		$key_condition = "and $kind like '$key'";
		$condition = $condition.$key_condition;
		$query = "select count(case when (start_date <= '$date') and (fin_date >= '$date') and (is_accepted ='1') and $kind like $Key then 1 end) total_rows from board";
	}
	else{
		$key = NULL;
		$kind = NULL;
	}
	$result = mysqli_query($conn,$query)or die(mysqli_error($conn));
	$total_rows = current (mysqli_fetch_array($result));

	$total_pages = ceil($total_rows/$rows_page);
	$start_row = $rows_page *($page-1);
	$pre_page = $page >1 ? $page-1 : NULL;
	$next_page = $page < $total_pages ? $page+1 : NULL;
	$start_page = (ceil($page/$direct_page)-1)*$direct_page +1;
	$end_page = $total_pages >= $start_page + $direct_page?
	$start_page+$direct_page-1:$total_pages;
?>
	<div class="container">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th colspan = "2" width = "100%"><?=$yyyy?>년 <?=$mm?>월 <?=$dd?>일 전시중인 전시회</th>
			</tr>
		</thead>
		<?php
			$query = "select uid, name, place, start_date, fin_date, up_filename from board $condition limit $start_row,$rows_page";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
			while($row = mysqli_fetch_array($result)){
				list($uid,$name,$place,$start_date,$fin_date,$up_filename) = $row;
				$place = htmlspecialchars($place);
				$img_link = "http://localhost/project/exhibition_info/pictures/".$up_filename;
		?>
		<tbody>
			
			<tr>
				<td width = "30%" rowspan="6">
				</td>
				<th>전시 제목</th>
			</tr>
			<tr>
				<td><a href="<?=dest_url_uid("./exhibition_detail.php",$page,$kind,$key,$yyyy,$mm,$dd)?>"><?=$name?></a></td>
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
    <a class = "btn btn-default pull-right"  href="./exhibition_list_now.php">목록 </a>
</div>
<div class="paging2">
  <ul class="pagination">
		<?php
		      if($start_page > 1)
         echo ("<li><a href =\"".dest_url("./exhibition_list_now.php",$start_page-1,$kind,$key,$yyyy,$mm,$dd)."\">&lt&lt</a></li>");
         if($pre_page)
            echo ("<li><a href =\"".dest_url("./exhibition_list_now.php",$pre_page,$kind,$key,$yyyy,$mm,$dd)."\">&lt</a></li>");

      for ($dest_page=$start_page; $dest_page <=$end_page ; $dest_page++) 
            echo ("<li><a href=\"".dest_url("./exhibition_list_now.php",$dest_page,$kind,$key,$yyyy,$mm,$dd)."\">$dest_page</a></li>");
         if($next_page)
            echo("<li><a href = \"".dest_url("./exhibition_list_now.php",$next_page,$kind,$key,$yyyy,$mm,$dd)."\">&gt</a></li>");
      if($end_page < $total_pages)
         echo("<li><a href =\"".dest_url("./exhibition_list_now.php",$end_page+1,$kind,$key,$yyyy,$mm,$dd)."\">&gt&gt</a></li>");
?>
    </ul>
</div>

<table>
	<form name "search_form" method="get" action="./exhibition_list_now.php">
		<tr align="center">
			<td>
				<select name="kind">
					<option value="name"<?if($kind == "name") echo("selected");?>> 제목
					</option>
					<option value="place"<?if($kind == "article") echo("selected");?>> 장소
					</option>
				</select>
				<input type="text" name="key" value="<?=$key?>" size ="20" maxlength="30">
				<input type="submit" value="검색">
			</td>
		</tr>
	</form>
</table>
</div>
<?php include("../commons/footer.php"); ?>
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>