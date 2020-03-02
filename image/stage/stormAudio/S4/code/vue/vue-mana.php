<?php
// gestion des vues / manage all vues
function loadHTML($argument){
	$path = "/root/ISP_CU_A/www/vue/all-vue/";
	if(strlen($path . $argument) === 0) {
		// no arg pass
		echo("<script>console.log('PHP: ERROR the argument is empty');</script>");
		return "WARNING NO ARGUMENT PASS";
	}else if(file_get_contents($path.$argument) === false){
		// the file don't exist
		echo("<script>console.log('PHP: ERROR the file ".$argument." dont exist');</script>");
		return "WARNING NO SUCH FILE AS ".$argument;
	}else{
		// the file exist so return it
		return(file_get_contents($path.$argument));
	}
}
?>