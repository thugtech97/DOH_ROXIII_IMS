<?php

require "../../php/php_conn.php";
require "../../php/php_general_functions.php";

session_start();

function update(){
	global $conn;

	$table = mysqli_real_escape_string($conn, $_POST["table"]);
	$field = mysqli_real_escape_string($conn, $_POST["field"]);
	$number=mysqli_real_escape_string($conn, $_POST["number"]);
	
	$entity_name=mysqli_real_escape_string($conn, $_POST["entity_name"]);
	$received_from=mysqli_real_escape_string($conn, $_POST["received_from"]);
	$received_from_designation=mysqli_real_escape_string($conn, $_POST["received_from_designation"]);
	$date_released=mysqli_real_escape_string($conn, $_POST["date_released"]);
	$reference_no=mysqli_real_escape_string($conn, $_POST["reference_no"]);
	$fund_cluster=mysqli_real_escape_string($conn, $_POST["fund_cluster"]);
	$received_by=mysqli_real_escape_string($conn, $_POST["received_by"]);
	$received_by_designation=mysqli_real_escape_string($conn, $_POST["received_by_designation"]);
	$area=mysqli_real_escape_string($conn, $_POST["area"]);

	$dtype = ($table == "tbl_ics") ? "ICS" : "PAR";
	$emp_id = $_SESSION["emp_id"];
	$description = $_SESSION["username"]." edited the details of ".$dtype." No. ".$number;
	mysqli_query($conn, "INSERT INTO tbl_logs(emp_id,description) VALUES('$emp_id','$description')");
	
	mysqli_query($conn, "UPDATE ".$table." SET entity_name='$entity_name',received_from='$received_from',received_from_designation='$received_from_designation',date_released='$date_released',reference_no='$reference_no',fund_cluster='$fund_cluster',received_by='$received_by',received_by_designation='$received_by_designation',area='$area' WHERE ".$field." LIKE '".$number."'");
}

function modify(){
	global $conn;

	$table = mysqli_real_escape_string($conn, $_POST["table"]);
	$field = mysqli_real_escape_string($conn, $_POST["field"]);
	$number=mysqli_real_escape_string($conn, $_POST["number"]);

	$entity_name="";$received_from="";$received_from_designation="";$date_released="";$reference_no="";$fund_cluster="";$received_by="";$received_by_designation="";$area=""; $tabled = ""; $tot_amt = 0.00;
	$sql = mysqli_query($conn, "SELECT entity_name, received_from, received_from_designation, SUBSTRING(date_released,1,10) AS date_r, reference_no,  fund_cluster, received_by, received_by_designation, area, item, description, serial_no, category, property_no, quantity, unit, cost, total, remarks FROM ".$table." WHERE ".$field." LIKE '".$number."'");
	while($row = mysqli_fetch_assoc($sql)){
		$entity_name=$row["entity_name"];$received_from=$row["received_from"];$received_from_designation=$row["received_from_designation"];$date_released=$row["date_r"];$reference_no=$row["reference_no"];$fund_cluster=$row["fund_cluster"];$received_by=$row["received_by"];$received_by_designation=$row["received_by_designation"];$area=$row["area"];
		$tabled.="<tr>
					<td>".$row["item"]."</td>
					<td>".$row["description"]."</td>
					<td>".$row["serial_no"]."</td>
					<td>".$row["category"]."</td>
					<td>".$row["property_no"]."</td>
					<td>".$row["quantity"]."</td>
					<td>".$row["unit"]."</td>
					<td>".number_format((float)$row["cost"], 2)."</td>
					<td>".number_format((float)$row["total"], 2)."</td>
					<td>".$row["remarks"]."</td>
					</tr>";
					$tot_amt+=(float)$row["total"];
	}
	
	echo json_encode(array(
		"entity_name"=>$entity_name,
		"received_from"=>$received_from,
		"received_from_designation"=>$received_from_designation,
		"date_released"=>$date_released,
		"reference_no"=>$reference_no,
		"fund_cluster"=>$fund_cluster,
		"received_by"=>$received_by,
		"received_by_designation"=>$received_by_designation,
		"area"=>$area,
		"tabled"=>$tabled,
		"tot_amt"=>$tot_amt
	));
}

