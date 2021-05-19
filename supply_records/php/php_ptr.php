<?php

require "../../php/php_conn.php";
require "../../php/php_general_functions.php";

session_start();

function update(){
	global $conn;

	$ptr_no = mysqli_real_escape_string($conn, $_POST["ptr_no"]);
	$from = mysqli_real_escape_string($conn, $_POST["from"]);
	$entity_name = mysqli_real_escape_string($conn, $_POST["entity_name"]);
	$approved_by = mysqli_real_escape_string($conn, $_POST["approved_by"]);
	$approved_by_designation = mysqli_real_escape_string($conn, $_POST["approved_by_designation"]);
	$date_released = mysqli_real_escape_string($conn, $_POST["date_released"]);
	$ttype = mysqli_real_escape_string($conn, $_POST["ttype"]);
	$to = mysqli_real_escape_string($conn, $_POST["to"]);
	$fund_cluster = mysqli_real_escape_string($conn, $_POST["fund_cluster"]);
	$received_from = mysqli_real_escape_string($conn, $_POST["received_from"]);
	$received_from_designation = mysqli_real_escape_string($conn, $_POST["received_from_designation"]);
	$area = mysqli_real_escape_string($conn, $_POST["area"]);
	$reason = mysqli_real_escape_string($conn, $_POST["reason"]);
	$address = mysqli_real_escape_string($conn, $_POST["address"]);
	$alloc_num = mysqli_real_escape_string($conn, $_POST["alloc_num"]);
	$storage_temp = mysqli_real_escape_string($conn, $_POST["storage_temp"]);
	$transport_temp = mysqli_real_escape_string($conn, $_POST["transport_temp"]);

	mysqli_query($conn, "UPDATE tbl_ptr SET tbl_ptr.from='$from',entity_name='$entity_name',approved_by='$approved_by',approved_by_designation='$approved_by_designation',date_released='$date_released',transfer_type='$ttype',tbl_ptr.to='$to',fund_cluster='$fund_cluster',received_from='$received_from',received_from_designation='$received_from_designation',area='$area',reason='$reason',address='$address',alloc_num='$alloc_num',storage_temp='$storage_temp',transport_temp='$transport_temp' WHERE ptr_no LIKE '$ptr_no'");

	$emp_id = $_SESSION["emp_id"];
	$description = $_SESSION["username"]." edited the details of PTR No. ".$ptr_no;
	mysqli_query($conn, "INSERT INTO tbl_logs(emp_id,description) VALUES('$emp_id','$description')");
}

function modify(){
	global $conn;
	
	$ptr_no = mysqli_real_escape_string($conn, $_POST["ptr_no"]);
	$reference_no = "";$from = "";$to = "";$entity_name = "";$fund_cluster = "";$approved_by = "";$approved_by_designation = "";$received_from = "";$received_from_designation = "";$date_released = "";$area = "";$transfer_type = "";$reason = ""; $table = ""; $address = "";
	$alloc_num = ""; $storage_temp = ""; $transport_temp = "";
	$sql = mysqli_query($conn, "SELECT ptr_id,reference_no, tbl_ptr.from, tbl_ptr.to, entity_name, fund_cluster, approved_by, approved_by_designation, received_from, received_from_designation, SUBSTRING(date_released,1,10) AS date_r, area, transfer_type, reason, address, alloc_num, storage_temp, transport_temp, item, description, serial_no, exp_date, category, property_no, quantity, unit, cost, total, conditions, remarks FROM tbl_ptr WHERE ptr_no LIKE '$ptr_no'");
	while($row = mysqli_fetch_assoc($sql)){
		$from = $row["from"];$to = $row["to"];$entity_name = $row["entity_name"];$fund_cluster = $row["fund_cluster"];$approved_by = $row["approved_by"];
		$approved_by_designation = $row["approved_by_designation"];$received_from = $row["received_from"];$received_from_designation = $row["received_from_designation"];
		$date_released = $row["date_r"];$area = $row["area"];$transfer_type = $row["transfer_type"];$reason = $row["reason"]; $address = $row["address"]; $reference_no = $row["reference_no"];
		$alloc_num = $row["alloc_num"]; $storage_temp = $row["storage_temp"]; $transport_temp = $row["transport_temp"];
		$table.="<tr>
					<td>".$row["item"]."</td>
					<td>".$row["description"]."</td>
					<td>".$row["serial_no"]."</td>
					<td>".$row["exp_date"]."</td>
					<td>".$row["category"]."</td>
					<td>".$row["property_no"]."</td>
					<td onclick=\"edit_quantity('".$row["ptr_id"]."','".$row["quantity"]."','".$row["reference_no"]."','".$row["item"]."','".$row["description"]."', 'tbl_ptr', 'ptr_id');\"><a><u>".$row["quantity"]."</u></a></td>
					<td>".$row["unit"]."</td>
					<td>".number_format((float)$row["cost"], 2)."</td>
					<td>".number_format((float)$row["total"], 2)."</td>
					<td>".$row["conditions"]."</td>
					<td>".$row["remarks"]."</td>
				</tr>";
	}

	echo json_encode(array(
		"reference_no"=>$reference_no,
		"from"=>$from,
		"to"=>$to,
		"entity_name"=>$entity_name,
		"fund_cluster"=>$fund_cluster,
		"approved_by"=>$approved_by,
		"approved_by_designation"=>$approved_by_designation,
		"received_from"=>$received_from,
		"received_from_designation"=>$received_from_designation,
		"date_released"=>$date_released,
		"area"=>$area,
		"transfer_type"=>$transfer_type,
		"reason"=>$reason,
		"address"=>$address,
		"table"=>$table,
		"alloc_num"=>$alloc_num,
		"storage_temp"=>$storage_temp,
		"transport_temp"=>$transport_temp
	));
}

