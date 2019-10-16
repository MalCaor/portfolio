$(document).ready(function() {
  $("#slider").css('display', 'none');
	} );
function js_change_dep(){
    var myselect = document.getElementById("list_dep");
    alert(myselect.options[myselect.selectedIndex].value);
  }
$("#liste_ville").empty();//vide la combo box
	$.ajax({
   			type: "POST",
        			url: "ajax/recherche_ville.php",
        			dataType: "json",
			encode          : true,
        			data: "id_dep="+myselect.options[myselect.selectedIndex].value, // on envoie via post l’id
        			success: function(retour) {

            			$.each(retour, function(index, value)
            			 { // pour chaque noeud JSON
                		// on ajoute l option dans la liste
                			$("#liste_ville").append("<option value="+ value +">"+ index +"</option>");						});
   						$("#liste_ville").focus();
   					},
   			error: function(jqXHR, textStatus)
			{
			// traitement des erreurs ajax
     			if (jqXHR.status === 0){alert("Not connect.n Verify Network.");}
    			else if (jqXHR.status == 404){alert("Requested page not found. [404]");}
				else if (jqXHR.status == 500){alert("Internal Server Error [500].");}
				else if (textStatus === "parsererror"){alert("Requested JSON parse failed.");}
				else if (textStatus === "timeout"){alert("Time out error.");}
				else if (textStatus === "abort"){alert("Ajax request aborted.");}
				else{alert("Uncaught Error.n" + jqXHR.responseText);}
			}
   	});