function delete_record(){
	global $conn;

	$field = mysqli_real_escape_string($conn, $_POST["field"]);
	$table = mysqli_real_escape_string($conn, $_POST["table"]);
	$number=mysqli_real_escape_string($conn, $_POST["number"]);
	$sql = mysqli_query($conn, "SELECT item, description, quantity, serial_no, reference_no FROM ".$table." WHERE ".$field." LIKE '".$number."'");
	while($row = mysqli_fetch_assoc($sql)){
		$item = $row["item"]; $description = $row["description"]; $reference_no = $row["reference_no"]; $quantity = $row["quantity"];
		$query_get_stocks = mysqli_query($conn, "SELECT quantity FROM tbl_po WHERE po_number = '$reference_no' AND item_name = '$item' AND description = '$description'");
		$rstocks = explode(" ", mysqli_fetch_assoc($query_get_stocks)["quantity"]);
		$newrstocks = ((int)$rstocks[0] + (int)$quantity)." ".$rstocks[1];
		mysqli_query($conn, "UPDATE tbl_po SET quantity = '$newrstocks' WHERE po_number = '$reference_no' AND item_name = '$item' AND description = '$description'");
		if($row["serial_no"] != null){
			$serials = explode(",", $row["serial_no"]);
			for($j = 0; $j < count($serials); $j++){
				$sn = $serials[$j];
				mysqli_query($conn, "UPDATE tbl_serial SET is_issued = 'N' WHERE serial_no = '$sn'");
			}
		}
	}
	mysqli_query($conn, "DELETE FROM ".$table." WHERE ".$field." LIKE '".$number."'");
	$dtype = ($table == "tbl_ics") ? "ICS" : (($table == "tbl_par") ? "PAR" : "PTR");
	$emp_id = $_SESSION["emp_id"];
	$description = $_SESSION["username"]." deleted a record ".$dtype." No. ".$number;
	mysqli_query($conn, "INSERT INTO tbl_logs(emp_id,description) VALUES('$emp_id','$description')");
}

function to_issue(){
	global $conn;
	$ics_no = mysqli_real_escape_string($conn, $_POST["ics_no"]);
	mysqli_query($conn, "UPDATE tbl_ics SET issued = '1' WHERE ics_no = '$ics_no'");
}

function get_item_details(){
	global $conn;

	$item_id = mysqli_real_escape_string($conn, $_POST["item_id"]);
	$po_number = mysqli_real_escape_string($conn, $_POST["po_number"]);
	$sql = mysqli_query($conn, "SELECT category, exp_date, quantity, description, sn_ln, unit_cost FROM tbl_po WHERE po_id = '$item_id' AND po_number = '$po_number'");
	if(mysqli_num_rows($sql) != 0){
		$row = mysqli_fetch_assoc($sql);
		$q_u = explode(" ", $row["quantity"]);
		$sql2 = mysqli_query($conn, "SELECT serial_id, serial_no FROM tbl_serial WHERE is_issued = 'N' AND inventory_id = '$item_id'");
		$sl_options = "";
		if(mysqli_num_rows($sql2) != 0){
			while($rows = mysqli_fetch_assoc($sql2)){
				$sl_options.="<option value=\"".$rows["serial_no"]."\">".$rows["serial_no"]."</option>";
			}	
		}
		echo json_encode(array("stocks"=>$q_u[0],"unit"=>$q_u[1],"description"=>$row["description"],"unit_cost"=>$row["unit_cost"],"exp_date"=>$row["exp_date"],"category"=>$row["category"],"sn_ln"=>$sl_options));
	}
}

function get_item(){
	global $conn;

	$po_number = mysqli_real_escape_string($conn, $_POST["po_number"]);
	$sql = mysqli_query($conn, "SELECT p.quantity, p.po_id, p.item_id, i.item FROM tbl_po AS p, ref_item AS i WHERE p.item_id = i.item_id AND p.po_number LIKE '$po_number' AND p.inspection_status = '1'");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$quan = explode(" ", $row["quantity"]);
			if((int)$quan[0] != 0){
				echo "<option value=\"".$row["po_id"]."\">".$row["item"]."</option>";
			}
		}
	}
}

