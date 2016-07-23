<!DOCTYPE html>
<html>
  <head>
    <title>Geocoding service</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
#floating-panel {
  position: absolute;
  top: 10px;
  left: 25%;
  z-index: 5;
  background-color: #fff;
  padding: 5px;
  border: 1px solid #999;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}

    </style>
  </head>
  <body>

    <div id="locationField">
      <input id="address" type="text" onFocus="geolocate()"></input>
      <input id="submit" type="button" value="Geocode">
    </div>


    <div id="map"></div>
    <script>
    var placeSearch, autocomplete; 
    
    function initAutocomplete(){
      autocomplete = new google.maps.places.Autocomplete(
          (document.getElementById('address')),
          {types:['geocode']

        });
      autocomplete.addListener('placed_changed', fillInAddress);

      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: {lat: -34.397, lng: 150.644}
      });
    var geocoder = new google.maps.Geocoder();

      document.getElementById('submit').addEventListener('click', function() {
        geocodeAddress(geocoder, map);
      });
    }

    function fillInAddress(){
      var place = autocomplete.getPlace();

      for (var component in componenForm) {
        document.getElementById(component).value='';
        document.getElementById(component).disabled = false; 
      };
    }

    function geolocate(){
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position){
          var geolocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          var latitude1 = position.coords.latitude;
          var longitude = position.coords.longitude;
          console.log(latitude1, longitude);
          var circle = new google.maps.Circle({
            center: geolocation,
            radius: position.coords.accuracy
          });
          autocomplete.setBounds(circle.getBounds());
        });
      }
    }

function geocodeAddress(geocoder, resultsMap) {
  var address = document.getElementById('address').value;
  geocoder.geocode({'address': address}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      resultsMap.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        map: resultsMap,
        position: results[0].geometry.location

      });
      var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
        console.log(latitude, longitude);
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
  console.log(address);

}

//Function to covert address to Latitude and Longitude


    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApuY4JfD2BGkajnfLxFyu2WdRfvUzTyJY&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
  </body>
</html>