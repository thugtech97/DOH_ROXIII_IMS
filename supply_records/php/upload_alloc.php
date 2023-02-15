<?php

require "../../php/php_conn.php";
require "SimpleXLSX.php";

session_start();

if(isset($_GET['files'])) {
	$type_iss = mysqli_real_escape_string($conn, $_GET["type_iss"]);
	$uploaddir = ""; $tbody_upload = ""; $program = "";
	$error = false;
	$uploaddir = "../../../archives/alloc/".$type_iss."/";
	
	if(!is_dir($uploaddir)){
		mkdir($uploaddir, 0777, true);
	}

	switch($type_iss){
		case "PTR":
			foreach($_FILES as $file){
				$filename = $file['name'];
				if(move_uploaded_file($file['tmp_name'], $uploaddir.basename($file['name']))){
					if($xlsx = SimpleXLSX::parse($uploaddir.$filename)){
						$i = 0;
						$count = 0;
						foreach($xlsx->rows(0) as $elt){
							$i++;
							if($i == 7){
								$program = explode(":", $elt[0])[1];
							}
							if($i == 9){
								if($elt[0] == "FROM" && $elt[1] == "TO" && $elt[2] == "ADDRESS" && $elt[3] == "TRANSFER REASON" && $elt[4] == "STORAGE TEMP" && $elt[5] == "TRANSPORT TEMP" && $elt[6] == "INVENTORY ID" && $elt[7] == "QUANTITY" && $elt[8] == "PROPERTY NO" && $elt[9] == "LOT/SERIAL"){
									$error = false;
								}else{
									$error = true;
									break;
								}
							}
							if($i >= 10){
								$count++;
								$tbody_upload.="<tr>
													<td>".$elt[0]."</td>
													<td>".$elt[1]."</td>
													<td>".$elt[2]."</td>
													<td>".$elt[3]."</td>
													<td>".$elt[4]."</td>
													<td>".$elt[5]."</td>
													<td>".$elt[6]."</td>
													<td>".$elt[7]."</td>
													<td>".$elt[8]."</td>
													<td>".$elt[9]."</td>
													<td id=\"remarks-row-".$count."\"></td>
												</tr>";
							}
						}
					}
				}
			}
			break;		
		default:
			break;
	}

	echo json_encode(array("tbody"=>$tbody_upload, "count"=>$count, "error"=>$error, "program"=>$program));
}

