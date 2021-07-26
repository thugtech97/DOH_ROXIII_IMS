<?php

require "php_conn.php";
require "php_general_functions.php";

function get_idr(){
	global $conn;

	$from = mysqli_real_escape_string($conn, $_POST["from"]);
	$to = mysqli_real_escape_string($conn, $_POST["to"]);
	$end = false;
	$tbody = "";

	$sub_total = 0.00; $grand_total = 0.00;

	$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	$dates = array();

	while(!$end) {
		array_push($dates, $from);
		if($from == $to) {
			$end = true;
			break;
		}
		$from_arr = explode("-", $from);
		if(((int)$from_arr[1]) < 12) {
			$from = $from_arr[0]."-".str_pad(((int)$from_arr[1]) + 1, 2, '0', STR_PAD_LEFT);
		}else{
			$from = (((int)$from_arr[0]) + 1 )."-01";
		}
	}
	foreach ($dates as $date) {
		$sql = mysqli_query($conn, "SELECT p.date_delivered, p.end_user, p.po_number, s.supplier, p.item_name, p.description, p.main_stocks, p.unit_cost FROM tbl_po AS p, ref_supplier AS s WHERE p.supplier_id = s.supplier_id AND p.date_delivered LIKE '%$date%' AND p.status = 'Delivered' ORDER BY p.date_delivered ASC");
		while($row = mysqli_fetch_assoc($sql)){
			$tbody.="<tr>
				      <td style=\"width: 32.4px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
				      <td style=\"width: 72.6px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["date_delivered"]."</td>
				      <td style=\"width: 59.4px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["end_user"]."</td>
				      <td style=\"width: 105px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["po_number"]."</td>
				      <td style=\"width: 96.6px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["supplier"]."</td>
				      <td style=\"width: 294.6px; text-align: left; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"><b>".$row["item_name"]."</b> - ".$row["description"]."</td>
				      <td style=\"width: 119.4px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format((float)$row["main_stocks"] * (float)$row["unit_cost"], 2)."</td>
				    </tr>";
				    $sub_total+=((float)$row["main_stocks"] * (float)$row["unit_cost"]);
		}
		$date_arr = explode("-", $date);
		$tbody.="<tr>
				      <td colspan=\"2\" style=\"width: 32.4px; height: 18px; text-align: center; font-size: 9px; font-weight: bold; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-bottom-width: 1px; border-left-width: 1px; border-bottom-style: solid; border-left-style: solid; background-color: rgb(255, 255, 0);border-right-color: rgb(0, 0, 0);border-right-width: 1px;border-right-style: solid;\">".strtoupper($months[(int)$date_arr[1] - 1])." ".$date_arr[0]."</td>
				      <td style=\"width: 59.4px; height: 18px; text-align: center; font-size: 9px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; background-color: rgb(255, 255, 0);\"></td>
				      <td style=\"width: 105px; height: 18px; text-align: center; font-size: 9px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; background-color: rgb(255, 255, 0);\"></td>
				      <td style=\"width: 96.6px; height: 18px; text-align: center; font-size: 9px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; background-color: rgb(255, 255, 0);\"></td>
				      <td style=\"width: 294.6px; height: 18px; text-align: left; font-size: 9px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; background-color: rgb(255, 255, 0);\">SUB - TOTAL P</td>
				      <td style=\"width: 119.4px; height: 18px; text-align: center; font-size: 9px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; background-color: rgb(255, 255, 0);\">".number_format($sub_total, 2)."</td>
				    </tr>";
				    $grand_total+=$sub_total;
				    $sub_total = 0.00;
	}
	echo json_encode(array("tbody"=>$tbody, "grand_total"=>number_format($grand_total,2)));
}

