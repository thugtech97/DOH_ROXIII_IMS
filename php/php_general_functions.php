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

function get_estimated_life($category){
	$account_codes = array(
		"ICT Equipments"=>5,
		"Communication Equipments"=>10,
		"Drugs and Medicines"=>"",
		"Furniture"=>10,
		"Housekeeping Supplies"=>"",
		"ICT Supplies"=>"",
		"Library"=>5,
		"Medical Equipment"=>10,
		"Medical Supplies"=>"",
		"Office Equipment"=>5,
		"Office Supplies"=>"",
		"Other Supplies"=>"",
		"Software Application"=>"",
		"Various Supplies"=>5
	);
	return (array_key_exists($category,$account_codes)) ? $account_codes[$category] : "";
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

function array_push_assoc($array, $key, $value){
    if(array_key_exists($key, $array)){
        array_push($array[$key], $value);
    }else{
        $array[$key] = array();
        array_push($array[$key], $value);
    }
    return $array;
}

function create_table_pagination($page, $limit, $total_data, $columns){

	$input = '<label>Total Records - '.$total_data.'</label>
	          <table class="table table-bordered">
	            <tr>';
	foreach($columns as $c){
		$input.='<th style=\'border: 2px solid black;\'>'.$c.'</th>';
	}	            
	$input.='</tr>';
	$output ='</table>
	          <br/>
	          <div align="center">
	            <ul class="pagination">
	          ';
	            
	$total_links = ceil($total_data/$limit);
	$previous_link = '';
	$next_link = '';
	$page_link = '';
	$page_array = array();

	if($total_links > 4) {
	  if($page < 5) {
	    for($count = 1; $count <= 5; $count++){
	      $page_array[] = $count;
	    }
	    $page_array[] = '...';
	    $page_array[] = $total_links;
	  }else{
	    $end_limit = $total_links - 5;
	    if($page > $end_limit){
	      $page_array[] = 1;
	      $page_array[] = '...';
	      for($count = $end_limit; $count <= $total_links; $count++){
	        $page_array[] = $count;
	      }
	    }else{
	      $page_array[] = 1;
	      $page_array[] = '...';
	      for($count = $page - 1; $count <= $page + 1; $count++){
	        $page_array[] = $count;
	      }
	      $page_array[] = '...';
	      $page_array[] = $total_links;
	    }
	  }
	}else{
	  for($count = 1; $count <= $total_links; $count++){
	    $page_array[] = $count;
	  }
	}
	for($count = 0; $count < count($page_array); $count++){
	  if($page == $page_array[$count]){
	    $page_link .= '<li class="page-item active"><a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a></li>';

	    $previous_id = $page_array[$count] - 1;
	    if($previous_id > 0){
	      $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
	    }else{
	      $previous_link = '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
	    }
	    $next_id = $page_array[$count] + 1;
	    if($next_id > $total_links){
	      $next_link = '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
	    }else{
	      $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
	    }
	  }else{
	    if($page_array[$count] == '...'){
	      $page_link .= '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
	    }else{
	      $page_link .= '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>';
	    }
	  }
	}
	$output .= $previous_link . $page_link . $next_link;
	$output .= '</ul></div>';

	return array($input, $output);
}

function check_pn_exist(){
	global $conn;

	$pn = mysqli_real_escape_string($conn, $_POST["pn_"]);
	$p_n = explode(",", $pn);
	$existing = array();
	foreach($p_n AS $prop_no){
		$exp_prop = explode("-", $prop_no);
		$imp_prop = $exp_prop[0]."-".$exp_prop[1]."-".$exp_prop[2];
		if(mysqli_num_rows(mysqli_query($conn, "SELECT property_no FROM tbl_ics WHERE property_no LIKE '%$imp_prop%'")) != 0 || mysqli_num_rows(mysqli_query($conn, "SELECT property_no FROM tbl_par WHERE property_no LIKE '%$imp_prop%'")) != 0 || mysqli_num_rows(mysqli_query($conn, "SELECT property_no FROM tbl_ptr WHERE property_no LIKE '%$imp_prop%'")) != 0){
			array_push($existing, $prop_no);
		}
	}

	echo implode(",", $existing);
}

?>