function insert_ptr(){
	global $conn;

	$yy_mm = mysqli_real_escape_string($conn, $_POST["yy_mm"]);
	$ptr_no = $yy_mm."-".get_latest_ptr($yy_mm);
	$alloc_number = mysqli_real_escape_string($conn, $_POST["alloc_number"]);
	$alloc_entity = mysqli_real_escape_string($conn, $_POST["alloc_entity"]);
	$date_released = mysqli_real_escape_string($conn, $_POST["date_released"]);
	$from = mysqli_real_escape_string($conn, $_POST["from"]);
	$to = mysqli_real_escape_string($conn, $_POST["to"]);
	$address = mysqli_real_escape_string($conn, $_POST["address"]);
	$transfer_reason = mysqli_real_escape_string($conn, $_POST["transfer_reason"]);
	$storage_temp = mysqli_real_escape_string($conn, $_POST["storage_temp"]);
	$transport_temp = mysqli_real_escape_string($conn, $_POST["transport_temp"]);
	$inventory_id = mysqli_real_escape_string($conn, $_POST["inventory_id"]);
	$quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
	$property_no = mysqli_real_escape_string($conn, $_POST["property_no"]);
	$lot_serial = mysqli_real_escape_string($conn, $_POST["lot_serial"]);

	$iids = explode(",", $inventory_id); $qtys = explode(",", $quantity);

	if(count($iids) == count($qtys)){
		$sql = mysqli_query($conn, "SELECT p.po_number, p.item_name, p.description, p.category, p.quantity, p.unit_cost, p.exp_date, s.supplier FROM tbl_po AS p, ref_supplier AS s WHERE p.supplier_id = s.supplier_id AND p.po_id = '$inventory_id'");
		if(mysqli_num_rows($sql) != 0){
			while(mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT ptr_no FROM tbl_ptr WHERE ptr_no = '$ptr_no'")) != 0) {
				$ptr_no = $yy_mm."-".get_latest_ptr($yy_mm);		
			}
			$row = mysqli_fetch_assoc($sql);
			$reference_no = mysqli_real_escape_string($conn, $row["po_number"]);
			$item = mysqli_real_escape_string($conn, $row["item_name"]);
			$description = mysqli_real_escape_string($conn, $row["description"]);
			$quan_unit = explode(" ", mysqli_real_escape_string($conn, $row["quantity"]));
			$category = mysqli_real_escape_string($conn, $row["category"]);
			$cost = mysqli_real_escape_string($conn, $row["unit_cost"]);
			$exp_date = mysqli_real_escape_string($conn, $row["exp_date"]);
			$supplier = mysqli_real_escape_string($conn, $row["supplier"]);
			$total = (float)$cost * (float)$quan_unit[0];
			$approved_by = $_SESSION["company_head"];
			$approved_by_designation = $_SESSION["company_head_designation"];
			$received_from = $_SESSION["property_custodian"];
			$received_from_designation = $_SESSION["property_custodian_designation"];

			if((int)$quantity <= (int)$quan_unit[0]){
				mysqli_query($conn, "INSERT INTO tbl_ptr(ptr_no,entity_name,fund_cluster,tbl_ptr.from,tbl_ptr.to,transfer_type,reference_no,item,description,unit,supplier,serial_no,exp_date,category,property_no,quantity,cost,total,conditions,remarks,reason,approved_by,approved_by_designation,received_from,received_from_designation,date_released,area,address,alloc_num,storage_temp,transport_temp,po_id) VALUES('$ptr_no','$alloc_entity','','$from','$to','Allocation','$reference_no','$item','$description','".$quan_unit[1]."','$supplier','$lot_serial','$exp_date','$category','$property_no','$quantity','$cost','$total','','','$transfer_reason','$approved_by','$approved_by_designation','$received_from','$received_from_designation','$date_released','','$address','$alloc_number','$storage_temp','$transport_temp','$inventory_id')");
				$newrstocks = ((int)$quan_unit[0] - (int)$quantity)." ".$quan_unit[1];
				mysqli_query($conn, "UPDATE tbl_po SET quantity = '$newrstocks' WHERE po_id = '$inventory_id'");
				if($category != "Drugs and Medicines" && $category != "Medical Supplies"){
					$serials = explode(",", $lot_serial);
					for($j = 0; $j < count($serials); $j++){
						$sn = $serials[$j];
						mysqli_query($conn, "UPDATE tbl_serial SET is_issued = 'Y' WHERE inventory_id = '$inventory_id' AND serial_no = '$sn'");
					}
				}
				if($property_no != ""){
					if($category != "Drugs and Medicines" && $category != "Medical Supplies"){
						$pns = explode(",", $property_no);
						$pn = end($pns);
						mysqli_query($conn, "UPDATE ref_lastpn SET property_no = '$pn' WHERE id = 1");
					}
				}
				echo json_encode(array("response"=>1,"message"=>"","ptr_no"=>$ptr_no,"recipient"=>$to,"category"=>$category));
			}else{
				echo json_encode(array("response"=>0,"message"=>"Quantity is greater than the remaining balance."));
			}
		}else{
			echo json_encode(array("response"=>0,"message"=>"Inventory ID not found."));
		}
	}else{
		echo json_encode(array("response"=>0,"message"=>"Error."));
	}
}

function get_latest_ptr($yy_mm){
	global $conn; $latest_ptr = "";

	$yy_mm = substr(mysqli_real_escape_string($conn, $yy_mm), 0, 4);
	$sql = mysqli_query($conn, "SELECT DISTINCT ptr_no FROM tbl_ptr WHERE ptr_no LIKE '%$yy_mm%' ORDER BY ptr_id DESC LIMIT 1");
	if(mysqli_num_rows($sql) != 0){
		$row = mysqli_fetch_assoc($sql);
		$latest_ptr = str_pad(((int)explode("-", $row["ptr_no"])[2]) + 1, 4, '0', STR_PAD_LEFT);
	}else{
		$latest_ptr = "0001";
	}
	return $latest_ptr;

}

$call_func = mysqli_real_escape_string($conn, $_POST["call_func"]);
switch($call_func){
	case "insert_ptr":
		insert_ptr();
		break;
}

?>