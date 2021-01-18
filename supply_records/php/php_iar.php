<?php

require "../../php/php_conn.php";
require "../../php/php_general_functions.php";
session_start();
function update(){
	global $conn;

	$entity_name = mysqli_real_escape_string($conn, $_POST["entity_name"]);
	$iar_number = mysqli_real_escape_string($conn, $_POST["iar_number"]);
	$fund_cluster = mysqli_real_escape_string($conn, $_POST["fund_cluster"]);
	$po_number = mysqli_real_escape_string($conn, $_POST["po_number"]);
	$req_office = mysqli_real_escape_string($conn, $_POST["req_office"]);
	$res_cc = mysqli_real_escape_string($conn, $_POST["res_cc"]);
	$charge_invoice = mysqli_real_escape_string($conn, $_POST["charge_invoice"]);
	$inspector = mysqli_real_escape_string($conn, $_POST["inspector"]);
	$date_inspected = mysqli_real_escape_string($conn, $_POST["date_inspected"]);
	$date_received = mysqli_real_escape_string($conn, $_POST["date_received"]);
	$items = $_POST["items"];

	for($i = 0; $i < count($items); $i++){
		$item_name = $items[$i][0];
		$description = $items[$i][1];
		$bool = $items[$i][2];
		mysqli_query($conn,"UPDATE tbl_po SET inspection_status = '$bool' WHERE item_name = '$item_name' AND description = '$description' AND po_number = '$po_number'");
	}
	mysqli_query($conn,"UPDATE tbl_iar SET entity_name = '$entity_name', fund_cluster = '$fund_cluster', req_office = '$req_office', res_cc = '$res_cc', charge_invoice = '$charge_invoice', inspector = '$inspector', date_inspected = '$date_inspected', date_received = '$date_received' WHERE iar_number LIKE '$iar_number'");

	$emp_id = $_SESSION["emp_id"];
	$description = $_SESSION["username"]." edited the details of IAR No. ".$iar_number;
	mysqli_query($conn, "INSERT INTO tbl_logs(emp_id,description) VALUES('$emp_id','$description')");
}

function get_iar_details(){
	global $conn;

	$iar_number = mysqli_real_escape_string($conn, $_POST["iar_number"]);
	$entity_name="";$fund_cluster="";$po_number="";$req_office="";$res_cc="";$charge_invoice="";$date_inspected="";$inspector="";$date_received="";$end_user="";$supplier="";
	$table = "";
	$sql = mysqli_query($conn, "SELECT i.entity_name, i.fund_cluster, i.po_number, i.req_office, i.res_cc, i.charge_invoice, i.date_inspected, i.inspector, i.date_received, p.end_user, p.date_conformed, p.date_delivered, p.item_name, p.description, p.quantity, p.unit_cost, p.inspection_status, s.supplier FROM tbl_iar AS i, tbl_po AS p, ref_supplier AS s WHERE i.iar_number LIKE '$iar_number' AND i.iar_number = p.iar_no AND s.supplier_id = p.supplier_id");
	while($row = mysqli_fetch_assoc($sql)){
		$entity_name = $row["entity_name"];$fund_cluster = $row["fund_cluster"];$po_number = $row["po_number"];$req_office = $row["req_office"];$res_cc = $row["res_cc"];
		$charge_invoice = $row["charge_invoice"];$date_inspected = $row["date_inspected"];$inspector = $row["inspector"];$date_received = $row["date_received"];
		$end_user = $row["end_user"];$supplier = $row["supplier"];
		$table.="<tr>
					<td>".$row["date_delivered"]."</td>
					<td>".$row["item_name"]."</td>
					<td>".$row["description"]."</td>
					<td>".$row["quantity"]."</td>
					<td>".$row["unit_cost"]."</td>
					<td><center>".($row["inspection_status"] == "1" ? "<input type=\"checkbox\" checked>" : "<input type=\"checkbox\">")."</center></td>
				</tr>";
	}
	echo json_encode(array(
		"entity_name"=>$entity_name,
		"fund_cluster"=>$fund_cluster,
		"po_number"=>$po_number,
		"req_office"=>$req_office,
		"res_cc"=>$res_cc,
		"charge_invoice"=>$charge_invoice,
		"date_inspected"=>$date_inspected,
		"inspector"=>$inspector,
		"date_received"=>$date_received,
		"end_user"=>$end_user,
		"supplier"=>$supplier,
		"table"=>$table
	));
}

