<?php

require "../../php/php_conn.php";
require "../../php/php_general_functions.php";

session_start();

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
	$total_cost = 0.00;
	$rows_limit = 45; $rows_occupied = 0;
	$par_no = mysqli_real_escape_string($conn, $_POST["par_no"]);
	$sql = mysqli_query($conn, "SELECT quantity, unit, description, serial_no, property_no, cost, total, received_from, received_from_designation, received_by, received_by_designation, SUBSTRING(date_released, 1, 10) AS date_r, reference_no, supplier FROM tbl_par WHERE par_no LIKE '$par_no'");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$received_from = utf8_encode($row["received_from"]); $received_by = utf8_encode($row["received_by"]);
			$received_from_designation = utf8_encode($row["received_from_designation"]); $received_by_designation = utf8_encode($row["received_by_designation"]);
			$date_released = $row["date_r"]; $supplier = $row["supplier"]; $reference_no = $row["reference_no"];
			$total_cost += (float)($row["cost"] * $row["quantity"]);
			$pn = explode(",", $row["property_no"]);
			$par_tbody .= "<tr id=\"1\">
			  	      <td style=\"width: 75.6px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\">".$row["quantity"]."</td>
			  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["unit"]."</td>
			  	      <td style=\"width: 61.8px; height: 14.5px; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["description"]."</td>
			  	      <td style=\"width: 62.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".((count($pn) >= 1 && $row["serial_no"] == null) ? $pn[0] : "")."</td>
			  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			  	      <td style=\"width: 85.2px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format((float)$row["cost"], 2)."</td>
			  	      <td style=\"width: 86.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format((float)($row["cost"] * $row["quantity"]), 2)."</td>
			      </tr>";
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
		$the_rest = array("*Nothing Follows*", "", "PO No. ".$reference_no, $supplier, "", "", "", "", "", "", "", "", "", "Approved by:", "", "<center><b>JOSE R. LLACUNA,JR.,MD,MPH,CESO III</b></center>", "<center>Director IV</center>");
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
			$rows_occupied++;
		}
		for($i = 0; $i < ($rows_limit - $rows_occupied); $i++){
			$par_tbody .= "<tr>
			  	      <td style=\"width: 75.6px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
			  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			  	      <td style=\"width: 61.8px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			  	      <td style=\"width: 62.4px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			  	      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			  	      <td style=\"width: 85.2px; height: 14.5px; text-align: left; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			  	      <td style=\"width: 86.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
			      </tr>";
		}
		$received_by = get_complete_name($received_by);
		echo json_encode(array("par_tbody"=>$par_tbody, "total_cost"=>number_format((float)$total_cost,2), "receivers"=>array($received_from, $received_from_designation, $received_by, $received_by_designation, _m_d_yyyy_($date_released))));
	}
}

