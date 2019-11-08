$(document).ready(function() {
  $("#slider").css('display', 'none');
  $("#list_ville").css('display', 'none');
  $("#info_ville").css('display', 'none');
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
    $("#info_ville").css('display', 'block');// affiche info ville
    //$("#info_ville").empty();//vide les infos
      	$.ajax({
         			      type: "POST",
              			url: "ajax/info_ville.php",
              			dataType: "json",
      			        encode: true,
              			data: "id_dep="+myselect.options[myselect.selectedIndex].value, // on envoie via post l’id
              			success: function(retour) {
                      //affiche les infos Ville
                      $("#ville_departement").val(retour ["ville_departement"]);
                      $("#ville_code_postal").val(retour ["ville_code_postal"]);
                      $("#ville_nom_reel").val(retour ["ville_nom_reel"]);
                      $("#ville_latitude_deg").val(retour ["ville_latitude_deg"]);
                      $("#ville_longitude_deg").val(retour ["ville_longitude_deg"]);

                      //modif de la carte
                      $("#map").empty();
                      init(Number(retour ["ville_longitude_deg"]), Number(retour ["ville_latitude_deg"]));
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
    function init(longi,latti) {
      var posi= [ longi,latti];
      var map = new ol.Map({
        target: "map",
        layers: [
          new ol.layer.Tile({
            source: new ol.source.OSM()
          })
        ],
        view: new ol.View({
        center: ol.proj.fromLonLat(posi),
        zoom: 14
              })
         });
    }
