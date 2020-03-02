<style>
	<?php include '/root/ISP_CU_A/www/css/card-control.css'; // include css?>
</style>
<?php
// start the session
session_start();

// IMPORT
// func inc
require_once 'includes/functions.inc.php';
// func manage vue
require_once 'vue/vue-mana.php';
// function Etat that display card manager
require_once 'vue/all-vue/Etat.php';
// verif Aut
isAutorize('AMVersion');

// LOAD HTML
// load the heading
print(loadHTML("base.php"));
// load the body
print(loadHTML("body.php"));

// get the setup in the db
$AllVersions = getVersions();
// array of card
$cards = array();

// this remove the h_ in front of the name
foreach($AllVersions as $key => $value)
{
	if(((string)$key[0].(string)$key[1]) !== "h_"){
		// ignore it
	}else{
		// is set and is here
		$cards[$key] = $value;
	}
}
// the Daemon take only a number to return the state of the card, but here is the number for each name
$ispEquivalNum = array(
	"ISP_DAC16_1" 		=> "0",
	"ISP_DAC16_2" 		=> "1",
	"ISP_HDMI_INT" 		=> "2",
	"ISP_IO" 			=> "4",
	"ISP_DSP" 			=> "5",
	"ISP_XLR18" 		=> "6",
	"ISP_ADC_DAC4" 		=> "7",
	"ISP_DIGIN" 		=> "8",
	"ISP_DIGOUT" 		=> "9",
	"IISP_DB25" 		=> "10",
	"IISP_DB25_2" 		=> "16",
	"ISP_XLR8_1" 		=> "11",
	"ISP_XLR8_2" 		=> "12",
	"IISP_XLR2" 		=> "13",
	"IISP_XLR4" 		=> "14",
	"ISP_RCA8" 			=> "15",
	"ISP_RCA8_2" 		=> "17",
	"ISP_AVB" 			=> "18",
	"ISP_DAC_XLR4" 		=> "19",
	"ISP_PSU" 			=> "20",
	"ISP_HMC" 			=> "21",
	"ISP_BACKINT" 		=> "22",
	"ISP_ADC_DAC2" 		=> "23",
	"ISP_XLR16" 		=> "24",
	"ISP_DAC16_V2_1" 	=> "25",
	"ISP_DAC16_V2_2" 	=> "26",
	"HDMI" 				=> "",
	"ISP_AP" 			=> "43"
);
// the name in the DB and by the Daemon are not the same (yea ^ ^) but here are the translation 
$ispEquivalName = array(
	"ISP_DAC16_1" 		=> "ISP_DAC16_BOARD_1",
	"ISP_DAC16_2" 		=> "ISP_DAC16_BOARD_2",
	"ISP_HDMI_INT" 		=> "ISP_HDMI_INT_BOARD",
	"ISP_IO" 			=> "ISP_IO_BOARD",
	"ISP_DSP" 			=> "ISP_DSP_BOARD",
	"ISP_XLR18" 		=> "ISP_XLR18_BOARD",
	"ISP_ADC_DAC4" 		=> "ISP_ADC_DAC4_x_BOARD",
	"ISP_DIGIN" 		=> "ISP_DIGIN_BOARD",
	"ISP_DIGOUT" 		=> "ISP_DIGOUT_BOARD",
	"IISP_DB25" 		=> "IISP_DB25_BOARD_1",
	"IISP_DB25_2" 		=> "IISP_DB25_BOARD_2",
	"ISP_XLR8_1" 		=> "ISP_XLR8_BOARD_1",
	"ISP_XLR8_2" 		=> "ISP_XLR8_BOARD_2",
	"IISP_XLR2" 		=> "IISP_XLR2_BOARD",
	"IISP_XLR4" 		=> "IISP_XLR4_BOARD",
	"ISP_RCA8" 			=> "ISP_RCA8_BOARD_1",
	"ISP_RCA8_2" 		=> "ISP_RCA8_BOARD_2",
	"ISP_AVB" 			=> "ISP_AVB_BOARD",
	"ISP_DAC_XLR4" 		=> "ISP_DAC_XLR4_BOARD",
	"ISP_PSU" 			=> "ISP_PSU_BOARD",
	"ISP_HMC" 			=> "ISP_HMC_BOARD",
	"ISP_BACKINT" 		=> "ISP_BACKINT_BOARD",
	"ISP_ADC_DAC2" 		=> "ISP_ADC_DAC2_BOARD",
	"ISP_XLR16" 		=> "ISP_XLR16_BOARD",
	"ISP_DAC16_V2_1" 	=> "ISP_DAC16V2_1",
	"ISP_DAC16_V2_2" 	=> "ISP_DAC16V2_2",
	"HDMI" 				=> "HDMI",
	"ISP_AP" 			=> "ISP_AP"
);
// the Etat function is the div that display the state "etat in french" of each card in the array given in params
// Param of Etat : $libel, $styleDiv, $policeTitle, $policeLabelCard, $classNone, $classEmpty, $classHere, $classbutton, $classSVG, $circleSize, $ispEquivalNum, $ispEquivalName,  $array
print(Etat("lesCartes", "div3", "police", "policeLabel", "div2", "div2", "div1", "button", "SNinput", "SVG", 15, $ispEquivalNum, $ispEquivalName, $cards));
?>