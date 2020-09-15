<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../bootstrap.css">
	<meta charset="utf-8">
	<link rel="stylesheet" href="./style.css">
	<style type="text/css">
		    img{
		    	width: 180px;
		    	height: 240px;
    }
	</style>
	<title>전시회 정보 등록</title>
</head>
<body>
	<?php
include("../commons/navbar.php");
?>
	<form name="exhibition_register" method="post" action="./exhibition_register.php" enctype="multipart/form-data">
	<div id="container">
		<table class="table table-striped table-bordered">
			<thead>
			<tr>
				<th colspan="2" style="height: 75px; vertical-align: middle;">
					전시회 등록 신청
				</th>
			</tr>
			<tr>
				 <th style="vertical-align: middle;">전시회명</th>
				 <td>
				 	<input type="text" name="name" required class="form-control l1">
				</td>	 
			</tr>
			<tr>
				<th style="vertical-align: middle;">전시회 포스터</th>
				<td><img id="imgs" src=""> <span>※전시회 포스터 부재시 등록신청이 가능하지 않습니다.</span>
					<input type="file" id="imgin" name="upfile" accept="image/*" class = "form-control l1">
					 <span>※사진명은 영문, 숫자만 가능합니다.</span>
				</td>
			</tr>

						<tr>
				 <th style="vertical-align: middle;">전시회 장소</th>
				 <td>
				 	<input type="text" name="place" required class="form-control l1">
				</td>	 
			</tr>
			<tr>
				<th style="vertical-align: middle;"> 전시회 기간</th>
				<td>
					<input type="text" name="start_date" placeholder="ex) 20171215" required class="form-control l2">
					<input type="text" name="fin_date" placeholder="ex) 20171215" required class="form-control l2">
				</td>
			</tr>
			<tr>
				<th style="vertical-align: middle;">전시회 설명</th>
				 <td>
                       <textarea class="form-control" name="info" rows="20">
                       </textarea>
                 </td>
			</tr>
		</thead>
	</table>
	<div>
<input type="submit"  class = "btn btn-default pull-right" value="신청">
<a class = "btn btn-default pull-right" href="./exhibition_user_check_list.php">목록</a>
</div>
</div>
</form>
<?php include("../commons/footer.php"); ?>
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script type="text/javascript">
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgs').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
    else{
    	$('#imgs').attr('src', '');
    }
    alert($("#imgin").val());
}

$("#imgin").change(function(){
    readURL(this);
	});
   </script>
</body>
</html>