<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap.css">
	<title>회원정보수정</title>
</head>
<body>
	<?php include '../commons/navbar.php'; 
		include "../commons/functions.inc";
		include "../commons/data_conn.inc";
		$id = $_SESSION['usr'];
	$query="SELECT id, pw, name, gender, byear, bmonth, bdate, email from account WHERE id='$id'";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	list($id,$pw,$name,$gender,$byear,$bmonth,$bdate,$email) = mysqli_fetch_array($result);
	if(!isset($key)||!isset($kind)){
        $key = NULL;
        $kind = NULL;
      }
?>
	<div class="sucontainer">
		<form class="suform" method="post" action="./edit_profile_db.php">
			<table class="signup">
				<thead>
					<tr>
						<th colspan="2" style="font-size: 25px">
							회원 정보 수정
						</th>
					</tr>
				</thead>
				<tbody>

					<tr>
						<th>
							아이디
						</th>
						<td>
							<input type="text" name="id" class="l1" value="<?=$id?>" disabled>
						</td>
					</tr>
					<tr>
						<th rowspan="2">
							비밀번호
						</th>
						<td>
							<input type="password" id="pw" name="pw" class="l1" value="<?=$pw?>" disabled minlength="8" maxlength="16" required onchange="password_check();">
						</td>
					</tr>
					<tr>
						<td>
							<input type="password" id="cpw" name="cpw" class="l1" placeholder="비밀번호 확인" maxlength="16" required onkeyup="password_check();">
						</td>
					</tr>
					<tr>
						<th>
							이름
						</th>
						<td>
							<input type="text" name="name" class="l2" value="<?=$name?>"> 
						</td>
					</tr>
					<tr>
						<th>
						생년월일
						</th>
						<td>
						<input type="number" id="byear" name="byear" placeholder="연도" value="<?=$byear?>" required>
            <select name="bmonth" id="bmonth" required>
               <option value="1" <?php if($bmonth == 1) echo"selected"; ?>>1월</option>
               <option value="2" <?php if($bmonth == 2) echo"selected"; ?>>2월</option>
               <option value="3" <?php if($bmonth == 3) echo"selected"; ?>>3월</option>
               <option value="4" <?php if($bmonth == 4) echo"selected"; ?>>4월</option>
               <option value="5" <?php if($bmonth == 5) echo"selected"; ?>>5월</option>
               <option value="6" <?php if($bmonth == 6) echo"selected"; ?>>6월</option>
               <option value="7" <?php if($bmonth == 7) echo"selected"; ?>>7월</option>
               <option value="8" <?php if($bmonth == 8) echo"selected"; ?>>8월</option>
               <option value="9" <?php if($bmonth == 9) echo"selected"; ?>>9월</option>
               <option value="10" <?php if($bmonth == 10) echo"selected"; ?>>10월</option>
               <option value="11" <?php if($bmonth == 11) echo"selected"; ?>>11월</option>
               <option value="12" <?php if($bmonth == 12) echo"selected"; ?>>12월</option>
            </select>
            <input type="number" id="bdate" name="bdate" placeholder="일" value="<?=$bdate?>" required min="1" max="31">
						</td>
					</tr>
					<tr>
						<th>
						성별
						</th>
						<td>
							<select id="gender" name="gender" required>
               <option value="" disabled selected hidden>성별</option>
               <option value="male" <?php if($gender == "male") echo"selected"; ?>>남성</option>
               <option value="female" <?php if($gender == "female") echo"selected"; ?>>여성</option>
            </select>
						</td>
					</tr>
					<tr>
						<th>
							이메일
						</th>
						<td>
							<input type="email" name="email" class="l1" value="<?=$email?>" required>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="btncontainer">
                <input type="submit" class="libtn btn btn-default" value="회원 정보 수정">
             </form>
            </div>

	</div>
	<?php include "../commons/footer.php";?>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./profile_check.js"></script>
</body>
</html>