<?php
// the Etat function is the div that display the state "etat in french" of each card in the array given in params
function Etat($libel, $styleDiv, $policeTitle, $policeLabelCard, $classNone, $classEmpty, $classHere, $classButton, $classSN, $classSVG, $circleSize, $ispEquivalNum, $ispEquivalName,  $array) {
	// $retour is the string var of the html that will be display
	$retour = "
		<div id=".$libel." class=".$styleDiv.">
			<p class=".$policeTitle.">  LES CARTES </p>";
	// checkbox that unable verification
	$retour = $retour."<input type='checkbox' id='verif' name='verif'> Deactivate Verification (if checked no verification will be done so be carefull)</br></br>";


	// div all Card
	$retour = $retour."<div>";
				// foreach CARD in the array
				foreach ($array as $key => $value) {
					// display card

					// the name get rid of h_
					$name = str_replace("h_","", $key);

					// this change the color of the div (red = not ok (not here or empty) and green = ok)
					if((string)$value === "None"){
						// it's not here
						$retour = $retour."<div class='".$classNone."'>";
					}elseif ((string)$value === "p/n NA rev NA") {
						// it's empty
						$retour = $retour."<div class='".$classEmpty."'>";
					}else{
						// it's here
						$retour = $retour."<div class='".$classHere."'>";
					}
					// this form go on an other page that apply the changes and is automaticaly redirected here and is link on sub to a js page that verify the info
					$retour = $retour."<script type='text/javascript'>
					function validateForm".$name."() {
						if(document.getElementById('verif').checked){
							return true;
						}else{
						var x = document.forms['cardForm".$name."']['CardNum'].value;
						var first = x.indexOf(';');
						if (first > -1){
							var sec = x.indexOf(';', (first + 1));
							if (sec > -1){
								var ToMany = x.indexOf(';', (sec + 1));
								if (ToMany > -1){
									alert('Too many (;) !');
									return false;
								}
								if ((sec - first) == 1){
									alert('SerialNumber not Valide');
									return false;
								}
								if (x.slice(-1) == ';'){
									alert('Card Number not Valide');
									return false;
								}
								if(first == 0){
									if(confirm('You dont have enter any version number')){

									}else{
										return false;
									}
								}
								
;
								return true;
							}
							alert('Miss one (;) !');
							return false;
						}
						alert('Miss two (;) !');
						return false;
					}
					}
					</script>
					<form name='cardForm".$name."' action='/card-Change.php' method='post' onsubmit='return validateForm".$name."()' >";
					// the input to set the name
					$retour = $retour."<input type='hidden' name='name' value=".str_replace("h_","", $key).">";

					// display the circle, grey = not here, red = empty, green = here and fill
					$carre = $circleSize;//15;
					$ray = $carre/2;
					if((string)$value === "None"){
						// it's not here
						$retour = $retour."
						<svg class=".$classSVG." height='".$carre."' width='".$carre."'>
  							<circle cx='".$ray."' cy='".$ray."' r='".$ray."' stroke='black' stroke-width='1' fill='grey' />
						</svg>";
					}elseif ((string)$value === "p/n NA rev NA") {
						// it's empty
						$retour = $retour."
						<svg class=".$classSVG." height='".$carre."' width='".$carre."'>
  							<circle cx='".$ray."' cy='".$ray."' r='".$ray."' stroke='black' stroke-width='1' fill='red' />
						</svg>";
					}else{
						// it's here
						$retour = $retour."
						<svg class=".$classSVG." height='".$carre."' width='".$carre."'>
  							<circle cx='".$ray."' cy='".$ray."' r='".$ray."' stroke='black' stroke-width='1' fill='green' />
						</svg>";
					}
					$retour = $retour."<p class=".$policeLabelCard.">".str_replace("h_","", $key)."</p>";
					// the name get rid of h_
					$name = str_replace("h_","", $key);

					// button modif serial number
					if ((string)$value === "None"){
						// if it's none it's not here so you can't modify it
						$retour = $retour."<input type='text' class=".$classSN." id='CardNum' name='CardNum' value='None' readonly>";
						
					}elseif((string)$value === "p/n NA rev NA"){
						// the value is not set but can be set
						$retour = $retour."<input type='text' id='CardNum' class=".$classSN." name='CardNum' value='Empty' required>";
						$retour = $retour."<input type='hidden' name='id' value=".$ispEquivalNum[(string)$name].">";
						$retour = $retour."<input type='hidden' id='Empty' name='Empty' value='Empty'>";
						$retour = $retour." <input type='submit' class='".$classButton."' value='Change SN' name='button'>";
					}else{
						// unset the array (just in case)
						unset($serialNumberArr);
						// exec the command in prompt on the server
						exec("sudo /root/ISP_CU/bin/ISP_CU_AP_D -e ".$ispEquivalNum[(string)$name], $serialNumberArr);
						// clean the return from useless thing
						foreach ($serialNumberArr as $key => $value) {
							$serialNumber = str_replace("reading eeprom board","", $value); // remove verbose
							$serialNumber = str_replace((string)$name." : ","", $serialNumber); // remove the name
						}
						// the id of the card is post for the modification command lign
						$retour = $retour."<input type='hidden' name='id' value=".$ispEquivalNum[(string)$name].">";
						// card num take only the usefull stuf and get ride of stuff that change from card to card
						$CardNum = "";
						// lenght of the serial Number
						$lenght = strlen($serialNumber);
						// lööp and write backward in CardNum until it collide with a " " so it stop (or if there is no char left of course)
						for ($i = $lenght; ($i > 0 ); $i= $i-1){
							if($serialNumber[$i] == " "){
								break;
							}
							$CardNum = $serialNumber[$i].$CardNum;
						}
						// the name get rid of h_
						$name = str_replace("h_","", $key);
						// display the result in a input and required for the form
						$retour = $retour."<input type='text' id='CardNum' class=".$classSN." name='CardNum' value='".$CardNum."' required >";
						// submit button
						$retour = $retour." <input type='submit' class='".$classButton."' value='Apply Change' name='button'>";
					}
					// end of the card form and let a space between each lign
					$retour = $retour."</form></div></br>";
				}
				// end the div
				$retour = $retour."
			</div>
		</div>
	";
	// return the html
	return $retour;
}
?>