function to_issue(){
	global $conn;

	$ptr_no = mysqli_real_escape_string($conn, $_POST["ptr_no"]);
	mysqli_query($conn, "UPDATE tbl_ptr SET issued = '1' WHERE ptr_no = '$ptr_no'");
}

function print_ptr_gen(){
	global $conn;

	$entity_name = ""; $fund_cluster = ""; $from = ""; $to = ""; $date = ""; $transfer_type = "";
	$total_cost = 0.00; $reason = ""; $approved_by = ""; $approved_by_designation = ""; $received_from = ""; $received_from_designation = "";
	$supplier = ""; $reference_no = ""; $address = "";
	$rows_limit = 35; $rows_occupied = 0;
	$ptr_body = "";
	$ptr_no = mysqli_real_escape_string($conn, $_POST["ptr_no"]);
	$sql = mysqli_query($conn, "SELECT entity_name, fund_cluster, tbl_ptr.from, tbl_ptr.to, serial_no, exp_date, SUBSTRING(date_released, 1, 10) AS date_r, transfer_type, reference_no, supplier, property_no, item, description, quantity, unit, cost, total, conditions, reason, approved_by, approved_by_designation, received_from, received_from_designation, address FROM tbl_ptr WHERE ptr_no LIKE '$ptr_no'");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$entity_name = $row["entity_name"]; $fund_cluster = $row["fund_cluster"]; $from = $row["from"]; $to = $row["to"]; $date = $row["date_r"];
			$transfer_type = $row["transfer_type"]; $reason = $row["reason"]; $approved_by = $row["approved_by"]; $received_from = $row["received_from"];
			$approved_by_designation = $row["approved_by_designation"]; $received_from_designation = $row["received_from_designation"]; $address = $row["address"];
			$supplier = $row["supplier"]; $reference_no = $row["reference_no"];
			$total_cost += (float)implode("", explode(",",$row["total"]));
			$pn = explode(",", $row["property_no"]);
			$ptr_body .= "<tr>
			      <td style=\"width: 73.2px; height: 14px; text-align: center; font-size: 12.5px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
			      <td colspan=\"2\" style=\"width: 23.4px; height: 14px; text-align: center; font-size: 11px; vertical-align: center; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\">".((count($pn) >= 1 && $row["serial_no"] == null) ? $pn[0] : "")."</td>
			      <td colspan=\"3\" style=\"width: 26.4px; height: 14px; text-align: left; font-size: 12.5px; vertical-align: center; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\"><b>".$row["item"]."</b><br>".$row["description"]."</td>
			      <td style=\"width: 49.8px; height: 14px; text-align: center; font-size: 12.5px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["quantity"]."</td>
			      <td style=\"width: 51.6px; height: 14px; text-align: center; font-size: 12.5px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["unit"]."</td>
			      <td style=\"width: 64.8px; height: 14px; text-align: center; font-size: 12.5px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format((float)$row["cost"], 2)."</td>
			      <td style=\"width: 72px; height: 14px; text-align: right; font-size: 12.5px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format((float)$row["total"],2)."</td>
			      <td style=\"width: 72.6px; height: 14px; text-align: center; font-size: 12.5px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["conditions"]."</td>
			    </tr>";$rows_occupied++;
			    $rows_occupied+=round((float)strlen($row["description"]) / 50.00);
			    if($row["serial_no"] == null && count($pn) > 1){
			     	for($j = 1; $j < count($pn); $j++){
			     		$ptr_body .= "<tr>
					      <td style=\"width: 73.2px; height: 14px; text-align: center; font-size: 12.5px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
					      <td colspan=\"2\" style=\"width: 23.4px; height: 14px; text-align: center; font-size: 11px; vertical-align: center; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\">".$pn[$j]."</td>
					      <td colspan=\"3\" style=\"width: 26.4px; height: 14px; text-align: left; font-size: 10px; vertical-align: center; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\"></td>
					      <td style=\"width: 49.8px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
					      <td style=\"width: 51.6px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
					      <td style=\"width: 64.8px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
					      <td style=\"width: 72px; height: 14px; text-align: right; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
					      <td style=\"width: 72.6px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
					    </tr>";
						$rows_occupied++;
			     	}
			    }
			    if($row["serial_no"] != null){
			    	$serials = explode(",", $row["serial_no"]);
			    	for($i = 0; $i < count($serials); $i++){
			    		$ptr_body .= "<tr>
					      <td style=\"width: 73.2px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
					      <td colspan=\"2\" style=\"width: 23.4px; height: 14px; text-align: center; font-size: 11px; vertical-align: center; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\">".$pn[$i]."</td>
					      <td colspan=\"3\" style=\"width: 26.4px; height: 14px; text-align: left; font-size: 12.5px; vertical-align: center; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\">Serial No. ".$serials[$i]."</td>
					      <td style=\"width: 49.8px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
					      <td style=\"width: 51.6px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
					      <td style=\"width: 64.8px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
					      <td style=\"width: 72px; height: 14px; text-align: right; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
					      <td style=\"width: 72.6px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
					    </tr>";
					    $rows_occupied++;
			    	}
			    }
		}
		$the_rest = array("*Nothing Follows*","","","PO No. ".$reference_no, $supplier);
		for($i = 0; $i < count($the_rest); $i++){
			$ptr_body .= "<tr>
					      <td style=\"width: 73.2px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
					      <td colspan=\"2\" style=\"width: 23.4px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\"></td>
					      <td colspan=\"3\" style=\"width: 26.4px; height: 14px; text-align: left; font-size: 12.5px; vertical-align: center; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\">".$the_rest[$i]."</td>
					      <td style=\"width: 49.8px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
					      <td style=\"width: 51.6px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
					      <td style=\"width: 64.8px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
					      <td style=\"width: 72px; height: 14px; text-align: right; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
					      <td style=\"width: 72.6px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
					    </tr>";
					    $rows_occupied++;
		}

		for($i = 0; $i < ($rows_limit - $rows_occupied); $i++){
			$ptr_body .= "<tr>
			      <td style=\"width: 73.2px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
			      <td colspan=\"2\" style=\"width: 23.4px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\"></td>
			      <td colspan=\"3\" style=\"width: 26.4px; height: 14px; text-align: left; font-size: 10px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\"></td>
			      <td style=\"width: 49.8px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			      <td style=\"width: 51.6px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			      <td style=\"width: 64.8px; height: 14px; text-align: right; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			      <td style=\"width: 72px; height: 14px; text-align: right; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			      <td style=\"width: 72.6px; height: 14px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			    </tr>";
		}
		$approved_by = get_complete_name($approved_by);
		echo json_encode(array("ptr_details"=>array($entity_name, $fund_cluster, $from, $to, _m_d_yyyy_($date), $transfer_type, number_format((float)$total_cost,2), $reason, $approved_by, $approved_by_designation, $received_from, $received_from_designation, $address), "ptr_tbody"=>$ptr_body));	
	}
}