function print_iar_dm(){
	global $conn;

	$rows_limit = 30; $rows_occupied = 0;
	$iar_number = mysqli_real_escape_string($conn, $_POST["iar_number"]);
	$entity_name = "";$fund_cluster = "";$po_number = "";$req_office = "";$res_cc = "";$invoice = "";$date_inspected = "";$inspector = "";$inspected = "";
	$date_received = "";$property_custodian = "";$status = "";$partial_specify = "";$supplier = "";$date_conformed = "";$date_delivered = "";$end_user = "";
	$tbody = "";$total_amount = 0.00;
	$sql = mysqli_query($conn, "SELECT po_number, entity_name, fund_cluster, req_office, res_cc, charge_invoice, date_inspected, inspector, inspected, date_received, property_custodian, status, partial_specify FROM tbl_iar WHERE iar_number LIKE '$iar_number'");
	while($row = mysqli_fetch_assoc($sql)){
		$po_number = $row["po_number"];$entity_name = $row["entity_name"];$fund_cluster = $row["fund_cluster"];$req_office = $row["req_office"];
		$res_cc = $row["res_cc"];$invoice = $row["charge_invoice"];$date_inspected = $row["date_inspected"];$inspector = $row["inspector"];
		$inspected = $row["inspected"];$date_received = $row["date_received"];$property_custodian = $row["property_custodian"];$status = $row["status"];
		$partial_specify = $row["partial_specify"];
	}

	$sql2 = mysqli_query($conn, "SELECT DISTINCT p.item_name, p.po_id, s.supplier, p.description, p.unit_cost, p.date_conformed, p.date_delivered, p.end_user FROM ref_supplier AS s, tbl_po AS p WHERE p.po_number LIKE '$po_number' AND p.inspection_status = '1' AND s.supplier_id = p.supplier_id AND p.iar_no LIKE '$iar_number'");
	while($row = mysqli_fetch_assoc($sql2)){
		$item_name = $row["item_name"]; $poid = $row["po_id"];
		$supplier = $row["supplier"]; $date_conformed = $row["date_conformed"];$date_delivered = $row["date_delivered"];$end_user = $row["end_user"];
		$quan_unit = "";
		$getQuan = mysqli_query($conn, "SELECT quantity FROM tbl_po WHERE item_name LIKE '$item_name' AND iar_no LIKE '$iar_number'");
		$total_quan = 0.00;
		while($rowt = mysqli_fetch_assoc($getQuan)){
			$quan_unit = explode(" ", $rowt["quantity"]);
			$total_quan+=(float)$quan_unit[0];
		}
		$tbody.="<tr>
	          <td style=\"width: 73.2px; height: 15px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
	          <td colspan=\"2\" style=\"width: 148.8px; height: 15px; text-align: left; font-size: 10px; font-weight: bold; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\">".$row["description"]."</td>
	          <td style=\"width: 72.6px; height: 15px; text-align: left; font-size: 9px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
	          <td style=\"width: 63px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$quan_unit[1]."</td>
	          <td colspan=\"2\" style=\"width: 57.6px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; border-right-color: rgb(0, 0, 0); border-right-width:2px;border-right-style:solid;\">".number_format((float)$total_quan, 0)."</td>
	        </tr>";
	        
	        $sql3 = mysqli_query($conn, "SELECT p.quantity, s.serial_no, p.exp_date FROM tbl_po AS p, tbl_serial AS s WHERE p.item_name LIKE '$item_name' AND iar_no LIKE '$iar_number' AND s.inventory_id = p.po_id");
	        while($rows = mysqli_fetch_assoc($sql3)){
	        	$tbody.="<tr>
		          <td style=\"width: 73.2px; height: 15px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
		          <td style=\"width: 148.8px; height: 15px; text-align: left; font-size: 10px; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\">Lot#: ".$rows["serial_no"]."</td>
		          <td style=\"width: 144px; height: 15px; text-align: left; font-size: 10px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\">Exp. Date: ".$rows["exp_date"]."</td>
		          <td style=\"width: 72.6px; height: 15px; text-align: right; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$rows["quantity"]."&nbsp;&nbsp;&nbsp;&nbsp;</td>
		          <td style=\"width: 63px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		          <td style=\"width: 57.6px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
		          <td style=\"width: 28.8px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		        </tr>";
		        $rows_occupied+=1;
	        }

	        $tbody.="<tr>
	          <td style=\"width: 73.2px; height: 15px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
	          <td colspan=\"3\" style=\"width: 148.8px; height: 15px; text-align: left; font-size: 10px; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\">Manufactured by: Serum Institute of India</td>
	          <td style=\"width: 63px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
	          <td style=\"width: 57.6px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
	          <td style=\"width: 28.8px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
	        </tr>
	        <tr>
	          <td style=\"width: 73.2px; height: 15px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
	          <td colspan=\"3\" style=\"width: 148.8px; height: 15px; text-align: left; font-size: 10px; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\">Price: P ".number_format((float)$row["unit_cost"],2)." = P ".number_format(((float)$row["unit_cost"] * (float)$total_quan), 2)."</td>
	          <td style=\"width: 63px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
	          <td style=\"width: 57.6px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
	          <td style=\"width: 28.8px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
	        </tr>
	        <tr>
	          <td style=\"width: 73.2px; height: 15px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
	          <td style=\"width: 148.8px; height: 15px; font-size: 10px; font-weight: bold; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
	          <td style=\"width: 144px; height: 15px; font-size: 10px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
	          <td style=\"width: 72.6px; height: 15px; text-align: left; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
	          <td style=\"width: 63px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
	          <td style=\"width: 57.6px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
	          <td style=\"width: 28.8px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
	        </tr>";
	        $rows_occupied+=4;
	        $total_amount+=((float)$row["unit_cost"] * (float)$total_quan);
	}
	for($i = 0; $i < ($rows_limit - $rows_occupied); $i++){
		$tbody.="<tr>
		          <td style=\"width: 73.2px; height: 15px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
		          <td style=\"width: 148.8px; height: 15px; font-size: 10px; font-weight: bold; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
		          <td style=\"width: 144px; height: 15px; font-size: 10px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
		          <td style=\"width: 72.6px; height: 15px; text-align: left; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		          <td style=\"width: 63px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		          <td style=\"width: 57.6px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;\"></td>
		          <td style=\"width: 28.8px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		        </tr>";
	}

	echo json_encode(array(
		"entity_name"=>$entity_name,
		"fund_cluster"=>$fund_cluster,
		"po_number"=>$po_number,
		"req_office"=>$req_office,
		"res_cc"=>$res_cc,
		"invoice_number"=>$invoice,
		"tbody"=>$tbody,
		"date_inspected"=>_m_d_yyyy_($date_inspected),
		"inspector"=>$inspector,
		"inspected"=>$inspected,
		"date_received"=>_m_d_yyyy_($date_received),
		"property_custodian"=>$property_custodian,
		"status"=>$status,
		"partial_specify"=>$partial_specify,
		"date_conformed"=>_m_d_yyyy_($date_conformed),
		"date_delivered"=>_m_d_yyyy_($date_delivered),
		"end_user"=>$end_user,
		"supplier"=>$supplier,
		"total_amount"=>number_format((float)$total_amount, 2)
		)
	);
}

