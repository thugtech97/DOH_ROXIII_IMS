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

function get_account_code($type, $category,$index){
	$acc_code = "";
	$account_codes = array(
		"ICT Equipments"=>array("10405030","10605030"),
		"Communication Equipments"=>array("10405070","10605070"),
		"Drugs and Medicines"=>array("10401010-02",""),
		"Furniture"=>array("10406010","10607010"),
		"Housekeeping Supplies"=>array("",""),
		"ICT Supplies"=>array("10405030","10605030"),
		"Library"=>array("10406010","10607020"),
		"Medical Equipment"=>array("10405100","10605110"),
		"Medical Supplies"=>array("10402990",""),
		"Office Equipment"=>array("10405020","10605020"),
		"Office Supplies"=>array("10404010",""),
		"Other Supplies"=>array("10404990","10604990"),
		"Software Application"=>array("10405030","10605030"),
		"Various Supplies"=>array("10404990","10604990")
	);
	$ptr_codes = array(
		"Property and Equipment for Distribution"=>array("10402090","10602090"),
		"Drugs and Medicines"=>array("10402030",""),
		"Textbooks and Instructional Materials for Distribution"=>array("10402070",""),
		"Other Supplies and Materials for Distribution"=>array("10402990","10602990")
	);

	if($type != "PTR"){
		$acc_code = (array_key_exists($category, $account_codes)) ? $account_codes[$category][$index] : "";
	}else{
		switch($category){
			case "Drugs and Medicines":
				$acc_code = $ptr_codes[$category][0];
				break;
			case "Medical Supplies":
				$acc_code = $ptr_codes["Other Supplies and Materials for Distribution"][0];
				break;
			case "Office Supplies":
				$acc_code = $ptr_codes["Other Supplies and Materials for Distribution"][0];
				break;
			case "Various Supplies":
				$acc_code = $ptr_codes["Other Supplies and Materials for Distribution"][0];
				break;
			case "Other Supplies":
				$acc_code = $ptr_codes["Other Supplies and Materials for Distribution"][0];
				break;
			case "ICT Supplies":
				$acc_code = $ptr_codes["Other Supplies and Materials for Distribution"][0];
				break;
			case "Housekeeping Supplies":
				$acc_code = $ptr_codes["Other Supplies and Materials for Distribution"][0];
				break;
			case "Library":
				$acc_code = $ptr_codes["Textbooks and Instructional Materials for Distribution"][0];
				break;
			default:
				$acc_code = $ptr_codes["Property and Equipment for Distribution"][0];
				break;
		}
	}
	return $acc_code;
}

function check_pn_exist(){

}

?>