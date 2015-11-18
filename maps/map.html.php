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

  <?php 

  if ( !empty($locality) ) {

    foreach ($locality as $local) {
    
      $place = "var myLatLng".$local['idLocation']." = { lat: ".$local['latitud'].", lng:".$local['longitud']."}; \n  ";

      echo $place;

    }

  }

  ?>

  //var myLatLngADA = {lat: 37.4078108, lng: -5.9282535};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: myLatLng
  });

  <?php

  $contentString = "";
  foreach ($locality as $local) {
    $contentString .= "var contentString".$local['idLocation'].
      " = \"<div id='content'><div id='siteNotice'></div><h1 id='firstHeading' class='firstHeading'>".
      $local['task']."</h1><div id='bodyContent'><p><b>".
      $local['location'].
      "</b>.</p></div></div>\";\n";    
  }
  echo $contentString;
  
  $infoWindow = "\n\n";
  foreach ($locality as $local) {
    $infoWindow .= " var infowindow".$local['idLocation'].
    " = new google.maps.InfoWindow({\ncontent: contentString".$local['idLocation']."});";
  }
  echo $infoWindow; 
   
  $markers = "\n\n";
  foreach ($locality as $local) {
    switch ( $local['level'] ) {
          case '1':
            $icon = "'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png'";
            break;
          case '2':
            $icon = "'http://maps.google.com/mapfiles/ms/icons/green-dot.png'";
            break;
          case '3':
            $icon = "'http://maps.google.com/mapfiles/ms/icons/purple-dot.png'";
            break;
          case '4':
            $icon = "'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'";
            break;
          case '5':
            $icon = "'http://maps.google.com/mapfiles/ms/icons/red-dot.png'";
            break;
          default:
            break;
    }

    $markers .= "var marker".$local['idLocation'].
      " = new google.maps.Marker({\nposition: myLatLng".$local['idLocation'].",\nicon: ".$icon.",\nmap: map,\ntitle: '".$local['location']."'});";
  }
  echo $markers;

  $markerListeners = "";
  foreach ($locality as $local) {
    $markerListeners .= "marker".$local['idLocation'].".addListener('click', function() {
      infowindow".$local['idLocation'].".open(map, marker".$local['idLocation'].");\n});";
  }
  echo $markerListeners;
?>
}

    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRurkRTeEvj6K2g3YgEECHGBu5r4-T0ls&signed_in=true&callback=initMap"></script>
  </body>
</html>