function get_par(){
	global $conn;
	
	$sql = mysqli_query($conn, "SELECT DISTINCT par_no, area, category, SUBSTRING(date_released, 1, 10) AS date_r, received_from, received_by, SUBSTRING(date_supply_received, 1, 10) AS date_s, remarks, issued, reference_no FROM tbl_par ORDER BY par_id DESC");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$parn = $row["par_no"];
			echo "<tr>
					<td><center>".(($row["issued"] == '0') ? "<button id=\"".$row["reference_no"]."\" value=\"".$row["par_no"]."\" onclick=\"to_issue(this.value, this.id);\" class=\"btn btn-xs btn-danger\" style=\"border-radius: 10px;\">✖</button>" : "<button class=\"btn btn-xs\" style=\"border-radius: 10px; background-color: #00FF00; color: white; font-weight: bold;\" disabled>✓</button>")."</center></td>
					<td>".$row["area"]."</td>
					<td>".$row["par_no"]."</td>
					<td>".$row["reference_no"]."</td>
					<td>".$row["category"]."</td>
					<td>".$row["date_r"]."</td>
					<td>".utf8_encode($row["received_from"])."</td>
					<td>".utf8_encode($row["received_by"])."</td>
					<td>".$row["date_s"]."</td>
					<td>".$row["remarks"]."</td>
					<td><center><button class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\" onclick=\"modify('".$parn."');\"><i class=\"fa fa-pencil-square-o\"></i></button>&nbsp;<button class=\"btn btn-xs btn-success\" value=\"".$row["par_no"]."\" onclick=\"print_par(this.value);\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Print\"><i class=\"fa fa-print\"></i></button>&nbsp;<button class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\"><i class=\"fa fa-trash\" onclick=\"delete_control('".$parn."');\"></i></button>&nbsp;<button class=\"btn btn-xs btn-warning\" onclick=\"download_xls('".$parn."');\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Save as Excel\"><i class=\"fa fa-file-excel-o\"></i></button></center></td>
				</tr>";
		}
	}
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
	$received_from_designation = mysqli_fetch_assoc($quer1)["designation"];
	$received_by_designation = mysqli_fetch_assoc($quer2)["designation"];

	$supplier = mysqli_fetch_assoc($query)["supplier"];
	for($i = 0; $i < count($items); $i++){
		$item_id = $items[$i][0];
		$item = $items[$i][1];
		$description = $items[$i][2];
		$serial_no = $items[$i][3];
		$category = $items[$i][4];
		$property_no = $items[$i][5];
		$quantity = $items[$i][6];
		$unit = $items[$i][7];
		$cost = $items[$i][8];
		$total = $items[$i][9];
		$remarks = $items[$i][10];
		mysqli_query($conn, "INSERT INTO tbl_par(par_no, entity_name, fund_cluster, reference_no, item, description, unit, supplier, serial_no, category, property_no, quantity, cost, total, remarks, received_from, received_from_designation, received_by, received_by_designation, date_released, area) VALUES ('$par_no', '$entity_name', '$fund_cluster', '$reference_no', '$item', '$description', '$unit', '$supplier', '$serial_no', '$category', '$property_no', '$quantity', '$cost', '$total', '$remarks', '$received_from', '$received_from_designation', '$received_by', '$received_by_designation', '$date_released', '$area')");
		$query_get_stocks = mysqli_query($conn, "SELECT quantity FROM tbl_po WHERE po_number = '$reference_no' AND po_id = '$item_id'");
		$rstocks = explode(" ", mysqli_fetch_assoc($query_get_stocks)["quantity"]);
		$newrstocks = ((int)$rstocks[0] - (int)$quantity)." ".$rstocks[1];
		mysqli_query($conn, "UPDATE tbl_po SET quantity = '$newrstocks' WHERE po_number = '$reference_no' AND po_id = '$item_id'");
		$serials = explode(",", $serial_no);
		for($j = 0; $j < count($serials); $j++){
			$sn = $serials[$j];
			mysqli_query($conn, "UPDATE tbl_serial SET is_issued = 'Y' WHERE inventory_id = '$item_id' AND serial_no = '$sn'");
		}
	}
	$emp_id = $_SESSION["emp_id"];
	$description = $_SESSION["username"]." created a PAR No. ".$par_no;
	mysqli_query($conn, "INSERT INTO tbl_logs(emp_id,description) VALUES('$emp_id','$description')");
}

function get_latest_par(){
	global $conn;

	$yy_mm = mysqli_real_escape_string($conn, $_POST["yy_mm"]);
	$sql = mysqli_query($conn, "SELECT DISTINCT par_no FROM tbl_par WHERE par_no LIKE '%$yy_mm%' ORDER BY par_id DESC LIMIT 1");
	if(mysqli_num_rows($sql) != 0){
		$row = mysqli_fetch_assoc($sql);
		echo str_pad(((int)explode("-", $row["par_no"])[2]) + 1, 4, '0', STR_PAD_LEFT);
	}else{
		echo "0001";
	}
}

$call_func = mysqli_real_escape_string($conn, $_POST["call_func"]);
switch($call_func){
	case "insert_par":
		insert_par();
		break;
	case "get_par":
		get_par();
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
}

?>