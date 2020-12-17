<?php

require "../../php/php_conn.php";

function insert_unit(){
	global $conn;
	$unit = mysqli_real_escape_string($conn, $_POST["unit"]);
	mysqli_query($conn, "INSERT INTO ref_unit(unit, status) VALUES('$unit','0')");
}

function insert_supplier(){
	global $conn;
	$supplier = mysqli_real_escape_string($conn, $_POST["supplier"]);
	mysqli_query($conn, "INSERT INTO ref_supplier(supplier, status) VALUES('$supplier','0')");
}

function insert_item(){
	global $conn;
	$item = mysqli_real_escape_string($conn, $_POST["item"]);
	$category_id = mysqli_real_escape_string($conn, $_POST["category_id"]);
	mysqli_query($conn, "INSERT INTO ref_item(item, category_id, status) VALUES('$item','$category_id','0')");
}

function insert_category(){
	global $conn;
	$category = mysqli_real_escape_string($conn, $_POST["category"]);
	$category_code = mysqli_real_escape_string($conn, $_POST["category_code"]);
	mysqli_query($conn, "INSERT INTO ref_category(category, category_code, status) VALUES('$category','$category_code','0')");
}

function get_data(){
	global $conn;
	$query = mysqli_real_escape_string($conn, $_POST["query"]);
	$fields = $_POST["fields"];
	$tbody = "";
	$sql = mysqli_query($conn, $query);

	while($row = mysqli_fetch_assoc($sql)){
		$tbody.="<tr>";
		foreach($fields as $f){
			$tbody.="<td>".$row[$f]."</td>";	
		}
		$tbody.="</tr>";
	}
	echo $tbody;
}

$call_func = mysqli_real_escape_string($conn, $_POST["call_func"]);
switch($call_func){
	case "get_data":
		get_data();
		break;
	case "insert_category":
		insert_category();
		break;
	case "insert_item":
		insert_item();
		break;
	case "insert_supplier":
		insert_supplier();
		break;
	case "insert_unit":
		insert_unit();
		break;
}

?>