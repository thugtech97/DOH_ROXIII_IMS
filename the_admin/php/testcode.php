<?php

require "../../php/php_conn.php";

function get_records1(){
	global $conn;
	
	$sql = mysqli_query($conn, "SELECT ics_no, item, description, area, cost, category, SUBSTRING(date_released, 1, 10) AS date_r, received_from, received_by, SUBSTRING(date_supply_received, 1, 10) AS date_s, remarks, issued, reference_no, property_no, serial_no FROM tbl_ics ORDER BY ics_id DESC");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_assoc($sql)){
			echo "<tr>
					<td><center>".(($row["issued"] == '0') ? "<button id=\"".$row["reference_no"]."\" class=\"btn btn-xs btn-danger\" style=\"border-radius: 10px;\">✖</button>" : "<button class=\"btn btn-xs\" style=\"border-radius: 10px; background-color: #00FF00; color: white; font-weight: bold;\" disabled>✓</button>")."</center></td>
					<td>".$row["area"]."</td>
					<td>".$row["ics_no"]."</td>
					<td>".$row["reference_no"]."</td>
					<td>".$row["item"]."</td>
					<td>".$row["description"]."</td>
					<td>".$row["property_no"]."</td>
					<td>".$row["serial_no"]."</td>
					<td>".$row["cost"]."</td>
					<td>".$row["category"]."</td>
					<td>".$row["date_r"]."</td>
					<td>".$row["received_from"]."</td>
					<td>".$row["received_by"]."</td>
					<td>".$row["date_s"]."</td>
					<td>".$row["remarks"]."</td>
					<td><center><button class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\"><i class=\"fa fa-pencil-square-o\"></i></button>&nbsp;<button class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Print\"><i class=\"fa fa-print\"></i></button>&nbsp;<button class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\"><i class=\"fa fa-trash\"></i></button></center></td>
				</tr>";
		}
	}
}

function get_records(){
	global $conn;
	
	$sql = mysqli_query($conn, "SELECT par_no, item, description, area, cost, category, SUBSTRING(date_released, 1, 10) AS date_r, received_from, received_by, SUBSTRING(date_supply_received, 1, 10) AS date_s, remarks, issued, reference_no, property_no, serial_no FROM tbl_par ORDER BY par_id DESC");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_assoc($sql)){
			echo "<tr>
					<td><center>".(($row["issued"] == '0') ? "<button id=\"".$row["reference_no"]."\" class=\"btn btn-xs btn-danger\" style=\"border-radius: 10px;\">✖</button>" : "<button class=\"btn btn-xs\" style=\"border-radius: 10px; background-color: #00FF00; color: white; font-weight: bold;\" disabled>✓</button>")."</center></td>
					<td>".$row["area"]."</td>
					<td>".$row["par_no"]."</td>
					<td>".$row["reference_no"]."</td>
					<td>".$row["item"]."</td>
					<td>".$row["description"]."</td>
					<td>".$row["property_no"]."</td>
					<td>".$row["serial_no"]."</td>
					<td>".$row["cost"]."</td>
					<td>".$row["category"]."</td>
					<td>".$row["date_r"]."</td>
					<td>".$row["received_from"]."</td>
					<td>".$row["received_by"]."</td>
					<td>".$row["date_s"]."</td>
					<td>".$row["remarks"]."</td>
					<td><center><button class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\"><i class=\"fa fa-pencil-square-o\"></i></button>&nbsp;<button class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Print\"><i class=\"fa fa-print\"></i></button>&nbsp;<button class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\"><i class=\"fa fa-trash\"></i></button></center></td>
				</tr>";
		}
	}
}

$call_func = mysqli_real_escape_string($conn, $_POST["call_func"]);
switch($call_func){
	case "get_records":
		get_records();
		break;
	case "get_records1":
		get_records1();
		break;
}

?>