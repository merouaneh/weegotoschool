

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
  return this;
};

function Location2(stringAddress) {
  this.stringAddress = stringAddress;
  this.lat = 0;
  this.lng = 0;
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

Location2.prototype.getLatLong = function() {
  var geocode = geocoder = new google.maps.Geocoder();
  geocoder.geocode({ 'address':this.stringAddress}, function(results, status){

  if (status == google.maps.GeocoderStatus.OK) {
    lat = results[0].geometry.location.lat();
    lng = results[0].geometry.location.lng();
   // color = '#'+Math.floor(Math.random()*16777215).toString(16);
    color = randomColor( {luminosity: 'dark',  hue: 'red'});
   // alert(color);
    new Route([ [48.95708459999999,2.5611887000000024], [lat, lng], [lat-1, lng]], color);
  } else {
    alert("No results found for address: " + this.stringAddress);
  }
});

};

Location.prototype.getLatLong = function() {
  var geocode = geocoder = new google.maps.Geocoder();
  geocoder.geocode({ 'address':this.stringAddress}, function(results, status){
  if (status == google.maps.GeocoderStatus.OK) {
    lat = results[0].geometry.location.lat();
    lng = results[0].geometry.location.lng();
    weegotoschool.locations.push(new Array(lat,lng));
    if( weegotoschool.locations.length == 2 ) {
       myOrigin = weegotoschool.locations[0];
       school = weegotoschool.locations[0];
       r = new Route([ school, myOrigin, [lat-1, lng]], randomColor()).drawRoute(weegotoschool.maps.map1);
       weegotoschool.routes.push(r);

    }
  } else {
    alert("No results found for address: " + this.stringAddress);
  }
});

};

function handleChange(element) {
  index = element.value;
  route = weegotoschool.routes[index];
  if(element.checked){
    school = weegotoschool.locations[0];
    myOrigin = weegotoschool.locations[index];
    new Route([ school, myOrigin, [lat-1, lng]], randomColor()).drawRoute(weegotoschool.maps.map1);
   // alert(myLocation);
  } else {
       alert('removing' + route);
       route.drawRoute(null);

    //route.drawRoute(null);
  }


value = document.getElementById(element)
}


function initialize() {
  //  alert("bbbgetLatLong: " + getLatLong('avenue louis breguet, villepinte'));

  var weegotoschoolOptions = { zoom: 3, center: new google.maps.LatLng(48.95708459999999,2.5611887000000024), mapTypeId: google.maps.MapTypeId.DRIVING };
  weegotoschool.maps.map1 = new google.maps.Map(document.getElementById('map_canvas'), weegotoschoolOptions);

  var loc = new Location('avenue louis breguet, villepinte'); loc.getLatLong();
  loc = new Location('avenue maurice utrillo, montmagny'); loc.getLatLong();
  loc = new Location('avenue maurice utrillo, argenteuil'); loc.getLatLong();
  loc = new Location('avenue maurice utrillo, montmagny'); loc.getLatLong();
  loc = new Location('avenue maurice utrillo, montmagny'); loc.getLatLong();
  loc = new Location('avenue maurice utrillo, montmagny'); loc.getLatLong();
  loc.getLatLong();

  //new Location2('avenue maurice utrillo, montmagny').getLatLong();
  //new Location('Paris').getLatLong();
  //new Location('mitry-mory').getLatLong();
  //new Location2('tremblay').getLatLong();
  //new Location('mitry-mory').getLatLong();

  weegotoschool.routes[0]=new Route();

}

google.maps.event.addDomListener(window, 'load', initialize);






