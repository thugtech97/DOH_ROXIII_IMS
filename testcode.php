<?php

require "php/php_conn.php";
require "php/php_general_functions.php";

function print_iar_gen(){
	global $conn;

	$rows_limit = 30; $rows_occupied = 0;
	$iar_number = mysqli_real_escape_string($conn, "767567");
	$entity_name = "";$fund_cluster = "";$po_number = "";$req_office = "";$res_cc = "";$invoice = "";$date_inspected = "";$inspector = "";$inspected = "";
	$date_received = "";$property_custodian = "";$status = "";$partial_specify = "";$supplier = "";$date_conformed = "";$date_delivered = "";$end_user = "";
	$tbody = "";$total_amount = 0.00;
	$sql = mysqli_query($conn, "SELECT po_number, entity_name, fund_cluster, req_office, res_cc, charge_invoice, inspector, inspected, property_custodian, partial_specify FROM tbl_iar WHERE iar_number LIKE '$iar_number'");
	while($row = mysqli_fetch_assoc($sql)){
		$po_number = $row["po_number"];$entity_name = $row["entity_name"];$fund_cluster = $row["fund_cluster"];$req_office = $row["req_office"];
		$res_cc = $row["res_cc"];$invoice = $row["charge_invoice"];$date_inspected = "";$inspector = $row["inspector"];
		$inspected = $row["inspected"];$date_received = "";$property_custodian = $row["property_custodian"];$status = "";
		$partial_specify = $row["partial_specify"];
	}
	$inspector = str_replace('|', '____', $inspector);
	$sql2 = mysqli_query($conn, "SELECT p.item_name, s.supplier, p.description, p.quantity, p.main_stocks, p.unit_cost, p.date_conformed, p.date_delivered, p.end_user FROM ref_supplier AS s, tbl_po AS p WHERE p.po_number LIKE '$po_number' AND p.inspection_status = '1' AND s.supplier_id = p.supplier_id AND p.iar_no LIKE '$iar_number'");
	while($row = mysqli_fetch_assoc($sql2)){
		$supplier = $row["supplier"]; $date_conformed = $row["date_conformed"];$date_delivered = $row["date_delivered"];$end_user = $row["end_user"];
		$quan_unit = explode(" ",$row["quantity"]);
		$tbody.="<tr>
			      <td style=\"width: 84.6px; height: 15px; font-size: 10px; text-align: center; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\">".$date_delivered."</td>
			      <td colspan=\"3\" style=\"width: 148.8px; height: 15px; text-align: left; font-size: 10px; font-weight: bold; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\">".$row["item_name"]."</td>
			      <td style=\"width: 82.2px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$quan_unit[1]."</td>
			      <td colspan=\"2\" style=\"width: 57.6px; height: 15px; text-align: center; font-size: 10px; font-weight: bold; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid;border-right-color: rgb(0, 0, 0); border-right-width: 2px; border-right-style: solid;\">".$row["main_stocks"]."</td>
			    </tr>";
			    $rows_occupied++;
			    $total_amount+=((float)$row["unit_cost"] * (float)$row["main_stocks"]);
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
		"date_inspected"=>$date_inspected,
		"inspector"=>$inspector,
		"inspected"=>$inspected,
		"date_received"=>$date_received,
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

function get_iar_details(){
	global $conn;

	$iar_number = mysqli_real_escape_string($conn, "5467");
	$entity_name="";$fund_cluster="";$po_number="";$req_office="";$res_cc="";$charge_invoice="";$date_inspected="";$inspector="";$date_received="";$end_user="";$supplier="";$spvs = ""; $spvs_designation = "";
	$table = "";
	$sql = mysqli_query($conn, "SELECT p.po_id, i.entity_name, i.fund_cluster, i.po_number, i.req_office, i.res_cc, i.charge_invoice, i.date_inspected, i.inspector, i.date_received, i.spvs, i.spvs_designation, p.end_user, p.date_conformed, p.date_delivered, p.item_name, p.description, p.quantity, p.unit_cost, p.inspection_status, p.main_stocks, p.exp_date, s.supplier, p.activity_title FROM tbl_iar AS i, tbl_po AS p, ref_supplier AS s WHERE i.iar_number LIKE '$iar_number' AND i.iar_number = p.iar_no AND s.supplier_id = p.supplier_id");
	while($row = mysqli_fetch_assoc($sql)){
		$entity_name = $row["entity_name"];$fund_cluster = $row["fund_cluster"];$po_number = $row["po_number"];$req_office = $row["req_office"];$res_cc = $row["res_cc"];
		$charge_invoice = $row["charge_invoice"];$date_inspected = $row["date_inspected"];$inspector = $row["inspector"];$date_received = $row["date_received"];
		$end_user = $row["end_user"];$supplier = $row["supplier"];$spvs = $row["spvs"];$spvs_designation = $row["spvs_designation"];
		$unit = (explode(" ", $row["quantity"]))[1];
		$table.="<tr>
					<td>".$row["po_id"]."</td>
					<td>".$row["date_delivered"]."</td>
					<td>".$row["item_name"]."</td>
					<td>".$row["description"]."</td>
					<td><input type=\"text\" value=\"".$row["exp_date"]."\" onfocus=\"(this.type='date')\" onblur=\"(this.type='text')\"></td>
					<td><input type=\"text\" value=\"".$row["activity_title"]."\"></td>
					<td>".$row["main_stocks"]." ".$unit."</td>
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
		"spvs"=>$spvs,
		"spvs_designation"=>$spvs_designation,
		"table"=>$table
	));
}

print_iar_gen();
//get_iar_details();

?>