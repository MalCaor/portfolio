$(document).ready(function() {
  $("#slider").css('display', 'none');
  $("#list_ville").css('display', 'none');
	} );
function js_change_dep(){
    $("#list_ville").css('display', 'block');
    var myselect = document.getElementById("list_dep");
    $("#list_ville").empty();//vide la combo box
    	$.ajax({
       			      type: "POST",
            			url: "ajax/recherche_ville.php",
            			dataType: "json",
    			        encode: true,
            			data: "id_dep="+myselect.options[myselect.selectedIndex].value, // on envoie via post l’id
            			success: function(retour) {

                			$.each(retour, function(index, value)
                			 { // pour chaque noeud JSON
                    		// on ajoute l option dans la liste
                        //  alert(index);
                        if(index != null || value != null)
                        {
                    			     $("#list_ville").append("<option value="+ value +">"+ index +"</option>");
                        }

                        });
       						$("#list_ville").focus();
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
  }

  function js_change_ville(){
    var myselect = document.getElementById("list_ville");
      $("#info_ville").empty();//vide les infos
      	$.ajax({
         			      type: "POST",
              			url: "ajax/info_ville.php",
              			dataType: "json",
      			        encode: true,
              			data: "id_dep="+myselect.options[myselect.selectedIndex].value, // on envoie via post l’id
              			success: function(retour) {
                      $("#info_ville").val(retour ["ville_departement"]);
                      $("#info_ville").val(retour ["ville_code_postal"]);
                      $("#info_ville").val(retour ["ville_nom_reel"]);
                      $("#info_ville").val(retour ["ville_latitude_deg"]);
                      $("#info_ville").val(retour ["ville_longitude_deg"]);
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
    }
