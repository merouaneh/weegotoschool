
var delay = 100;
var infowindow = new google.maps.InfoWindow();
var latlng = new google.maps.LatLng();
var mapOptions = { zoom: 5, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP }
var geocoder = new google.maps.Geocoder(); 
var map = new google.maps.Map(document.getElementById("map"), mapOptions);
var bounds = new google.maps.LatLngBounds();
var locations = new Array();
var routes = new Array();
var addressesComponents = new Array();




function AddressComponent(stringAddress) {
  this.stringAddress = stringAddress;
  this.lat = 0;
  this.lng = 0;
  this.streetNumber = '';
  this.locality = '';
  this.postalCode = '';
  return this;
};


function geocodeAddress(address, label, next) {
  geocoder.geocode({address:address}, function (results,status) { 
     if (status == google.maps.GeocoderStatus.OK) {
        var result = results[0].geometry.location;
        var lat=result.lat();
        var lng=result.lng();
        var addressComponent = new AddressComponent(address);
        addressesComponents.push(addressComponent);
        addressComponent.extractAddressComponent(result);

        createMarker(address,label, lat,lng);
    } else {
       if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
          console.log('OVER_QUERY_LIMIT reached');
          nextAddress--;
          delay++;
      } else {   }   
    }
  next();
  });
}

AddressComponent.prototype.extractAddressComponent = function(result) {
 var addressComponents = result.address_components;
  if( addressComponents ) {
    for( i = 0; i < addressComponents.length ; i ++){
      addressComponent = addressComponents[i];
      addressComponentType = addressComponent.types[0];
      switch( addressComponentType)  {
        case "street_number": this.streetNumber = addressComponent.long_name; break;
        case "locality": this.locality = addressComponent.long_name;
        case "postal_code": this.postalCode = addressComponent.long_name; break;
        case "route": this.route = addressComponent.long_name; break;
        default: break;
      }
    }
  }
}

function getHexavigesimalValue(number) {
  var base = 26;
  var converted = "";
  var alpha = "A".charCodeAt(0);
  var offset = 0;
  do  {
      var remainder = number % base;
      converted = String.fromCharCode( alpha + remainder - offset) + converted;
      number = Math.floor((number - remainder) / base);
      offset = 1;
  } while (number > 0);

  return converted;
}

function createMarker(address, label, lat, lng) {
  var contentString = label;
  var latLng = new google.maps.LatLng(lat,lng);
  var letter = '';  
  var icon_prefix = 'http://www.google.com/mapfiles/arrow';
   if( locations.length > 1) {
    icon_prefix = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=';
    letter = getHexavigesimalValue( locations.length - 1);
  }

  //icon_prefix = 'marker_green';
  var marker = new google.maps.Marker({ map: map, position: latLng, icon: icon_prefix + letter + '|66bb4a', animation: google.maps.Animation.NONE });

  locations.push({ label: label, address: address, latLng: latLng , draggable:true});
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent(contentString); 
    infowindow.open(map,marker);
  });
  bounds.extend(marker.position);

  var destination = locations[0].latLng;
  console.log('Origin is : ' + latLng);
  console.log('Destination is : ' + destination);


  var directionsService = new google.maps.DirectionsService();
  var request = { origin: latLng, destination: destination, travelMode: google.maps.TravelMode.DRIVING };
  directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
  directionsDisplay.setMap(map);

  directionsService.route(request, function (response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(response);
          directionsDisplay.setMap(map);
          routes.push(directionsDisplay);
          var leg = response.routes[ 0 ].legs[ 0 ];
      //  makeMarker( leg.start_location, icons.start, "title" );
      // makeMarker( leg.end_location, icons.end, 'title' );          
      } else {
          alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
      }
  });
}
