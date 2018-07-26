
<?php

		$connectionInfo = array( "Database"=>"VrVideos");
		$conn = sqlsrv_connect( ".\SQLEXPRESS", $connectionInfo);

		if ($conn===false) {
			die(print_r(sqlsrv_errors() , true));
		}
         
              
		$sql = "select * from [VrVideos].[dbo].[Markers] " ;
		       
		  

          $params = array();
          $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

		$result = sqlsrv_query($conn, $sql ,$params ,$options);
             
     	if ($result===false) {
			die(print_r(sqlsrv_errors() , true));
		} 
        
   					$title[] = "";
   					$lat[] = "";
   					$lng[] = "";
		           
     
		for ($i = 0; $i < sqlsrv_num_rows( $result ); $i++)
		   {
		         	
		         $line = sqlsrv_fetch($result);	
		         $field1 =sqlsrv_get_field($result , 1);
		         $field2 =sqlsrv_get_field($result , 2);
		         $field3 =sqlsrv_get_field($result , 3);		         
		         $title[] = $field1;
   				 $lat[] = $field2;
   				 $lng[] = $field3;		                
		    }

        $out="<script type='text/javascript'>
              var locations= [];

         ";
			
			for ($i=1; $i < count($title) ; $i++) { 
	
//{title: 'Park Ave Penthouse', location: {lat: 40.7713024, lng: -73.9632393}}
		
		    $out=$out." 
	
						  
					    var place = new Object();
						place.title = '".$title[$i]."';
                       place.location = new Object();
						place.location.lat  = ".$lat[$i].";
						place.location.lng = ".$lng[$i].";


                        locations.push(place);
						
						";		           
		      
			}
            $out=$out." </script>";           
			echo $out;

?>






<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  	<title>Google Maps</title>
    <style>
      html,
      body {
        font-family: Arial, sans-serif;
        height: 100%;
        margin: 0;
        padding: 0;
      }

       .container1 {
        height: 100%;
        position: relative;

      }

      input {
        font-size: 12px;
      }

      h1 {
        color: #525454;
        font-size: 22px;
        margin: 0 0 10px 0;
        text-align: center;
      }

hr {
        background: #D0D7D9;
        height: 1px;
        margin: 20px 0 20px 0;
        border: none;
      }
      

      #map {
        bottom:0px;
        height: 100%;
        left: 312px;
        position: absolute;
        right: 0px;
      }
     

      .options-box {
        background: #fff;
        border: 1px solid #999;
        border-radius: 3px;
        height: 100%;
        line-height: 35px;
        padding: 10px 10px 30px 10px;
        text-align: left;
        width: 290px;
      }

       #pano {
        width: 340px;
        height: 300px;
      }

      #places-search,
      #search-within-time-text {
        width: 84%;
      }

      .text {
        font-size: 12px;
      }
    </style>
  </head>
  <body>
   
    <div class="container1">
      <div class="options-box">
        <h1>Sightseeing</h1>
        <div>
          
        </div>
        <hr>
        <div>

<div class="container">
          <span class="text" for="usr">Search for nearby places</span>
          <input id="places-search" class="form-control" id="usr" type="text" placeholder="Ex: Rani Road">
          <input onclick="initMap()" id="go-places" type="button" class="btn btn-warning" value="Go"><br>

            <button onclick="getLocation()" class="btn btn-link" >Get present Location</button>
</div>
        </div>

      </div>
      <div id="map"></div>
      
    </div>
     

    <script>
      var map;
      // Create a new blank array for all the listing markers.
      var markers = [];
      var placeMarkers = [];


       var map2;
      // Create a new blank array for all the listing markers.
      var markers2 = [];
      var placeMarkers2 = [];


       opened = 0;

      var lat2 = 0;
      var lng2 = 0;
      mylocations= [];
      
var x = document.getElementById("info");

   