function get_rpci(){
	global $conn;

	$sql = mysqli_query($conn, "SELECT category, CASE WHEN category = 'Drugs and Medicines' THEN 1 WHEN category = 'Medical Supplies' THEN 2 ELSE 3 END AS category_order FROM ref_category ORDER BY category_order ASC");
	$tbody = "";
	$grand_total = 0.00;
	while($row = mysqli_fetch_assoc($sql)){
		$category = $row["category"];
		$tbody.="<tr>
          <td colspan=\"11\" style=\"width: 54.6px; height: 19.5px; text-align: center; font-size: 11px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; background-color: rgb(255, 255, 0);\">".strtoupper($category)."</td>
        </tr>";
		$sub_total = 0.00;
		$sql2 = mysqli_query($conn, "SELECT p.po_id, p.end_user, p.po_number, p.item_name, s.supplier, p.date_delivered, p.description, p.quantity, p.unit_cost FROM tbl_po AS p, ref_supplier AS s WHERE p.supplier_id = s.supplier_id AND p.category = '$category' AND (p.status = 'Delivered' OR p.status = '') ORDER BY p.end_user ASC");
		if(mysqli_num_rows($sql2) != 0){
			while($row2 = mysqli_fetch_assoc($sql2)){
				$quantity_unit = explode(" ", $row2["quantity"]);
				$total_amount = (float)$quantity_unit[0] * (float)$row2["unit_cost"];
				$sub_total+=$total_amount;
				if($quantity_unit[0] != "0"){
					$qi = "q".$row2["po_id"];
					$vi = "v".$row2["po_id"];
					$tbody.="<tr>
				          <td style=\"width: 54.6px; height: 15px; font-size: 11px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-left-width: 2px; border-right-style: solid; border-left-style: solid;border-bottom-width: 1px;border-bottom-color: rgb(0, 0, 0);border-bottom-style: solid;\"></td>
				          <td style=\"width: 258.6px; height: 15px; text-align: left; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"><b>".$row2["item_name"]."</b> - ".$row2["description"]."</td>
				          <td style=\"width: 56.4px; height: 15px; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				          <td style=\"width: 64.2px; height: 15px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$quantity_unit[1]."</td>
				          <td style=\"width: 64.2px; height: 15px; text-align: right; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format((float)$row2["unit_cost"],2)."</td>
				          <td style=\"width: 94.2px; height: 15px; text-align: right; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format((float)$total_amount,2)."</td>
				          <td style=\"width: 62.4px; height: 15px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format($quantity_unit[0],0)."</td>
				          <td style=\"width: 57.6px; height: 15px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"><input type=\"number\" onchange=\"this.setAttribute('value', this.value)\" style=\"border: none transparent;outline: none; text-align: center;\" onblur=\"compute_shortage('".$quantity_unit[0]."','".$row2["unit_cost"]."',this.value,'".$qi."','".$vi."')\"></td>
				          <td style=\"width: 44.4px; height: 15px; font-size: 9px; vertical-align: center; text-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"><span id=\"".$qi."\"></span></td>
				          <td style=\"width: 48px; height: 15px; font-size: 9px; vertical-align: center; text-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"><span id=\"".$vi."\"></span></td>
				          <td style=\"width: 84px; height: 15px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
				        </tr>";
				}
			}
		}else{
			$tbody.="<tr>
				          <td style=\"width: 54.6px; height: 15px; font-size: 11px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-left-width: 2px; border-right-style: solid; border-left-style: solid;border-bottom-width: 1px;border-bottom-color: rgb(0, 0, 0);border-bottom-style: solid;\">-</td>
				          <td style=\"width: 258.6px; height: 15px; text-align: left; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
				          <td style=\"width: 56.4px; height: 15px; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
				          <td style=\"width: 64.2px; height: 15px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
				          <td style=\"width: 64.2px; height: 15px; text-align: right; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
				          <td style=\"width: 94.2px; height: 15px; text-align: right; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
				          <td style=\"width: 62.4px; height: 15px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
				          <td style=\"width: 57.6px; height: 15px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
				          <td style=\"width: 44.4px; height: 15px; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
				          <td style=\"width: 48px; height: 15px; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
				          <td style=\"width: 84px; height: 15px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
				        </tr>";
		}
		$tbody.="<tr>
		          <td colspan=\"5\" style=\"width: 54.6px; height: 18.75px; text-align: right; font-size: 10px; font-weight: bold; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; background-color: rgb(255, 255, 0);\">Sub - Total</td>
		          <td style=\"width: 94.2px; height: 18.75px; text-align: right; font-size: 9px; font-weight: bold; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; background-color: rgb(255, 255, 0);\">".number_format((float)$sub_total, 2)."</td>
		          <td style=\"width: 62.4px; height: 18.75px; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; background-color: rgb(255, 255, 0);\"></td>
		          <td style=\"width: 57.6px; height: 18.75px; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; background-color: rgb(255, 255, 0);\"></td>
		          <td style=\"width: 44.4px; height: 18.75px; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; background-color: rgb(255, 255, 0);\"></td>
		          <td colspan=\"2\" style=\"width: 48px; height: 18.75px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; background-color: rgb(255, 255, 0);\"></td>
		        </tr>";
		        $grand_total+=$sub_total;
	}
	echo json_encode(array("tbody"=>$tbody, "grand_total"=>number_format((float)$grand_total, 2))); 
}