function get_category(){
	global $conn;
	$sql = mysqli_query($conn, "SELECT category_id, category, category_code FROM ref_category WHERE status = '0' ORDER BY category_id ASC");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_assoc($sql)){
			echo "<option value=".$row["category_id"]."┼".$row["category_code"].">".$row["category"]."</option>";
		}
	}
}

function get_area(){
	global $conn;

	$sql = mysqli_query($conn, "SELECT area_id, area FROM ref_area WHERE status = '0' ORDER BY area_id ASC");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_assoc($sql)){
			echo "<option value=\"".$row["area_id"]."\">".$row["area"]."</option>";
		}
	}
}

function get_employee(){
	global $connhr;
	$sql = mysqli_query($connhr, "SELECT emp_id, fname, mname, lname, prefix, suffix FROM tbl_employee WHERE status LIKE 'Active' ORDER BY fname ASC");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_assoc($sql)){
			echo "<option value=\"".$row["emp_id"]."\">".(($row["prefix"] != null) ? $row["prefix"]." " : "")."".$row["fname"]." ".$row["mname"][0].". ".$row["lname"]."".(($row["suffix"] != null) ? ", ".$row["suffix"] : "")."</option>";
		}
	}
}

function get_ics_details(){
  global $conn;

  $entity_name = "";
  $fund_cluster = "";
  $ics_tbody = "";
  $total_cost = 0.00; $reference_no = ""; $supplier = ""; $date_released = "";
  $received_from = ""; $received_by = "";
  $received_from_designation = ""; $received_by_designation = "";
  $rows_limit = 40; $rows_occupied = 0;
  $ics_no = mysqli_real_escape_string($conn, $_POST["ics_no"]);
  $sql = mysqli_query($conn, "SELECT entity_name, fund_cluster, quantity, unit, cost, total, description, property_no, serial_no, reference_no, supplier, SUBSTRING(date_released, 1, 10) AS date_r, received_from, received_from_designation, received_by, received_by_designation FROM tbl_ics WHERE ics_no LIKE '$ics_no'");
  if(mysqli_num_rows($sql) != 0){
    while($row = mysqli_fetch_assoc($sql)) {
      $entity_name = $row["entity_name"];
      $fund_cluster = $row["fund_cluster"];
      $total_cost += (float)($row["cost"] * $row["quantity"]);
      $reference_no = $row["reference_no"]; $supplier = $row["supplier"]; $date_released = $row["date_r"];
      $received_from = $row["received_from"]; $received_by = $row["received_by"];
      $received_from_designation = $row["received_from_designation"]; $received_by_designation = $row["received_by_designation"];
      $pn = explode(",", $row["property_no"]);
      $ics_tbody.="<tr>
                  <td style=\"width: 75.6px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\">".$row["quantity"]."</td>
                  <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row["unit"]."</td>
                  <td style=\"width: 61.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format((float)$row["cost"], 2)."</td>
                  <td style=\"width: 62.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format((float)($row["cost"] * $row["quantity"]), 2)."</td>
                  <td colspan=\"2\" style=\"width: 48px; height: 14.5px; text-align: left; font-size: 10px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; border-right-color: rgb(0, 0, 0); border-right-width: 1px; border-right-style: solid;\">".$row["description"]."</td>
                  <td style=\"width: 86.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".((count($pn) >= 1 && $row["serial_no"] == null) ? $pn[0] : "")."</td>
                  <td style=\"width: 89.4px; height: 14.5px; font-size: 11px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
               </tr>";
               $rows_occupied+=round((float)strlen($row["description"]) / 60.00);
               if($row["serial_no"] == null && count($pn) > 1){
                for($j = 1; $j < count($pn); $j++){
                  $ics_tbody.="<tr>
                      <td style=\"width: 75.6px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
                      <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                      <td style=\"width: 61.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                      <td style=\"width: 62.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                      <td colspan=\"2\" style=\"width: 48px; height: 14.5px; text-align: left; font-size: 10px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; border-right-color: rgb(0, 0, 0); border-right-width: 1px; border-right-style: solid;\"></td>
                      <td style=\"width: 86.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$pn[$j]."</td>
                      <td style=\"width: 89.4px; height: 14.5px; font-size: 11px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                   </tr>";
                   $rows_occupied++;
                }
               }
               if($row["serial_no"] != null){
                $serials = explode(",", $row["serial_no"]);
                for($i = 0; $i < count($serials); $i++){
                  if(!array_key_exists($i, $pn)){
                    $ics_tbody.="<tr>
                          <td style=\"width: 75.6px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
                          <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                          <td style=\"width: 61.8px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                          <td style=\"width: 62.4px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                          <td colspan=\"2\" style=\"width: 48px; height: 14.5px; text-align: left; font-size: 10px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; border-right-color: rgb(0, 0, 0); border-right-width: 1px; border-right-style: solid;\">Serial No. ".$serials[$i]."</td>
                          <td style=\"width: 86.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                          <td style=\"width: 89.4px; height: 14.5px; font-size: 11px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                       </tr>";
                       $rows_occupied++;
                  }else{
                    $ics_tbody.="<tr>
                          <td style=\"width: 75.6px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
                          <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                          <td style=\"width: 61.8px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                          <td style=\"width: 62.4px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                          <td colspan=\"2\" style=\"width: 48px; height: 14.5px; text-align: left; font-size: 10px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; border-right-color: rgb(0, 0, 0); border-right-width: 1px; border-right-style: solid;\">Serial No. ".$serials[$i]."</td>
                          <td style=\"width: 86.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$pn[$i]."</td>
                          <td style=\"width: 89.4px; height: 14.5px; font-size: 11px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                       </tr>";
                  }
                  $rows_occupied++;
                }
               }
    }
    $the_rest = array("*Nothing Follows*", "", "", "PO No. ".$reference_no, $supplier);
    for($i = 0; $i < count($the_rest); $i++){
      $ics_tbody.="<tr>
                <td style=\"width: 75.6px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
                <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                <td style=\"width: 61.8px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                <td style=\"width: 62.4px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                <td colspan=\"2\" style=\"width: 48px; height: 14.5px; text-align: left; font-size: 10px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; border-right-color: rgb(0, 0, 0); border-right-width: 1px; border-right-style: solid;\">".$the_rest[$i]."</td>
                <td style=\"width: 86.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                <td style=\"width: 89.4px; height: 14.5px; font-size: 11px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
             </tr>";
             $rows_occupied++;
    }
    for($i = 0; $i < ($rows_limit - $rows_occupied); $i++){
      $ics_tbody.="<tr>
                <td style=\"width: 75.6px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
                <td style=\"width: 70.8px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                <td style=\"width: 61.8px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                <td style=\"width: 62.4px; height: 14.5px; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                <td colspan=\"2\" style=\"width: 48px; height: 14.5px; text-align: left; font-size: 10px; vertical-align: bottom; border-bottom-color: rgb(0, 0, 0); border-bottom-width: 1px; border-bottom-style: solid; border-right-color: rgb(0, 0, 0); border-right-width: 1px; border-right-style: solid;\"></td>
                <td style=\"width: 86.4px; height: 14.5px; text-align: center; font-size: 10px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
                <td style=\"width: 89.4px; height: 14.5px; font-size: 11px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
             </tr>";
    }
    $received_by = get_complete_name($received_by);
    echo json_encode(array("entity_name"=>$entity_name, "fund_cluster"=>$fund_cluster, "ics_tbody"=>$ics_tbody, "total_cost"=>number_format((float)$total_cost,2), "receivers"=>array($received_from, $received_from_designation, $received_by, $received_by_designation, _m_d_yyyy_($date_released))));
  }
}