function getLocation() {
  
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    
    lat2 = position.coords.latitude ; 
    lng2 = position.coords.longitude;

    var place2 = new Object();
      place2.title = "Your current location";
                 place2.location = new Object();
      place2.location.lat  = lat2;
      place2.location.lng = lng2;

        mylocations.push(place2);


var styles = [
          {
            featureType: 'water',
            stylers: [
              { color: '#19a0d8' }
            ]
          },{
            featureType: 'administrative',
            elementType: 'labels.text.stroke',
            stylers: [
              { color: '#ffffff' },
              { weight: 6 }
            ]
          },{
            featureType: 'administrative',
            elementType: 'labels.text.fill',
            stylers: [
              { color: '#e85113' }
            ]
          },{
            featureType: 'road.highway',
            elementType: 'geometry.stroke',
            stylers: [
              { color: '#efe9e4' },
              { lightness: -40 }
            ]
          },{
            featureType: 'transit.station',
            stylers: [
              { weight: 9 },
              { hue: '#e85113' }
            ]
          },{
            featureType: 'road.highway',
            elementType: 'labels.icon',
            stylers: [
              { visibility: 'off' }
            ]
          },{
            featureType: 'water',
            elementType: 'labels.text.stroke',
            stylers: [
              { lightness: 100 }
            ]
          },{
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [
              { lightness: -100 }
            ]
          },{
            featureType: 'poi',
            elementType: 'geometry',
            stylers: [
              { visibility: 'on' },
              { color: '#f0e4d3' }
            ]
          },{
            featureType: 'road.highway',
            elementType: 'geometry.fill',
            stylers: [
              { color: '#efe9e4' },
              { lightness: -25 }
            ]
          }
        ];




        // Constructor creates a new map - only center and zoom are required.
        map2 = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 22.922549, lng: 78.783406},
          zoom: 5 ,// min 0 - max 21
          styles: styles,
          mapTypeControl: false
        });


        
        




       
        var largeInfowindow2 = new google.maps.InfoWindow();

        // Style the markers a bit. This will be our listing marker icon.
        var defaultIcon = makeMarkerIcon('0091ff');

        // Create a "highlighted location" marker color for when the user
        // mouses over the marker.
        var highlightedIcon = makeMarkerIcon('FFFF24');


        var bounds2 = new google.maps.LatLngBounds();


        // The following group uses the location array to create an array of markers on initialize.
        for (var i = 0; i < mylocations.length; i++) {
               
          // Get the position from the location array.
          var position2 = mylocations[i].location;
          var title2 = mylocations[i].title;
          // Create a marker per location, and put into markers array.
          var marker = new google.maps.Marker({
            map: map2,
            position: position2,
            title: title2,
            animation: google.maps.Animation.DROP,
            id: i
          });
          // Push the marker to our array of markers.
          markers2.push(marker);
          // Create an onclick event to open an infowindow at each marker.
          marker.addListener('click', function() {
            populateInfoWindow2(this, largeInfowindow2);
          });

          // Two event listeners - one for mouseover, one for mouseout,
          // to change the colors back and forth.
          marker.addListener('mouseover', function() {
            this.setIcon(highlightedIcon);
          });
          marker.addListener('mouseout', function() {
            this.setIcon(defaultIcon);
          });

          bounds2.extend(markers2[i].position);
        }

          
        

       
        // Extend the boundaries of the map for each marker
        map2.fitBounds(bounds2);
   
}

     
      
 function populateInfoWindow2(marker, infowindow) {
            // Check to make sure the infowindow is not already opened on this marker.
        if (infowindow.marker != marker) {
          // Clear the infowindow content to give the streetview time to load.
          infowindow.setContent('');
          infowindow.marker = marker;
          // Make sure the marker property is cleared if the infowindow is closed.
          infowindow.addListener('closeclick', function() {
            infowindow.marker = null;
          });
          var streetViewService = new google.maps.StreetViewService();
          var radius = 50;
          // In case the status is OK, which means the pano was found, compute the
          // position of the streetview image, then calculate the heading, then get a
          // panorama from that and set the options
          function getStreetView2(data, status) {
            if (status == google.maps.StreetViewStatus.OK) {
              var nearStreetViewLocation = data.location.latLng;
              var heading = google.maps.geometry.spherical.computeHeading(
                nearStreetViewLocation, marker.position);
                infowindow.setContent('<div>' + marker.title + '</div><div id="pano"></div>' + '<div><a href="360Video.php">360° videos</a> <a href="VrVideo.php">360° VR videos</a> </div>' );
                var panoramaOptions = {
                  position: nearStreetViewLocation,
                  pov: {
                    heading: heading,
                    pitch: 30
                  }
                };
              var panorama = new google.maps.StreetViewPanorama(
                document.getElementById('pano'), panoramaOptions);
            } else {
              infowindow.setContent('<div>' + marker.title + '</div>' +
                '<div><a href="360Video.php">360° videos</a> <a  href="VrVideo.php">360° VR videos</a> <a  href="wiki1.php?q='+marker.title+'&lat='+marker.position.lat()+'&lng='+marker.position.lng()+'">Wikipedia</a> </div>');
            }
          }
          // Use streetview service to get the closest streetview image within
          // 50 meters of the markers position
          streetViewService.getPanoramaByLocation(marker.position, radius, getStreetView2);
          // Open the infowindow on the correct marker.
          infowindow.open(map2, marker);
        }
      }

       
    
     

      

      function initMap() {
      var styles = [
          {
            featureType: 'water',
            stylers: [
              { color: '#19a0d8' }
            ]
          },{
            featureType: 'administrative',
            elementType: 'labels.text.stroke',
            stylers: [
              { color: '#ffffff' },
              { weight: 6 }
            ]
          },{
            featureType: 'administrative',
            elementType: 'labels.text.fill',
            stylers: [
              { color: '#e85113' }
            ]
          },{
            featureType: 'road.highway',
            elementType: 'geometry.stroke',
            stylers: [
              { color: '#efe9e4' },
              { lightness: -40 }
            ]
          },{
            featureType: 'transit.station',
            stylers: [
              { weight: 9 },
              { hue: '#e85113' }
            ]
          },{
            featureType: 'road.highway',
            elementType: 'labels.icon',
            stylers: [
              { visibility: 'off' }
            ]
          },{
            featureType: 'water',
            elementType: 'labels.text.stroke',
            stylers: [
              { lightness: 100 }
            ]
          },{
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [
              { lightness: -100 }
            ]
          },{
            featureType: 'poi',
            elementType: 'geometry',
            stylers: [
              { visibility: 'on' },
              { color: '#f0e4d3' }
            ]
          },{
            featureType: 'road.highway',
            elementType: 'geometry.fill',
            stylers: [
              { color: '#efe9e4' },
              { lightness: -25 }
            ]
          }
        ];



        
        // Constructor creates a new map - only center and zoom are required.
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 22.922549, lng: 78.783406},
          zoom: 5 ,// min 0 - max 21
          styles: styles,
          mapTypeControl: false
         
        });

				
	      // Create a searchbox in order to execute a places search
        var searchBox = new google.maps.places.SearchBox(
            document.getElementById('places-search'));
        // Bias the searchbox to within the bounds of the map.
        searchBox.setBounds(map.getBounds());					
						
