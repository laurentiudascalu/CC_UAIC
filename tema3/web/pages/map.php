<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
  <nav>
    <a href="/">Home</a>
    <a href="map">Map</a>
    <a href="youtube">Youtube</a>
    <a href="books">Books</a>
    <a href="fonts">Fonts</a>
  </nav>
    <div id="map"></div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 47.151726, lng: 27.587914},
          zoom: 8
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA29UjoxZzjSS8uG2beY5h-IJhepEvU3-k&callback=initMap"
    async defer></script>
  </body>
</html>