function print_wi(){
	global $conn;

	$sql = mysqli_query($conn, "SELECT category, CASE WHEN category = 'Drugs and Medicines' THEN 1 WHEN category = 'Medical Supplies' THEN 2 ELSE 3 END AS category_order FROM ref_category ORDER BY category_order ASC");
	$tbody = "";
	$grand_total = 0.00;
	$filter = mysqli_real_escape_string($conn, $_POST["filter"]);
	while($row = mysqli_fetch_assoc($sql)){
		$category = $row["category"];
		$sub_total = 0.00;
		$sql2 = mysqli_query($conn, "SELECT p.end_user, p.po_number, p.item_name, s.supplier, p.date_delivered, p.description, p.quantity, p.sn_ln, p.exp_date, p.unit_cost FROM tbl_po AS p, ref_supplier AS s WHERE p.end_user LIKE '%$filter%' AND p.supplier_id = s.supplier_id AND p.category = '$category' AND (p.status = 'Delivered' OR p.status = '') ORDER BY p.end_user ASC");
		if(mysqli_num_rows($sql2) != 0){
			while($row2 = mysqli_fetch_assoc($sql2)){
				$quantity_unit = explode(" ", $row2["quantity"]);
				$total_amount = (float)$quantity_unit[0] * (float)$row2["unit_cost"];
				$sn_ln = ($category != "Drugs and Medicines" && $category != "Medical Supplies") ? "" : explode("|", $row2["sn_ln"])[0];
				$exp_date = ($category != "Drugs and Medicines" && $category != "Medical Supplies") ? "" : $row2["exp_date"];
				$sub_total+=$total_amount;
				if($quantity_unit[0] != "0"){
					$tbody.="<tr>
		            <td style=\"width: 61.2px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\">".$row2["end_user"]."</td>
		            <td style=\"width: 56.4px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row2["po_number"]."</td>
		            <td style=\"width: 73.8px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row2["supplier"]."</td>
		            <td style=\"width: 56.4px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row2["date_delivered"]."</td>
		            <td style=\"width: 204.6px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"><b>".$row2["item_name"]."</b> - ".$row2["description"]."</td>
		            <td style=\"width: 59.4px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$sn_ln."</td>
		            <td style=\"width: 53.4px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$exp_date."</td>
		            <td style=\"width: 54px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format($quantity_unit[0],0)."</td>
		            <td style=\"width: 41.4px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$quantity_unit[1]."</td>
		            <td style=\"width: 48.6px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format((float)$row2["unit_cost"], 2)."</td>
		            <td style=\"width: 73.8px; text-align: right; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format($total_amount, 2)."</td>
		            <td style=\"width: 51.6px; text-align: center; font-size: 9px; font-weight: bold; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		          </tr>";
				}
			}
		}else{
			$tbody.="<tr>
		            <td style=\"width: 61.2px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\">-</td>
		            <td style=\"width: 56.4px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
		            <td style=\"width: 73.8px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
		            <td style=\"width: 56.4px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
		            <td style=\"width: 204.6px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
		            <td style=\"width: 59.4px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
		            <td style=\"width: 53.4px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
		            <td style=\"width: 54px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
		            <td style=\"width: 41.4px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
		            <td style=\"width: 48.6px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
		            <td style=\"width: 73.8px; text-align: right; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
		            <td style=\"width: 51.6px; text-align: center; font-size: 9px; font-weight: bold; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">-</td>
		          </tr>";
		}
		$tbody.="<tr>
		      <td colspan=\"3\" style=\"width: 61.2px; text-align: left; font-size: 8px; font-weight: bold; vertical-align: center; border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-bottom-width: 1px; border-left-width: 1px; border-bottom-style: solid; border-left-style: solid; background-color: rgb(255, 255, 0);\">Category: ".$category."</td>
		      <td style=\"width: 56.4px; text-align: center; font-size: 8px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; background-color: rgb(255, 255, 0);\"></td>
		      <td style=\"width: 204.6px; text-align: center; font-size: 8px; font-weight: bold; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; background-color: rgb(255, 255, 0);\"></td>
		      <td style=\"width: 59.4px; text-align: center; font-size: 8px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; background-color: rgb(255, 255, 0);\"></td>
		      <td style=\"width: 53.4px; text-align: center; font-size: 8px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; background-color: rgb(255, 255, 0);\"></td>
		      <td style=\"width: 54px; text-align: center; font-size: 8px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; background-color: rgb(255, 255, 0);\"></td>
		      <td colspan=\"2\" style=\"width: 41.4px; text-align: center; font-size: 9px; font-weight: bold; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; background-color: rgb(255, 255, 0);\">SUB - TOTAL</td>
		      <td style=\"width: 73.8px; text-align: right; font-size: 9px; font-weight: bold; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; background-color: rgb(255, 255, 0);\">".number_format((float)$sub_total, 2)."</td>
		      <td style=\"width: 51.6px; font-size: 8px; font-weight: bold; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; background-color: rgb(255, 255, 0);\"></td>
		    </tr>";
		    $grand_total+=$sub_total;
	}
	echo json_encode(array("tbody"=>$tbody, "grand_total"=>number_format((float)$grand_total, 2)));
}

