<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../bootstrap.css">
<link rel="stylesheet" href="./style.css">
</head>
<body>
<?php
include ("../commons/navbar.php");
include ("./config.cfg");
include ("../commons/functions.inc");
include ("../commons/data_conn.inc");
extract($_GET);

if(!isset($page))
   $page = 1;
$query = "select count(*) total_rows from free_board";
$condition = "";
  if(isset($key)&&isset($kind)){
    $condition = "where $kind like '%$key%' ";
    $query = "select count(case when $kind like '%$key%' THEN 1 END) total_rows from free_board";
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
	<div id = "list">
	<br>
	<b>자유 게시판 (전체 글: <?=$total_rows?>)</b>
	</div>
	</td>
	  <div class="container" >
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th width="10%">번호</th>
            <th width="50%">제목</th>
            <th width="10%">작성자</th>
            <th width="20%">작성일</th>
            <th width="10%">조회</th>
          </tr>
        </thead>
        <tbody>
  <?php
		$query = "select uid, gid, name, subject, writedate, refnum, comment_count from free_board $condition"."order by gid desc limit $start_row,$rows_page";
			$result = mysqli_query($conn,$query) or die (mysqli_error($conn));
		while ($row = mysqli_fetch_array($result))
		{
   		list($uid,$gid,$name,$subject,$writedate,$refnum,$comment_count) = $row;
  		 $subject = htmlspecialchars($subject);
  		 if (strlen($subject) > $row_length)
     	 $subject = substr($subject,0,$row_length)."...";   
		?>


		<tr>
		<td><?=$gid?></td>
		<td id="title">
			<a href="<?=dest_url_uid("./count_ref.php",$page,$uid,$kind,$key)?>"><?=$subject?>&nbsp;(<?=$comment_count?>)</a>
			<?php
				if ($refnum >= 20) {
			?>
				  <span class="hot">hot</span>
			<?php
				}

            ?>
		</td>
		<td><?=$name?>
		</td>
		<td><?=$writedate?></td>
		<td><?=$refnum?></td>
	</tr>
	<?php } ?>
</tbody>
</table>
<div class="container">

    
    <a class = "btn btn-default pull-right"  href="../main.php">메인 </a>
    <a class = "btn btn-default pull-right"  href="./free_list.php">목록 </a>
        <a class = "btn btn-default pull-right"  href="<?=dest_url("./free_write.php",$page,$kind,$key)?>"> 글쓰기 </a>
</div>
<div class="paging2">
  <ul class="pagination">
		<?php
         if($pre_page)
            echo ("<li><a href =\"".dest_url("./free_list.php",$pre_page,$kind,$key)."\">이전</a></li>");

         if($next_page)
            echo("<li><a href = \"".dest_url("./free_list.php",$next_page,$kind,$key)."\">다음</a></li>");

   extract($_POST);
      if($start_page > 1)
         echo ("<li><a href =\"".dest_url("./free_list.php",$start_page-1,$kind,$key)."\">pre</a></li>");

      for ($dest_page=$start_page; $dest_page <=$end_page ; $dest_page++) 
         echo ("<li><a href=\"".dest_url("./free_list.php",$dest_page,$kind,$key)."\">$dest_page</a></li>");

      if($end_page < $total_pages)
         echo("<li><a href =\"".dest_url("./free_list.php",$end_page+1,$kind,$key)."\">next</a></li>");
?>
    </ul>
</div>
<center>
<table>
	<form name "search_form" method="get" action="./free_list.php">
		<tr align="center">
			<td>
				<select name="kind" class="form-control">
					<option value="subject"> <?if($kind == "subject") echo("selected");?>> 제목
					</option>
					<option value="name"<?if($kind == "name") echo("selected");?>> 작성자명
					</option>
				</select>
				<input type="text" class="form-control"  name="key" value="<?=$key?>" size ="20" maxlength="30">
				<input type="submit" class="btn btn-default" value="검색">
			</td>
		</tr>
	</form>
</table>
</center>
</div>
<?php include("../commons/footer.php"); ?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
