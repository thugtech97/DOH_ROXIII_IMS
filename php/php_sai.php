<?php

require "php_connect_online.php";
require "php_general_functions.php";

function get_pr(){
	global $conn_epabs;

	$whole_dom = "";

	if($conn_epabs){
		$limit = '10';
		$page = 1;
		if($_POST["page"] > 1){
			$start = (($_POST["page"] - 1) * $limit);
			$page = $_POST["page"];
		}else{
			$start = 0;
		}

		$query = "SELECT DISTINCT pr_code, division, office, pr_no, prepared_user_name, pr_purpose FROM tbl_pr WHERE pr_no <> '' ";
		if($_POST["search"] != ""){
			$qs = mysqli_real_escape_string($conn_epabs, $_POST["search"]);
			$query.="AND (pr_code LIKE '%$qs%' OR division LIKE '%$qs%' OR office LIKE '%$qs%' OR pr_no LIKE '%$qs%' OR prepared_user_name LIKE '%$qs%' OR pr_purpose LIKE '%$qs%') ";
		}
		$query.="ORDER BY created_at ASC ";

		$sql_orig = mysqli_query($conn_epabs, $query);
		$sql = mysqli_query($conn_epabs, $query."LIMIT ".$start.", ".$limit."");
		$tbody = "";
		$total_data = mysqli_num_rows($sql_orig);
		if($total_data != 0){
			while($row = mysqli_fetch_assoc($sql)){
				$pr_code = $row["pr_code"];
				$in = array();
				$get_items = mysqli_query($conn_epabs, "SELECT item_description FROM tbl_pr_details WHERE pr_code LIKE '$pr_code' AND item_classification <> 'CATERING SERVICES'");
				while($ri = mysqli_fetch_assoc($get_items)){
					array_push($in, trim($ri["item_description"]));
				}
				if(!empty($in)){
					$tbody.="<tr>
							<td style=\"border: thin solid black;\">".$row["pr_code"]."</td>
							<td style=\"font-size: 10px; border: thin solid black;\">".implode(", ", $in)."</td>
							<td style=\"border: thin solid black;\">".$row["division"]."</td>
							<td style=\"border: thin solid black;\">".$row["office"]."</td>
							<td style=\"border: thin solid black;\">".$row["pr_no"]."</td>
							<td style=\"border: thin solid black;\">".$row["prepared_user_name"]."</td>
							<td style=\"border: thin solid black;\">".$row["pr_purpose"]."</td>
							<td style=\"border: thin solid black;\"><center><button id=\"".$row["pr_code"]."\" class=\"btn btn-xs btn-warning\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"View\" onclick=\"get_pr_items(this.id);\"><i class=\"fa fa-eye\"></i></button></center></td>
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
						<tr><th style=\"border: 2px solid black;\" colspan=\"8\">Not connected to E-Procurement Database</th></tr>
						</table>";
	}

	echo $whole_dom;
}

function get_items(){
	global $conn_epabs;

	$pr_code = mysqli_real_escape_string($conn_epabs, $_POST["pr_code"]);
	$sql = mysqli_query($conn_epabs, "SELECT wfp_code, item_description, item_price, item_qty, item_unit FROM tbl_pr_details WHERE pr_code LIKE '$pr_code'");
	
	while($row = mysqli_fetch_assoc($sql)){
		echo 	"<tr>
					<td>".$row["wfp_code"]."</td>
					<td>".$row["item_description"]."</td>
					<td>".$row["item_price"]."</td>
					<td>".$row["item_qty"]."</td>
					<td>".$row["item_unit"]."</td>
					<td><label class=\"col-form-label\"><input type=\"checkbox\" class=\"i-checks\" style=\"height: 15px; width: 15px;\"></label></td>
				</tr>";
	}
}

$call_func = mysqli_real_escape_string($conn_epabs, $_POST["call_func"]);
switch($call_func){
	case "get_pr":
		get_pr();
		break;
	case "get_items":
		get_items();
		break;
}

?>