function get_rsmi_details(){
	global $conn;

	$year_month = mysqli_real_escape_string($conn, $_POST["year_month"]);
	mysqli_query($conn, "TRUNCATE tbl_rsmi");
	$tbody = ""; $total_rsmi = 0.00;
	$sql = mysqli_query($conn, "SELECT tbl_ris.date,ris_no,item,description,rcc,category,quantity,unit,unit_cost,requested_by,remarks FROM tbl_ris WHERE tbl_ris.date LIKE '%".$year_month."%'");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date"];
		$ris_no = $row["ris_no"];
		$description = mysqli_real_escape_string($conn, $row["description"]);
		$rcc = $row["rcc"];
		$unit = $row["unit"];
		$quantity = $row["quantity"];
		$category = $row["category"];
		$account_code = get_account_code("RIS", $category, 0);
		$requested_by = $row["requested_by"];
		$unit_cost = $row["unit_cost"];
		mysqli_query($conn, "INSERT INTO tbl_rsmi(date_released,control_no,item,unit,quantity,recipients,unit_cost,account_code,rcc) VALUES('$date_released','$ris_no','$description','$unit','$quantity','$requested_by','$unit_cost','$account_code','$rcc')");
	}
	$sql = mysqli_query($conn, "SELECT SUBSTRING(date_released,1,10) AS date_r,control_no,rcc,account_code,item,unit,quantity,recipients,unit_cost FROM tbl_rsmi ORDER BY date_released ASC");
	while($row = mysqli_fetch_assoc($sql)){
		$tbody .= "<tr>
		      <td style=\"width: 61.8px; height: 16px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\">".$row["date_r"]."</td>
		      <td style=\"width: 63px; height: 16px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["control_no"]."</td>
		      <td style=\"width: 49.8px; height: 16px; text-align: center;font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["rcc"]."</td>
		      <td style=\"width: 48px; height: 18px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["account_code"]."</td>
		      <td style=\"width: 190.2px; height: 16px; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["item"]."</td>
		      <td style=\"width: 52.2px; height: 16px; text-align: center;font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["unit"]."</td>
		      <td style=\"width: 46.8px; height: 16px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["quantity"]."</td>
		      <td style=\"width: 118.8px; height: 16px; text-align: center;font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["recipients"]."</td>
		      <td style=\"width: 103.2px; height: 16px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format((float)$row["unit_cost"], 2)."</td>
		      <td style=\"width: 62.4px; height: 16px; text-align: center;font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format((float)$row["quantity"] * (float)$row["unit_cost"], 2)."</td>
		    </tr>";
		    $total_rsmi+=((float)$row["quantity"] * (float)$row["unit_cost"]);
	}
	$tbody .= "<tr>
		      <td style=\"width: 61.8px; height: 16px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 2px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
		      <td style=\"width: 63px; height: 16px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		      <td style=\"width: 49.8px; height: 16px; text-align: center;font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		      <td style=\"width: 48px; height: 18px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		      <td style=\"width: 190.2px; height: 16px; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		      <td style=\"width: 52.2px; height: 16px; text-align: center;font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		      <td style=\"width: 46.8px; height: 16px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		      <td style=\"width: 118.8px; height: 16px; text-align: center;font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
		      <td style=\"width: 103.2px; height: 16px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"><b>TOTAL</b></td>
		      <td style=\"width: 62.4px; height: 16px; text-align: center;font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 2px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"><b>₱ ".number_format((float)$total_rsmi, 2)."</b></td>
		    </tr>";

	echo $tbody;
}

