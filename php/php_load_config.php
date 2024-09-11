<?php

require "php_conn.php";
session_start();

function get_designation($action,$value){
	global $connhr;
	$v = explode("|", $value);
	$id = $v[0];
	$return_value = "";
	if($action == "name"){
		$return_value = $v[1];
	}else{
		$query = mysqli_query($connhr, "SELECT d.designation, e.designation_fid FROM tbl_employee AS e, ref_designation AS d WHERE d.designation_id = e.designation_fid AND e.emp_id = '$id'");
		$return_value = mysqli_fetch_assoc($query)["designation"];
	}
	return $return_value;
}

$sql = mysqli_query($conn, "SELECT * FROM config WHERE id='1'");
	$row = mysqli_fetch_assoc($sql);
	$_SESSION["company_title"] = $row["company_title"];
	$_SESSION["supporting_title"] = $row["supporting_title"];
	$_SESSION["entity_name"] = $row["entity_name"];
	$_SESSION["company_head"] = get_designation("name",$row["company_head"]);
	$_SESSION["company_head_designation"] = get_designation("",$row["company_head"]);
	$_SESSION["company_logo"] = $row["company_logo"];
	$_SESSION["property_custodian"] = get_designation("name",$row["property_custodian"]);
	$_SESSION["property_custodian_designation"] = get_designation("",$row["property_custodian"]);
	$_SESSION["division_chief"] = get_designation("name",$row["division_chief"]);
	$_SESSION["division_chief_designation"] = get_designation("",$row["division_chief"]);
	$_SESSION["ppe_prepared_by"] = get_designation("name",$row["ppe_prepared_by"]);
	$_SESSION["ppe_prepared_by_designation"] = get_designation("",$row["ppe_prepared_by"]);
	$_SESSION["ppe_noted_by"] = get_designation("name",$row["ppe_noted_by"]);
	$_SESSION["ppe_noted_by_designation"] = get_designation("",$row["ppe_noted_by"]);
	$_SESSION["wi_prepared_by"] = get_designation("name",$row["wi_prepared_by"]);
	$_SESSION["wi_prepared_by_designation"] = get_designation("",$row["wi_prepared_by"]);
	$_SESSION["wi_reviewed_by"] = get_designation("name",$row["wi_reviewed_by"]);
	$_SESSION["wi_reviewed_by_designation"] = get_designation("",$row["wi_reviewed_by"]);
	$_SESSION["wi_noted_by"] = get_designation("name",$row["wi_noted_by"]);
	$_SESSION["wi_noted_by_designation"] = get_designation("",$row["wi_noted_by"]);
	$_SESSION["wi_approved_by"] = get_designation("name",$row["wi_approved_by"]);
	$_SESSION["wi_approved_by_designation"] = get_designation("",$row["wi_approved_by"]);
	$_SESSION["rpci_prepared_by"] = get_designation("name",$row["rpci_prepared_by"]);
	$_SESSION["rpci_prepared_by_designation"] = get_designation("",$row["rpci_prepared_by"]);
	$_SESSION["rpci_certified_correct"] = get_designation("name",$row["rpci_certified_correct"]);
	$_SESSION["rpci_certified_correct_designation"] = get_designation("",$row["rpci_certified_correct"]);
	$_SESSION["rpci_noted_by"] = get_designation("name",$row["rpci_noted_by"]);
	$_SESSION["rpci_noted_by_designation"] = get_designation("",$row["rpci_noted_by"]);
	$_SESSION["rpci_approved_by"] = get_designation("name",$row["rpci_approved_by"]);
	$_SESSION["rpci_approved_by_designation"] = get_designation("",$row["rpci_approved_by"]);
	$_SESSION["rpci_coa"] = $row["rpci_coa"];
	$_SESSION["rpci_coa_designation"] = $row["rpci_coa_designation"];
	$_SESSION["warehouse_name"] = $row["warehouse_name"];
	$_SESSION["warehouse_location"] = $row["warehouse_location"];

	echo json_encode(array("company_logo"=>$_SESSION["company_logo"],"company_title"=>$_SESSION["company_title"]));
?>
