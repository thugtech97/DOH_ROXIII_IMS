<?php

require "php_conn.php";

function get_ppe_details(){
	global $conn;

	mysqli_query($conn, "TRUNCATE tbl_ppe");
	$year_month = mysqli_real_escape_string($conn, $_POST["year_month"]);
	$tbody = "";
	$sql = mysqli_query($conn, "SELECT date_released,item,reference_no,quantity,unit,cost,total,received_by,remarks FROM tbl_ics WHERE date_released LIKE '%$year_month%'");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date_released"];
		$item = $row["item"];
		$reference_no = $row["reference_no"];
		$quantity = $row["quantity"];
		$unit = $row["unit"];
		$cost = $row["cost"];
		$total = $row["total"];
		$received_by = $row["received_by"];
		$remarks = $row["remarks"];
		mysqli_query($conn, "INSERT INTO tbl_ppe(tbl_ppe.date,particular,par_ptr_reference,qty,unit,unit_cost,total_cost,type,received_by,remarks) VALUES('$date_released','$item','$reference_no','$quantity','$unit','$cost','$total','ics','$received_by','$remarks')");
	}
	
	$sql = mysqli_query($conn, "SELECT date_released,item,reference_no,quantity,unit,cost,total,received_by,remarks FROM tbl_par WHERE date_released LIKE '%$year_month%'");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date_released"];
		$item = $row["item"];
		$reference_no = $row["reference_no"];
		$quantity = $row["quantity"];
		$unit = $row["unit"];
		$cost = $row["cost"];
		$total = $row["total"];
		$received_by = $row["received_by"];
		$remarks = $row["remarks"];
		mysqli_query($conn, "INSERT INTO tbl_ppe(tbl_ppe.date,particular,par_ptr_reference,qty,unit,unit_cost,total_cost,type,received_by,remarks) VALUES('$date_released','$item','$reference_no','$quantity','$unit','$cost','$total','par','$received_by','$remarks')");
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
	$sql = mysqli_query($conn, "SELECT date_released,item,reference_no,quantity,unit,cost,total,tbl_ptr.to,remarks FROM tbl_ptr WHERE date_released LIKE '%$year_month%' /*AND (category != 'Drugs and Medicines' AND category != 'Medical Supplies')*/");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date_released"];
		$item = $row["item"];
		$reference_no = $row["reference_no"];
		$quantity = $row["quantity"];
		$unit = $row["unit"];
		$cost = $row["cost"];
		$total = $row["total"];
		$to = $row["to"];
		$remarks = $row["remarks"];
		mysqli_query($conn, "INSERT INTO tbl_ppe(tbl_ppe.date,particular,par_ptr_reference,qty,unit,unit_cost,total_cost,type,received_by,remarks) VALUES('$date_released','$item','$reference_no','$quantity','$unit','$cost','$total','ptr','$to','$remarks')");
	}
	$sql = mysqli_query($conn, "SELECT SUBSTRING(tbl_ppe.date, 1, 10) AS date_r, particular,par_ptr_reference,qty,unit,unit_cost,total_cost,type,received_by,remarks FROM tbl_ppe ORDER BY tbl_ppe.date ASC");
	$ics_total = 0.00;
	$par_total = 0.00;
	$ptr_total = 0.00;
	$overall = 0.00;
	while($row = mysqli_fetch_assoc($sql)){
	 	$tbody.="<tr style=\"font-size: 10px;\">
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".$row["date_r"]."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".$row["particular"]."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".$row["par_ptr_reference"]."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".$row["qty"]."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".$row["unit"]."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".number_format((float)$row["unit_cost"], 2)."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\">".number_format((float)$row["total_cost"], 2)."</td>
                    <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
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
	$tbody.="<tr style=\"font-size: 10px;\">
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
			<tr style=\"font-size: 10px;\">
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\">".number_format((float)$overall, 2)."</td>
                <td style=\"padding-left: 10px; padding-right: 10px;\"></td>
                <td style=\"padding-left: 10px; padding-right: 10px;\">".number_format((float)$ptr_total, 2)."</td>
                <td style=\"padding-left: 10px; padding-right: 10px;\">".number_format((float)$par_total, 2)."</td>
                <td style=\"padding-left: 10px; padding-right: 10px;\">".number_format((float)$ics_total, 2)."</td>
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

	mysqli_query($conn, "TRUNCATE tbl_stockcard");

	$sql = mysqli_query($conn, "SELECT s.supplier, p.date_received, p.po_number, p.main_stocks FROM tbl_po AS p, ref_supplier AS s WHERE p.item_name LIKE '$item_name' AND p.description LIKE '$item_desc' AND p.supplier_id = s.supplier_id");
	while($row = mysqli_fetch_assoc($sql)){
		$date_received = $row["date_received"];
		$reference_no = $row["po_number"];
		$main_stocks = $row["main_stocks"];
		$supplier = $row["supplier"];
		mysqli_query($conn, "INSERT INTO tbl_stockcard(tbl_stockcard.date,quantity,reference_no,office,remarks,status) VALUES('$date_received','$main_stocks','$reference_no','$supplier','','IN')");
	}
	$sql = mysqli_query($conn, "SELECT date_released,ics_no,quantity,received_by,remarks FROM tbl_ics WHERE item LIKE '$item_name' AND description LIKE '$item_desc' AND issued = '1'");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date_released"];
		$reference_no = $row["ics_no"];
		$quantity = $row["quantity"];
		$area = $row["received_by"];
		mysqli_query($conn, "INSERT INTO tbl_stockcard(tbl_stockcard.date,quantity,reference_no,office,remarks,status) VALUES('$date_released','$quantity','$reference_no','$area','','OUT')");
	}

	$sql = mysqli_query($conn, "SELECT date_released,par_no,quantity,received_by,remarks FROM tbl_par WHERE item LIKE '$item_name' AND description LIKE '$item_desc' AND issued = '1'");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date_released"];
		$reference_no = $row["par_no"];
		$quantity = $row["quantity"];
		$area = $row["received_by"];
		mysqli_query($conn, "INSERT INTO tbl_stockcard(tbl_stockcard.date,quantity,reference_no,office,remarks,status) VALUES('$date_released','$quantity','$reference_no','$area','','OUT')");
	}
	
	$sql = mysqli_query($conn, "SELECT tbl_ris.date,ris_no,quantity,requested_by,remarks FROM tbl_ris WHERE item LIKE '$item_name' AND description LIKE '$item_desc' AND issued = '1'");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date"];
		$reference_no = $row["ris_no"];
		$quantity = $row["quantity"];
		$area = $row["requested_by"];
		mysqli_query($conn, "INSERT INTO tbl_stockcard(tbl_stockcard.date,quantity,reference_no,office,remarks,status) VALUES('$date_released','$quantity','$reference_no','$area','','OUT')");
	}
	
	$sql = mysqli_query($conn, "SELECT date_released,ptr_no,quantity,tbl_ptr.to,remarks FROM tbl_ptr WHERE item = '$item_name' AND description LIKE '$item_desc' AND issued = '1'");
	while($row = mysqli_fetch_assoc($sql)){
		$date_released = $row["date_released"];
		$reference_no = $row["ptr_no"];
		$quantity = $row["quantity"];
		$area = $row["to"];
		mysqli_query($conn, "INSERT INTO tbl_stockcard(tbl_stockcard.date,quantity,reference_no,office,remarks,status) VALUES('$date_released','$quantity','$reference_no','$area','','OUT')");
	}

	$read_sql = mysqli_query($conn, "SELECT SUBSTRING(tbl_stockcard.date, 1, 10) AS date_r,quantity,reference_no,office,remarks,status FROM tbl_stockcard ORDER BY tbl_stockcard.date ASC");
	while($row = mysqli_fetch_assoc($read_sql)){
		if($row["status"] == "IN"){
			$qty_balance+=(int)$row["quantity"];
			$sc_drugs.="<tr>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["date_r"]."</td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["reference_no"]."</td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["quantity"]."</td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["office"]."</td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$qty_balance."</td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		    </tr>";
		}
		if($row["status"] == "OUT"){
			$qty_balance-=(int)$row["quantity"];
			$sc_drugs.="<tr>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["date_r"]."</td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["reference_no"]."</td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["quantity"]."</td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["office"]."</td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$qty_balance."</td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		    </tr>";
		}
		$rows++;
	}
	for($i = 0; $i < (65 - $rows); $i++){
		$sc_drugs.="<tr>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"><span style=\"visibility: hidden;\">LALA</span></td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		      <td style=\"font-size:8px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
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
}

?>