function print_iar_gen(){
	global $conn;

	$rows_limit = 30; $rows_occupied = 0;
	$iar_number = mysqli_real_escape_string($conn, $_POST["iar_number"]);
	$entity_name = "";$fund_cluster = "";$po_number = "";$req_office = "";$res_cc = "";$invoice = "";$date_inspected = "";$inspector = "";$inspected = "";
	$date_received = "";$property_custodian = "";$status = "";$partial_specify = "";$supplier = "";$date_conformed = "";$date_delivered = "";$end_user = "";
	$tbody = "";$total_amount = 0.00;
	$sql = mysqli_query($conn, "SELECT po_number, entity_name, fund_cluster, req_office, res_cc, charge_invoice, date_inspected, inspector, inspected, date_received, property_custodian, status, partial_specify FROM tbl_iar WHERE iar_number LIKE '$iar_number'");
	while($row = mysqli_fetch_assoc($sql)){
		$po_number = $row["po_number"];$entity_name = $row["entity_name"];$fund_cluster = $row["fund_cluster"];$req_office = $row["req_office"];
		$res_cc = $row["res_cc"];$invoice = $row["charge_invoice"];$date_inspected = $row["date_inspected"];$inspector = $row["inspector"];
		$inspected = $row["inspected"];$date_received = $row["date_received"];$property_custodian = $row["property_custodian"];$status = $row["status"];
		$partial_specify = $row["partial_specify"];
	}
	$sql2 = mysqli_query($conn, "SELECT p.item_name, s.supplier, p.description, p.quantity, p.unit_cost, p.date_conformed, p.date_delivered, p.end_user FROM ref_supplier AS s, tbl_po AS p WHERE p.po_number LIKE '$po_number' AND p.inspection_status = '1' AND s.supplier_id = p.supplier_id AND p.iar_no LIKE '$iar_number'");
	while($row = mysqli_fetch_assoc($sql2)){
		$supplier = $row["supplier"]; $date_conformed = $row["date_conformed"];$date_delivered = $row["date_delivered"];$end_user = $row["end_user"];
		$quan_unit = explode(" ",$row["quantity"]);
		$tbody.="<tr>
			      <td style=\"width: 84.6px; height: 15px; font-size: 10px; text-align: center; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\">".$date_delivered."</td>
			      <td colspan=\"3\" style=\"width: 148.8px; height: 15px; text-align: left; font-size: 10px; font-weight: bold; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\">".$row["item_name"]."</td>
			      <td style=\"width: 82.2px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$quan_unit[1]."</td>
			      <td colspan=\"2\" style=\"width: 57.6px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\">".$quan_unit[0]."</td>
			    </tr>";
			    $rows_occupied++;
			    $total_amount+=((float)$row["unit_cost"] * (float)$quan_unit[0]);
		$arr = array($row["description"], "");
		for($j = 0; $j < count($arr); $j++){
			$tbody.="<tr>
				      <td style=\"width: 84.6px; height: 15px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
				      <td colspan=\"3\" style=\"width: 148.8px; height: 15px; text-align: left; font-size: 10px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\">".$arr[$j]."</td>
				      <td style=\"width: 82.2px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				      <td colspan=\"2\" style=\"width: 57.6px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\"></td>
				    </tr>";
		   	$rows_occupied++;
		}
	}
	for($i = 0; $i < ($rows_limit - $rows_occupied); $i++){
		$tbody.="<tr>
			      <td style=\"width: 84.6px; height: 15px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
			      <td colspan=\"3\" style=\"width: 148.8px; height: 15px; text-align: left; font-size: 10px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\"></td>
			      <td style=\"width: 82.2px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			      <td colspan=\"2\" style=\"width: 57.6px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\"></td>
			    </tr>";
	}

	echo json_encode(array(
		"entity_name"=>$entity_name,
		"fund_cluster"=>$fund_cluster,
		"po_number"=>$po_number,
		"req_office"=>$req_office,
		"res_cc"=>$res_cc,
		"charge_invoice"=>$invoice,
		"tbody"=>$tbody,
		"date_inspected"=>_m_d_yyyy_($date_inspected),
		"inspector"=>$inspector,
		"inspected"=>$inspected,
		"date_received"=>_m_d_yyyy_($date_received),
		"property_custodian"=>$property_custodian,
		"status"=>$status,
		"partial_specify"=>$partial_specify,
		"date_conformed"=>_m_d_yyyy_($date_conformed),
		"date_delivered"=>_m_d_yyyy_($date_delivered),
		"end_user"=>$end_user,
		"supplier"=>$supplier,
		"total_amount"=>number_format((float)$total_amount, 2)
		)
	);
}

