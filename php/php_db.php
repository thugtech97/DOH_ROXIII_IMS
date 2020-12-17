<?php

require "php_conn.php";
require "php_general_functions.php";

$is_rows = 0; $ics = 0; $par = 0; $ris = 0; $ptr = 0;

function load_card(){
	global $conn;global $ics;global $par;global $ptr;global $ris;

	$sql = mysqli_query($conn, "SELECT DISTINCT po_number FROM tbl_po");
	$po_rows = mysqli_num_rows($sql);

	$sql = mysqli_query($conn, "SELECT item FROM ref_item");
	$it_rows = mysqli_num_rows($sql);

	$sql = mysqli_query($conn, "SELECT DISTINCT ics_no FROM tbl_ics");
	$ics = mysqli_num_rows($sql);
	$is_rows = $ics;

	$sql = mysqli_query($conn, "SELECT DISTINCT par_no FROM tbl_par");
	$par = mysqli_num_rows($sql);
	$is_rows += (int)$par;

	$sql = mysqli_query($conn, "SELECT DISTINCT ris_no FROM tbl_ris");
	$ris = mysqli_num_rows($sql);
	$is_rows += (int)$ris;

	$sql = mysqli_query($conn, "SELECT DISTINCT ptr_no FROM tbl_ptr");
	$ptr = mysqli_num_rows($sql);
	$is_rows += (int)$ptr;

	$sql = mysqli_query($conn, "SELECT * FROM tbl_logs");
	$ul_rows = mysqli_num_rows($sql);

	echo json_encode(array("po_rows"=>$po_rows,"it_rows"=>$it_rows,"is_rows"=>$is_rows,"ul_rows"=>$ul_rows,"is_data"=>array($ics, $par, $ptr, $ris)));
}

function load_all(){
	global $conn;
	$sql = mysqli_query($conn, "SELECT DISTINCT po_number, procurement_mode, end_user FROM tbl_po ORDER BY po_id DESC");
	$tbody_po = "";
	while($row = mysqli_fetch_assoc($sql)){
		$tbody_po.="<tr>
						<td>".$row["po_number"]."</td>
						<td>".$row["procurement_mode"]."</td>
						<td>".$row["end_user"]."</td>
					</tr>";
	}

	
	$tbody_ul = "";
	$sql = mysqli_query($conn, "SELECT logs_id, description, dt FROM tbl_logs ORDER BY logs_id DESC");
	while($row = mysqli_fetch_assoc($sql)){
		$dt = explode(" ", $row["dt"]);
		$t = explode(":", $dt[1]);
		$final_time = "";
		if((int)$t[0] <= 11){
			$final_time = $dt[1]." AM";
		}else{
			if((int)$t[0] == 12){
				$final_time = $dt[1]." PM";
			}else{
				$final_time = ((int)$t[0] - 12).":".$t[1].":".$t[2]." PM";	
			}
		}
		$tbody_ul.="<tr>
						<td>".$row["logs_id"]."</td>
						<td>".$row["description"]."</td>
						<td>"._m_d_yyyy_($dt[0])."</td>
						<td>".$final_time."</td>
					</tr>";
	}
	echo json_encode(array("po_data"=>$tbody_po,"ul_data"=>$tbody_ul));
}

switch(mysqli_real_escape_string($conn, $_POST["call_func"])){
	case "load_card":
		load_card();
		break;
	case "load_all":
		load_all();
		break;
}

?>