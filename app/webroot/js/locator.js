
var map;
var location;
var hospitals = [
 	new google.maps.LatLng(14.630217392956231, 121.04946613213542),
	new google.maps.LatLng(14.633040997357666, 121.0419981386733),
	new google.maps.LatLng(14.625525146485097, 121.05465888895196),
	new google.maps.LatLng(14.628016617277165, 121.0470199584961),
	new google.maps.LatLng(14.63378841597103, 121.043372153581),
	new google.maps.LatLng(14.62585734422432, 121.04315757751465),
	//new google.maps.LatLng(14.641467764938367, 121.04830741882324),
	new google.maps.LatLng(14.653840891942055, 121.03989600611385),
	new google.maps.LatLng(14.69635261740111, 121.06719017028809),
	new google.maps.LatLng(14.632083652143054, 121.05199813842773),
	new google.maps.LatLng(14.615434401019797, 121.01191520167049),
	new google.maps.LatLng(14.621331106801781, 121.02350234985352)
];

var markers = [];
var mylocwindow;
var hospwindow;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var mylocation;
var mymarker;
function initializeMap(){
	mylocwindow  = new google.maps.InfoWindow();
	hospwindow  = new google.maps.InfoWindow();
	latlng = new google.maps.LatLng(14.56723453062288, 121.0463106271668);
	
	directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
	var myOptions = {
		zoom:15,
		center:hospitals[0],
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(jQuery('#my_map').get(0),myOptions);
	directionsDisplay.setMap(map);
	
/*	jQuery.each(hospitals,function(x,y){
		addMarker(y,x,'red');
	});*/

/*	if (navigator.geolocation){
		 navigator.geolocation.getCurrentPosition(showPosition,showError);
	}else{
		alert("Geolocation is not supported by this browser.");
	}*/
	  
}
function showPosition(position)
{
	mylocation = new google.maps.LatLng(parseFloat(position.coords.latitude),parseFloat(position.coords.longitude));
	addMarker(mylocation,markers.length,'yellow');
	map.setCenter(mylocation);
	mymarker = markers[markers.length-1];
	mylocwindow.setContent("<span style='color:black;'><b>You are here!</b></span><br /><input onclick='locateNearest(mymarker);jQuery(this).remove();mylocwindow.close();' type='submit' value='locate nearest'/>");
	mylocwindow.open(map,mymarker);
	
	google.maps.event.addListener(mymarker, 'mouseover', function() {
		mylocwindow.open(map,this);
	});
	
}
function showInfo(){
	
}
function showError(error)
{
switch(error.code) 
  {
  case error.PERMISSION_DENIED:
    alert("User denied the request for Geolocation.");
    break;
  case error.POSITION_UNAVAILABLE:
	  alert("Location information is unavailable.");
    break;
  case error.TIMEOUT:
	  alert("The request to get user location timed out.");
    break;
  case error.UNKNOWN_ERROR:
	  alert("An unknown error occurred.");
    break;
  }
}
function addMarker(pos,index,color){
	marker = new google.maps.Marker({
		position: pos,
		animation: google.maps.Animation.DROP,
		title:index.toString(),
		icon: new google.maps.MarkerImage(
			    'http://maps.google.com/intl/en_us/mapfiles/ms/micons/'+color+'-dot.png',
			    new google.maps.Size(30, 30),
			    new google.maps.Point(0, 0),
			    new google.maps.Point(0, 24)
			  )
	});
	
	
	markers[index] = marker;
//	google.maps.event.addListener(marker, 'mouseover', function() {
//		locateNearest(this);
//	});
	marker.setMap(map);
	return marker;
}

function locateNearest(marker){
	lng = marker.getPosition().lng();
	lat = marker.getPosition().lat();
	
	nearest = 9999;
	markerDistances = [];
	
	// 
	jQuery.each(markers,function(x,y){
		
		currentlng = y.getPosition().lng();
		currentlat = y.getPosition().lat();

//		lngDiff = lng - currentlng;
//		if(lngDiff < 0)
//			lngDiff *= -1;
//		
//		latDiff = lat - currentlat;
//		if(latDiff < 0)
//			latDiff *= -1;
//		
//		markerDistances[x] = parseFloat(lngDiff + latDiff);

		markerDistances[x] = Math.sqrt(Math.pow((lng - currentlng), 2) + Math.pow((lat - currentlat), 2));
		if(markerDistances[x] > 0 && nearest > markerDistances[x])
			nearest = markerDistances[x];

	});
	
	nearestMarker = markers[markerDistances.indexOf(nearest)];
	
	nearestMarker.setAnimation(google.maps.Animation.BOUNCE);
	setTimeout("nearestMarker.setAnimation(null)",3000);
	
	var request = {
	    origin:marker.getPosition(),
	    destination:nearestMarker.getPosition(),
	    travelMode: google.maps.TravelMode.DRIVING
	};
	directionsService.route(request, function(result, status) {
	    if (status == google.maps.DirectionsStatus.OK) {
	      directionsDisplay.setDirections(result);
	    }
	});
	
	hospwindow.setContent("<span style='color:black;'><b>This is the nearest marker!</b></span><br />");
	//hospwindow.open(map,nearestMarker);
}


jQuery(document).ready(function(){
	initializeMap();
	
	geocoder = new google.maps.Geocoder();
	jQuery('#geocode-btn').click(function(){
		address = jQuery("#compaddress").val();
		if(address.length){
			geocodeAddress(address);
		}
	});
	
//	jQuery('#geocode-2-btn').click(function(){
//		st = jQuery("#st").val();
//		ct = jQuery("#ct").val();
//		stt = jQuery("#stt").val();
//		if(address.length){
//			geocodeAddress(st,ct,stt);
//		}
//	});
});

//function geocodeAddress(st,ct,stt) {
//	geocoder.geocode( { 'street': st,'city':ct,'state':stt}, function(results, status) {
//      if (status == google.maps.GeocoderStatus.OK) {
//        map.setCenter(results[0].geometry.location);
//        addMarker(results[0].geometry.location,markers.length,"blue");
//      } else {
//        alert("Geocode was not successful for the following reason: " + status);
//      }
//    });
//}

function geocodeAddress(address) {
	geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        markr = addMarker(results[0].geometry.location,markers.length,"blue");
        
        infow = new google.maps.InfoWindow();
	 	infow.setContent('<p style="color:#000;">Testing only</p>');
	 	infow.open(map,markr);
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
//	jQuery.ajax({
//		url:"http://maps.googleapis.com/maps/api/geocode/json",
//		data:{'address':address,'sensor':false,'region':'ph'},
//		type:"GET",
//		dataType:'jsonp',
//		success:function(data){
//			alert(data);
//		}
//	});
//	jQuery.getJSON(
//		"http://maps.googleapis.com/maps/api/geocode/json",
//		{'address':address,'sensor':false,'region':'ph'},
//		function(data){
//			alert(data);
//		}
//	);
  }