function get_ics(){
	global $conn;
	
	$sql = mysqli_query($conn, "SELECT DISTINCT ics_no, area, category, SUBSTRING(date_released, 1, 10) AS date_r, received_from, received_by, SUBSTRING(date_supply_received, 1, 10) AS date_s, remarks, issued, reference_no FROM tbl_ics ORDER BY ics_id DESC");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$icsn = $row["ics_no"];
			echo "<tr>
					<td><center>".(($row["issued"] == '0') ? "<button id=\"".$row["reference_no"]."\" value=\"".$row["ics_no"]."\" onclick=\"to_issue(this.value, this.id);\" class=\"btn btn-xs btn-danger\" style=\"border-radius: 10px;\">✖</button>" : "<button class=\"btn btn-xs\" style=\"border-radius: 10px; background-color: #00FF00; color: white; font-weight: bold;\" disabled>✓</button>")."</center></td>
					<td>".$row["area"]."</td>
					<td>".$row["ics_no"]."</td>
					<td>".$row["reference_no"]."</td>
					<td>".$row["category"]."</td>
					<td>".$row["date_r"]."</td>
					<td>".$row["received_from"]."</td>
					<td>".$row["received_by"]."</td>
					<td>".$row["date_s"]."</td>
					<td>".$row["remarks"]."</td>
					<td><center><button class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" value=\"".$row["ics_no"]."\" data-placement=\"top\" title=\"Edit\" onclick=\"modify(this.value);\"><i class=\"fa fa-pencil-square-o\"></i></button>&nbsp;<button class=\"btn btn-xs btn-success\" value=\"".$row["ics_no"]."\" onclick=\"print_ics(this.value);\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Print\"><i class=\"fa fa-print\"></i></button>&nbsp;<button class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\" value=\"".$row["ics_no"]."\" onclick=\"delete_control(this.value);\"><i class=\"fa fa-trash\"></i></button>&nbsp;<button class=\"btn btn-xs btn-warning\" value=\"".$row["ics_no"]."\" onclick=\"download_xls(this.value);\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Save as Excel\"><i class=\"fa fa-file-excel-o\"></i></button></center></td>
				</tr>";
		}
	}
}