//for (var i = listOfPlaces.length - 1; i >= 0; i--) {
//						 alert(listOfPlaces[count].title);
	//					}




       
        var largeInfowindow = new google.maps.InfoWindow();

        // Style the markers a bit. This will be our listing marker icon.
        var defaultIcon = makeMarkerIcon('0091ff');

        // Create a "highlighted location" marker color for when the user
        // mouses over the marker.
        var highlightedIcon = makeMarkerIcon('FFFF24');


        var bounds = new google.maps.LatLngBounds();

        
        // The following group uses the location array to create an array of markers on initialize.
        for (var i = 0; i < locations.length; i++) {
          // Get the position from the location array.
          var position = locations[i].location;
          var title = locations[i].title;
          // Create a marker per location, and put into markers array.
          var marker = new google.maps.Marker({
            map: map,
            position: position,
            title: title,
            animation: google.maps.Animation.DROP,
            id: i
          });
          // Push the marker to our array of markers.
          markers.push(marker);
          // Create an onclick event to open an infowindow at each marker.
          marker.addListener('click', function() {
            populateInfoWindow(this, largeInfowindow);
          });

          // Two event listeners - one for mouseover, one for mouseout,
          // to change the colors back and forth.
          marker.addListener('mouseover', function() {
            this.setIcon(highlightedIcon);
          });
          marker.addListener('mouseout', function() {
            this.setIcon(defaultIcon);
          });

            if (opened<3) {
            	bounds.extend(markers[i].position);
            	opened++;
             }
          	
      
        }

          
        

       // Listen for the event fired when the user selects a prediction from the
        // picklist and retrieve more details for that place.
        searchBox.addListener('places_changed', function() {
          
          searchBoxPlaces(this);
        });

        // Listen for the event fired when the user selects a prediction and clicks
        // "go" more details for that place.
        document.getElementById('go-places').addEventListener('click', textSearchPlaces);


        // Extend the boundaries of the map for each marker
        map.fitBounds(bounds);
      }

     // This function populates the infowindow when the marker is clicked. We'll only allow
      // one infowindow which will open at the marker that is clicked, and populate based
      // on that markers position.

      function populateInfoWindow(marker, infowindow) {
        // Check to make sure the infowindow is not already opened on this marker.
        if (infowindow.marker != marker) {
          // Clear the infowindow content to give the streetview time to load.
          infowindow.setContent('');
          infowindow.marker = marker;
          // Make sure the marker property is cleared if the infowindow is closed.
          infowindow.addListener('closeclick', function() {
            infowindow.marker = null;
          });
          var streetViewService = new google.maps.StreetViewService();
          var radius = 50;
          // In case the status is OK, which means the pano was found, compute the
          // position of the streetview image, then calculate the heading, then get a
          // panorama from that and set the options
          function getStreetView(data, status) {
            if (status == google.maps.StreetViewStatus.OK) {
              var nearStreetViewLocation = data.location.latLng;
              var heading = google.maps.geometry.spherical.computeHeading(
                nearStreetViewLocation, marker.position);
                infowindow.setContent('<div>' + marker.title + '</div><div id="pano"></div>' + '<div><a  href="360Video.php?q='+marker.title+'">360° videos</a> <a  href="VrVideo.php">360° VR videos</a> <a  href="wiki1.php?q='+marker.title+'&lat='+marker.position.lat()+'&lng='+marker.position.lng()+'">Wikipedia</a> </div>' );
                var panoramaOptions = {
                  position: nearStreetViewLocation,
                  pov: {
                    heading: heading,
                    pitch: 30
                  }
                };
              var panorama = new google.maps.StreetViewPanorama(
                document.getElementById('pano'), panoramaOptions);
            } else {
              infowindow.setContent('<div>' + marker.title + '</div>' +
                '<div>No Street View Found</div>');
            }
          }
          // Use streetview service to get the closest streetview image within
          // 50 meters of the markers position
          streetViewService.getPanoramaByLocation(marker.position, radius, getStreetView);
          // Open the infowindow on the correct marker.
          infowindow.open(map, marker);
        }
      }

       // This function will loop through the listings and hide them all.
      function hideMarkers(markers) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(null);
        }
      }

      // This function takes in a COLOR, and then creates a new marker
      // icon of that color. The icon will be 21 px wide by 34 high, have an origin
      // of 0, 0 and be anchored at 10, 34).
      function makeMarkerIcon(markerColor) {
        var markerImage = new google.maps.MarkerImage(
          'http://chart.googleapis.com/chart?chst=d_map_spin&chld=1.15|0|'+ markerColor +
          '|40|_|%E2%80%A2',
          new google.maps.Size(21, 34),
          new google.maps.Point(0, 0),
          new google.maps.Point(10, 34),
          new google.maps.Size(21,34));
        return markerImage;
      }


      // This function fires when the user selects a searchbox picklist item.
      // It will do a nearby search using the selected query string or place.
      function searchBoxPlaces(searchBox) {

        hideMarkers(placeMarkers);
        var places = searchBox.getPlaces();
        // For each place, get the icon, name and location.
        createMarkersForPlaces(places);
        if (places.length == 0) {
          window.alert('We did not find any places matching that search!');
        }
      }

      // This function firest when the user select "go" on the places search.
      // It will do a nearby search using the entered query string or place.
      function textSearchPlaces() {


        var bounds = map.getBounds();
        hideMarkers(placeMarkers);
        var placesService = new google.maps.places.PlacesService(map);
        placesService.textSearch({
          query: document.getElementById('places-search').value,
          bounds: bounds
        }, function(results, status) {
          if (status === google.maps.places.PlacesServiceStatus.OK) {
            createMarkersForPlaces(results);
          }
        });
      }

      // This function creates markers for each place found in either places search.
      function createMarkersForPlaces(places) {
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < places.length; i++) {
          var place = places[i];
          var icon = {
            url: place.icon,
            size: new google.maps.Size(35, 35),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(15, 34),
            scaledSize: new google.maps.Size(25, 25)
          };
          // Create a marker for each place.
          var marker = new google.maps.Marker({
            map: map,
            icon: icon,
            title: place.name,
            position: place.geometry.location,
            id: place.place_id
          });
          // Create a single infowindow to be used with the place details information
          // so that only one is open at once.
          var placeInfoWindow = new google.maps.InfoWindow();
          // If a marker is clicked, do a place details search on it in the next function.
          marker.addListener('click', function() {
            if (placeInfoWindow.marker == this) {
              console.log("This infowindow already is on this marker!");
            } else {
              getPlacesDetails(this, placeInfoWindow);
            }
          });
          placeMarkers.push(marker);
          if (place.geometry.viewport) {
            // Only geocodes have viewport.
            bounds.union(place.geometry.viewport);
          } else {
            bounds.extend(place.geometry.location);
          }
        }
        map.fitBounds(bounds);
      }
      // This is the PLACE DETAILS search - it's the most detailed so it's only
    // executed when a marker is selected, indicating the user wants more
    // details about that place.
    function getPlacesDetails(marker, infowindow) {
      var service = new google.maps.places.PlacesService(map);
      service.getDetails({
        placeId: marker.id
      }, function(place, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          // Set the marker property on this infowindow so it isn't created again.
          infowindow.marker = marker;
          var innerHTML = '<div>';
          if (place.name) {
            innerHTML += '<strong>' + place.name + '</strong>';
          }
          if (place.formatted_address) {
            innerHTML += '<br>' + place.formatted_address;
          }
          if (place.formatted_phone_number) {
            innerHTML += '<br>' + place.formatted_phone_number;
          }
          if (place.opening_hours) {
            innerHTML += '<br><br><strong>Hours:</strong><br>' +
                place.opening_hours.weekday_text[0] + '<br>' +
                place.opening_hours.weekday_text[1] + '<br>' +
                place.opening_hours.weekday_text[2] + '<br>' +
                place.opening_hours.weekday_text[3] + '<br>' +
                place.opening_hours.weekday_text[4] + '<br>' +
                place.opening_hours.weekday_text[5] + '<br>' +
                place.opening_hours.weekday_text[6];
          }
          if (place.photos) {
            innerHTML += '<br><br><img src="' + place.photos[0].getUrl(
                {maxHeight: 100, maxWidth: 200}) + '">';
          }
          innerHTML += '</div>';
          infowindow.setContent(innerHTML);
          infowindow.open(map, marker);
          // Make sure the marker property is cleared if the infowindow is closed.
          infowindow.addListener('closeclick', function() {
            infowindow.marker = null;
          });
        }
      });
    }

    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDExKEazq41dfC6mzsnfYDuqy6VzOt7T8&libraries=places,geometry,drawing&v=3&callback=initMap">
    </script>



  </body>
</html>




