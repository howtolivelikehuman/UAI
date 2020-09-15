<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
  </head>
  <body>
    <h3>My Google Maps Demo</h3>
    <div id="map"></div>
    <?php
    $address = "전주시 완산구 삼천동1가 306-2";

    $xml = simplexml_load_file("http://maps.google.com/maps/api/geocode/xml?address=".urlencode($address)."&sensor=false");

  $lat = $xml->result->geometry->location->lat;
  $lng = $xml->result->geometry->location->lng;
  echo $lat
  ?>
    <script type="text/javascript">
      function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDS6n6frSlsjSVcxkSY_hLGMienZSQglMM&callback=initMap">
    </script>
  </body>
</html>