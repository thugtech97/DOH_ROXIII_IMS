<?php

require "../../php/php_conn.php";
require "../../php/php_general_functions.php";

session_start();

function new_add_item(){

	global $conn;
	global $special_category;

	$table = "";
	$num_iss = mysqli_real_escape_string($conn, $_POST["num_iss"]);
    $item_name = mysqli_real_escape_string($conn, $_POST["item_name"]);
    $item_id = mysqli_real_escape_string($conn, $_POST["item_id"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $category = mysqli_real_escape_string($conn, $_POST["category"]);
    $stock = mysqli_real_escape_string($conn, $_POST["stock"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
    $reference_no = mysqli_real_escape_string($conn, $_POST["reference_no"]);
    $serial_no = mysqli_real_escape_string($conn, $_POST["serial_no"]);
    $unit = mysqli_real_escape_string($conn, $_POST["unit"]);
    $unit_value = mysqli_real_escape_string($conn, $_POST["unit_value"]);
	$property_no = mysqli_real_escape_string($conn, $_POST["property_no"]);
	$remarks = mysqli_real_escape_string($conn, $_POST["remarks"]);

    $sql = mysqli_query($conn, "SELECT * FROM tbl_par WHERE par_no LIKE '$num_iss'");
	$supplier = mysqli_real_escape_string($conn, mysqli_fetch_assoc(mysqli_query($conn, "SELECT s.supplier, p.supplier_id FROM tbl_po AS p, ref_supplier AS s WHERE s.supplier_id = p.supplier_id AND p.po_number LIKE '$reference_no'"))["supplier"]);
	$row = mysqli_fetch_assoc($sql); $entity_name = $row["entity_name"]; $fund_cluster = $row["fund_cluster"]; $received_from = $row["received_from"]; 
	$received_from_designation = $row["received_from_designation"]; $date_released = $row["date_released"]; $area = $row["area"]; $view_par = $row["view_par"];
	$received_by = $row["received_by"]; $received_by_designation = $row["received_by_designation"]; $date_supply_received = $row["date_supply_received"]; $issued = $row["issued"];

	mysqli_query($conn, "INSERT INTO tbl_par(par_no, entity_name, fund_cluster, reference_no, item, description, unit, supplier, serial_no, category, property_no, quantity, cost, total, remarks, received_from, received_from_designation, received_by, received_by_designation, date_released, date_supply_received, issued, view_par, area, po_id) 
	VALUES ('$num_iss', '$entity_name', '$fund_cluster', '$reference_no', '$item_name', '$description', '$unit', '$supplier', '$serial_no', '$category', '$property_no', '$quantity', '$unit_value', '0.00', '$remarks', '$received_from', '$received_from_designation', '$received_by', '$received_by_designation', '$date_released', '$date_supply_received', '$issued', '$view_par', '$area', '$item_id')");
	
	$query_get_stocks = mysqli_query($conn, "SELECT quantity FROM tbl_po WHERE po_id = '$item_id'");
	$rstocks = explode(" ", mysqli_fetch_assoc($query_get_stocks)["quantity"]);
	$newrstocks = ((int)$rstocks[0] - (int)$quantity)." ".$rstocks[1];
	mysqli_query($conn, "UPDATE tbl_po SET quantity = '$newrstocks' WHERE po_id = '$item_id'");
	if(!in_array($category, $special_category)){
		$serials = explode(",", $serial_no);
		for($j = 0; $j < count($serials); $j++){
			$sn = $serials[$j];
			mysqli_query($conn, "UPDATE tbl_serial SET is_issued = 'Y' WHERE inventory_id = '$item_id' AND serial_no = '$sn'");
		}
		$pns = explode(",", $property_no);
		$pn = end($pns);
		$currentDate = date('Y-m');
		$pnDate = substr($pn, 0, 7);
		if ($currentDate === $pnDate) {
			mysqli_query($conn, "UPDATE ref_lastpn SET property_no = '$pn' WHERE id = 1");
		}
	}

	reload_item($num_iss);
}

function reload_item($num_iss){
	global $conn;

	$table = "";
	$sql = mysqli_query($conn, "SELECT par_id, po_id, entity_name, received_from, received_from_designation, SUBSTRING(date_released,1,10) AS date_r, reference_no,  fund_cluster, received_by, received_by_designation, area, item, description, serial_no, category, property_no, quantity, unit, cost, total, remarks FROM tbl_par WHERE par_no LIKE '".$num_iss."'");
	while($row = mysqli_fetch_assoc($sql)){
		$table.="<tr>
					<td>".$row["item"]."</td>
					<td>".$row["description"]."</td>
					<td>".$row["serial_no"]."</td>
					<td>".$row["category"]."</td>
					<td>".$row["property_no"]."</td>
					<td onclick=\"edit_quantity('".$row["par_id"]."','".$row["quantity"]."','".$row["reference_no"]."','".mysqli_real_escape_string($conn, $row["item"])."','".mysqli_real_escape_string($conn, $row["description"])."', 'tbl_par', 'par_id', '".$row["po_id"]."');\"><a><u>".$row["quantity"]."</u></a></td>
					<td>".$row["unit"]."</td>
					<td>".number_format((float)$row["cost"], 3)."</td>
					<td>".number_format((float)$row["cost"] * (float)$row["quantity"], 3)."</td>
					<td><input onblur=\"update_remarks('".$row["par_id"]."', this.value, 'tbl_par', 'par_id');\" type=\"text\" value=\"".$row["remarks"]."\"></td>
					<td>
						<button class=\"btn btn-xs btn-info dim\" onclick=\"get_item_trans('".$row["par_id"]."', 'tbl_par', 'par_id', 'par_no', '".$row["quantity"]."', '".$row["property_no"]."');\"><i class=\"fa fa-exchange\"></i></button>
						<button class=\"btn btn-xs btn-success dim\" onclick=\"get_history('".$row['property_no']."');\"><i class=\"fa fa-history\"></i></button>
					</td>
					</tr>";
	}
	echo $table;
}

function create_trans(){
	global $conn; global $connhr;
	date_default_timezone_set("Asia/Shanghai");
	$id = mysqli_real_escape_string($conn, $_POST["id"]);
	$trans_ics = mysqli_real_escape_string($conn, $_POST["trans_ics"]);
	$received_by = mysqli_real_escape_string($conn, $_POST["trans_name"]);
	$trans_id = mysqli_real_escape_string($conn, $_POST["trans_id"]);
	$prop_no = implode(",",(array) $_POST["prop_no"]);
	$serial_no = implode(",",(array) $_POST["serial_no"]);
	$un_prop_no = implode(",",(array) $_POST["un_prop_no"]);
	$un_serial_no = implode(",",(array) $_POST["un_serial_no"]);
	$date_released = mysqli_real_escape_string($conn, $_POST["date_released"])." ".date("H:i:s");

	$type 		= mysqli_real_escape_string($conn, $_POST["type"]);
	$table 		= mysqli_real_escape_string($conn, $_POST["table"]);
	$table_id 	= mysqli_real_escape_string($conn, $_POST["table_id"]);
	$table_no 	= mysqli_real_escape_string($conn, $_POST["table_no"]);

	$quer1 = mysqli_query($connhr, "SELECT d.designation, e.designation_fid FROM tbl_employee AS e, ref_designation AS d WHERE d.designation_id = e.designation_fid AND e.emp_id = '$trans_id'");
	$received_by_designation = mysqli_real_escape_string($conn, mysqli_fetch_assoc($quer1)["designation"]);
	
	$sql = mysqli_query($conn, "SELECT * FROM ".$table." WHERE ".$table_id." = '$id'");
	if($row = mysqli_fetch_assoc($sql)){
		$quantity_trans = count(explode(",", $prop_no));
		$received = ($type === "PTR") ? $row["to"] : $row["received_by"];
		$remarks = "This cancels previous " . $type . " issued to " . $received . " (" . $row[$table_no] . ")";
		mysqli_query($conn, "INSERT INTO tbl_par(par_no, entity_name, fund_cluster, reference_no, item, description, unit, supplier, serial_no, category, property_no, quantity, cost, total, remarks, received_from, received_from_designation, received_by, received_by_designation, date_released, area, po_id) VALUES ('$trans_ics', '".$row["entity_name"]."', '".$row["fund_cluster"]."', '".$row["reference_no"]."', '".$row["item"]."', '".$row["description"]."', '".$row["unit"]."', '".$row["supplier"]."', '$serial_no', '".$row["category"]."', '$prop_no', '$quantity_trans', '".$row["cost"]."', '0.00', '$remarks', '".$row["received_from"]."', '".$row["received_from_designation"]."', '$received_by', '$received_by_designation', '$date_released', '".$row["area"]."', '".$row["po_id"]."')");
		
		$quantity_new = (int)$row["quantity"] - $quantity_trans;
		mysqli_query($conn, "UPDATE ".$table." SET quantity = '$quantity_new' WHERE ".$table_id." = '$id'");

		$emp_id = $_SESSION["emp_id"];
		$description = $_SESSION["username"]." created a PAR transfer (".$trans_ics.") to ".$received_by." with a remarks - ".$remarks;
		mysqli_query($conn, "INSERT INTO tbl_logs(emp_id,description) VALUES('$emp_id','$description')");
	}
}

function iss_validator(){
	global $conn;

	$par_no = mysqli_real_escape_string($conn, $_POST["par_no"]);
	$sql = mysqli_query($conn, "SELECT view_par FROM tbl_par WHERE par_no = '$par_no'");
	$view_par = mysqli_fetch_assoc($sql)["view_par"];
	$parts = explode(".", $view_par);
	if(end($parts) == "pdf" || end($parts) == "PDF"){
		echo "1";
	}else{
		echo "0";
	}
}

function to_issue(){
	global $conn;

	$par_no = mysqli_real_escape_string($conn, $_POST["par_no"]);
	mysqli_query($conn, "UPDATE tbl_par SET issued = '1' WHERE par_no = '$par_no'");
}

function get_par_details(){
	global $conn;

	$received_from = ""; $received_from_designation = "";
	$received_by = ""; $received_by_designation = "";
	$date_released = ""; $par_tbody = "";
	$supplier = ""; $reference_no = "";
	$entity_name = ""; $remarks = "";
	$total_cost = 0.00;
	$rows_limit = 45; $rows_occupied = 0;
	$par_no = mysqli_real_escape_string($conn, $_POST["par_no"]);
	$sql = mysqli_query($conn, "SELECT entity_name, quantity, item, unit, description, serial_no, property_no, cost, total, received_from, received_from_designation, received_by, received_by_designation, SUBSTRING(date_released, 1, 10) AS date_r, reference_no, supplier, remarks FROM tbl_par WHERE par_no LIKE '$par_no'");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$received_from = utf8_encode($row["received_from"]); $received_by = utf8_encode($row["received_by"]);
			$received_from_designation = utf8_encode($row["received_from_designation"]); $received_by_designation = utf8_encode($row["received_by_designation"]);
			$date_released = $row["date_r"]; $supplier = $row["supplier"]; $reference_no = $row["reference_no"];
			$entity_name = $row["entity_name"];
			$remarks = $row["remarks"];
			$total_cost += (float)($row["cost"] * $row["quantity"]);
			$pn = explode(",", $row["property_no"]);
			$par_tbody .= "<tr id=\"1\">
			  	      <td style=\"width: 75.6px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\">".$row["quantity"]."</td>
			  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["unit"]."</td>
			  	      <td style=\"width: 61.8px; height: 14.5px; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"><b>".$row["item"]."</b><br>".$row["description"]."</td>
			  	      <td style=\"width: 62.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".((count($pn) >= 1 && $row["serial_no"] == null) ? $pn[0] : "")."</td>
			  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			  	      <td style=\"width: 85.2px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format((float)$row["cost"], 3)."</td>
			  	      <td style=\"width: 86.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format((float)($row["cost"] * $row["quantity"]), 3)."</td>
			      </tr>";$rows_occupied++;
			      $rows_occupied+=round((float)strlen($row["description"]) / 60.00);
			if($row["serial_no"] == null && count($pn) > 1){
		     	for($j = 1; $j < count($pn); $j++){
		     		$par_tbody .= "<tr id=\"1\">
				  	      <td style=\"width: 75.6px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
				  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				  	      <td style=\"width: 61.8px; height: 14.5px; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				  	      <td style=\"width: 62.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$pn[$j]."</td>
				  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				  	      <td style=\"width: 85.2px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				  	      <td style=\"width: 86.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				      </tr>";
					$rows_occupied++;
		     	}
		    }
			if($row["serial_no"] != null){
				$serials = explode(",", $row["serial_no"]);
				for($i = 0; $i < count($serials); $i++){
					if(!array_key_exists($i, $pn)){
						$par_tbody .= "<tr>
				  	      <td style=\"width: 75.6px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
				  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				  	      <td style=\"width: 61.8px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">Serial No. ".$serials[$i]."</td>
				  	      <td style=\"width: 62.4px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				  	      <td style=\"width: 85.2px; height: 14.5px; text-align: left; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				  	      <td style=\"width: 86.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				      </tr>";
					}else{
						$par_tbody .= "<tr>
				  	      <td style=\"width: 75.6px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
				  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				  	      <td style=\"width: 61.8px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">Serial No. ".$serials[$i]."</td>
				  	      <td style=\"width: 62.4px; height: 14.5px; font-size: 10px; text-align: center; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$pn[$i]."</td>
				  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				  	      <td style=\"width: 85.2px; height: 14.5px; text-align: left; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				  	      <td style=\"width: 86.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				      </tr>";
					}
					$rows_occupied++;
				}
			}
		}
		$the_rest = array("*Nothing Follows*", "", "PO No. ".$reference_no, $supplier, "", "", "", "", "", "", "", "", "", "Approved by:", "", "<center><b>".strtoupper($_SESSION["company_head"])."</b></center>", "<center>".$_SESSION["company_head_designation"]."</center>", "", "", "", "", "<p style=\"font-size: 14px;\">".$remarks."</p>");
		for($i = 0; $i < count($the_rest); $i++){
			$par_tbody .= "<tr>
		  	      <td style=\"width: 75.6px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
		  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		  	      <td style=\"width: 61.8px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$the_rest[$i]."</td>
		  	      <td style=\"width: 62.4px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		  	      <td style=\"width: 85.2px; height: 14.5px; text-align: left; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		  	      <td style=\"width: 86.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		      </tr>";
			$rows_occupied = $rows_occupied + ($i == count($the_rest) - 1 ? 3 : 1);
		}
		for($i = 0; $i < ($rows_limit - $rows_occupied); $i++){
			$par_tbody .= "<tr>
			  	      <td style=\"width: 75.6px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
			  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			  	      <td style=\"width: 61.8px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
			  	      <td style=\"width: 62.4px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			  	      <td style=\"width: 85.2px; height: 14.5px; text-align: left; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			  	      <td style=\"width: 86.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			      </tr>";
		}
		$received_by = get_complete_name($received_by);
		echo json_encode(array("par_tbody"=>$par_tbody, "total_cost"=>number_format((float)$total_cost,3), "receivers"=>array($received_from, $received_from_designation, $received_by, $received_by_designation, _m_d_yyyy_($date_released)), "entity_name"=>$entity_name));
	}
}

function get_records(){
	global $conn;
	
	$limit = '10';
	$page = 1;
	if($_POST["page"] > 1){
	  $start = (($_POST["page"] - 1) * $limit);
	  $page = $_POST["page"];
	}else{
	  $start = 0;
	}

	$query = "SELECT DISTINCT par_no, area, SUBSTRING(date_released, 1, 10) AS date_r, received_from, received_by, issued FROM tbl_par ";
	if($_POST["search"] != ""){
		$qs = mysqli_real_escape_string($conn, $_POST["search"]);
		$query.="WHERE par_no LIKE '%$qs%' OR reference_no LIKE '%$qs%' OR area LIKE '%$qs%' OR received_from LIKE '%$qs%' OR received_by LIKE '%$qs%' OR item LIKE '%$qs%' ";
	}
	$query.="ORDER BY par_id DESC ";

	$sql_orig = mysqli_query($conn, $query);
	$sql = mysqli_query($conn, $query."LIMIT ".$start.", ".$limit."");
	$tbody = "";
	$total_data = mysqli_num_rows($sql_orig);
	if($total_data != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$parn = $row["par_no"];
			$rb = str_replace(' ', '', $row["received_by"]);
			$rb = rtrim($rb, '.');
			$in = array();
			$get_items = mysqli_query($conn, "SELECT item FROM tbl_par WHERE par_no LIKE '$parn'");
			while($ri = mysqli_fetch_assoc($get_items)){
				array_push($in, $ri["item"]);
			}
			$refs = array();
			$get_rf = mysqli_query($conn, "SELECT DISTINCT reference_no FROM tbl_par WHERE par_no LIKE '$parn'");
			while($rf = mysqli_fetch_assoc($get_rf)){
				array_push($refs, $rf["reference_no"]);
			}
			$rems = array();
			$get_rf = mysqli_query($conn, "SELECT DISTINCT remarks FROM tbl_par WHERE par_no LIKE '$parn'");
			while($rf = mysqli_fetch_assoc($get_rf)){
				array_push($rems, $rf["remarks"]);
			}
			$tbody.="<tr>
					<td><center>".(($row["issued"] == '0') ? "<button id=\"\" value=\"".$row["par_no"]."\" ".(($_SESSION["role"] == "SUPPLY" || $_SESSION["role"] == "SUPPLY_SU") ? "onclick=\"to_issue(this.value, this.id);\"" : "")." class=\"btn btn-xs btn-danger\" style=\"border-radius: 10px;\">✖</button>" : "<button class=\"btn btn-xs\" style=\"border-radius: 10px; background-color: #00FF00; color: white; font-weight: bold;\" value=\"".$parn."\" onclick=\"modify_dr(this.value, 'PAR No. '+this.value, 'tbl_par', 'par_no');\">✓</button>")."</center></td>
					<td>".$row["area"]."</td>
					<td>".$row["par_no"]."</td>
					<td style=\"font-size: 10px;\">".implode(", ", $refs)."</td>
					<td style=\"font-size: 10px;\">".implode(", ", $in)."</td>
					<td>".$row["date_r"]."</td>
					<td>".utf8_encode($row["received_from"])."</td>
					<td>".utf8_encode($row["received_by"])."</td>
					<td style=\"font-size: 12px;\">".implode(", ", $rems)."</td>
					<td><center><button class=\"btn btn-xs btn-primary dim\" value=\"".$row["par_no"]."\" onclick=\"view_iss(this.value,'tbl_par','view_par','PAR','par_no','".$rb."');\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Preview\"><i class=\"fa fa-picture-o\"></i></button>&nbsp;".(($_SESSION["role"] == "SUPPLY" || $_SESSION["role"] == "SUPPLY_SU") ? "<button class=\"btn btn-xs btn-info dim\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\" onclick=\"modify('".$parn."');\"><i class=\"fa fa-pencil-square-o\"></i></button>&nbsp;" : "")."<button class=\"btn btn-xs btn-success dim\" value=\"".$row["par_no"]."\" onclick=\"print_par(this.value);\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Print\"><i class=\"fa fa-print\"></i></button>&nbsp;".(($_SESSION["role"] == "SUPPLY_SU") ? "<button class=\"btn btn-xs btn-danger dim\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\"><i class=\"fa fa-trash\" onclick=\"delete_control('".$parn."');\"></i></button>&nbsp;" : "")."<button class=\"btn btn-xs btn-warning dim\" onclick=\"download_xls('".$parn."');\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Save as Excel\"><i class=\"fa fa-file-excel-o\"></i></button></center></td>
				</tr>";
		}
	}else{
		$tbody = "<tr><td colspan=\"11\" style=\"text-align: center;\">No data found.</td></tr>";
	}
	$in_out = create_table_pagination($page, $limit, $total_data, array("","Area","PAR No.","PO No.","Items","Date Released","Received From", "Received By", "Remarks", ""));
	$whole_dom = $in_out[0]."".$tbody."".$in_out[1];
	echo $whole_dom;
}

function insert_par(){
	global $conn;
	global $connhr;
	date_default_timezone_set("Asia/Shanghai");
	$time_now = date("H:i:s");
	$par_no = mysqli_real_escape_string($conn, $_POST["par_no"]);
	$entity_name = mysqli_real_escape_string($conn, $_POST["entity_name"]);
	$fund_cluster = mysqli_real_escape_string($conn, $_POST["fund_cluster"]);
	$reference_no = mysqli_real_escape_string($conn, $_POST["reference_no"]);
	$received_from_id = mysqli_real_escape_string($conn, $_POST["received_from_id"]);
	$received_from = mysqli_real_escape_string($conn, $_POST["received_from"]);
	$received_by_id = mysqli_real_escape_string($conn, $_POST["received_by_id"]);
	$received_by = mysqli_real_escape_string($conn, $_POST["received_by"]);
	$date_released = mysqli_real_escape_string($conn, $_POST["date_released"])." ".$time_now;
	$area = mysqli_real_escape_string($conn, $_POST["area"]);
	$items = $_POST["items"];

	$quer1 = mysqli_query($connhr, "SELECT d.designation, e.designation_fid FROM tbl_employee AS e, ref_designation AS d WHERE d.designation_id = e.designation_fid AND e.emp_id = '$received_from_id'");
	$quer2 = mysqli_query($connhr, "SELECT d.designation, e.designation_fid FROM tbl_employee AS e, ref_designation AS d WHERE d.designation_id = e.designation_fid AND e.emp_id = '$received_by_id'");
	$query = mysqli_query($conn, "SELECT s.supplier, p.supplier_id FROM tbl_po AS p, ref_supplier AS s WHERE s.supplier_id = p.supplier_id AND p.po_number LIKE '$reference_no'");
	$received_from_designation = mysqli_real_escape_string($conn, mysqli_fetch_assoc($quer1)["designation"]);
	$received_by_designation = mysqli_real_escape_string($conn, mysqli_fetch_assoc($quer2)["designation"]);

	$supplier = mysqli_real_escape_string($conn, mysqli_fetch_assoc($query)["supplier"]);
	if(mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT par_no FROM tbl_par WHERE par_no = '$par_no'"))==0){
		$emp_id = $_SESSION["emp_id"];
		$description = $_SESSION["username"]." created a PAR No. ".$par_no;
		mysqli_query($conn, "INSERT INTO tbl_logs(emp_id,description) VALUES('$emp_id','$description')");
		echo "0";
		for($i = 0; $i < count($items); $i++){
			$item_id = $items[$i][0];
			$ref_no = $items[$i][1];
			$item = mysqli_real_escape_string($conn, $items[$i][2]);
			$description = mysqli_real_escape_string($conn, $items[$i][3]);
			$serial_no = mysqli_real_escape_string($conn, $items[$i][4]);
			$category = $items[$i][5];
			$property_no = $items[$i][6];
			$quantity = $items[$i][7];
			$unit = $items[$i][8];
			$cost = $items[$i][9];
			$total = $items[$i][10];
			$remarks = $items[$i][11];
			mysqli_query($conn, "INSERT INTO tbl_par(par_no, entity_name, fund_cluster, reference_no, item, description, unit, supplier, serial_no, category, property_no, quantity, cost, total, remarks, received_from, received_from_designation, received_by, received_by_designation, date_released, area, po_id) VALUES ('$par_no', '$entity_name', '$fund_cluster', '$ref_no', '$item', '$description', '$unit', '$supplier', '$serial_no', '$category', '$property_no', '$quantity', '$cost', '$total', '$remarks', '$received_from', '$received_from_designation', '$received_by', '$received_by_designation', '$date_released', '$area', '$item_id')");
			$query_get_stocks = mysqli_query($conn, "SELECT quantity FROM tbl_po WHERE po_number = '$ref_no' AND po_id = '$item_id'");
			$rstocks = explode(" ", mysqli_fetch_assoc($query_get_stocks)["quantity"]);
			$newrstocks = ((int)$rstocks[0] - (int)$quantity)." ".$rstocks[1];
			mysqli_query($conn, "UPDATE tbl_po SET quantity = '$newrstocks' WHERE po_number = '$ref_no' AND po_id = '$item_id'");
			$serials = explode(",", $serial_no);
			for($j = 0; $j < count($serials); $j++){
				$sn = $serials[$j];
				mysqli_query($conn, "UPDATE tbl_serial SET is_issued = 'Y' WHERE inventory_id = '$item_id' AND serial_no = '$sn'");
			}
			$pns = explode(",", $property_no);
			$pn = end($pns);
			$currentDate = date('Y-m');
			$pnDate = substr($pn, 0, 7);
			if ($currentDate === $pnDate) {
				mysqli_query($conn, "UPDATE ref_lastpn SET property_no = '$pn' WHERE id = 1");
			}
		}
	}else{
		echo "1";
	}
}

function get_latest_par(){
	global $conn; $latest_par = ""; $latest_pn = "";

	$yy_mm = substr(mysqli_real_escape_string($conn, $_POST["yy_mm"]), 0, 4);
	$sql = mysqli_query($conn, "SELECT DISTINCT par_no FROM tbl_par WHERE par_no LIKE '%$yy_mm%' ORDER BY par_id DESC LIMIT 1");
	if(mysqli_num_rows($sql) != 0){
		$row = mysqli_fetch_assoc($sql);
		$latest_par = str_pad(((int)explode("-", $row["par_no"])[2]) + 1, 4, '0', STR_PAD_LEFT);
	}else{
		$latest_par = "0001";
	}
	$sql = mysqli_query($conn, "SELECT property_no FROM ref_lastpn WHERE id = 1 AND property_no LIKE '%$yy_mm%'");
	if(mysqli_num_rows($sql) != 0){
		$row = mysqli_fetch_assoc($sql);
		$latest_pn = str_pad(((int)explode("-", $row["property_no"])[2]) + 1, 4, '0', STR_PAD_LEFT);
	}else{
		$latest_pn = "0001";
	}
	echo json_encode(array("latest_par"=>$latest_par,"latest_pn"=>$latest_pn));
}

$call_func = mysqli_real_escape_string($conn, $_POST["call_func"]);
switch($call_func){
	case "insert_par":
		insert_par();
		break;
	case "get_records":
		get_records();
		break;
	case "get_par_details":
		get_par_details();
		break;
	case "get_latest_par":
		get_latest_par();
		break;
	case "to_issue":
		to_issue();
		break;
	case "iss_validator":
		iss_validator();
		break;
	case "create_trans":
		create_trans();
		break;
	case "new_add_item":
		new_add_item();
		break;
}

?>