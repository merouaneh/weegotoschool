

var my={directionsSVC:new google.maps.DirectionsService(),
              maps:{},
              routes:{}};
      
      /**
        * base-class     
        * @param points optional array array of lat+lng-values defining a route
        * @return object Route
        **/                     
      function Route(points, strokeColor)
      {
        this.origin       = null;
        this.destination  = null;
        this.waypoints    = [];
        this.strokeColor = strokeColor;
        if(points && points.length>1)
        {
          this.setPoints(points);
        }
        return this; 
      };

      /**
        *  draws route on a map 
        *              
        * @param map object google.maps.Map 
        * @return object Route
        **/                    
      Route.prototype.drawRoute = function(map)
      {
        var _this=this;
        my.directionsSVC.route(
          {'origin': this.origin,
           'destination': this.destination,
           'waypoints': this.waypoints,
           'travelMode': google.maps.DirectionsTravelMode.DRIVING
          },
          function(res,sts) 
          {
              if(sts==google.maps.DirectionsStatus.OK){
              if(!_this.directionsRenderer)
              {
              //  { polylineOptions: { strokeWeight: 4, strokeOpacity: 1, strokeColor:  'red' }
                _this.directionsRenderer = new google.maps.DirectionsRenderer({ polylineOptions: { strokeWeight: 6, strokeOpacity: 0.4, strokeColor:  _this.strokeColor},  'draggable':true }); 
                              }
                _this.directionsRenderer.setMap(map);
                _this.directionsRenderer.setDirections(res);
                
                google.maps.event.addListener(_this.directionsRenderer, 'directions_changed',
                                              function()
                                              {
                                                _this.setPoints();
                                              }
                                              );
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
      Route.prototype.setPoints = function(points)
      {
        this.origin = null;
        this.destination = null;
        this.waypoints = [];
        if(points)
        {
          for(var p=0;p<points.length;++p)
          {
            this.waypoints.push({location:new google.maps.LatLng(points[p][0],
                                                                 points[p][1]),
                                 stopover:false});
          }
          this.origin=this.waypoints.shift().location;
          this.destination=this.waypoints.pop().location;
        }
        else
        {
          var route=this.directionsRenderer.getDirections().routes[0];
          
          for(var l=0;l<route.legs.length;++l)
          {
            if(!this.origin)this.origin=route.legs[l].start_location;
            this.destination = route.legs[l].end_location;
            
            for(var w=0;w<route.legs[l].via_waypoints.length;++w)
            {
              this.waypoints.push({location:route.legs[l].via_waypoints[w],
                                   stopover:false});
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
    Route.prototype.getPoints = function()
    {
      var points=[[this.origin.lat(),this.origin.lng()]];
      
      for(var w=0;w<this.waypoints.length;++w)
      {
        points.push([this.waypoints[w].location.lat(),
                     this.waypoints[w].location.lng()]);
      }
      
      points.push([this.destination.lat(),
                   this.destination.lng()]);
      return points;
    };
   


function getCoordinatesByAddress(address) {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var myOptions = {
    zoom: 8,
    center: latlng,
    mapTypeControl: true,
    mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
    },
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  this.points = [];
  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  if (geocoder) {
    geocoder.geocode({
      'address': address
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
          map.setCenter(results[0].geometry.location);

          var infowindow = new google.maps.InfoWindow({
            content: '<b>' + address + '</b>',
            size: new google.maps.Size(150, 50)
          });

          var marker = new google.maps.Marker({
            position: results[0].geometry.location,
            map: map,
            title: address
          });
          google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
          });

        } else {
          alert("No results found");
        }
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    this.points=[[location.lat(),location.lng()]];
    });
  }
  return this.points;

}


   
    
    function initialize() 
    {
      var myOptions = {
                        zoom: 8,
                        center: new google.maps.LatLng(-34.397, 150.644),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                      };
        my.maps.map1 = new google.maps.Map(document.getElementById('map_canvas'),
                                           myOptions);
        my.maps.map2 = new google.maps.Map(document.getElementById('map_canvas2'),
                                           myOptions);
      
        my.routes.r0 = new Route([
                                  [55.930385, -3.118425],
                                  [50.909700, -1.40435]
                                 ], 'blue').drawRoute(my.maps.map1);
        my.routes.r1 = new Route([
                                  [51.454513, -2.58790],
                                  [52.6308859, 1.2973550]
                                 ], 'red').drawRoute(my.maps.map1);
         my.routes.r2 = new Route([
                                  [53.454513, -2.58790],
                                  [52.6308859, 1.2973550]
                                 ], 'green').drawRoute(my.maps.map1);
      
        my.routes.rx=new Route();
        
        document.getElementById('UI').style.visibility='visible';
      }

      google.maps.event.addDomListener(window, 'load', initialize);
      function fx(route)
      {
        var points=my.routes[route].getPoints();
        //alert('copying route '+route+'\n__________\n'+points.join('\n'));
        my.routes.rx.setPoints(points).drawRoute(my.maps.map2);
      }
