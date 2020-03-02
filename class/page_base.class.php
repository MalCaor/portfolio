<?php

class page_base {
	protected $right_sidebar;
	protected $left_sidebar;
	protected $slider;
	protected $titre;
	protected $js=array('jquery-3.4.1.min','bootstrap.min');
	protected $css=array('perso','bootstrap.min','base', 'modele');
	protected $page;
	protected $metadescription="Bienvenue sur le site de promotion des sites touristiques de FRANCE";
	protected $metakeyword=array('france','site touristique','tourisme','géolocalisation' );
	protected $path='http://localhost/portfolio';

	public function __construct() {
		$numargs = func_num_args();
		$arg_list = func_get_args();
        if ($numargs == 1) {
			$this->titre=$arg_list[0];
		}
	}

	public function __set($propriete, $valeur) {
		switch ($propriete) {
			case 'css' : {
				$this->css[count($this->css)+1] = $valeur;
				break;
			}
			case 'slider' : {
				$this->slider = $valeur;
				break;
			}
			case 'js' : {
				$this->js[count($this->js)+1] = $valeur;
				break;
			}
			case 'metakeyword' : {
				$this->metakeyword[count($this->metakeyword)+1] = $valeur;
				break;
			}
			case 'titre' : {
				$this->titre = $valeur;
				break;
			}
			case 'metadescription' : {
				$this->metadescription = $valeur;
				break;
			}
			case 'right_sidebar' : {
				$this->right_sidebar = $this->right_sidebar.$valeur;
				break;
			}
			case 'left_sidebar' : {
				$this->left_sidebar = $this->left_sidebar.$valeur;
				break;
			}
			default:
			{
				$trace = debug_backtrace();
				trigger_error(
            'Propriété non-accessible via __set() : ' . $propriete .
            ' dans ' . $trace[0]['file'] .
            ' à la ligne ' . $trace[0]['line'],
            E_USER_NOTICE);

				break;
			}

		}
	}
	public function __get($propriete) {
		switch ($propriete) {
			case 'titre' :
				{
					return $this->titre;
					break;
				}
				case 'path' :
				{
					return $this->path;
					break;
				}
				default:
			{
				$trace = debug_backtrace();
        trigger_error(
            'Propriété non-accessible via __get() : ' . $propriete .
            ' dans ' . $trace[0]['file'] .
            ' à la ligne ' . $trace[0]['line'],
            E_USER_NOTICE);

				break;
			}

		}
	}
	/******************************Gestion des styles **********************************************/
	/* Insertion des feuilles de style */
	private function affiche_style() {
		foreach ($this->css as $s) {
			echo "<link rel='stylesheet'  href='".$this->path."/css/".$s.".css' />\n";
		}

	}
	/******************************Gestion du javascript **********************************************/
	/* Insertion  js */
	private function affiche_javascript() {
		foreach ($this->js as $s) {
			echo "<script src='".$this->path."/js/".$s.".js'></script>\n";
		}
	}
	/******************************affichage metakeyword **********************************************/

	private function affiche_keyword() {
		echo '<meta name="keywords" content="';
		foreach ($this->metakeyword as $s) {
			echo utf8_encode($s).',';
		}
		echo '" />';
	}
	/****************************** Affichage de la partie entÃªte ***************************************/
	protected function affiche_entete() {
		echo'
           <header>
				<h1>
					Portfolio
				</h1>
             </header>
		';
	}
	/****************************** Affichage du menu ***************************************/

	protected function affiche_menu() {
		echo '
				<ul >
					<li ><a   href="'.$this->path.'/Accueil" >Accueil </a></li>
				</ul>';
	}
	protected function affiche_menu_connexion() {

		if(!(isset($_SESSION['id']) && isset($_SESSION['type'])))
		{
			echo '
					<ul >
						<li><a  href="'.$this->path.'/Connexion">Connexion</a></li>
					</ul>';
		}
		else
		{
			echo '
					<ul >
						<li><a  href="'.$this->path.'/Deconnexion">Déconnexion</a></li>
					</ul>';
		}
	}
	public function affiche_entete_menu() {
		echo '
		<div id="menu_horizontal">
			<nav >
				<div >

				';

	}
	public function affiche_footer_menu(){
		echo '


				</div>
			</nav>
		</div>';

	}

