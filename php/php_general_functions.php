<?php

function _m_d_yyyy_($date){
	$in_word = "";
	if($date != "0000-00-00"){
		$d = explode("-", $date);
		$months = array("January","February","March","April","May","June","July","August","September","October","November","December");
		$in_word = $months[(int)$d[1] - 1]." ".$d[2].", ".$d[0];
	}else{
		$in_word = "";
	}
	return $in_word;
}

function get_complete_name($name){
	$fnwd = array(
		"Gerna M. Manatad"=>"GERNA M. MANATAD, MD, PHSAE, CESE, MDM",
		"Jose  R. Llacuna Jr."=>"JOSE R. LLACUNA,JR.,MD,MPH,CESO III"
	);
	return (array_key_exists($name,$fnwd)) ? $fnwd[$name] : $name;
}

function get_account_code($category,$index){
	$account_codes = array(
		"ICT Equipments"=>array("10405030","10605030"),
		"Communication Equipments"=>array("10405070","10605070"),
		"Drugs and Medicines"=>array("10402990",""),
		"Furniture"=>array("10406010","10607010"),
		"Housekeeping Supplies"=>array("",""),
		"ICT Supplies"=>array("10405030","10605030"),
		"Library"=>array("10406010","10607020"),
		"Medical Equipment"=>array("10405100","10605110"),
		"Medical Supplies"=>array("10402990",""),
		"Office Equipment"=>array("10405020","10605020"),
		"Office Supplies"=>array("10404010",""),
		"Other Supplies"=>array("10404990","10604990"),
		"Property and Equipment for Distribution"=>array("10402090","10602090"),
		"Software Application"=>array("10405030","10605030"),
		"Various Supplies"=>array("10404990","10604990")
	);
	return (array_key_exists($category, $account_codes)) ? $account_codes[$category][$index] : "";
}

?>