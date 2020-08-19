<!DOCTYPE html>
<html>
  <head>
    <title>Rhombus</title>
    <link rel = "stylesheet" href = "https://bootswatch.com/4/flatly/bootstrap.min.css">
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.css' rel='stylesheet' />
      <style>
        body { margin:0; padding:0; }
        #map {
          position: absolute;
          top: 0;
          bottom: 0;
          width: 100%;
        }

        .marker {
            background-image: url('mapbox-icon.png');
            background-size: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
          }

          .mapboxgl-popup {
            max-width: 200px;
          }

          .mapboxgl-popup-content {
            text-align: center;
            font-family: 'Open Sans', sans-serif;
          }
      </style>
      <style>
          .center {
        text-align: center;
        border: 3px solid green;
      }
      </style>

  </head>
  <body>
    <nav class ="navbar navbar-inverse">
      <div class = "flex-container">
        <div class = "navbar-header">
          <a class = "navbar-brand" href="/">Rhombus</a>
        </div>
        <div id = "navbar">
          <ul class = "nav navbar-nav">
            <li><a href = "<?php echo base_url(); ?>">Home</a></li>
            <li><a href = "<?php echo base_url(); ?>/about">About</a></li>
          </ul>
        </div>      
        </div>
    </nav>

    <div id='map'></div>

          <script>

          mapboxgl.accessToken = 'pk.eyJ1IjoicHJhbmF2c2FodTk3IiwiYSI6ImNrY3BjZDNlMjBhdmEzM29jOXd4ampyY3AifQ.WrJtcYhFi91QLRvMZVJXcQ';

          var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/light-v10',
            center: [-96, 37.8],
            zoom: 3
          });

        var geojson = <?php echo $geoJson; ?>

        geojson.features.forEach(function(marker) {

        // create a HTML element for each feature
          var el = document.createElement('div');
          el.className = 'marker';

        // make a marker for each feature and add to the map
          new mapboxgl.Marker(el)
          .setLngLat(marker.geometry.coordinates)
          .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
          .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
          .addTo(map);
          });


      </script>
    </body>
</html>