function insert_ics(){
	global $conn;
	global $connhr;
	date_default_timezone_set("Asia/Shanghai");
	$time_now = date("H:i:s");
	$ics_no = mysqli_real_escape_string($conn, $_POST["ics_no"]);
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
		mysqli_query($conn, "INSERT INTO tbl_ics(ics_no, entity_name, fund_cluster, reference_no, item, description, unit, supplier, serial_no, category, property_no, quantity, cost, total, remarks, received_from, received_from_designation, received_by, received_by_designation, date_released, area) VALUES ('$ics_no', '$entity_name', '$fund_cluster', '$reference_no', '$item', '$description', '$unit', '$supplier', '$serial_no', '$category', '$property_no', '$quantity', '$cost', '$total', '$remarks', '$received_from', '$received_from_designation', '$received_by', '$received_by_designation', '$date_released', '$area')");
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
	$description = $_SESSION["username"]." created an ICS No. ".$ics_no;
	mysqli_query($conn, "INSERT INTO tbl_logs(emp_id,description) VALUES('$emp_id','$description')");
}

function get_latest_ics(){
	global $conn;
	$yy_mm = mysqli_real_escape_string($conn, $_POST["yy_mm"]);
	$sql = mysqli_query($conn, "SELECT DISTINCT ics_no FROM tbl_ics WHERE ics_no LIKE '%$yy_mm%' ORDER BY ics_id DESC LIMIT 1");
	if(mysqli_num_rows($sql) != 0){
		$row = mysqli_fetch_assoc($sql);
		echo str_pad(((int)explode("-", $row["ics_no"])[2]) + 1, 4, '0', STR_PAD_LEFT);
	}else{
		echo "0001";
	}
}

$call_func = mysqli_real_escape_string($conn, $_POST["call_func"]);
switch($call_func){
	case "insert_ics":
		insert_ics();
		break;
	case "get_ics":
		get_ics();
		break;
	case "get_area":
		get_area();
		break;
	case "get_employee":
		get_employee();
		break;
	case "get_category":
		get_category();
		break;
	case "get_ics_details":
		get_ics_details();
		break;
	case "get_item":
		get_item();
		break;
	case "get_item_details":
		get_item_details();
		break;
	case "get_latest_ics":
		get_latest_ics();
		break;
	case "to_issue":
		to_issue();
		break;
	case "delete":
		delete_record();
		break;
	case "modify":
		modify();
		break;
	case "update":
		update();
		break;
}

?>