function get_rcc(){
	global $conn;

	$sql = mysqli_query($conn, "SELECT code, acronym FROM ref_rcc WHERE status = '0' ORDER by id");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_assoc($sql)){
			echo "<option value=\"".$row["code"]."\">".$row["acronym"]."</option>";
		}
	}
}

function get_po(){
	global $conn;

	$action = mysqli_real_escape_string($conn, $_POST["action"]);
	$add_query = (isset($_POST["add_query"])) ? "AND inspection_status <> '1' AND status LIKE 'Delivered'" : "";

	if($action == "get_number"){
		$operator = (mysqli_real_escape_string($conn, $_POST["po_type"]) == "ictvar") ? "po_type != 'Catering' AND po_type != 'Drugs and Medicines'" : "po_type != 'Catering'";
		$sql = mysqli_query($conn, "SELECT DISTINCT po_number FROM tbl_po WHERE ".$operator." ".$add_query." ORDER BY po_id DESC");
		
		if(mysqli_num_rows($sql) != 0){
			while($row = mysqli_fetch_assoc($sql)){
				echo "<option id=".$row["po_number"].">".$row["po_number"]."</option>";
			}	
		}
	}

	if($action == "get_details"){
		$po_number = mysqli_real_escape_string($conn, $_POST["po_number"]);
		$sql = mysqli_query($conn, "SELECT s.supplier, p.date_delivered, p.date_conformed, p.end_user, i.item, p.description, p.sn_ln, p.unit_cost, p.quantity, p.po_type FROM ref_supplier AS s, tbl_po AS p, ref_item AS i WHERE p.po_number LIKE '$po_number' AND s.supplier_id = p.supplier_id AND i.item_id = p.item_id AND p.inspection_status = '0'");
		$supplier = "";
		$date_delivered = "";
		$date_conformed = "";
		$end_user = "";
		$po_type = "";
		$tbody = "";

		if(mysqli_num_rows($sql) != 0){
			while($row = mysqli_fetch_assoc($sql)){
				$supplier = $row["supplier"];
				$date_delivered = $row["date_delivered"];
				$date_conformed = $row["date_conformed"];
				$end_user = $row["end_user"];
				$quantity = explode(" ", $row["quantity"]);
				$po_type = $row["po_type"];
				$tbody.="<tr>
							<td></td>
							<td>".$row["item"]."</td>
							<td>".$row["description"]."</td>
							<td>".$row["sn_ln"]."</td>
							<td>".$row["quantity"]."</td>
							<td>".number_format((float)$quantity[0] * (float)$row["unit_cost"], 2)."</td>
							<td><center><input type=\"checkbox\" checked></center></td>
						</tr>";
			}
			echo json_encode(array("supplier"=>$supplier, 
				"date_delivered"=>$date_delivered, 
				"date_conformed"=>$date_conformed, 
				"tbody"=>$tbody, 
				"end_user"=>$end_user,
				"po_type"=>$po_type,
				"success"=>true));
		}else{
			echo json_encode(array("success"=>false));
		}
	}
}

