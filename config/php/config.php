<?php

require "../../php/php_conn.php";

session_start();

function load_employee(){
	global $connhr;

	$sql = mysqli_query($connhr, "SELECT emp_id, fname, mname, lname, prefix, suffix FROM tbl_employee WHERE status LIKE 'Active' AND (job_status LIKE 'Regular' OR job_status LIKE '') ORDER BY fname ASC");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$name = (($row["prefix"] != null) ? $row["prefix"]." " : "")."".$row["fname"]." ".$row["mname"][0].". ".$row["lname"]."".(($row["suffix"] != null) ? ", ".$row["suffix"] : "");
			echo "<div class=\"chat-user\">
                        <span class=\"float-right label label-primary\">Active</span>
                        <img class=\"chat-avatar\" src=\"../../archives/img/".$_SESSION['company_logo']."\">
                        <div class=\"chat-user-name\">
                            <p>".$name."</p>
                        </div>
                    </div>";
		}
	}
}

function load_designation(){
	global $connhr;

	$designations = array();
	$sql = mysqli_query($connhr, "SELECT designation_id, designation FROM ref_designation");
	while($row = mysqli_fetch_assoc($sql)){
		array_push($designations, array("designation" => $row["designation"], "id" => $row["designation_id"]));
	}

	echo json_encode($designations);
}

function save_employee(){
	global $connhr;

	$prefix = mysqli_real_escape_string($connhr, $_POST["prefix"]);
	$fname = mysqli_real_escape_string($connhr, $_POST["fname"]);
	$mname = mysqli_real_escape_string($connhr, $_POST["mname"]);
	$lname = mysqli_real_escape_string($connhr, $_POST["lname"]);
	$suffix = mysqli_real_escape_string($connhr, $_POST["suffix"]);
	$position = mysqli_real_escape_string($connhr, $_POST["position"]);
	$position_id = mysqli_real_escape_string($connhr, $_POST["position_id"]);

	if($position_id == 0){
		mysqli_query($connhr, "INSERT INTO ref_designation(designation, status) VALUES('$position', '0')");
		$position_id = mysqli_insert_id($connhr);
	}

	mysqli_query($connhr, "INSERT INTO tbl_employee(fname, mname, lname, prefix, suffix, designation_fid, status) VALUES('$fname', '$mname', '$lname', '$prefix', '$suffix', '$position_id', 'Active')");
}

function save_rep(){
	global $conn;

	$property_custodian = mysqli_real_escape_string($conn, $_POST["property_custodian"]);
	$division_chief = mysqli_real_escape_string($conn, $_POST["division_chief"]);
	$ppe_prepared_by = mysqli_real_escape_string($conn, $_POST["ppe_prepared_by"]);
	$ppe_noted_by = mysqli_real_escape_string($conn, $_POST["ppe_noted_by"]);
	$wi_prepared_by = mysqli_real_escape_string($conn, $_POST["wi_prepared_by"]);
	$wi_reviewed_by = mysqli_real_escape_string($conn, $_POST["wi_reviewed_by"]);
	$wi_noted_by = mysqli_real_escape_string($conn, $_POST["wi_noted_by"]);
	$wi_approved_by = mysqli_real_escape_string($conn, $_POST["wi_approved_by"]);
	$rpci_prepared_by = mysqli_real_escape_string($conn, $_POST["rpci_prepared_by"]);
	$rpci_certified_correct = mysqli_real_escape_string($conn, $_POST["rpci_certified_correct"]);
	$rpci_noted_by = mysqli_real_escape_string($conn, $_POST["rpci_noted_by"]);
	$rpci_approved_by = mysqli_real_escape_string($conn, $_POST["rpci_approved_by"]);
	$rpci_coa = mysqli_real_escape_string($conn, $_POST["rpci_coa"]);
	$rpci_coa_designation = mysqli_real_escape_string($conn, $_POST["rpci_coa_designation"]);

	mysqli_query($conn, "UPDATE config SET property_custodian='$property_custodian',division_chief='$division_chief',ppe_prepared_by='$ppe_prepared_by',ppe_noted_by='$ppe_noted_by',wi_prepared_by='$wi_prepared_by',wi_reviewed_by='$wi_reviewed_by',wi_noted_by='$wi_noted_by',wi_approved_by='$wi_approved_by',rpci_prepared_by='$rpci_prepared_by',rpci_certified_correct='$rpci_certified_correct',rpci_noted_by='$rpci_noted_by',rpci_approved_by='$rpci_approved_by',rpci_coa='$rpci_coa',rpci_coa_designation='$rpci_coa_designation' WHERE id='1'");
}

function save_org(){
	global $conn;

	$company_title = mysqli_real_escape_string($conn, $_POST["company_title"]);
	$supporting_title = mysqli_real_escape_string($conn, $_POST["supporting_title"]);
	$entity_name = mysqli_real_escape_string($conn, $_POST["entity_name"]);
	$company_head = mysqli_real_escape_string($conn, $_POST["company_head"]);
	$warehouse_name = mysqli_real_escape_string($conn, $_POST["warehouse_name"]);
	mysqli_query($conn, "UPDATE config SET company_title='$company_title',supporting_title='$supporting_title',entity_name='$entity_name',company_head='$company_head',warehouse_name='$warehouse_name' WHERE id='1'");
}

function get_data(){
	global $conn;

	$sql = mysqli_query($conn, "SELECT company_title, supporting_title, entity_name, company_head, company_logo, property_custodian, division_chief, ppe_prepared_by, ppe_noted_by, wi_prepared_by, wi_reviewed_by, wi_noted_by, wi_approved_by, rpci_prepared_by, rpci_certified_correct, rpci_noted_by, rpci_approved_by, rpci_coa, rpci_coa_designation, warehouse_name FROM config WHERE id='1'");
	$row = mysqli_fetch_assoc($sql);
	echo json_encode(array(
		"company_title"=>$row["company_title"],
		"supporting_title"=>$row["supporting_title"],
		"entity_name"=>$row["entity_name"],
		"company_head"=>$row["company_head"],
		"company_logo"=>$row["company_logo"],
		"property_custodian"=>$row["property_custodian"],
		"division_chief"=>$row["division_chief"],
		"ppe_prepared_by"=>$row["ppe_prepared_by"],
		"ppe_noted_by"=>$row["ppe_noted_by"],
		"wi_prepared_by"=>$row["wi_prepared_by"],
		"wi_reviewed_by"=>$row["wi_reviewed_by"],
		"wi_noted_by"=>$row["wi_noted_by"],
		"wi_approved_by"=>$row["wi_approved_by"],
		"rpci_prepared_by"=>$row["rpci_prepared_by"],
		"rpci_certified_correct"=>$row["rpci_certified_correct"],
		"rpci_noted_by"=>$row["rpci_noted_by"],
		"rpci_approved_by"=>$row["rpci_approved_by"],
		"rpci_coa"=>$row["rpci_coa"],
		"rpci_coa_designation"=>$row["rpci_coa_designation"],
		"warehouse_name"=>$row["warehouse_name"]
	));
}

$call_func = mysqli_real_escape_string($conn, $_POST["call_func"]);
//$call_func = "get_data";
switch($call_func){
	case "get_data":
		get_data();
		break;
	case "save_org":
		save_org();
		break;
	case "save_rep":
		save_rep();
		break;
	case "load_employee":
		load_employee();
		break;
	case "load_designation":
		load_designation();
		break;
	case "save_employee":
		save_employee();
		break;
}

?>