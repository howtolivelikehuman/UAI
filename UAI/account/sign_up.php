<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap.css">
	<title>회원 가입</title>
</head>
<body>
	<?php include '../commons/navbar.php'; ?>
	<div class="sucontainer">
		<form class="suform" method="post" action="./register.php">
			<table class="signup">
				<thead>
					<tr>
						<th colspan="2">
							회원 가입
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>
							이름
						</th>
						<td>
							<input type="text" name="name" class="l2" placeholder="이름" required>
						</td>
					</tr>
					<tr>
						<th>
							아이디
						</th>
						<td>
							<input type="text" name="id" class="l1" placeholder="아이디" required>
						</td>
					</tr>
					<tr>
						<th rowspan="2">
							비밀번호
						</th>
						<td>
							<input type="password" id="pw" name="pw" class="l1" placeholder="비밀번호" minlength="8" maxlength="16" required onchange="password_check();">
						</td>
					</tr>
					<tr>
						<td>
							<input type="password" id="cpw" name="cpw" class="l1" placeholder="비밀번호 확인" minlength="8" maxlength="16" required onkeyup="password_check();">
						</td>
					</tr>
					<tr>
						<th>
						생년월일
						</th>
						<td>
							<input type="number" id="byear" name="byear" placeholder="연도" required>
							<select name="bmonth" id="bmonth" required onchange="bday_check();">
								<option value="" disabled selected hidden>월</option>
								<option value="01">1월</option>
								<option value="02">2월</option>
								<option value="03">3월</option>
								<option value="04">4월</option>
								<option value="05">5월</option>
								<option value="06">6월</option>
								<option value="07">7월</option>
								<option value="08">8월</option>
								<option value="09">9월</option>
								<option value="10">10월</option>
								<option value="11">11월</option>
								<option value="12">12월</option>
							</select>
							<input type="number" id="bdate" name="bdate" placeholder="일" required min="1" max="31" onkeyup="bday_check()";>
						</td>
					</tr>
					<tr>
						<th>
						성별
						</th>
						<td>
							<select id="gender" name="gender" required>
								<option value="" disabled selected hidden>성별</option>
								<option value="male">남성</option>
								<option value="female">여성</option>
								<option value="hide">비공개</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							이메일
						</th>
						<td>
							<input type="email" name="email" class="l1" placeholder="이메일" required>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="btncontainer">
                <input type="submit" class="libtn btn btn-default" value="회원가입">
            </div>
		</form>	
	</div>
	<?php include "../commons/footer.php"; ?>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./profile_check.js"></script>
</body>
</html>