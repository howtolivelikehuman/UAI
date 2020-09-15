<?PHP
@session_start();
$id = $_SESSION['usr'];
extract($_POST);
extract($_GET);
include "config.cfg";
include "../commons/functions.inc";
include "../commons/data_conn.inc";

$subject=trim($subject);
$article=trim($article);

if(!$subject||!$article){
    error("입력값이 부족합니다.");
    exit;
}
$query="update free_board set subject='$subject', article='$article' where uid=$uid";
mysqli_query($conn,$query) or die (mysqli_error($conn));
mysqli_close($conn);

forward(dest_url_uid("./free_read.php",$page,$uid,$kind,$key));

?>