function get_ptr_details(){
	global $conn;

	$entity_name = ""; $fund_cluster = ""; $from = ""; $to = ""; $date = ""; $transfer_type = "";
	$total_cost = 0.00; $reason = ""; $approved_by = ""; $approved_by_designation = ""; $received_from = "";$received_from_designation = "";
	$alloc_num = ""; $storage_temp = ""; $transport_temp = "";

	$rows_limit = 35; $rows_occupied = 0;
	$ptr_body = "";
	$ptr_no = mysqli_real_escape_string($conn, $_POST["ptr_no"]);
	$sql = mysqli_query($conn, "SELECT entity_name, fund_cluster, tbl_ptr.from, tbl_ptr.to, serial_no, exp_date, SUBSTRING(date_released, 1, 10) AS date_r, transfer_type, reference_no, item, description, quantity, unit, cost, total, remarks, reason, approved_by, approved_by_designation, received_from, received_from_designation,alloc_num,storage_temp,transport_temp FROM tbl_ptr WHERE ptr_no LIKE '$ptr_no'");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$entity_name = $row["entity_name"]; $fund_cluster = $row["fund_cluster"]; $from = $row["from"]; $to = $row["to"]; $date = $row["date_r"];
			$transfer_type = $row["transfer_type"]; $reason = $row["reason"]; $approved_by = $row["approved_by"]; $received_from = $row["received_from"];
			$approved_by_designation = $row["approved_by_designation"];$received_from_designation = $row["received_from_designation"];
			$alloc_num = $row["alloc_num"]; $storage_temp = $row["storage_temp"]; $transport_temp = $row["transport_temp"];
			$total_cost += (float)implode("", explode(",",$row["total"]));
			$ptr_body .= "<tr>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 9.5px; vertical-align: center; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
			        <td style=\"width: 24.6px; height: 13.75px; text-align:center; font-size: 9.5px; vertical-align: center; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
			        <td colspan=\"2\" style=\"width: 24.6px; height: 13.75px; text-align:center;font-size: 9.5px; vertical-align: center; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\">".$row["reference_no"]."</td>
			        <td colspan=\"5\" style=\"width: 24.6px; height: 13.75px; font-size: 13px; vertical-align: center; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"><b>".$row["item"]."</b><br>- ".$row["description"]."</td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 13px; text-align:center;vertical-align: center; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\">".$row["serial_no"]."</td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 13px; text-align:center;vertical-align: center; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\">".($row["exp_date"] == "0000-00-00" ? "" : $row["exp_date"])."</td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 13px; text-align:center; vertical-align: center; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\">".$row["quantity"]."</td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 13px; text-align:center;vertical-align: center; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\">".$row["unit"]."</td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 13px; text-align:center;vertical-align: center; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\">".$row["cost"]."</td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 13px; text-align:center;vertical-align: center; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\">".number_format((float)$row["total"], 2)."</td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 9.5px; vertical-align: center; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 11px; text-align:center;vertical-align: center; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; border-right-color: rgb(0, 0, 0); border-right-width: 1px; border-right-style: solid;\">".$row["remarks"]."</td>
			      </tr>";
			      $rows_occupied+=2;
		}
		for($i = 0; $i < ($rows_limit - $rows_occupied); $i++){
			$ptr_body .= "<tr>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 10px; vertical-align: bottom; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 10px; vertical-align: bottom; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
			        <td colspan=\"2\" style=\"width: 24.6px; height: 13.75px; font-size: 10px; vertical-align: bottom; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
			        <td colspan=\"5\" style=\"width: 24.6px; height: 13.75px; font-size: 10px; vertical-align: bottom; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 10px; vertical-align: bottom; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 10px; vertical-align: bottom; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 10px; vertical-align: bottom; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 10px; vertical-align: bottom; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 10px; vertical-align: bottom; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 10px; vertical-align: bottom; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 10px; vertical-align: bottom; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
			        <td style=\"width: 24.6px; height: 13.75px; font-size: 10px; vertical-align: bottom; border-left-color: rgb(0, 0, 0); border-left-width: 1px; border-left-style: solid; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; border-right-color: rgb(0, 0, 0); border-right-width: 1px; border-right-style: solid;\"></td>
			      </tr>";
		}
		echo json_encode(array("ptr_details"=>array($entity_name, $fund_cluster, $from, $to, _m_d_yyyy_($date), $transfer_type, number_format((float)$total_cost,2), $reason, $approved_by, $approved_by_designation, $received_from, $received_from_designation), "ptr_tbody"=>$ptr_body,"alloc_num"=>$alloc_num,"storage_temp"=>$storage_temp,"transport_temp"=>$transport_temp));	
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

	$query = "SELECT DISTINCT ptr_no, area, SUBSTRING(date_released, 1, 10) AS date_r, SUBSTRING(date_supply_received,1,10) AS date_s, tbl_ptr.from, tbl_ptr.to, reason, remarks, issued, transfer_type FROM tbl_ptr ";
	if($_POST["search"] != ""){
		$qs = mysqli_real_escape_string($conn, $_POST["search"]);
		$query.="WHERE ptr_no LIKE '%$qs%' OR reference_no LIKE '%$qs%' OR tbl_ptr.from LIKE '%$qs%' OR tbl_ptr.to LIKE '%$qs%' OR transfer_type LIKE '%$qs%' OR reason LIKE '%$qs%' OR item LIKE '%$qs%' ";
	}
	$query.="ORDER BY ptr_id DESC ";

	$sql_orig = mysqli_query($conn, $query);
	$sql = mysqli_query($conn, $query."LIMIT ".$start.", ".$limit."");
	$tbody = "";
	$total_data = mysqli_num_rows($sql_orig);
	if($total_data != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$ptr_no = $row["ptr_no"];
			$category = mysqli_fetch_assoc(mysqli_query($conn, "SELECT category FROM tbl_ptr WHERE ptr_no = '$ptr_no'"))["category"];
			$func_call = ($category == "Drugs and Medicines" || $category == "Medical Supplies") ? "print_ptr(this.value);" : "print_ptr_gen(this.value)";
			$dl_xls = ($category == "Drugs and Medicines" || $category == "Medical Supplies") ? "download_xls(this.value);" : "download_xls_gen(this.value)";
			$to = str_replace(' ', '', $row["to"]);

			$in = array();			
			$get_items = mysqli_query($conn, "SELECT item FROM tbl_ptr WHERE ptr_no LIKE '$ptr_no'");
			while($ri = mysqli_fetch_assoc($get_items)){
				array_push($in, $ri["item"]);
			}
			$refs = array();
			$get_rf = mysqli_query($conn, "SELECT DISTINCT reference_no FROM tbl_ptr WHERE ptr_no LIKE '$ptr_no'");
			while($rf = mysqli_fetch_assoc($get_rf)){
				array_push($refs, $rf["reference_no"]);
			}
			$tbody.="<tr>
					<td><center>".(($row["issued"] == '0') ? "<button id=\"\" value=\"".$row["ptr_no"]."\" ".(($_SESSION["role"] == "SUPPLY") ? "onclick=\"to_issue(this.value, this.id);\"" : "")." class=\"btn btn-xs btn-danger\" style=\"border-radius: 10px;\">✖</button>" : "<button class=\"btn btn-xs\" style=\"border-radius: 10px; background-color: #00FF00; color: white; font-weight: bold;\" disabled>✓</button>")."</center></td>
					<td>".$row["ptr_no"]."</td>
					<td style=\"font-size: 10px;\">".implode(", ", $refs)."</td>
					<td style=\"font-size: 10px;\">".implode(", ", $in)."</td>
					<td>".$row["from"]."</td>
					<td>".$row["to"]."</td>
					<td>".$row["date_r"]."</td>
					<td>".$row["date_s"]."</td>
					<td>".$row["transfer_type"]."</td>
					<td>".$row["reason"]."</td>
					<td><center><button class=\"btn btn-xs btn-primary\" value=\"".$row["ptr_no"]."\" onclick=\"view_iss(this.value,'tbl_ptr','view_ptr','PTR','ptr_no','".$to."');\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Preview\"><i class=\"fa fa-picture-o\"></i></button>&nbsp;".(($_SESSION["role"] == "SUPPLY") ? "<button class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" value=\"".$row["ptr_no"]."\" data-placement=\"top\" title=\"Edit\" onclick=\"modify(this.value);\"><i class=\"fa fa-pencil-square-o\"></i></button>&nbsp;" : "")."<button value=\"".$row["ptr_no"]."\" onclick=\"".$func_call."\" class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Print\"><i class=\"fa fa-print\"></i></button>&nbsp;".(($_SESSION["role"] == "SUPPLY") ? "<button class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\" value=\"".$row["ptr_no"]."\" onclick=\"delete_control(this.value);\"><i class=\"fa fa-trash\"></i></button>&nbsp;" : "")."<button class=\"btn btn-xs btn-warning\" value=\"".$row["ptr_no"]."\" onclick=\"".$dl_xls."\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Save as Excel\"><i class=\"fa fa-file-excel-o\"></i></button></center></td>
				</tr>";
		}
	}else{
		$tbody="<tr><td colspan=\"11\" style=\"text-align: center;\">No data found.</td></tr>";
	}
	$in_out = create_table_pagination($page, $limit, $total_data, array("","PTR No.","PO No.","Items","From","To","Date Released","Date Received", "Transfer Type", "Reason", ""));
	$whole_dom = $in_out[0]."".$tbody."".$in_out[1];
	echo $whole_dom;
}

