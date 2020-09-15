<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap.css">
    <title>Log in</title>
</head>
<body>
    <?php
    include '../commons/data_conn.inc';
    include '../commons/navbar.php';
    $_SESSION['is_usrloggedin'] = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
    extract($_POST); 
    
    $result = mysqli_query($conn, "SELECT * FROM account WHERE ID='$id' and pw='$pw'") or die (mysqli_error());
    $row = mysqli_fetch_array($result);
    if(mysqli_num_rows($result) == 1) 
    {
        $_SESSION['usr'] = $id;
        $_SESSION['is_usrloggedin'] = true;
        $_SESSION['is_admin'] = $row['isadmin'];
        echo "<html><head>
        <script name=javascript>
        location.href='../main.php';
        </script>
        </head>
        </html>";
    }
    else 
    {
        echo "<html><head>
        <script name=javascript>
        alert('아이디와 비밀번호를 확인해주세요.');
        </script>
        </head>
        </html>";
    }
}
?>
    <div class="licontainer">
        <form class="liform" method="post" action="#">
            <table class="login">
                <thead>
                    <tr>
                        <th colspan="2">
                            로그인
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            아이디
                        </th>
                        <td>
                            <input type="text" name="id" class="l1" placeholder="아이디" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            비밀번호
                        </th>
                        <td>
                            <input type="password" name="pw" class="l1" placeholder="비밀번호" required maxlength="16">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="btncontainer">
                <input type="submit" class="libtn btn btn-default" value="로그인">
                <a href="./sign_up.php" class="libtn btn btn-default">회원가입</a>
            </div>
        </form> 
    </div>
    <?php include "../commons/footer.php";?>
</body>
</html>