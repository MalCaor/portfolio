$(document).ready(function() {
  $("#slider").css('display', 'none');
	} );
function js_change_dep(){
    var myselect = document.getElementById("list_dep");
    alert(myselect.options[myselect.selectedIndex].value);
  }
