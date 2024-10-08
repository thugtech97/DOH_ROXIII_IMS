<?php

require "php_conn.php";

session_start();

function save_bf(){
	global $conn;
	$po_number = mysqli_real_escape_string($conn, str_replace(' ', '', $_POST["po_number"]));
	$supplier_id = mysqli_real_escape_string($conn, $_POST["supplier_id"]);
	$bdfwd = mysqli_real_escape_string($conn, $_POST["date_fwd"]);
	$end_user = mysqli_real_escape_string($conn, $_POST["program_eu"]);
	$items = $_POST["items"];
	for($i = 0; $i < count($items); $i++){
		$item_id = $items[$i][0];
		$item_name = mysqli_real_escape_string($conn, $items[$i][1]);
		$description = mysqli_real_escape_string($conn, $items[$i][2]);
		$category = $items[$i][3];
		$sn_ln = $items[$i][4];
		$exp_date = empty($items[$i][5]) ? NULL : $items[$i][5]; // Set to NULL if empty;
		$unit_cost = $items[$i][6];
		$quantity = $items[$i][7];
		$main_stocks = explode(" ", $quantity)[0];
		if(mysqli_query($conn, "INSERT INTO tbl_po(date_received,po_number,inspection_status,supplier_id,item_id,item_name,description,category,sn_ln,exp_date,unit_cost,main_stocks,quantity,end_user,po_type,entry_type) VALUES('$bdfwd','$po_number','1','$supplier_id','$item_id','$item_name','$description','$category','$sn_ln','$exp_date','$unit_cost','$main_stocks','$quantity','$end_user','$category','1')")){
			if($sn_ln != ""){
				$last_id = (int)mysqli_insert_id($conn);
				$serials_lots = explode("|", $sn_ln);
				for($j = 0; $j < count($serials_lots) - 1; $j++){
					$sl = $serials_lots[$j];
					mysqli_query($conn, "INSERT INTO tbl_serial(inventory_id,serial_no,is_issued) VALUES('$last_id','$sl','N')");
				}
			}

		}
	}
	$emp_id = $_SESSION["emp_id"];
	$description = $_SESSION["username"]." forwarded new stocks of items (RefNumber: ".$po_number.")";
	mysqli_query($conn, "INSERT INTO tbl_logs(emp_id,description) VALUES('$emp_id','$description')");
}

$call_func = mysqli_real_escape_string($conn, $_POST["call_func"]);
switch($call_func){
	case "save_bf":
		save_bf();
		break;

}

?>
