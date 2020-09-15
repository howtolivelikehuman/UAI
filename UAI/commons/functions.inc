<?php 
	function error($msg){
		echo "
			<script language=\"javascript\">
				alert(\"$msg\");
				history.back();
			</script>";
	}

	function forward($url) {
		header("Location:".$url);
		echo "<meta http-equiv='Refresh' content='0'; URL=list.html";
	}
	function dest_url_uid($link,$page,$uid,$kind,$key,$yyyy=NULL,$mm=NULL,$dd=NULL){
		$link .= "?page=$page&uid=$uid";
		if(!is_null($yyyy)||!is_null($mm)||!is_null($dd)){
			$link .= "&yyyy=$yyyy&mm=$mm&dd=$dd";
		}
		if(!is_null($kind)&&!is_null($key)){
			$link .="&kind=$kind&key=$key";
		}
		return $link;
	}
	function dest_url($link,$page,$kind,$key,$yyyy=NULL,$mm=NULL,$dd=NULL){
		$link .= "?page=$page";
		if(!is_null($yyyy)||!is_null($mm)||!is_null($dd)){
			$link .= "&yyyy=$yyyy&mm=$mm&dd=$dd";
		}
		if(!is_null($kind)&&!is_null($key)){
			$link .="&kind=$kind&key=$key";
		}
		return $link;
	}
	function cal_prev_link_year($yyyy,$mm){
		if($mm == 01){
			return $yyyy - 1;
		}
		else return $yyyy;
	}
	function cal_prev_link_month($mm){
		if($mm == 01){
			return 12;
		}
		else return $mm - 1;
	}
	function cal_next_link_year($yyyy,$mm){
		if($mm == 12){
			return $yyyy + 1;
		}
		else return $yyyy;
	}
	function cal_next_link_month($mm){
		if($mm == 12){
			return 01;
		}
		else return $mm + 1;
	}
 ?>