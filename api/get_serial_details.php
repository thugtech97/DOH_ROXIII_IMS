<?php

require "../php/php_conn.php";

$serial = mysqli_real_escape_string($conn, $_GET["serial"]);
$property_no = mysqli_real_escape_string($conn, $_GET["prop_no"]);

$sql = mysqli_query($conn, "SELECT * FROM tbl_ics WHERE serial_no LIKE '%$serial%' OR property_no LIKE '%$property_no%'");

if(mysqli_num_rows($sql) != 0){
	$row = mysqli_fetch_assoc($sql);
	echo json_encode(array(
		"success"=>true,
		"serial_no"=>$row["serial_no"],
		"ics_no"=>$row["ics_no"], 
		"item"=>$row["item"], 
		"description"=>$row["description"],
		"reference_no"=>$row["reference_no"],
		"unit"=>$row["unit"],
		"supplier"=>$row["supplier"],
		"property_no"=>$row["property_no"],
		"category"=>$row["category"],
		"quantity"=>$row["quantity"],
		"cost"=>$row["cost"]));
}else{
	$sql = mysqli_query($conn, "SELECT * FROM tbl_par WHERE serial_no LIKE '%$serial%' OR property_no LIKE '%$property_no%'");
	if(mysqli_num_rows($sql) != 0){
		$row = mysqli_fetch_assoc($sql);
		echo json_encode(array(
			"success"=>true,
			"serial_no"=>$row["serial_no"],
			"par_no"=>$row["par_no"], 
			"item"=>$row["item"], 
			"description"=>$row["description"],
			"reference_no"=>$row["reference_no"],
			"unit"=>$row["unit"],
			"supplier"=>$row["supplier"],
			"property_no"=>$row["property_no"],
			"category"=>$row["category"],
			"quantity"=>$row["quantity"],
			"cost"=>$row["cost"]));
	}else{
		echo json_encode(array("success"=>false,"serial_no"=>$serial));
	}
}

?>