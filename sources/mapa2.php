<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Complex icons</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
	  <script src='http://code.jquery.com/jquery.min.js' type='text/javascript'></script>

   <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC95cAMo1G5bCkWUfnbPDPwpwZjFdpoOzY&sensor=false"></script>
    <script>

var infowindow = null;
    $(document).ready(function () { initialize();  });

    function initialize() {

        var centerMap = new google.maps.LatLng(39.828175, -98.5795);

        var myOptions = {
            zoom: 4,
            center: centerMap,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

        setMarkers(map, sites);
	    infowindow = new google.maps.InfoWindow({
                content: "loading..."
            });

        var bikeLayer = new google.maps.BicyclingLayer();
		bikeLayer.setMap(map);
    }

    var sites = [
	['Mount Evans', 39.58108, -105.63535, 4, '<div style="background-color: #000;"> Testess</div>'],
	['Irving Homestead', 40.315939, -105.440630, 2, 'This is the Irving Homestead.'],
	['Badlands National Park', 43.785890, -101.90175, 1, 'This is Badlands National Park'],
	['Flatirons in the Spring', 39.99948, -105.28370, 3, 'These are the Flatirons in the spring.']
];



    function setMarkers(map, markers) {
		var image = {
			url: 'images/prf.png',
			size: new google.maps.Size(27, 31),
			origin: new google.maps.Point(0,0),
			anchor: new google.maps.Point(0, 32)
		  };
		 
		  var shape = {
			  coord: [1, 1, 1, 20, 18, 20, 18 , 1],
			  type: 'poly'
		  };
        for (var i = 0; i < markers.length; i++) {
            var sites = markers[i];
            var siteLatLng = new google.maps.LatLng(sites[1], sites[2]);
            var marker = new google.maps.Marker({
                position: siteLatLng,
                map: map,
				icon: image,
				shape: shape,
                title: sites[0],
                zIndex: sites[3],
                html: sites[4]
            });

            var contentString = "Some content";
			
            google.maps.event.addListener(marker, "click", function () {
                infowindow.setContent(this.html);
                infowindow.open(map, this);
            });
        }
    }
</script>

  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>
