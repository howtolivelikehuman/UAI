<?php
	extract($_GET);
	include "../commons/functions.inc";
	include "../commons/data_conn.inc";
	$query = "update free_board set refnum=refnum+1 where uid='$uid'";
	mysqli_query($conn,$query) or die(mysqli_error($conn));

	forward(dest_url_uid("./free_read.php",$page,$uid,$kind,$key));
 ?>