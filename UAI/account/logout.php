<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
	 <meta charset="utf-8">
  </head>
  <body>
    <?php
      if(session_destroy()){
        echo "<html>
        <head>
        <script name=javascript>
        self.window.alert('로그아웃 되었습니다.');
        location.href='../main.php?';
        </script>
        </head>
        </html>";
      }
      else{
        echo "<html>
        <head>
        <script name=javascript>
        self.window.alert('에러가 발생했습니다.');    
        location.href='../main.php?';
        </script>
        </head>
        </html>";
      }
    ?>
  </body>
</html>
