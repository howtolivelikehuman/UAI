<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap.css">
    <title>회원 탈퇴</title>
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
        <form class="suform" method="post" action="./delete_profile_db.php">
            <table class="signup">
                <thead>
                    <tr>
                        <th colspan="2" style="font-size: 25px">
                            회원 탈퇴
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
                        <th>
                            비밀번호
                        </th>
                            <td>
                            <input type="password" name="lastpw" class="l1" placeholder="비밀번호 확인" minlength="8" maxlength="16" required >
                            </td>
                    </tr>
                </tbody>
            </table>
            <div class="btncontainer">
                <input type="submit" class="libtn btn btn-default" value="회원탈퇴">
             </form>
            </div>
    </div>
    <? include "../commons/footer.php";?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./account.js"></script>
</body>
</html>