function get_ppe_details(){
	global $conn;

	mysqli_query($conn, "TRUNCATE tbl_ppe");
	$year_month = mysqli_real_escape_string($conn, $_POST["year_month"]);
	$tbody = "";
	$sql = mysqli_query($conn, "SELECT date_released,item,category,ics_no,quantity,unit,cost,total,received_by,remarks FROM tbl_ics WHERE date_released LIKE '%$year_month%'");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date_released"];
		$item = mysqli_real_escape_string($conn, $row["item"]);
		$reference_no = $row["ics_no"];
		$quantity = $row["quantity"];
		$unit = $row["unit"];
		$cost = $row["cost"];
		$total = $row["total"];
		$category = $row["category"];
		$account_code = ($cost < 15000) ? get_account_code("ICS", $category, 0) : get_account_code("ICS" ,$category, 1);
		$received_by = $row["received_by"];
		$remarks = $row["remarks"];
		mysqli_query($conn, "INSERT INTO tbl_ppe(tbl_ppe.date,particular,par_ptr_reference,qty,unit,unit_cost,total_cost,type,received_by,remarks,account_code) VALUES('$date_released','$item','$reference_no','$quantity','$unit','$cost','$total','ics','$received_by','$remarks','$account_code')");
	}
	
	$sql = mysqli_query($conn, "SELECT date_released,item,category,par_no,quantity,unit,cost,total,received_by,remarks FROM tbl_par WHERE date_released LIKE '%$year_month%'");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date_released"];
		$item = mysqli_real_escape_string($conn, $row["item"]);
		$reference_no = $row["par_no"];
		$quantity = $row["quantity"];
		$unit = $row["unit"];
		$cost = $row["cost"];
		$total = $row["total"];
		$category = $row["category"];
		$account_code = ($cost < 15000) ? get_account_code("PAR", $category, 0) : get_account_code("PAR", $category, 1);
		$received_by = $row["received_by"];
		$remarks = $row["remarks"];
		mysqli_query($conn, "INSERT INTO tbl_ppe(tbl_ppe.date,particular,par_ptr_reference,qty,unit,unit_cost,total_cost,type,received_by,remarks,account_code) VALUES('$date_released','$item','$reference_no','$quantity','$unit','$cost','$total','par','$received_by','$remarks','$account_code')");
	}
	/*
	$sql = mysqli_query($conn, "SELECT tbl_ris.date,item,reference_no,quantity,unit,unit_cost,total,requested_by,remarks FROM tbl_ris WHERE tbl_ris.date LIKE '%$year_month%' AND (category != 'Drugs and Medicines' AND category != 'Medical Supplies')");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date"];
		$item = $row["item"];
		$reference_no = $row["reference_no"];
		$quantity = $row["quantity"];
		$unit = $row["unit"];
		$cost = $row["unit_cost"];
		$total = $row["total"];
		$received_by = $row["requested_by"];
		$remarks = $row["remarks"];
		mysqli_query($conn, "INSERT INTO tbl_ppe(tbl_ppe.date,particular,par_ptr_reference,qty,unit,unit_cost,total_cost,type,received_by,remarks) VALUES('$date_released','$item','$reference_no','$quantity','$unit','$cost','$total','ris','$received_by','$remarks')");
	}
	*/
	$sql = mysqli_query($conn, "SELECT date_released,item,category,ptr_no,quantity,unit,cost,total,tbl_ptr.to,remarks FROM tbl_ptr WHERE date_released LIKE '%$year_month%' /*AND (category != 'Drugs and Medicines' AND category != 'Medical Supplies')*/");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date_released"];
		$item = mysqli_real_escape_string($conn, $row["item"]);
		$reference_no = $row["ptr_no"];
		$quantity = $row["quantity"];
		$unit = $row["unit"];
		$cost = $row["cost"];
		$total = $row["total"];
		$category = $row["category"];
		$account_code = ($cost < 15000) ? get_account_code("PTR", $category, 0) : get_account_code("PTR", $category, 1);
		$to = $row["to"];
		$remarks = $row["remarks"];
		mysqli_query($conn, "INSERT INTO tbl_ppe(tbl_ppe.date,particular,par_ptr_reference,qty,unit,unit_cost,total_cost,type,received_by,remarks,account_code) VALUES('$date_released','$item','$reference_no','$quantity','$unit','$cost','$total','ptr','$to','$remarks','$account_code')");
	}
	$sql = mysqli_query($conn, "SELECT SUBSTRING(tbl_ppe.date, 1, 10) AS date_r, particular,par_ptr_reference,qty,unit,unit_cost,total_cost,type,received_by,remarks,account_code FROM tbl_ppe ORDER BY tbl_ppe.date ASC");
	$ics_total = 0.00;
	$par_total = 0.00;
	$ptr_total = 0.00;
	$overall = 0.00;
	while($row = mysqli_fetch_assoc($sql)){
	 	$tbody.="<tr style=\"font-size: 9px;\">
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".$row["date_r"]."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".$row["particular"]."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".$row["par_ptr_reference"]."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".$row["qty"]."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".$row["unit"]."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".number_format((float)$row["unit_cost"], 2)."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".number_format((float)$row["total_cost"], 2)."</td>
                    <td class=\"acc_code\" style=\"padding-left: 10px; padding-right: 10px;\">".$row["account_code"]."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".(($row["type"] == "ptr") ? number_format((float)$row["total_cost"], 2) : "")."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".(($row["type"] == "par") ? number_format((float)$row["total_cost"], 2) : "")."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".(($row["type"] == "ics") ? number_format((float)$row["total_cost"], 2) : "")."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".$row["received_by"]."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".$row["remarks"]."</td>
                </tr>";
                $overall+=(float)$row["total_cost"];
                $ics_total+=(($row["type"] == "ics") ? (float)$row["total_cost"] : 0.00);
                $par_total+=(($row["type"] == "par") ? (float)$row["total_cost"] : 0.00);
                $ptr_total+=(($row["type"] == "ptr") ? (float)$row["total_cost"] : 0.00);
	}
	$tbody.="<tr style=\"font-size: 9px;\">
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\">-</td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\">-</td>
                <td style=\"padding-left: 10px; padding-right: 10px;\">-</td>
                <td style=\"padding-left: 10px; padding-right: 10px;\">-</td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
            </tr>
			<tr style=\"font-size: 9px;\">
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"><b>".number_format((float)$overall, 2)."</b></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"><b>".number_format((float)$ptr_total, 2)."</b></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"><b>".number_format((float)$par_total, 2)."</b></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"><b>".number_format((float)$ics_total, 2)."</b></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
            </tr>";

	echo $tbody;
}

