<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
  <link rel="stylesheet" type="text/css" href="./bootstrap.css">
  <title>UAI</title>
</head>
<body>
  <?php include("./commons/navbar.php"); ?>
  <div id="maincarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#maincarousel" data-slide-to="0" class="active"></li>
      <li data-target="#maincarousel" data-slide-to="1"></li>
      <li data-target="#maincarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="item active">
        <img src="./imgs/main1.jpg" alt="Los Angeles">
        <div class="carousel-caption">
        </div>
      </div>
      <div class="item">
        <img src="./imgs/main2.jpg" alt="Chicago">
        <div class="carousel-caption">
        </div>
      </div>
      <div class="item">
        <img src="./imgs/art.jpg"" alt="New York">
        <div class="carousel-caption">
        </div>
      </div>
    </div>
    <a class="left carousel-control" href="#maincarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#maincarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <hr class="featurette-divider">
  <div class="container marketing">
    <div class ="row">
      <div class ="col-lg-4" style="text-align: center;">
        <img class = "img-circle" src="./imgs/list.jpg" width="160" height="160">
        <h2>전시회 리스트</h2>
        <p>
          서울 주변 대학 학생, 동아리, 단체들의
          <br>
          다양한 문화전시, 공연 리스트들을 확인하세요</p>
        <p>
          <a class = "btn btn-default" href="http://localhost/project/exhibition_info/exhibition_list.php" role="button">바로가기</a>
        </p>
      </div>
      <div class ="col-lg-4" style="text-align: center;">
        <img class = "img-circle" src="./imgs/calendar.jpg" width="160" height="160">
        <h2>관심 전시회 관리</h2>
        <p>내가 관심표시를 한 전시회 목록들을 날짜별로 보여줍니다</p>
        <p>
          <a class = "btn btn-default" href="http://localhost/project/calendar.php" role="button">바로가기</a>
        </p>
      </div>
      <div class ="col-lg-4" style="text-align: center;">
        <img class = "img-circle" src="./imgs/apply.jpg" width="160" height="160">
        <h2>전시회 등록신청</h2>
        <p>나의 전시회를 알려 보세요!</p>
        <p>
          <a class = "btn btn-default" href="http://localhost/project/exhibition_info/exhibition_submit.php" role="button">바로가기</a>
        </p>
      </div>
    </div>
  </div>
  <?php include"./commons/footer.php" ?>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>