
function handleChange(element) {
  index = element.value;
  route = routes[index];
  console.log('Handling checked:' +element.checked+' for index' +index+ ' route is : ' + route); 

  if( route != null ) {
    route.setMap(element.checked ? map : null );
    }   
};