function get_item(){
	global $conn;

	$category = mysqli_real_escape_string($conn, $_POST["category"]);
	$searchkw = mysqli_real_escape_string($conn, $_POST["searchkw"]);
	$sql = mysqli_query($conn, "SELECT DISTINCT description, item_name FROM tbl_po WHERE category = '$category' ORDER BY item_name ASC");
	$list_items = "";
	$num_items = mysqli_num_rows($sql);
	if($num_items != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$list_items.="<ol class=\"dd-list\">
                    <li class=\"dd-item\">
                        <div data-desc=\"".$row["description"]."\" class=\"dd-handle\"><b>".$row["item_name"]."</b> ➜ ".$row["description"]."</div>
                    </li>
                </ol>";
		}
	}
	echo json_encode(array("list_items"=>$list_items, "num_items"=>$num_items));
}

function print_stock_card(){
	global $conn; $rows = 0;
	$sc_drugs = "";
	$qty_balance = 0;
	$item_name = mysqli_real_escape_string($conn, $_POST["item_name"]);
	$item_desc = mysqli_real_escape_string($conn, $_POST["item_desc"]);
	$spec = mysqli_real_escape_string($conn, $_POST["spec"]);

	$is_issued = ($spec == "") ? "" : " AND issued = '".$spec."'";

	mysqli_query($conn, "TRUNCATE tbl_stockcard");
	$rows+=round((float)strlen($item_desc) / 47.00);

	$sql = mysqli_query($conn, "SELECT s.supplier, p.date_received, p.date_delivered, p.po_number, p.main_stocks FROM tbl_po AS p, ref_supplier AS s WHERE p.item_name LIKE '$item_name' AND p.description LIKE '$item_desc' AND p.supplier_id = s.supplier_id");
	while($row = mysqli_fetch_assoc($sql)){
		$date_received = ($row["date_delivered"] != "0000-00-00") ? $row["date_delivered"] : $row["date_received"];
		$reference_no = $row["po_number"];
		$main_stocks = $row["main_stocks"];
		$supplier = $row["supplier"];
		mysqli_query($conn, "INSERT INTO tbl_stockcard(tbl_stockcard.date,quantity,reference_no,office,remarks,status) VALUES('$date_received','$main_stocks','$reference_no','$supplier','','IN')");
	}
	$sql = mysqli_query($conn, "SELECT issued,date_released,ics_no,quantity,received_by,remarks FROM tbl_ics WHERE item LIKE '$item_name' AND description LIKE '$item_desc'".$is_issued."");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date_released"];
		$reference_no = $row["ics_no"];
		$quantity = $row["quantity"];
		$area = $row["received_by"];
		$remarks = $row["issued"];
		mysqli_query($conn, "INSERT INTO tbl_stockcard(tbl_stockcard.date,quantity,reference_no,office,remarks,status) VALUES('$date_released','$quantity','$reference_no','$area','$remarks','OUT')");
	}

	$sql = mysqli_query($conn, "SELECT issued,date_released,par_no,quantity,received_by,remarks FROM tbl_par WHERE item LIKE '$item_name' AND description LIKE '$item_desc'".$is_issued."");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date_released"];
		$reference_no = $row["par_no"];
		$quantity = $row["quantity"];
		$area = $row["received_by"];
		$remarks = $row["issued"];
		mysqli_query($conn, "INSERT INTO tbl_stockcard(tbl_stockcard.date,quantity,reference_no,office,remarks,status) VALUES('$date_released','$quantity','$reference_no','$area','$remarks','OUT')");
	}
	
	$sql = mysqli_query($conn, "SELECT issued,tbl_ris.date,ris_no,quantity,requested_by,remarks FROM tbl_ris WHERE item LIKE '$item_name' AND description LIKE '$item_desc'".$is_issued."");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date"];
		$reference_no = $row["ris_no"];
		$quantity = $row["quantity"];
		$area = $row["requested_by"];
		$remarks = $row["issued"];
		mysqli_query($conn, "INSERT INTO tbl_stockcard(tbl_stockcard.date,quantity,reference_no,office,remarks,status) VALUES('$date_released','$quantity','$reference_no','$area','$remarks','OUT')");
	}
	
	$sql = mysqli_query($conn, "SELECT issued,date_released,ptr_no,quantity,tbl_ptr.to,remarks FROM tbl_ptr WHERE item = '$item_name' AND description LIKE '$item_desc'".$is_issued."");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date_released"];
		$reference_no = $row["ptr_no"];
		$quantity = $row["quantity"];
		$area = $row["to"];
		$remarks = $row["issued"];
		mysqli_query($conn, "INSERT INTO tbl_stockcard(tbl_stockcard.date,quantity,reference_no,office,remarks,status) VALUES('$date_released','$quantity','$reference_no','$area','$remarks','OUT')");
	}

	$read_sql = mysqli_query($conn, "SELECT SUBSTRING(tbl_stockcard.date, 1, 10) AS date_r,quantity,reference_no,office,remarks,status FROM tbl_stockcard ORDER BY tbl_stockcard.date ASC");
	while($row = mysqli_fetch_assoc($read_sql)){
		$remarks = ($row["remarks"] == "1") ? "✔️" : "❌";
		if($row["status"] == "IN"){
			$qty_balance+=(int)$row["quantity"];
			$sc_drugs.="<tr>
		      <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["date_r"]."</td>
		      <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["reference_no"]."</td>
		      <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["quantity"]."</td>
		      <td style=\"font-size: 10px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["office"]."</td>
		      <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$qty_balance."</td>
		      <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		    </tr>";
		}
		if($row["status"] == "OUT"){
			$qty_balance-=(int)$row["quantity"];
			$sc_drugs.="<tr>
		      <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["date_r"]."</td>
		      <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["reference_no"]."</td>
		      <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["quantity"]."</td>
		      <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["office"]."</td>
		      <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$qty_balance."</td>
		      <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$remarks."</td>
		    </tr>";
		}
		$rows++;
	}
	for($i = 0; $i < (45 - $rows); $i++){
		$sc_drugs.="<tr>
		      <td style=\"font-size:12px; text-align: center; height: 12px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"><span style=\"visibility: hidden;\">LALA</span></td>
		      <td style=\"font-size:8px; text-align: center; height: 12px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 12px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 12px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 12px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 12px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 12px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 12px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		    </tr>";
	}
	echo json_encode(array("sc_drugs"=>$sc_drugs));
}

$call_func = mysqli_real_escape_string($conn, $_POST["call_func"]);
switch($call_func){
	case "print_stock_card":
		print_stock_card();
		break;
	case "get_item":
		get_item();
		break;
	case "get_ppe_details":
		get_ppe_details();	
		break;
	case "get_rsmi_details":
		get_rsmi_details();
		break;
	case "print_wi":
		print_wi();
		break;
	case "get_rpci":
		get_rpci();
		break;
	case "get_idr":
		get_idr();
		break;
}

?>