function insert_ptr(){
	global $conn;
	global $connhr;
	date_default_timezone_set("Asia/Shanghai");
	$time_now = date("H:i:s");
	$ptr_no = mysqli_real_escape_string($conn, $_POST["ptr_no"]);
	$from = mysqli_real_escape_string($conn, $_POST["from"]);
	$entity_name = mysqli_real_escape_string($conn, $_POST["entity_name"]);
	$approved_by_id = mysqli_real_escape_string($conn, $_POST["approved_by_id"]);
	$approved_by = mysqli_real_escape_string($conn, $_POST["approved_by"]);
	$date_released = mysqli_real_escape_string($conn, $_POST["date_released"])." ".$time_now;
	$transfer_type = mysqli_real_escape_string($conn, $_POST["transfer_type"]);
	$reference_no = mysqli_real_escape_string($conn, $_POST["reference_no"]);
	$fund_cluster = mysqli_real_escape_string($conn, $_POST["fund_cluster"]);
	$to = mysqli_real_escape_string($conn, $_POST["to"]);
	$received_from_id = mysqli_real_escape_string($conn, $_POST["received_from_id"]);
	$received_from = mysqli_real_escape_string($conn, $_POST["received_from"]);
	$area = mysqli_real_escape_string($conn, $_POST["area"]);
	$reason = mysqli_real_escape_string($conn, $_POST["reason"]);
	$address = mysqli_real_escape_string($conn, $_POST["address"]);
	$items = $_POST["items"];
	$alloc_num = mysqli_real_escape_string($conn, $_POST["alloc_num"]);
	$storage_temp = mysqli_real_escape_string($conn, $_POST["storage_temp"]);
	$transport_temp = mysqli_real_escape_string($conn, $_POST["transport_temp"]);

	$quer1 = mysqli_query($connhr, "SELECT d.designation, e.designation_fid FROM tbl_employee AS e, ref_designation AS d WHERE d.designation_id = e.designation_fid AND e.emp_id = '$approved_by_id'");
	$quer2 = mysqli_query($connhr, "SELECT d.designation, e.designation_fid FROM tbl_employee AS e, ref_designation AS d WHERE d.designation_id = e.designation_fid AND e.emp_id = '$received_from_id'");
	$query = mysqli_query($conn, "SELECT s.supplier, p.supplier_id FROM tbl_po AS p, ref_supplier AS s WHERE s.supplier_id = p.supplier_id AND p.po_number LIKE '$reference_no'");
	$approved_by_designation = mysqli_fetch_assoc($quer1)["designation"];
	$received_from_designation = mysqli_fetch_assoc($quer2)["designation"];

	$supplier = mysqli_fetch_assoc($query)["supplier"];
	if(mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT ptr_no FROM tbl_ptr WHERE ptr_no = '$ptr_no'"))==0){
		$emp_id = $_SESSION["emp_id"];
		$description = $_SESSION["username"]." created a PTR No. ".$ptr_no;
		mysqli_query($conn, "INSERT INTO tbl_logs(emp_id,description) VALUES('$emp_id','$description')");
		for($i = 0; $i < count($items); $i++){
			$item_id = $items[$i][0];
			$ref_no = $items[$i][1];
			$item = mysqli_real_escape_string($conn, $items[$i][2]);
			$description = mysqli_real_escape_string($conn, $items[$i][3]);
			$serial_no = $items[$i][4];
			$exp_date = $items[$i][5];
			$category = $items[$i][6];
			$property_no = $items[$i][7];
			$quantity = $items[$i][8];
			$unit = $items[$i][9];
			$cost = $items[$i][10];
			$total = $items[$i][11];
			$conditions = $items[$i][12];
			$remarks = $items[$i][13];
			mysqli_query($conn, "INSERT INTO tbl_ptr(ptr_no,entity_name,fund_cluster,tbl_ptr.from,tbl_ptr.to,transfer_type,reference_no,item,description,unit,supplier,serial_no,exp_date,category,property_no,quantity,cost,total,conditions,remarks,reason,approved_by,approved_by_designation,received_from,received_from_designation,date_released,area,address,alloc_num,storage_temp,transport_temp) VALUES('$ptr_no','$entity_name','$fund_cluster','$from','$to','$transfer_type','$ref_no','$item','$description','$unit','$supplier','$serial_no','$exp_date','$category','$property_no','$quantity','$cost','$total','$conditions','$remarks','$reason','$approved_by','$approved_by_designation','$received_from','$received_from_designation','$date_released','$area','$address','$alloc_num','$storage_temp','$transport_temp')");
			$query_get_stocks = mysqli_query($conn, "SELECT quantity FROM tbl_po WHERE po_number = '$ref_no' AND po_id = '$item_id'");
			$rstocks = explode(" ", mysqli_fetch_assoc($query_get_stocks)["quantity"]);
			$newrstocks = ((int)$rstocks[0] - (int)$quantity)." ".$rstocks[1];
			mysqli_query($conn, "UPDATE tbl_po SET quantity = '$newrstocks' WHERE po_number = '$ref_no' AND po_id = '$item_id'");
			if($category != "Drugs and Medicines" && $category != "Medical Supplies"){
				$serials = explode(",", $serial_no);
				for($j = 0; $j < count($serials); $j++){
					$sn = $serials[$j];
					mysqli_query($conn, "UPDATE tbl_serial SET is_issued = 'Y' WHERE inventory_id = '$item_id' AND serial_no = '$sn'");
				}
			}
			if($property_no != ""){
				if($category != "Drugs and Medicines" && $category != "Medical Supplies"){
					$pns = explode(",", $property_no);
					$pn = end($pns);
					mysqli_query($conn, "UPDATE ref_lastpn SET property_no = '$pn' WHERE id = 1");
				}
			}
		}
		echo "0";
	}else{
		echo "1";
	}
}