function get_iar(){
	global $conn;

	$sql = mysqli_query($conn, "SELECT DISTINCT iar_number, iar_type, po_number, inspected, date_inspected, date_received, status FROM tbl_iar ORDER BY iar_id DESC");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$pn = $row["po_number"];
			if($row["iar_type"] != "Drugs and Medicines"){
				echo "<tr>
				<td>".$row["po_number"]."</td><td>".$row["iar_number"]."</td>
				<td>".(($row["inspected"]) == 1 ? "Inspected" : "Not Inspected")."</td>
				<td>".$row["date_inspected"]."</td><td>".$row["date_received"]."</td>
				<td>".$row["status"]."</td>
				<td><center><button class=\"btn btn-xs btn-primary\" value=\"".$row["iar_number"]."\" onclick=\"view_iss(this.value,'tbl_iar','view_iar','IAR','iar_number','".substr($pn,0,4)."');\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Preview\"><i class=\"fa fa-picture-o\"></i></button>&nbsp;".(($_SESSION["role"] == "SUPPLY") ? "<button class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\" value=\"".$row["iar_number"]."\" onclick=\"modify(this.value);\"><i class=\"fa fa-pencil-square-o\"></i></button>&nbsp;" : "")."<button class=\"btn btn-xs btn-success ladda-button\" data-style=\"slide-down\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Print\" value=\"".$row["iar_number"]."\" onclick=\"print_iar(this.value);\"><i class=\"fa fa-print\"></i></button>&nbsp;".(($_SESSION["role"] == "SUPPLY") ? "<button id=\"".$row["iar_number"]."\" class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\" onclick=\"delete_control(this.id);\"><i class=\"fa fa-trash\"></i></button>&nbsp;" : "")."<button class=\"btn btn-xs btn-warning\" value=\"".$row["iar_number"]."\" onclick=\"download_xls(this.value);\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Save as Excel\"><i class=\"fa fa-file-excel-o\"></i></button></center></td>
				</tr>";
			}else{
				echo "<tr>
				<td>".$row["po_number"]."</td>
				<td>".$row["iar_number"]."</td>
				<td>".(($row["inspected"]) == 1 ? "Inspected" : "Not Inspected")."</td>
				<td>".$row["date_inspected"]."</td><td>".$row["date_received"]."</td>
				<td>".$row["status"]."</td>
				<td><center><button class=\"btn btn-xs btn-primary\" value=\"".$row["iar_number"]."\" onclick=\"view_iss(this.value,'tbl_iar','view_iar','IAR','iar_number','".substr($pn,0,4)."');\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Preview\"><i class=\"fa fa-picture-o\"></i></button>&nbsp;".(($_SESSION["role"] == "SUPPLY") ? "<button class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\" value=\"".$row["iar_number"]."\" onclick=\"modify(this.value);\"><i class=\"fa fa-pencil-square-o\"></i></button>&nbsp;" : "")."<button class=\"btn btn-xs btn-success ladda-button\" data-style=\"slide-down\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Print\" value=\"".$row["iar_number"]."\" onclick=\"print_iar_dm(this.value);\"><i class=\"fa fa-print\"></i></button>&nbsp;".(($_SESSION["role"] == "SUPPLY") ? "<button id=\"".$row["iar_number"]."\" class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\" onclick=\"delete_control(this.id);\"><i class=\"fa fa-trash\"></i></button>&nbsp;" : "")."<button class=\"btn btn-xs btn-warning\" value=\"".$row["iar_number"]."\" onclick=\"download_xls_dm(this.value);\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Save as Excel\"><i class=\"fa fa-file-excel-o\"></i></button></center></td>
				</tr>";
			}
		}
	}
}

