
function handleChange(element) {
    index = element.value;
    route = routes[index];
    console.log('Handling checked:' + element.checked + ' for index' +index+ ' route is : ' + route); 

    if( route != null ) {
        route.setMap(element.checked ? map : null );
    }   
};


function toggleAll(element) {
    var target = element.htmlFor;
    console.log('Toggling all checkboxes for target ' + target); 

    var checkboxes = document.getElementsByName(target);
    var start = 1;
    if( target.indexOf("[]") < 0 ) {
        checkboxes = document.querySelectorAll("input[value=" + target + "]");
        start = 0;
    }
    console.log('Elements with name ' + target + ' : ' + checkboxes.length); 
    var checked = !checkboxes[0].checked;
    console.log('All elements will be set to checked= ' + checked); 
    for(var i = start ; i < checkboxes.length; i++) {
       checkboxes[i].checked = checked;
    } 
};
