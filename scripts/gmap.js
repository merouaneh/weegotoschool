

var weegotoschool={ directions:new google.maps.DirectionsService(), maps:{}, routes:[], locations: []};
      
/**
 * base-class     
 * @param points optional array array of lat+lng-values defining a route
 * @return object Route
 **/                     
function Route(points, strokeColor) {     
  this.origin       = null;
  this.destination  = null;
  this.waypoints    = [];
  this.strokeColor  = strokeColor;
  this.lat = 0;
  this.lng = 0;
  if(points && points.length>1) {
      this.setPoints(points);
    }
    return this; 
};


function Location(stringAddress) {
  this.stringAddress = stringAddress;
  this.lat = 0;
  this.lng = 0;
  this.streetNumber = '';
  this.locality = '';
  this.postalCode = '';
  return this;
};


/**
  *  draws route on a map 
  *              
  * @param map object google.maps.Map 
  * @return object Route
  **/                    
Route.prototype.drawRoute = function(map) {
  var _this=this;
  directionDisplay = _this.directionsRenderer
  if( map == null &&  directionDisplay != null) {
    directionDisplay.setMap(null);
  }
  weegotoschool.directions.route( { 'origin': this.origin, 'destination': this.destination, 'waypoints': this.waypoints, 
                                  'travelMode': google.maps.DirectionsTravelMode.DRIVING },
    function(res,sts) {
        if(sts==google.maps.DirectionsStatus.OK) {
        if(!_this.directionsRenderer) {
        //  { polylineOptions: { strokeWeight: 4, strokeOpacity: 1, strokeColor:  'red' }
          _this.directionsRenderer = new google.maps.DirectionsRenderer({ polylineOptions: { strokeWeight: 6, strokeOpacity: 0.6, strokeColor: _this.strokeColor}, 
                                                                                             'draggable':true }); 
                        }
          _this.directionsRenderer.setMap(map);
          _this.directionsRenderer.setDirections(res);
          google.maps.event.addListener(_this.directionsRenderer, 'directions_changed', function() { _this.setPoints(); } ); 
        }   
    });
  return _this;
 };

/**
  * sets map for directionsRenderer     
  * @param map object google.maps.Map
  **/             
Route.prototype.setGMap = function(map){
  this.directionsRenderer.setMap(map);
};

/**
  * sets origin, destination and waypoints for a route 
  * from a directionsResult or the points-param when passed    
  * 
  * @param points optional array array of lat+lng-values defining a route
  * @return object Route        
  **/
Route.prototype.setPoints = function(points) {
  this.origin = null;
  this.destination = null;
  this.waypoints = [];
  if(points) {
    for(var p=0;p<points.length;++p)
    {
      this.waypoints.push({location:new google.maps.LatLng(points[p][0], points[p][1]), stopover:false});
    }
    this.origin=this.waypoints.shift().location;
    this.destination=this.waypoints.pop().location;
  } else {
    var route=this.directionsRenderer.getDirections().routes[0];        
    for(var l=0;l<route.legs.length;++l) {
      if(!this.origin)this.origin=route.legs[l].start_location;
      this.destination = route.legs[l].end_location;
      
      for(var w=0;w<route.legs[l].via_waypoints.length;++w)
      {
        this.waypoints.push({location:route.legs[l].via_waypoints[w], stopover:false});
      }
    }
    //the route has been modified by the user when you're here
    //you may call now this.getPoints() and work with the result
  }
  return this;
};

/**
  * retrieves points for a route 
  *         
  * @return array         
  **/
Route.prototype.getPoints = function() {
  var points=[[this.origin.lat(),this.origin.lng()]];
  for(var w=0;w<this.waypoints.length;++w) {
    points.push([this.waypoints[w].location.lat(), this.waypoints[w].location.lng()]);
  }
  points.push([this.destination.lat(), this.destination.lng()]);
  return points;
};



Location.prototype.getCoordinates = function() {
  var geocode = geocoder = new google.maps.Geocoder();
  geocoder.geocode({ 'address':this.stringAddress}, function(results, status){
  if (status == google.maps.GeocoderStatus.OK) {
    result = results[0];
    loc = result.geometry.location;
    lat = loc.lat();
    lng = loc.lng();
    
    addressComponents = result.address_components;
    for( i = 0; i < addressComponents.length ; i ++){
      addressComponent = addressComponents[i];
      addressComponentType = addressComponent.types[0];
      switch( addressComponentType)  {
        case "street_number": this.streetNumber = addressComponent.long_name; break;
        case "locality": this.locality = addressComponent.long_name; addToSelect(document.getElementById('city'), this.locality ); break;
        case "postal_code": this.postalCode = addressComponent.long_name; break;
        case "route": this.route = addressComponent.long_name; break;
        default: break;
      }
    }
    weegotoschool.locations.push(new Array(lat,lng));
    if( weegotoschool.locations.length == 2 ) {
       school = weegotoschool.locations[0];
       home = weegotoschool.locations[1];
       route = new Route([ home, school], color()).drawRoute(weegotoschool.maps.map1);
       weegotoschool.routes.push(route);

    }
  } else {
    alert("No results found for address: " + this.stringAddress);
  }
});

};

function color () {
  return randomColor({ luminosity: 'bright', hue: 'blue'}); 
};


function handleChange(element) {
  index = element.value;
  route = weegotoschool.routes[index];
  console.log('Handling checked:' +element.checked+' for index' +index+ ' route is : ' + route); 

  if( route == null ) {
    school = weegotoschool.locations[0];
    home = weegotoschool.locations[index];
    route = new Route([ home, school, ], color());
    weegotoschool.routes[index]=route;
    
  }
  if(element.checked == true ){ 
      console.log('enabling route display for route '+route.origin+','+route.destination);
      route.drawRoute(weegotoschool.maps.map1);
    }
  else{
    console.log('Disabling route display for route '+route.origin+','+route.destination);
    route.drawRoute(null);
  }
};



function handleCityChange(element) {
  city = element.value;
  var checkboxes = document.getElementsByName('route');
  for (var i=0, n=checkboxes.length;i<n;i++) {
     if (checkboxes[i].getAttribute('city') == city) {
       if( checkboxes[i].checked != true ) {
          checkboxes[i].checked = true;
          handleChange(checkboxes[i]);
        }
      } else {
          if( checkboxes[i].checked == true ) {
          checkboxes[i].checked = false;
          handleChange(checkboxes[i]);
        }
      }
     }
};


function initialize() {
  //  alert("bbbgetCoordinates: " + getCoordinates('avenue louis breguet, villepinte'));

  var weegotoschoolOptions = { zoom: 3, center: new google.maps.LatLng(48.95708459999999,2.5611887000000024), mapTypeId: google.maps.MapTypeId.DRIVING };
  weegotoschool.maps.map1 = new google.maps.Map(document.getElementById('map_canvas'), weegotoschoolOptions);

  var loc = new Location('avenue louis breguet, villepinte'); loc.getCoordinates();
  loc = new Location('avenue maurice utrillo, montmagny'); loc.getCoordinates();
  loc = new Location('La Courneuve'); loc.getCoordinates();
  loc = new Location('saint-denis'); loc.getCoordinates();
  loc = new Location('gagny'); loc.getCoordinates(); 
  loc = new Location('neuilly'); loc.getCoordinates();
  loc = new Location('pantin'); loc.getCoordinates();
  loc = new Location('villeneuve la garenne'); loc.getCoordinates();
}


function addToSelect(select, value) {
    var child = document.createElement("option");
    child.textContent = value;
    child.value = value;
    select.appendChild(child);
}



google.maps.event.addDomListener(window, 'load', initialize);






