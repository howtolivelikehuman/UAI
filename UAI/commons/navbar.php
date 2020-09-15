<?php
	@session_start();
	extract($_SESSION);
	if(!isset($_SESSION['is_usrloggedin']) || !isset($_SESSION['usr'])){
		$_SESSION['usr'] = null;
		$_SESSION['is_usrloggedin'] = false;
		$_SESSION['is_admin'] = false;
	}
?>
<nav class="navbar navbar-default" id = "mynav">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://localhost/project/main.php"  style="color : #ffffff; font-size: 30px">UAI</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"  style="color : #ffffff; background-color: #f96666;" >
            전시회
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="http://localhost/project/exhibition_info/exhibition_list_now.php">
                진행중인 전시회 목록
              </a>
            </li>
            <li>
              <a href="http://localhost/project/exhibition_info/exhibition_list.php">
                전시 예정 전시회 목록
              </a>
            </li>
            <?php if($is_usrloggedin){ ?>
            <li>
              <a href="http://localhost/project/calendar.php">
                관심 전시회 목록
              </a>
            </li>
            <li role="separator" class="divider"></li>
            <li>
              <a href="http://localhost/project/exhibition_info/exhibition_submit.php">
              전시회 등록 신청
            </a>
            </li>
            <?php if($is_admin){ ?>
              <li>
                <a href="http://localhost/project/exhibition_info/exhibition_admin_check_list.php">
                  신청받은 전시회 목록
                </a>
              </li>	
            <?php } else { ?> 
              <li>
                <a href="http://localhost/project/exhibition_info/exhibition_user_check_list.php">
                  신청한 전시회 목록
                </a>
              </li>
            <?php } } ?>
          </ul>
        </li>
        <?php if($is_usrloggedin) { ?>
          <li>
            <a href="http://localhost/project/mypage.php"  style="color : #ffffff;" >
            마이페이지
            </a>
          </li>
          <li>
            <a href="http://localhost/project/free_board/free_list.php"  style="color : #ffffff;" >
              자유게시판
            </a>
          </li>        
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"  style="color : #ffffff; background-color: #f96666;" >
              <?=$usr?>님<span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="http://localhost/project/account/edit_profile.php">
                  회원정보 수정
                </a>
              </li>
              <li>
                <a href="http://localhost/project/account/edit_pw.php">
                  비밀번호 변경
                </a>
              </li>
              <li>
                <a href="http://localhost/project/account/delete_profile.php">
                  회원 탈퇴
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="http://localhost/project/account/logout.php"  style="color : #ffffff;" >
              <span class = "glyphicon glyphicon-log-out"></span>&nbsp;로그아웃
            </a>
          </li>
        </ul>
        <?php } else { ?>        
          <li>
            <a href="http://localhost/project/free_board/free_list.php"  style="color : #ffffff;" >
              자유게시판
            </a>
         </li>         
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="http://localhost/project/account/sign_up.php" style="color : #ffffff;">
              <span class="glyphicon glyphicon-user"></span>&nbsp;회원가입
            </a>
          </li>
          <li>
            <a href="http://localhost/project/account/login.php" style="color : #ffffff;">
              <span class="glyphicon glyphicon-log-in"></span>&nbsp;로그인
            </a>
          </li>
        </ul>
      <?php } ?>
    </div>
  </div>
</nav>