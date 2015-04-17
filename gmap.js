

var my={ directionsSVC:new google.maps.DirectionsService(), maps:{}, routes:{}};
      
/**
 * base-class     
 * @param points optional array array of lat+lng-values defining a route
 * @return object Route
 **/                     
function Route(points, strokeColor) {     
  this.origin       = null;
  this.destination  = null;
  this.waypoints    = [];
  this.strokeColor    = strokeColor;
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

/**
  *  draws route on a map 
  *              
  * @param map object google.maps.Map 
  * @return object Route
  **/                    
Route.prototype.drawRoute = function(map) {
  var _this=this;
  my.directionsSVC.route(
    {'origin': this.origin,
     'destination': this.destination,
     'waypoints': this.waypoints,
     'travelMode': google.maps.DirectionsTravelMode.DRIVING
    },
    function(res,sts) {
        if(sts==google.maps.DirectionsStatus.OK){
        if(!_this.directionsRenderer)
        {
        //  { polylineOptions: { strokeWeight: 4, strokeOpacity: 1, strokeColor:  'red' }
          _this.directionsRenderer = new google.maps.DirectionsRenderer({ polylineOptions: { strokeWeight: 6, strokeOpacity: 0.4, strokeColor: _this.strokeColor},  'draggable':true }); 
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
Route.prototype.setPoints = function(points)
{
  this.origin = null;
  this.destination = null;
  this.waypoints = [];
  if(points)
  {
    for(var p=0;p<points.length;++p)
    {
      this.waypoints.push({location:new google.maps.LatLng(points[p][0], points[p][1]), stopover:false});
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
Route.prototype.getPoints = function() {
  var points=[[this.origin.lat(),this.origin.lng()]];
  for(var w=0;w<this.waypoints.length;++w) {
    points.push([this.waypoints[w].location.lat(), this.waypoints[w].location.lng()]);
  }
  points.push([this.destination.lat(), this.destination.lng()]);
  return points;
};

Location.prototype.getLatLong = function() {
  var geocode = geocoder = new google.maps.Geocoder();
  geocoder.geocode({ 'address':this.stringAddress}, function(results, status){

  if (status == google.maps.GeocoderStatus.OK) {
    lat = results[0].geometry.location.lat();
    lng = results[0].geometry.location.lng();
   // color = '#'+Math.floor(Math.random()*16777215).toString(16);
    color = randomColor( {luminosity: 'dark',  hue: 'green'});
   // alert(color);
    new Route([ [48.95708459999999,2.5611887000000024], [lat, lng], ], color).drawRoute(my.maps.map1);
  } else {
    alert("No results found for address: " + this.stringAddress);
  }
});

};


function initialize() {
//  alert("bbbgetLatLong: " + getLatLong('avenue louis breguet, villepinte'));

 var myOptions = { zoom: 8, center: new google.maps.LatLng(48.95708459999999,2.5611887000000024), mapTypeId: google.maps.MapTypeId.ROADMAP };
 my.maps.map1 = new google.maps.Map(document.getElementById('map_canvas'),
                                     myOptions);

my.routes.rx=new Route();
  
new Location('avenue maurice utrillo, montmagny').getLatLong();
new Location('rue francois mitterand, pierrefitte').getLatLong();
new Location('PAris').getLatLong();
new Location('mitry-mory').getLatLong();
new Location('tremblay').getLatLong();

}

google.maps.event.addDomListener(window, 'load', initialize);
function fx(route)
{
  var points=my.routes[route].getPoints();
  //alert('copying route '+route+'\n__________\n'+points.join('\n'));
  my.routes.rx.setPoints(points).drawRoute(my.maps.map2);
}









;(function(root, factory) {

  // Support AMD
  if (typeof define === 'function' && define.amd) {
    define([], factory);

  // Support CommonJS
  } else if (typeof exports === 'object') {
    var randomColor = factory();
    
    // Support NodeJS & Component, which allow module.exports to be a function
    if (typeof module === 'object' && module && module.exports) {
      exports = module.exports = randomColor;
    }
    
    // Support CommonJS 1.1.1 spec
    exports.randomColor = randomColor;
  
  // Support vanilla script loading
  } else {
    root.randomColor = factory();
  };

}(this, function() {

  // Shared color dictionary
  var colorDictionary = {};

  // Populate the color dictionary
  loadColorBounds();

  var randomColor = function(options) {
    options = options || {};

    var H,S,B;

    // Check if we need to generate multiple colors
    if (options.count != null) {

      var totalColors = options.count,
          colors = [];

      options.count = null;

      while (totalColors > colors.length) {
        colors.push(randomColor(options));
      }

      options.count = totalColors;

      return colors;
    }

    // First we pick a hue (H)
    H = pickHue(options);

    // Then use H to determine saturation (S)
    S = pickSaturation(H, options);

    // Then use S and H to determine brightness (B).
    B = pickBrightness(H, S, options);

    // Then we return the HSB color in the desired format
    return setFormat([H,S,B], options);
  };

  function pickHue (options) {

    var hueRange = getHueRange(options.hue),
        hue = randomWithin(hueRange);

    // Instead of storing red as two seperate ranges,
    // we group them, using negative numbers
    if (hue < 0) {hue = 360 + hue}

    return hue;

  }

  function pickSaturation (hue, options) {

    if (options.luminosity === 'random') {
      return randomWithin([0,100]);
    }

    if (options.hue === 'monochrome') {
      return 0;
    }

    var saturationRange = getSaturationRange(hue);

    var sMin = saturationRange[0],
        sMax = saturationRange[1];

    switch (options.luminosity) {

      case 'bright':
        sMin = 55;
        break;

      case 'dark':
        sMin = sMax - 10;
        break;

      case 'light':
        sMax = 55;
        break;
   }

    return randomWithin([sMin, sMax]);

  }

  function pickBrightness (H, S, options) {

    var brightness,
        bMin = getMinimumBrightness(H, S),
        bMax = 100;

    switch (options.luminosity) {

      case 'dark':
        bMax = bMin + 20;
        break;

      case 'light':
        bMin = (bMax + bMin)/2;
        break;

      case 'random':
        bMin = 0;
        bMax = 100;
        break;
    }

    return randomWithin([bMin, bMax]);

  }

  function setFormat (hsv, options) {

    switch (options.format) {

      case 'hsvArray':
        return hsv;

      case 'hslArray':
        return HSVtoHSL(hsv);

      case 'hsl':
        var hsl = HSVtoHSL(hsv);
        return 'hsl('+hsl[0]+', '+hsl[1]+'%, '+hsl[2]+'%)';

      case 'rgbArray':
        return HSVtoRGB(hsv);

      case 'rgb':
        var rgb = HSVtoRGB(hsv);
        return 'rgb(' + rgb.join(', ') + ')';

      default:
        return HSVtoHex(hsv);
    }

  }

  function getMinimumBrightness(H, S) {

    var lowerBounds = getColorInfo(H).lowerBounds;

    for (var i = 0; i < lowerBounds.length - 1; i++) {

      var s1 = lowerBounds[i][0],
          v1 = lowerBounds[i][1];

      var s2 = lowerBounds[i+1][0],
          v2 = lowerBounds[i+1][1];

      if (S >= s1 && S <= s2) {

         var m = (v2 - v1)/(s2 - s1),
             b = v1 - m*s1;

         return m*S + b;
      }

    }

    return 0;
  }

  function getHueRange (colorInput) {

    if (typeof parseInt(colorInput) === 'number') {

      var number = parseInt(colorInput);

      if (number < 360 && number > 0) {
        return [number, number];
      }

    }

    if (typeof colorInput === 'string') {

      if (colorDictionary[colorInput]) {
        var color = colorDictionary[colorInput];
        if (color.hueRange) {return color.hueRange}
      }
    }

    return [0,360];

  }

  function getSaturationRange (hue) {
    return getColorInfo(hue).saturationRange;
  }

  function getColorInfo (hue) {

    // Maps red colors to make picking hue easier
    if (hue >= 334 && hue <= 360) {
      hue-= 360;
    }

    for (var colorName in colorDictionary) {
       var color = colorDictionary[colorName];
       if (color.hueRange &&
           hue >= color.hueRange[0] &&
           hue <= color.hueRange[1]) {
          return colorDictionary[colorName];
       }
    } return 'Color not found';
  }

  function randomWithin (range) {
    return Math.floor(range[0] + Math.random()*(range[1] + 1 - range[0]));
  }

  function HSVtoHex (hsv){

    var rgb = HSVtoRGB(hsv);

    function componentToHex(c) {
        var hex = c.toString(16);
        return hex.length == 1 ? "0" + hex : hex;
    }

    var hex = "#" + componentToHex(rgb[0]) + componentToHex(rgb[1]) + componentToHex(rgb[2]);

    return hex;

  }

  function defineColor (name, hueRange, lowerBounds) {

    var sMin = lowerBounds[0][0],
        sMax = lowerBounds[lowerBounds.length - 1][0],

        bMin = lowerBounds[lowerBounds.length - 1][1],
        bMax = lowerBounds[0][1];

    colorDictionary[name] = {
      hueRange: hueRange,
      lowerBounds: lowerBounds,
      saturationRange: [sMin, sMax],
      brightnessRange: [bMin, bMax]
    };

  }

  function loadColorBounds () {

    defineColor(
      'monochrome',
      null,
      [[0,0],[100,0]]
    );

    defineColor(
      'red',
      [-26,18],
      [[20,100],[30,92],[40,89],[50,85],[60,78],[70,70],[80,60],[90,55],[100,50]]
    );

    defineColor(
      'orange',
      [19,46],
      [[20,100],[30,93],[40,88],[50,86],[60,85],[70,70],[100,70]]
    );

    defineColor(
      'yellow',
      [47,62],
      [[25,100],[40,94],[50,89],[60,86],[70,84],[80,82],[90,80],[100,75]]
    );

    defineColor(
      'green',
      [63,178],
      [[30,100],[40,90],[50,85],[60,81],[70,74],[80,64],[90,50],[100,40]]
    );

    defineColor(
      'blue',
      [179, 257],
      [[20,100],[30,86],[40,80],[50,74],[60,60],[70,52],[80,44],[90,39],[100,35]]
    );

    defineColor(
      'purple',
      [258, 282],
      [[20,100],[30,87],[40,79],[50,70],[60,65],[70,59],[80,52],[90,45],[100,42]]
    );

    defineColor(
      'pink',
      [283, 334],
      [[20,100],[30,90],[40,86],[60,84],[80,80],[90,75],[100,73]]
    );

  }

  function HSVtoRGB (hsv) {

    // this doesn't work for the values of 0 and 360
    // here's the hacky fix
    var h = hsv[0];
    if (h === 0) {h = 1}
    if (h === 360) {h = 359}

    // Rebase the h,s,v values
    h = h/360;
    var s = hsv[1]/100,
        v = hsv[2]/100;

    var h_i = Math.floor(h*6),
      f = h * 6 - h_i,
      p = v * (1 - s),
      q = v * (1 - f*s),
      t = v * (1 - (1 - f)*s),
      r = 256,
      g = 256,
      b = 256;

    switch(h_i) {
      case 0: r = v, g = t, b = p;  break;
      case 1: r = q, g = v, b = p;  break;
      case 2: r = p, g = v, b = t;  break;
      case 3: r = p, g = q, b = v;  break;
      case 4: r = t, g = p, b = v;  break;
      case 5: r = v, g = p, b = q;  break;
    }
    var result = [Math.floor(r*255), Math.floor(g*255), Math.floor(b*255)];
    return result;
  }

  function HSVtoHSL (hsv) {
    var h = hsv[0],
      s = hsv[1]/100,
      v = hsv[2]/100,
      k = (2-s)*v;

    return [
      h,
      Math.round(s*v / (k<1 ? k : 2-k) * 10000) / 100,
      k/2 * 100
    ];
  }

  return randomColor;
}));











