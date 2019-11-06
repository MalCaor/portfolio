<?php
include_once('../class/autoload.php');
$data = array();
$mypdo=new mypdo();
if(isset($_POST['id_dep']))
{
	// exécution de la requête
	$resultat = $mypdo->info_ville($_POST['id_dep']);
	if(isset($resultat))
	{
  //  var_dump( $donnees);
    $donnees = $resultat->fetch(PDO::FETCH_OBJ);
    $data["ville_departement"][] = ($donnees->ville_departement);
    $data["ville_code_postal"][] = ($donnees->ville_code_postal);
    $data["ville_nom_reel"][] = ($donnees->ville_nom_reel);
    $data["ville_latitude_deg"][] = ($donnees->ville_latitude_deg);
    $data["ville_longitude_deg"][] = ($donnees->ville_longitude_deg);
	}
}
// renvoit un tableau dynamique encodé en json
echo json_encode($data);
?>
