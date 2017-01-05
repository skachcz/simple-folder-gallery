 /* listener for click to wrapper div*/
document.getElementById("wrapper").addEventListener("click", function(e){
    
	var wrapper = document.getElementById("wrapper");
	var width = wrapper.clientWidth;
	var x = e.pageX;
	
	if(width/2 > x)
		window.location = 'index.php?id=' + window.prev;
    else
		window.location = 'index.php?id=' + window.next;	
});

/* listener for keyboard control */
window.addEventListener("keydown", function(e){
    if (e.keyCode == 37) { // left arrow key
		window.location = 'index.php?id=' + window.prev; // redirect
        return false;
    }
    if (e.keyCode == 39 || e.keyCode == 32) { //right arrow key, space
		window.location = 'index.php?id=' + window.next; // redirect
        return false;
    }
});