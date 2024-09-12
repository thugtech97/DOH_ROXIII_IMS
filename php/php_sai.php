<?php

require "php_connect_online.php";
require "php_conn.php";
require "php_general_functions.php";

function get_pr(){
	global $conn_epabs;

	$whole_dom	= "";

	if($conn_epabs){
		$limit = '10';
		$page = 1;
		if($_POST["page"] > 1){
			$start = (($_POST["page"] - 1) * $limit);
			$page = $_POST["page"];
		}else{
			$start = 0;
		}

		$query = "SELECT pr_code, division, office, pr_no, prepared_user_name, pr_purpose FROM tbl_pr ";
		if($_POST["search"] != ""){
			$qs = mysqli_real_escape_string($conn_epabs, $_POST["search"]);
			$query.="WHERE pr_code LIKE '%$qs%' OR division LIKE '%$qs%' OR office LIKE '%$qs%' OR pr_no LIKE '%$qs%' OR prepared_user_name LIKE '%$qs%' OR pr_purpose LIKE '%$qs%' ";
		}
		//$query.="ORDER BY created_at ASC ";

		$sql_orig = mysqli_query($conn_epabs, $query);
		$sql = mysqli_query($conn_epabs, $query."LIMIT ".$start.", ".$limit."");
		$tbody = "";
		$total_data = mysqli_num_rows($sql_orig);
		if($total_data != 0){
			while($row = mysqli_fetch_assoc($sql)){
				$pr_code = mysqli_real_escape_string($conn_epabs, $row["pr_code"]);
				$in = array();
				$get_items = mysqli_query($conn_epabs, "SELECT item_description FROM tbl_pr_details WHERE pr_code LIKE '$pr_code' AND item_classification <> 'CATERING SERVICES'");
				while($ri = mysqli_fetch_assoc($get_items)){
					array_push($in, trim($ri["item_description"]));
				}
				if(!empty($in)){
					$tbody.="<tr>
							<td>".$row["pr_code"]."</td>
							<td style=\"font-size: 10px;\">".implode(", ", $in)."</td>
							<td>".$row["division"]."</td>
							<td>".$row["office"]."</td>
							<td>".$row["pr_no"]."</td>
							<td>".$row["prepared_user_name"]."</td>
							<td>".$row["pr_purpose"]."</td>
							<td><center><button id=\"".$row["pr_code"]."\" class=\"btn btn-xs btn-info dim\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"View\" onclick=\"get_pr_items(this.id);\"><i class=\"fa fa-eye\"></i></button></center></td>
						</tr>";
				}
			}
		}else{
			$tbody = "<tr><td colspan=\"8\" style=\"text-align: center;\">No data found.</td></tr>";
		}

		$in_out = create_table_pagination($page, $limit, $total_data, array("PR Code","Items","Division","Office","PR No", "Prepared By","Purpose",""));
		$whole_dom = $in_out[0]."".$tbody."".$in_out[1];
	}else{
		$whole_dom = "<table class=\"table table-bordered\">
						<tr><th colspan=\"8\">Not connected to E-Procurement Database</th></tr>
						</table>";
	}

	echo $whole_dom;
}

function get_items(){
	global $conn_epabs;

	$pr_code = mysqli_real_escape_string($conn_epabs, $_POST["pr_code"]);
	$sql = mysqli_query($conn_epabs, "SELECT id, wfp_code, wfp_act, item_description, item_price, item_qty, item_unit FROM tbl_pr_details WHERE pr_code LIKE '$pr_code'");
	$tbody = "";
	while($row = mysqli_fetch_assoc($sql)){
		 	$tbody.="<tr data-id=\"".$row["id"]."\"> 
						<td style=\"vertical-align: center;\">".$row["wfp_code"]."</td>
						<td style=\"vertical-align: center;\">".$row["wfp_act"]."</td>
						<td style=\"vertical-align: center;\">".$row["item_description"]."</td>
						<td style=\"vertical-align: center;\">".$row["item_price"]."</td>
						<td style=\"vertical-align: center;\">".$row["item_qty"]."</td>
						<td style=\"vertical-align: center;\">".$row["item_unit"]."</td>
						<td><center><label class=\"col-form-label\"><input type=\"checkbox\" class=\"i-checks\" style=\"height: 18px; width: 18px;\"></label></center></td>
					</tr>";
	}
	$sql = mysqli_query($conn_epabs, "SELECT p.division, p.office, p.pr_purpose, p.prepared_user_name, p.prepared_user_id, u.designation FROM tbl_pr AS p, users_profile AS u WHERE p.pr_code LIKE '$pr_code' AND p.prepared_user_id = u.user_id");
	$row = mysqli_fetch_assoc($sql);

	echo json_encode(array("tbody"=>$tbody, "pr_purpose"=>$row["pr_purpose"], "prep_name"=>$row["prepared_user_name"], "prep_id"=>$row["prepared_user_id"], "division"=>$row["division"], "office"=>$row["office"], "designation"=>$row["designation"]));

}

