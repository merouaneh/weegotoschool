

var data  = new Array();
var checkboxes = document.getElementsByName('route');
for (var i=0, n=checkboxes.length;i<n;i++) {
  var element = checkboxes[i];
  address = element.getAttribute('address');
  label = element.getAttribute('label');
  content = element.getAttribute('content');
  myLabel = label + '<br/>' + address + (content != null ? '<br/>' + content : '');
  data.push({ label: myLabel , address: address });

  var letter = String.fromCharCode("A".charCodeAt(0) + i);
  var img = document.createElement('img');
  img.src = 'http://maps.gstatic.com/mapfiles/markers2/marker_green' + letter + '.png';
  //element.parentNode.insertBefore(img, element);
  
  //var label = document.createElement('label');
  //label.for = element.parentNode.id;
 // label.innerHTML = '[' + letter + ']' + element.parentNode.innerHTML;
  element.parentNode.innerHTML = '[' + letter + ']' + element.parentNode.innerHTML
  //element.parentNode.insertBefore(label, element);

}

var nextAddress = 0;
function theNext() {
  if (nextAddress < data.length) {
    var location = data[nextAddress];
    setTimeout('geocodeAddress("'+location.address+'", "'+location.label+'" , theNext)', delay);
    nextAddress++;
  } else {
    map.fitBounds(bounds);
  }
}
theNext();


