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

  <?php foreach ($locality as $local) : ?>

  //var contentString = '<div id="content">'+
  //    '<div id="siteNotice">'+
  //    '</div>'+
  //    '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
  //    '<div id="bodyContent">'+
  //    '<p><b>Uluru</b>, </p>'+
  //    '</div>'+
  //    '</div>';    

  //var infowindow = new google.maps.InfoWindow({
  //  content: contentString<?=$local['idLocation']?>
  //});

  var marker = new google.maps.Marker({
    position: myLatLng<?=$local['idLocation']?>,
    /*icon: <?php switch ( $local['level'] ) {
          case '1':
            echo "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png";
            break;
          case '2':
            echo "http://maps.google.com/mapfiles/ms/icons/green-dot.png";
            break;
          case '3':
            echo "http://maps.google.com/mapfiles/ms/icons/purple-dot.png";
            break;
          case '4':
            echo "http://maps.google.com/mapfiles/ms/icons/blue-dot.png";
            break;
          case '5':
            echo "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
            break;
          default:
          break;
    }
    ?>, */
    map: map,
    title: '<?=$local['location']?>'
  });

  //marker.addListener('click', function() {
  //  infowindow.open(map, marker);
  //});

  <?php endforeach; ?>
  }

    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRurkRTeEvj6K2g3YgEECHGBu5r4-T0ls&signed_in=true&callback=initMap"></script>
  </body>
</html>