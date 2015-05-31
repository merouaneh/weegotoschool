
function handleChange(element) {
    index = element.value;
    route = routes[index];
    console.log('Handling checked:' +element.checked+' for index' +index+ ' route is : ' + route); 

    if( route != null ) {
        route.setMap(element.checked ? map : null );
    }   
};


function toggleAll(element) {
    var target = element.htmlFor;
    console.log('Toggling all checkboxes for target ' + target); 

    var checkboxes = document.getElementsByName(target);
    if( target.indexOf("[]") > -1 ) {
        console.log('Elements with name ' + target + ' : ' + checkboxes.length); 
    } else {
        checkboxes = document.querySelectorAll("input[value=" + target + "]");
    }

    var checked = !checkboxes[0].checked;
    for(var i = 0 ; i < checkboxes.length; i++) {
        checkboxes[i].checked = checked;
    } 

};