		/****************************************** remplissage affichage colonne ***************************/
	public function rempli_right_sidebar() {
		return'


				<article>

                </article>
				';

	}

	/****************************************** Affichage du pied de la page ***************************/
	private function affiche_footer() {
		echo '
		<!-- Footer -->
			<footer>

            </footer>
		';
	}


	/****************************************** Affichage stormAudio ***************************/
	private function affiche_stage_stormAudio() {
		$pathO='http://localhost/portfolio';
		$pathI=$pathO.'/image/';
		$pathS = $pathO.'/image/stage/stormAudio/';
		$size = 200;
		echo '
			<p>Lien Projet :</p>
			<img src = "'.$pathI.'git.png" height="30"/><a href="https://github.com/MalCaor/Vumeter">Vumeter Git </a>
			</br>
			<img src = "'.$pathI.'git.png" height="30"/><a href="https://github.com/MalCaor/CardControlREADME">Card Manager Doc </a>

			<p>Semaine 1</p>
			<img src = "'.$pathS.'S1/bar.png" height="'.$size.'"/>
			<img src = "'.$pathS.'S1/column.png" height="'.$size.'"/>
			<img src = "'.$pathS.'S1/number.png" height="'.$size.'"/>

			<p>Semaine 2</p>
			<img src = "'.$pathS.'S2/vide.png" height="'.$size.'"/>
			<img src = "'.$pathS.'S2/finAtLast.png" height="'.$size.'"/>
			<img src = "'.$pathS.'S2/compl.png" height="'.$size.'"/>

			<p>Semaine 3</p>
			<img src = "'.$pathS.'S3/Screenshot from 2020-01-22 16-13-57.png" height="'.$size.'"/>
			<img src = "'.$pathS.'S3/Screenshot from 2020-01-23 10-26-15.png" height="'.$size.'"/>
			<img src = "'.$pathS.'S3/Screenshot from 2020-01-23 14-22-57.png" height="'.$size.'"/>

			<p>Semaine 4</p>
			<img src = "'.$pathS.'S4/MainBoardInfo.png" height="'.$size.'"/>
			<img src = "'.$pathS.'S4/Screenshot from 2020-01-27 17-09-54.png" height="'.$size.'"/>
			<img src = "'.$pathS.'S4/Screenshot from 2020-02-05 09-54-14.png" height="'.$size.'"/>

			<p>Semaine 5</p>
			<img src = "'.$pathS.'S5/Screenshot from 2020-02-06 11-05-01.png" height="'.$size.'"/>
			<img src = "'.$pathS.'S5/Screenshot from 2020-02-06 15-03-38.png" height="'.$size.'"/>
			<img src = "'.$pathS.'S5/Screenshot from 2020-02-07 16-51-23.png" height="'.$size.'"/>

			<p>Semaine 6</p>
			<img src = "'.$pathS.'S6/Screenshot from 2020-02-11 10-49-20.png" height="'.$size.'"/>
			<img src = "'.$pathS.'S6/Screenshot from 2020-02-10 15-56-35.png" height="'.$size.'"/>
			<img src = "'.$pathS.'S6/Screenshot from 2020-02-12 16-29-19.png" height="'.$size.'"/>
		';
	}



	/********************************************* Fonction permettant l'affichage de la page ****************/

	public function affiche() {


		?>
			<!DOCCTYPE html>
			<html lang='fr'>
				<head>
					<title><?php echo $this->titre; ?></title>
					<meta http-equiv="content-type" content="text/html; charset=utf-8" />
					<meta name="description" content="<?php echo $this->metadescription; ?>" />

					<?php $this->affiche_keyword(); ?>
					<?php $this->affiche_javascript(); ?>
					<?php $this->affiche_style(); ?>
				</head>
				<body>
				<div class="global">

						<?php $this->affiche_entete(); ?>
						<?php $this->affiche_entete_menu(); ?>
						<?php $this->affiche_stage_stormAudio(); ?>
						<?php $this->affiche_footer_menu(); ?>
					</div>
				</body>
			</html>
		<?php
	}

}

?>
