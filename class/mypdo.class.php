<?php
class mypdo extends PDO{

    private $PARAM_hote='localhost'; // le chemin vers le serveur
    private $PARAM_utilisateur='SiteDeFrance'; // nom d'utilisateur pour se connecter
    private $PARAM_mot_passe='SiteDeFrance'; // mot de passe de l'utilisateur pour se connecter
    private $PARAM_nom_bd='tourisme_france';
    private $connexion;
    public function __construct() {
    	try {

    		$this->connexion = new PDO('mysql:host='.$this->PARAM_hote.';dbname='.$this->PARAM_nom_bd, $this->PARAM_utilisateur, $this->PARAM_mot_passe,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    		//echo '<script>alert ("ok connex");</script>)';echo $this->PARAM_nom_bd;
    	}
    	catch (PDOException $e)
    	{
    		echo 'hote: '.$this->PARAM_hote.' '.$_SERVER['DOCUMENT_ROOT'].'<br />';
    		echo 'Erreur : '.$e->getMessage().'<br />';
    		echo 'N° : '.$e->getCode();
    		$this->connexion=false;
    		//echo '<script>alert ("pbs acces bdd");</script>)';
    	}
    }
    public function __get($propriete) {
    	switch ($propriete) {
    		case 'connexion' :
    			{
    				return $this->connexion;
    				break;
    			}
    	}
    }

    public function liste_article($title)
    {

		$requete='
    select a.h3, a.corps, s.nom, s.prenom
    from article a, page p, salarie s
    where a.page=p.id
    and p.title="'.$title.'"
    and a.salarie = s.id
    and now() > a.date_deb
    and now() < a.date_fin
    and a.publie = 1
    order by a.num_ordre asc
    ;';

    	$result=$this->connexion ->query($requete);
    	if ($result)

    	{

    			return ($result);
   		}
    	return null;
    }
    public function liste_dep()
    {

    	$requete='
      SELECT departement_code,departement_nom,libel
      FROM departement,region,departement_region
      WHERE departement_code= code_dep
      and code_reg=code
      order by departement_code;';

    	$result=$this->connexion ->query($requete);
    	if ($result)

    	{

    		return ($result);
    	}
    	return null;
    }
    public function liste_ville()
    {

      $requete='
      SELECT ville_id,ville_nom_reel
      FROM villes_france_free';

      $result=$this->connexion ->query($requete);
      if ($result)

      {

        return ($result);
      }
      return null;
    }

    public function trouve_toutes_les_ville_via_un_departement($id){
      $requete='
      SELECT vr.ville_nom_reel, vr.ville_id
      FROM villes_france_free vr, departement d
      WHERE vr.ville_departement = d.departement_code
      AND d.departement_code = '.$id.'
       Order by vr.ville_nom_reel;';

      $result=$this->connexion ->query($requete);
    	if ($result)

    	{

    		return ($result);
    	}
    	return null;
    }

    public function info_ville($id){
      $requete='
      SELECT vr.ville_departement, vr.ville_code_postal, vr.ville_nom_reel, vr.ville_latitude_deg, vr.ville_longitude_deg
      from villes_france_free vr
      where vr.ville_id = '.$id;

      $result=$this->connexion ->query($requete);
      if ($result)
      {
        return($result);
      }

      return null;

    }

}
?>
