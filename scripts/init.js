

var data  = new Array();
var checkboxes = document.getElementsByName('route');
for (var i=0, n=checkboxes.length;i<n;i++) {
  var element = checkboxes[i];
  address = element.getAttribute('data-address');
  label =  element.getAttribute('data-label');
  //TODO change this by using classes on these labels to format content with CSS
  content = '<i>' + element.getAttribute('data-content') + '</i>';
  cov = element.getAttribute('data-content');
  content += '<table><tr><td>' + element.getAttribute('data-content') + '</i>';

  myLabel = label + '<br/>' + address + (content != null ? '<br/>' + content : '');
  data.push({ label: myLabel , address: address });

  var letter = getHexavigesimalValue( i - 1 );
  var img = document.createElement('img');
  if( letter.charCodeAt(0) == "@".charCodeAt(0) ) {
    letter = ' ';
  }

  if(i == 0) {
    img.src = 'http://www.google.com/mapfiles/arrow.png'
  }
  var div = document.createElement('div');
  div.className = 'mycell';
  var rowDiv = element.parentNode.parentNode.parentNode;


  var label = document.createElement('label');
  label.innerHTML = letter;
  label.htmlFor = 'route_'+ i;
  element.parentNode.parentNode.insertBefore(label,element.parentNode);

  var label = document.createElement('label');
  label.for = element.parentNode.id;
  label.innerHTML = '[' + letter + ']' + element.parentNode.innerHTML;
  //element.parentNode.innerHTML = '[' + letter + ']' + element.parentNode.innerHTML
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


