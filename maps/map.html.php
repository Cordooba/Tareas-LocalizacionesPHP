<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Mapa de Localizaciones</title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>

function initMap() {
  var myLatLng = {lat: 37.4105634, lng: -5.9251314};

  

  var myLatLngADA = {lat: 37.4078108, lng: -5.9282535};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: myLatLng
  });

  var marker = new google.maps.Marker({
    position: myLatLngADA,
    map: map,
    title: 'ADA ITS'
  });
}

    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRurkRTeEvj6K2g3YgEECHGBu5r4-T0ls&signed_in=true&callback=initMap"></script>
  </body>
</html>