function insert_ntc(){
	echo "ntc_inserted!";
}

function insert_various(){
	global $conn;

	$entity_name = mysqli_real_escape_string($conn, $_POST["entity_name"]);
	$fund_cluster = mysqli_real_escape_string($conn, $_POST["fund_cluster"]);
	$po_number = mysqli_real_escape_string($conn, $_POST["po_number"]);
	$iar_number = mysqli_real_escape_string($conn, $_POST["iar_number"]);
	$iar_type = mysqli_real_escape_string($conn, $_POST["iar_type"]);
	$req_office = mysqli_real_escape_string($conn, $_POST["req_office"]);
	$res_cc = mysqli_real_escape_string($conn, $_POST["res_cc"]);
	$charge_invoice = mysqli_real_escape_string($conn, $_POST["charge_invoice"]);
	$date_inspected = mysqli_real_escape_string($conn, $_POST["date_inspected"]);
	$inspector = mysqli_real_escape_string($conn, $_POST["inspector"]);
	$inspected = mysqli_real_escape_string($conn, $_POST["inspected"]);
	$date_received = mysqli_real_escape_string($conn, $_POST["date_received"]);
	$property_custodian = mysqli_real_escape_string($conn, $_POST["property_custodian"]);
	$status = mysqli_real_escape_string($conn, $_POST["status"]);
	$partial_specify = mysqli_real_escape_string($conn, $_POST["partial_specify"]);
	$items = $_POST["items"];

	mysqli_query($conn, "INSERT INTO tbl_iar(entity_name,fund_cluster,po_number,iar_number,iar_type,req_office,res_cc,charge_invoice,date_inspected,inspector,inspected,date_received,property_custodian,status,partial_specify) VALUES('$entity_name','$fund_cluster','$po_number','$iar_number','$iar_type','$req_office','$res_cc','$charge_invoice','$date_inspected','$inspector','$inspected','$date_received','$property_custodian','$status','$partial_specify')");

	for($i = 0; $i < count($items); $i++){
		$item_name = $items[$i][0];
		$description = $items[$i][1];
		$sn = $items[$i][2];
		$bool = $items[$i][3];
		mysqli_query($conn, "UPDATE tbl_po SET inspection_status = '$bool', iar_no = '$iar_number' WHERE item_name LIKE '$item_name' AND description LIKE '$description' AND po_number LIKE '$po_number'");
	}
	$emp_id = $_SESSION["emp_id"];
	$description = $_SESSION["username"]." created an IAR No. ".$iar_number." - PO#".$po_number;
	mysqli_query($conn, "INSERT INTO tbl_logs(emp_id,description) VALUES('$emp_id','$description')");

}

$call_func = mysqli_real_escape_string($conn, $_POST["call_func"]);
switch($call_func){
	case "insert_various":
		insert_various();
		break;
	case "insert_ntc":
		insert_ntc();
		break;
	case "get_po":
		get_po();
		break;
	case "get_rcc":
		get_rcc();
		break;
	case "get_iar":
		get_iar();
		break;
	case "print_iar_gen":
		print_iar_gen();
		break;
	case "print_iar_dm":
		print_iar_dm();
		break;
	case "get_iar_details":
		get_iar_details();
		break;
	case "update":
		update();
		break;
}

?>