function insert_sai(){
	global $conn;

	$sai_no = mysqli_real_escape_string($conn, $_POST["sai_no"]);
	$pr_code = mysqli_real_escape_string($conn, $_POST["pr_code"]);
	$division = mysqli_real_escape_string($conn, $_POST["division"]);
	$office = mysqli_real_escape_string($conn, $_POST["office"]);
	$purpose = mysqli_real_escape_string($conn, $_POST["purpose"]);
	$prep_by = mysqli_real_escape_string($conn, $_POST["prep_by"]);
	$prep_des = mysqli_real_escape_string($conn, $_POST["prep_des"]);
	$items = $_POST["items"];
	$currentDateTime = date('Y-m-d H:i:s');

	for($i = 0; $i < count($items); $i++){
		$wfp_code = $items[$i][0];
		$wfp_act = $items[$i][1];
		$item_description = mysqli_real_escape_string($conn, $items[$i][2]);
		$unit_cost = $items[$i][3];
		$item_quantity = $items[$i][4];
		$item_unit = $items[$i][5];
		$stock_status = $items[$i][6];
		$pr_details_id = $items[$i][7];
		mysqli_query($conn, "INSERT INTO tbl_sai(sai_no, pr_code, division, office, purpose, inquired_by, inquired_by_designation, wfp_code, wfp_act, item_description, unit, quantity, stock_status, pr_details_id) VALUES('$sai_no', '$pr_code', '$division', '$office', '$purpose', '$prep_by', '$prep_des', '$wfp_code', '$wfp_act', '$item_description', '$item_unit', '$item_quantity', '$stock_status', '$pr_details_id')");
	}
}

function get_sai_reports(){
	global $conn;

	$sql = mysqli_query($conn, "SELECT DISTINCT sai_no, division, office FROM tbl_sai ORDER BY id DESC");
	$tbody = "";
	$count = mysqli_num_rows($sql);
	if($count != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$sai_no = $row["sai_no"];
			$in = array();
			$get_items = mysqli_query($conn, "SELECT item_description FROM tbl_sai WHERE sai_no LIKE '$sai_no'");
			while($ri = mysqli_fetch_assoc($get_items)){
				array_push($in, trim($ri["item_description"]));
			}
			$tbody.=	"<tr>
							<td>".$sai_no."</td>
							<td>".$row["division"]."</td>
							<td>".$row["office"]."</td>
							<td style=\"font-size: 10px;\">".implode(", ", $in)."</td>
							<td><center><button class=\"btn btn-xs btn-info\" onclick=\"print_sai('".$sai_no."');\"><i class=\"fa fa-print\"></i></button>&nbsp;<button class=\"btn btn-xs btn-warning\"><i class=\"fa fa-pencil-square-o\"></i></button>&nbsp;<button class=\"btn btn-xs btn-danger\" onclick=\"delete_sai('".$sai_no."');\"><i class=\"fa fa-trash\"></i></button></center></td>
						</tr>";
		}
	}else{
		$tbody.=	"<tr>
						<td colspan=\"5\"><center>No SAI Report.</center></td>
					</tr>";	
	}

	echo json_encode(array("tbody"=>$tbody, "count"=>$count));
}

function print_sai(){
	global $conn;

	$sai_no = mysqli_real_escape_string($conn, $_POST["sai_no"]);
	$tbody = ""; $division = ""; $office = ""; $purpose = ""; $inquired_by = ""; $inquired_by_designation = "";
	$rows = 0;
	$sql = mysqli_query($conn, "SELECT division, office, inquired_by, inquired_by_designation, item_description, unit, quantity, stock_status, purpose FROM tbl_sai WHERE sai_no LIKE '$sai_no'");
	while($row = mysqli_fetch_assoc($sql)){
		$division = $row["division"]; $office = $row["office"]; $purpose = $row["purpose"]; $inquired_by = $row["inquired_by"]; $inquired_by_designation = $row["inquired_by_designation"];
		$tbody.=	"<tr>
		                <td style=\"font-size: 12px;; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">-</td>
		                <td colspan=\"3\" style=\"font-size: 12px;text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black;border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["item_description"]."</td>
		                <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;\">".$row["unit"]."</td>
		                <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".$row["quantity"]."</td>
		                <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">".($row["stock_status"] == "Available" ? "✔️ ".$row["stock_status"] : "❌ ".$row["stock_status"])."</td>
		              </tr>";
		              $rows+=round((float)strlen($row["item_description"]) / 30.00);
	}

	for($i = 0; $i < (40 - $rows); $i++){
		$tbody.=	"<tr>
		                <td style=\"font-size: 12px;; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\">-</td>
		                <td colspan=\"3\" style=\"font-size: 12px;text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black;border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		                <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: bottom; border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;\"></td>
		                <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		                <td style=\"font-size: 12px; text-align: center; height: 9px; vertical-align: bottom; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;border-left-color: black; border-left-width: 1px; border-left-style: solid; border-right-color: black; border-right-width: 1px; border-right-style: solid;\"></td>
		              </tr>";
	}

	echo json_encode(array("tbody"=>$tbody, "division"=>$division, "office"=>$office, "purpose"=>$purpose, "inquired_by"=>strtoupper($inquired_by), "inquired_by_designation"=>$inquired_by_designation));
}

function delete_sai(){
	global $conn;

	$sai_no = mysqli_real_escape_string($conn, $_POST["sai_no"]);
	mysqli_query($conn, "DELETE FROM tbl_sai WHERE sai_no LIKE '$sai_no'");
}

$call_func = mysqli_real_escape_string($conn_epabs, $_POST["call_func"]);
switch($call_func){
	case "get_pr":
		get_pr();
		break;
	case "get_items":
		get_items();
		break;
	case "insert_sai":
		insert_sai();
		break;
	case "get_sai_reports":
		get_sai_reports();
		break;
	case "print_sai":
		print_sai();
		break;
	case "delete_sai":
		delete_sai();
		break;
}

?>