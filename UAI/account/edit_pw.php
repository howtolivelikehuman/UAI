<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap.css">
	<title>비밀번호 변경</title>
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
		<form class="suform" method="post" action="./edit_pw_db.php">
			<table class="signup">
				<thead>
					<tr>
						<th colspan="2" style="font-size: 25px">
							비밀번호 변경
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
						<th rowspan="3">
							비밀번호
						</th>
							<td>
							<input type="password" name="lastpw" class="l1" placeholder="이전 비밀번호" minlength="8" maxlength="16" required >
							</td>
						<tr>
								
						<td>
							<input type="password" id="pw" name="newpw" class="l1" placeholder="새 비밀번호" minlength="8" maxlength="16" required onchange="password_check();" required>
						</td>
					</tr>
					<tr>
						<td>
							<input type="password" id="cpw" name="cpw" class="l1" placeholder="비밀번호 확인" minlength="8" maxlength="16" required onkeyup="password_check();" required>
						</td>
					</tr>
					<tr>
						<th>
							이름
						</th>
						<td>
							<input type="text" name="name" class="l2" value="<?=$name?>" disabled> 
						</td>
					</tr>
					<tr>
						<th>
						생년월일
						</th>
						<td>
							<input type="number" id="byear" name="byear" value="<?=$byear?>" required disabled>
							<select name="bmonth" id="bmonth" required disabled>
               <?php 
                  for($i=1;$i<=12;$i++){
                     if($bmonth == $i){ ?>
                        <option value=<?=$i?> selected> <?=$i?>월</option>";
                    <?php } 
                     else{
                         ?> <option value=<?=$i?> > <?=$i?>월</option>";
                   <?php  }
                  }
                ?>
            </select>
							<input type="number" id="bdate" name="bdate" value="<?=$bdate?>" required min="1" max="31" disabled>
						</td>
					</tr>
					<tr>
						<th>
						성별
						</th>
						<td>
							<select id="gender" name="gender" required disabled>
								<?php if($gender == "male") { ?>
								<option value="male">남성</option>
								<?php } else { ?>
								<option value="female">여성</option>
								<?php }?>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							이메일
						</th>
						<td>
							<input type="email" name="email" class="l1" value="<?=$email?>" required disabled>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="btncontainer">
                <input type="submit" class="libtn btn btn-default" value="비밀번호 변경">
             </form>
            </div>

	</div>
	<?php include "../commons/footer.php"; ?>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./profile_check.js"></script>
</body>
</html>