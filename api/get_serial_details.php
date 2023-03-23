<?php

require "../php/php_conn.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

function api_process($serial, $property_no){
	global $conn;
	$sql_str = ($serial != null && $property_no == null ? "serial_no LIKE '%$serial%'" : "property_no LIKE '%$property_no%'");
	$sql = mysqli_query($conn, "SELECT * FROM tbl_ics WHERE ".$sql_str."");

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
		$sql = mysqli_query($conn, "SELECT * FROM tbl_par WHERE ".$sql_str."");
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
			http_response_code(404);
			echo json_encode(array("success"=>false,"serial_no"=>$serial,"property_no"=>$property_no));
		}
	}
}


$serial = mysqli_real_escape_string($conn, $_GET["serial"]);
$property_no = mysqli_real_escape_string($conn, $_GET["prop_no"]);

if(($serial != null && $property_no != null) || ($serial == null && $property_no != null) || ($serial != null && $property_no == null)){
	api_process($serial, $property_no);
}else{
	http_response_code(402);
	echo json_encode(array("success"=>false,"response_desc"=>"Please input both."));
}
	


?>