function get_latest_ptr(){
	global $conn; $latest_ptr = ""; $latest_pn = "";

	$yy_mm = substr(mysqli_real_escape_string($conn, $_POST["yy_mm"]), 0, 4);
	$sql = mysqli_query($conn, "SELECT DISTINCT ptr_no FROM tbl_ptr WHERE ptr_no LIKE '%$yy_mm%' ORDER BY ptr_id DESC LIMIT 1");
	if(mysqli_num_rows($sql) != 0){
		$row = mysqli_fetch_assoc($sql);
		$latest_ptr = str_pad(((int)explode("-", $row["ptr_no"])[2]) + 1, 4, '0', STR_PAD_LEFT);
	}else{
		$latest_ptr = "0001";
	}
	$sql = mysqli_query($conn, "SELECT property_no FROM ref_lastpn WHERE id = 1 AND property_no LIKE '%$yy_mm%'");
	if(mysqli_num_rows($sql) != 0){
		$row = mysqli_fetch_assoc($sql);
		$latest_pn = str_pad(((int)explode("-", $row["property_no"])[2]) + 1, 4, '0', STR_PAD_LEFT);
	}else{
		$latest_pn = "0001";
	}
	echo json_encode(array("latest_ptr"=>$latest_ptr,"latest_pn"=>$latest_pn));
}

$call_func = mysqli_real_escape_string($conn, $_POST["call_func"]);
switch($call_func){
	case "insert_ptr":
		insert_ptr();
		break;
	case "get_records":
		get_records();
		break;
	case "get_ptr_details":
		get_ptr_details();
		break;
	case "print_ptr_gen":
		print_ptr_gen();
		break;
	case "get_latest_ptr":
		get_latest_ptr();
		break;
	case "to_issue":
		to_issue();
		break;
	case "modify":
		modify();
		break;
	case "update":
		update();
		break;
}

?>