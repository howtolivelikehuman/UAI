<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title></title>
   <link rel="stylesheet" type="text/css" href="./bootstrap.css">
   <link rel="stylesheet" type="text/css" href="./calendar.css">
</head>
<body>
   <?php
   include './commons/navbar.php';
   include './commons/functions.inc';
   extract($_GET);
   if(!isset($yyyy)){
      $yyyy = date('Y');
   }
   if(!isset($mm)){
      $mm = date('m');
   }
   if(!isset($dd)){
      $dd = date('d');
   }

   $last_date = date('t',strtotime($yyyy."-".$mm."-".$dd));
   $start_day = date('w',strtotime($yyyy."-".$mm."-"."01"));
   $total_week = ceil(($last_date + $start_day) / 7);   
   $last_day = date('w', strtotime($yyyy."-".$mm."-".$last_date));
   $day = 1;
?>
   <center>
   <div class="calcontainer">
   <table class="calendar">
   <tr>
      <th colspan="7">
         <a href="calendar.php?yyyy=<?=cal_prev_link_year($yyyy,$mm,$dd)?>&mm=<?=cal_prev_link_month($mm)?>"><button>&lt</button></a>
         <span><?=$yyyy?>년 <?=$mm?>월</span>
         <a href="calendar.php?yyyy=<?=cal_next_link_year($yyyy,$mm,$dd)?>&mm=<?=cal_next_link_month($mm)?>"><button>&gt</button></a>
      </th>
   </tr>
   <tr>
      <td class="_0">일</td>
      <td class="_1">월</td>
      <td class="_2">화</td>
      <td class="_3">수</td>
      <td class="_4">목</td>
      <td class="_5">금</td>
      <td class="_6">토</td>
   </tr>
   <?php
      for($i=0;$i<$total_week;$i++){
   ?>
         <tr>
            <?php
               for($j=0;$j<7;$j++){
            ?>
                  <td class="_<?=$j?>">
                                          <?php
                        if(!(($i==0 && $j < $start_day)||($i==$total_week-1&&$j>$last_day))){
                     ?>
                     <button class="clickable <?php if($day==$dd){?>selected<?php } ?>">
                     <?=$day?>
                     <?php
                        $day++;
                        ?>
                        </button>
                        <?php
                        }
                     ?>
                  </td>
                  <?php } ?>
         </tr>
         <?php } ?>
         </table>
         <iframe src="./mypage.php?yyyy=<?=$yyyy?>&mm=<?=$mm?>&dd=<?=$dd?>" id="iframe"></iframe>
         </div>
         </center>
         
  <?php include './commons/footer.php'; ?>
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script type="text/javascript">
      $(function(){
         $(".clickable").click(function(){
            $(".selected").removeClass("selected");
            $(this).addClass("selected");
            $("#iframe").attr('src','./mypage.php?yyyy='+"<?=$yyyy?>"+"&mm="+"<?=$mm?>"+"&dd="+ $.trim($(".selected").text()) + "&page=1");
         });
      });
   </script>
</body>
</html>