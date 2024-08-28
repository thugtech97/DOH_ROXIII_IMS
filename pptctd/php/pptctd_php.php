<?php

require "../../php/php_general_functions.php";
$conn;
$grand_total = 0.00;

session_start();

function login(){

	$connhr = mysqli_connect("localhost", "root", "", "hr");
	$username = mysqli_real_escape_string($connhr, $_POST["username"]);
	$password = mysqli_real_escape_string($connhr, $_POST["password"]);

	$sql = mysqli_query($connhr, "SELECT * FROM tbl_employee WHERE username = '$username' AND password = AES_ENCRYPT('$password', 'pass') AND role = 'PPTCTD'");

	if(mysqli_num_rows($sql) != 0){
		$_SESSION["uname"] = $username;
		echo "1";
	}else{
		echo "0";
	}
}

function connect(){
	global $conn;

	$db_name = $_POST["warehouse"] == "Doongan" ? "supply" : "supply1";
	$conn = mysqli_connect("localhost", "root", "", $db_name);
}

function get_user_items(){
	global $grand_total;
	global $conn;
	connect();

	$end_user = mysqli_real_escape_string($conn, $_POST["end_user"]);
	$tbody_eu = get_get_awhh("supply", "ICS", "tbl_ics", "ics_no", $end_user);
	$tbody_eu.= get_get_awhh("supply", "PAR", "tbl_par", "par_no", $end_user);
	$tbody_eu.= get_get_awhh("supply1", "ICS", "tbl_ics", "ics_no", $end_user);
	$tbody_eu.= get_get_awhh("supply1", "PAR", "tbl_par", "par_no", $end_user);

	echo json_encode(array("tbody"=>$tbody_eu, "grand_total"=>number_format($grand_total, 2)));
}

function get_get_awhh($db, $doc, $table, $field, $user){
	global $grand_total;
	$tbody = "";
	$connection = mysqli_connect("localhost", "root", "", $db);

	$sql = mysqli_query($connection, "SELECT ".$field.", item, description, category, property_no, serial_no, cost, quantity, unit, remarks FROM ".$table." WHERE received_by LIKE '$user' ORDER BY date_released ASC");	
	while($row = mysqli_fetch_assoc($sql)){
		$tbody.="<tr contenteditable=\"true\" style=\"font-size: 9px;\">
						<td>".$doc."#".$row[$field]."</td>
						<td>".$row["item"]."</td>
						<td>".$row["description"]."</td>
						<td>".$row["category"]."</td>
						<td>'".(($row["property_no"] == "") ? "N/A" : str_replace(",", "<br>'", $row["property_no"]))."</td>
						<td>'".(($row["serial_no"] == "") ? "N/A" : str_replace(",", "<br>'", $row["serial_no"]))."</td>
						<td>".$row["remarks"]."</td>
						<td>".$row["cost"]."</td>
						<td>".$row["quantity"]." ".$row["unit"]."</td>
						<td>".number_format((float)$row["quantity"] * (float)$row["cost"], 2)."</td>
						<td>".(($db == "supply") ? "Doongan Warehouse" : "Villa Kananga Warehouse")."</td>
					</tr>";
					$grand_total+=((float)$row["quantity"] * (float)$row["cost"]);
	}
	return $tbody;

}

function get_distinct_users(){
	global $conn;
	connect();

	$end_users = array();
	$list_users = "";
	$sql = mysqli_query($conn, "SELECT DISTINCT received_by FROM tbl_ics");
	while($row = mysqli_fetch_assoc($sql)){
		if($row["received_by"] != ""){
			array_push($end_users, $row["received_by"]);
		}
	}
	$sql = mysqli_query($conn, "SELECT DISTINCT received_by FROM tbl_par");
	while($row = mysqli_fetch_assoc($sql)){
		if($row["received_by"] != ""){
			if(!in_array($row["received_by"], $end_users)){
				array_push($end_users, $row["received_by"]);
			}
		}
	}

	sort($end_users);

	foreach($end_users AS $end_user){
		$list_users.="<ol class=\"dd-list\">
                    <li class=\"dd-item\">
                        <div class=\"dd-handle\">".$end_user."</div>
                    </li>
                </ol>";
	}
	echo $list_users;
}

function get_purchase_orders(){
	global $conn;
	connect();

	$limit = '10';
	$page = 1;
	if($_POST["page"] > 1){
		$start = (($_POST["page"] - 1) * $limit);
		$page = $_POST["page"];
	}else{
		$start = 0;
	}
	
	$query = "SELECT DISTINCT p.po_number, p.remarks, p.status, p.inspection_status, p.procurement_mode,s.supplier, SUBSTRING(p.date_received, 1, 10) AS date_r, p.delivery_term, p.date_conformed, p.date_delivered, p.activity_date, p.end_user FROM tbl_po AS p, ref_supplier AS s WHERE p.supplier_id = s.supplier_id ";
	if($_POST["query"] != ""){
		$qs = mysqli_real_escape_string($conn, $_POST["query"]);
		$query.="AND (p.po_number LIKE '%$qs%' OR s.supplier LIKE '%$qs%' OR p.end_user LIKE '%$qs%' OR p.item_name LIKE '%$qs%') ";
	}
	$query.="ORDER BY p.po_id DESC ";

	$sql_orig = mysqli_query($conn, $query);
	$sql = mysqli_query($conn, $query."LIMIT ".$start.", ".$limit."");
	$tbody = "";
	$total_data = mysqli_num_rows($sql_orig);

	if($total_data != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$eu = str_replace(' ', '', $row["end_user"]);
			$date = date_create($row["date_conformed"]);
			$pon = $row["po_number"];
			$in = array();
			$get_items = mysqli_query($conn, "SELECT item_name FROM tbl_po WHERE po_number LIKE '$pon'");
			while($ri = mysqli_fetch_assoc($get_items)){
				array_push($in, trim($ri["item_name"]));
			}
			date_add($date,date_interval_create_from_date_string($row["delivery_term"] == "Progress Billing" || $row["delivery_term"] == "" ? "0 days" : $row["delivery_term"]));
			$expected_delivery_date = date_format($date,"Y-m-d");
			$start_date = strtotime(date("Y-m-d"));
			$end_date = strtotime($expected_delivery_date);

			$remaining_days = round(($end_date - $start_date)/60/60/24);
			$fdays = ($remaining_days < 0) ? "<span style=\"color: red;\">(".(-1 * (int)$remaining_days)." days ago)</span>" : "<span style=\"color: green;\">(".$remaining_days." days left)</span>";
			
			$tbody.="<tr>
					<td>".$row["date_r"]."</td>
					<td>".$row["po_number"]."</td>
					<td style=\"font-size: 10px;\">".implode(", ", $in)."</td>
					<td>".$row["procurement_mode"]."</td>
					<td>".$row["date_conformed"]."</td>
					<td>".(($row["status"] == "Delivered" || $row["status"] == "") ? "" : $expected_delivery_date." ".$fdays)."</td>
					<td>".$row["date_delivered"]."</td>
					<td>".$row["supplier"]."</td>
					<td>".$row["end_user"]."</td>
					<td>".$row["status"]."</td>
					<td><center>".(($row["inspection_status"] == '0') ? "<button class=\"btn btn-xs btn-danger\" style=\"border-radius: 10px;\" disabled>✖</button>" : "<button class=\"btn btn-xs\" style=\"border-radius: 10px; background-color: #00FF00; color: white; font-weight: bold;\" disabled>✓</button>")."</center></td>
					<td><center><button id=\"".$row["po_number"]."\" class=\"btn btn-xs btn-warning\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"View\" onclick=\"view_po(this.id, '".$eu."')\" disabled><i class=\"fa fa-picture-o\"></i></button>&nbsp;<button id=\"".$row["po_number"]."\" class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\" onclick=\"edit_po_various(this.id)\" disabled><i class=\"fa fa-pencil-square-o\"></i></button>&nbsp;</center></td></tr>";
		}
	}else{
		$tbody = "<tr><td colspan=\"12\" style=\"text-align: center;\">No data found.</td></tr>";
	}
	$in_out = create_table_pagination($page, $limit, $total_data, array("Date Received","PO No.","Items","Procurement Mode","Date Conformed","Expected Delivery Date", "Date Delivered", "Supplier", "End User", "Delivery Status", "Inspection Status", ""));
	$whole_dom = $in_out[0]."".$tbody."".$in_out[1];
	echo $whole_dom;
}

function get_iar(){
	global $conn;
	connect();

	$limit = '10';
	$page = 1;
	if($_POST["page"] > 1){
		$start = (($_POST["page"] - 1) * $limit);
		$page = $_POST["page"];
	}else{
		$start = 0;
	}
	
	$query = "SELECT DISTINCT iar_id, iar_number, po_number, req_office, res_cc FROM tbl_iar ";
	if($_POST["query"] != ""){
		$qs = mysqli_real_escape_string($conn, $_POST["query"]);
		$query.="WHERE iar_number LIKE '%$qs%' OR po_number LIKE '%$qs%' OR req_office LIKE '%$qs%' OR res_cc LIKE '%$qs%' ";
	}
	$query.="ORDER BY iar_id DESC ";

	$sql_orig = mysqli_query($conn, $query);
	$sql = mysqli_query($conn, $query."LIMIT ".$start.", ".$limit."");
	$tbody = "";
	$total_data = mysqli_num_rows($sql_orig);

	if($total_data != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$pn = $row["po_number"];
			$tbody.="<tr>
			<td>".$row["iar_id"]."</td>
			<td>".$row["po_number"]."</td>
			<td>".$row["iar_number"]."</td>
			<td>".$row["req_office"]."</td>
			<td>".$row["res_cc"]."</td>
			<td><center><button class=\"btn btn-xs btn-primary\" value=\"".$row["iar_number"]."\" onclick=\"view_iss(this.value,'tbl_iar','view_iar','IAR','iar_number','".substr($pn,0,4)."');\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Preview\" disabled><i class=\"fa fa-picture-o\"></i></button>&nbsp;<button class=\"btn btn-xs btn-success ladda-button\" data-style=\"slide-down\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Print\" value=\"".$row["iar_number"]."\" onclick=\"print_iar(this.value);\" disabled><i class=\"fa fa-print\" disabled></i></button>&nbsp;<button class=\"btn btn-xs btn-warning\" value=\"".$row["iar_number"]."\" onclick=\"download_xls(this.value);\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Save as Excel\" disabled><i class=\"fa fa-file-excel-o\"></i></button>&nbsp;|&nbsp;<button class=\"btn btn-xs\" title=\"Notice of Delivery\" onclick=\"print_nod('".$row["iar_number"]."','".$row["po_number"]."');\" disabled><i class=\"fa fa-truck\"></i></button>&nbsp;<button class=\"btn btn-xs\" title=\"Disbursement Voucher\" onclick=\"print_dv('".$row["iar_number"]."','".$row["po_number"]."');\" disabled><i class=\"fa fa-credit-card\"></i></button>&nbsp;<button class=\"btn btn-xs\" title=\"Performance Evaluation\" onclick=\"print_pe('".$row["iar_number"]."','".$row["po_number"]."');\" disabled><i class=\"fa fa-tasks\"></i></button></center></td>
			</tr>";
		}
	}else{
		$tbody = "<tr><td colspan=\"6\" style=\"text-align: center;\">No data found.</td></tr>";
	}
	$in_out = create_table_pagination($page, $limit, $total_data, array("IAR ID","PO Number","IAR Number","Requisitioning Office","Responsibility Center Code",""));
	$whole_dom = $in_out[0]."".$tbody."".$in_out[1];
	echo $whole_dom;
}

function get_ics(){
	global $conn;
	connect();

	$limit = '10';
	$page = 1;
	if($_POST["page"] > 1){
	  $start = (($_POST["page"] - 1) * $limit);
	  $page = $_POST["page"];
	}else{
	  $start = 0;
	}

	$query = "SELECT DISTINCT ics_no, area, SUBSTRING(date_released, 1, 10) AS date_r, received_from, received_by, SUBSTRING(date_supply_received, 1, 10) AS date_s, remarks, issued FROM tbl_ics ";
	if($_POST["query"] != ""){
		$qs = mysqli_real_escape_string($conn, $_POST["query"]);
		$query.="WHERE ics_no LIKE '%$qs%' OR reference_no LIKE '%$qs%' OR area LIKE '%$qs%' OR received_from LIKE '%$qs%' OR received_by LIKE '%$qs%' OR item LIKE '%$qs%' ";
	}
	$query.="ORDER BY ics_id DESC ";
	
	$sql_orig = mysqli_query($conn, $query);
	$sql = mysqli_query($conn, $query."LIMIT ".$start.", ".$limit."");
	$tbody = "";
	$total_data = mysqli_num_rows($sql_orig);
	if($total_data != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$icsn = $row["ics_no"];
			$rb = str_replace(' ', '', $row["received_by"]);
			$in = array();
			$get_items = mysqli_query($conn, "SELECT item FROM tbl_ics WHERE ics_no LIKE '$icsn'");
			while($ri = mysqli_fetch_assoc($get_items)){
				array_push($in, $ri["item"]);
			}
			$refs = array();
			$get_rf = mysqli_query($conn, "SELECT DISTINCT reference_no FROM tbl_ics WHERE ics_no LIKE '$icsn'");
			while($rf = mysqli_fetch_assoc($get_rf)){
				array_push($refs, $rf["reference_no"]);
			}
			$tbody.="<tr>
					<td><center>".(($row["issued"] == '0') ? "<button id=\"\" value=\"".$row["ics_no"]."\" class=\"btn btn-xs btn-danger\" style=\"border-radius: 10px;\" disabled>✖</button>" : "<button class=\"btn btn-xs\" style=\"border-radius: 10px; background-color: #00FF00; color: white; font-weight: bold;\" value=\"".$row["ics_no"]."\" onclick=\"modify_dr(this.value, 'ICS No. '+this.value, 'tbl_ics', 'ics_no');\" disabled>✓</button>")."</center></td>
					<td>".$row["area"]."</td>
					<td>".$row["ics_no"]."</td>
					<td style=\"font-size: 10px;\">".implode(", ", $refs)."</td>
					<td style=\"font-size: 10px;\">".implode(", ", $in)."</td>
					<td>".$row["date_r"]."</td>
					<td>".$row["received_from"]."</td>
					<td>".$row["received_by"]."</td>
					<td>".$row["date_s"]."</td>
					<td>".$row["remarks"]."</td>
					<td><center><button disabled class=\"btn btn-xs btn-primary\" value=\"".$row["ics_no"]."\" onclick=\"view_iss(this.value,'tbl_ics','view_ics','ICS','ics_no','".$rb."');\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Preview\"><i class=\"fa fa-picture-o\"></i></button>&nbsp;<button disabled class=\"btn btn-xs btn-success\" value=\"".$row["ics_no"]."\" onclick=\"print_ics(this.value);\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Print\"><i class=\"fa fa-print\"></i></button>&nbsp;<button disabled class=\"btn btn-xs btn-warning\" value=\"".$row["ics_no"]."\" onclick=\"download_xls(this.value);\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Save as Excel\"><i class=\"fa fa-file-excel-o\"></i></button></center></td>
				</tr>";
		}
	}else{
		$tbody = "<tr><td colspan=\"11\" style=\"text-align: center;\">No data found.</td></tr>";
	}
	$in_out = create_table_pagination($page, $limit, $total_data, array("","Area","ICS No.","PO No.","Items","Date Released","Received From", "Received By", "Date Supply Received", "Remarks", ""));
	$whole_dom = $in_out[0]."".$tbody."".$in_out[1];
	echo $whole_dom;
}

function get_par(){
	global $conn;
	connect();

	$limit = '10';
	$page = 1;
	if($_POST["page"] > 1){
	  $start = (($_POST["page"] - 1) * $limit);
	  $page = $_POST["page"];
	}else{
	  $start = 0;
	}

	$query = "SELECT DISTINCT par_no, area, SUBSTRING(date_released, 1, 10) AS date_r, received_from, received_by, SUBSTRING(date_supply_received, 1, 10) AS date_s, remarks, issued FROM tbl_par ";
	if($_POST["query"] != ""){
		$qs = mysqli_real_escape_string($conn, $_POST["query"]);
		$query.="WHERE par_no LIKE '%$qs%' OR reference_no LIKE '%$qs%' OR area LIKE '%$qs%' OR received_from LIKE '%$qs%' OR received_by LIKE '%$qs%' OR item LIKE '%$qs%' ";
	}
	$query.="ORDER BY par_id DESC ";

	$sql_orig = mysqli_query($conn, $query);
	$sql = mysqli_query($conn, $query."LIMIT ".$start.", ".$limit."");
	$tbody = "";
	$total_data = mysqli_num_rows($sql_orig);
	if($total_data != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$parn = $row["par_no"];
			$rb = str_replace(' ', '', $row["received_by"]);
			$in = array();
			$get_items = mysqli_query($conn, "SELECT item FROM tbl_par WHERE par_no LIKE '$parn'");
			while($ri = mysqli_fetch_assoc($get_items)){
				array_push($in, $ri["item"]);
			}
			$refs = array();
			$get_rf = mysqli_query($conn, "SELECT DISTINCT reference_no FROM tbl_par WHERE par_no LIKE '$parn'");
			while($rf = mysqli_fetch_assoc($get_rf)){
				array_push($refs, $rf["reference_no"]);
			}
			$tbody.="<tr>
					<td><center>".(($row["issued"] == '0') ? "<button id=\"\" value=\"".$row["par_no"]."\" class=\"btn btn-xs btn-danger\" style=\"border-radius: 10px;\" disabled>✖</button>" : "<button class=\"btn btn-xs\" style=\"border-radius: 10px; background-color: #00FF00; color: white; font-weight: bold;\" value=\"".$parn."\" onclick=\"modify_dr(this.value, 'PAR No. '+this.value, 'tbl_par', 'par_no');\" disabled>✓</button>")."</center></td>
					<td>".$row["area"]."</td>
					<td>".$row["par_no"]."</td>
					<td style=\"font-size: 10px;\">".implode(", ", $refs)."</td>
					<td style=\"font-size: 10px;\">".implode(", ", $in)."</td>
					<td>".$row["date_r"]."</td>
					<td>".utf8_encode($row["received_from"])."</td>
					<td>".utf8_encode($row["received_by"])."</td>
					<td>".$row["date_s"]."</td>
					<td>".$row["remarks"]."</td>
					<td><center><button disabled class=\"btn btn-xs btn-primary\" value=\"".$row["par_no"]."\" onclick=\"view_iss(this.value,'tbl_par','view_par','PAR','par_no','".$rb."');\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Preview\"><i class=\"fa fa-picture-o\"></i></button>&nbsp;<button disabled class=\"btn btn-xs btn-success\" value=\"".$row["par_no"]."\" onclick=\"print_par(this.value);\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Print\"><i class=\"fa fa-print\"></i></button>&nbsp;<button disabled class=\"btn btn-xs btn-warning\" onclick=\"download_xls('".$parn."');\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Save as Excel\"><i class=\"fa fa-file-excel-o\"></i></button></center></td>
				</tr>";
		}
	}else{
		$tbody = "<tr><td colspan=\"11\" style=\"text-align: center;\">No data found.</td></tr>";
	}
	$in_out = create_table_pagination($page, $limit, $total_data, array("","Area","PAR No.","PO No.","Items","Date Released","Received From", "Received By", "Date Supply Received", "Remarks", ""));
	$whole_dom = $in_out[0]."".$tbody."".$in_out[1];
	echo $whole_dom;
}

function get_ptr(){
	global $conn;
	connect();

	$limit = '10';
	$page = 1;
	if($_POST["page"] > 1){
	  $start = (($_POST["page"] - 1) * $limit);
	  $page = $_POST["page"];
	}else{
	  $start = 0;
	}

	$query = "SELECT DISTINCT ptr_no, area, SUBSTRING(date_released, 1, 10) AS date_r, SUBSTRING(date_supply_received,1,10) AS date_s, tbl_ptr.from, tbl_ptr.to, reason, remarks, issued, transfer_type FROM tbl_ptr ";
	if($_POST["query"] != ""){
		$qs = mysqli_real_escape_string($conn, $_POST["query"]);
		$query.="WHERE ptr_no LIKE '%$qs%' OR reference_no LIKE '%$qs%' OR tbl_ptr.from LIKE '%$qs%' OR tbl_ptr.to LIKE '%$qs%' OR transfer_type LIKE '%$qs%' OR reason LIKE '%$qs%' OR item LIKE '%$qs%' ";
	}
	$query.="ORDER BY ptr_id DESC ";

	$sql_orig = mysqli_query($conn, $query);
	$sql = mysqli_query($conn, $query."LIMIT ".$start.", ".$limit."");
	$tbody = "";
	$total_data = mysqli_num_rows($sql_orig);
	if($total_data != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$ptr_no = $row["ptr_no"];
			$category = mysqli_fetch_assoc(mysqli_query($conn, "SELECT category FROM tbl_ptr WHERE ptr_no = '$ptr_no'"))["category"];
			$func_call = ($category == "Drugs and Medicines" || $category == "Medical Supplies") ? "print_ptr(this.value);" : "print_ptr_gen(this.value)";
			$dl_xls = ($category == "Drugs and Medicines" || $category == "Medical Supplies") ? "download_xls(this.value);" : "download_xls_gen(this.value)";
			$to = str_replace(' ', '', $row["to"]);

			$in = array();			
			$get_items = mysqli_query($conn, "SELECT item FROM tbl_ptr WHERE ptr_no LIKE '$ptr_no'");
			while($ri = mysqli_fetch_assoc($get_items)){
				array_push($in, $ri["item"]);
			}
			$refs = array();
			$get_rf = mysqli_query($conn, "SELECT DISTINCT reference_no FROM tbl_ptr WHERE ptr_no LIKE '$ptr_no'");
			while($rf = mysqli_fetch_assoc($get_rf)){
				array_push($refs, $rf["reference_no"]);
			}
			$tbody.="<tr>
					<td><center>".(($row["issued"] == '0') ? "<button id=\"\" value=\"".$row["ptr_no"]."\" class=\"btn btn-xs btn-danger\" style=\"border-radius: 10px;\" disabled>✖</button>" : "<button class=\"btn btn-xs\" style=\"border-radius: 10px; background-color: #00FF00; color: white; font-weight: bold;\" value=\"".$row["ptr_no"]."\" onclick=\"modify_dr(this.value, 'PTR No. '+this.value, 'tbl_ptr', 'ptr_no');\" disabled>✓</button>")."</center></td>
					<td>".$row["ptr_no"]."</td>
					<td style=\"font-size: 10px;\">".implode(", ", $refs)."</td>
					<td style=\"font-size: 10px;\">".implode(", ", $in)."</td>
					<td>".$row["from"]."</td>
					<td>".$row["to"]."</td>
					<td>".$row["date_r"]."</td>
					<td>".$row["date_s"]."</td>
					<td>".$row["transfer_type"]."</td>
					<td>".$row["reason"]."</td>
					<td><center><button disabled class=\"btn btn-xs btn-primary\" value=\"".$row["ptr_no"]."\" onclick=\"view_iss(this.value,'tbl_ptr','view_ptr','PTR','ptr_no','".$to."');\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Preview\"><i class=\"fa fa-picture-o\"></i></button>&nbsp;<button disabled value=\"".$row["ptr_no"]."\" onclick=\"".$func_call."\" class=\"btn btn-xs btn-success\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Print\"><i class=\"fa fa-print\"></i></button>&nbsp;<button disabled class=\"btn btn-xs btn-warning\" value=\"".$row["ptr_no"]."\" onclick=\"".$dl_xls."\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Save as Excel\"><i class=\"fa fa-file-excel-o\"></i></button></center></td>
				</tr>";
		}
	}else{
		$tbody="<tr><td colspan=\"11\" style=\"text-align: center;\">No data found.</td></tr>";
	}
	$in_out = create_table_pagination($page, $limit, $total_data, array("","PTR No.","PO No.","Items","From","To","Date Released","Date Received", "Transfer Type", "Reason", ""));
	$whole_dom = $in_out[0]."".$tbody."".$in_out[1];
	echo $whole_dom;
}

function get_ris(){
	global $conn;
	connect();

	$limit = '10';
	$page = 1;
	if($_POST["page"] > 1){
	  $start = (($_POST["page"] - 1) * $limit);
	  $page = $_POST["page"];
	}else{
	  $start = 0;
	}

	$query = "SELECT DISTINCT ris_no,division,office,SUBSTRING(tbl_ris.date,1,10) AS d,requested_by,issued_by,purpose, issued FROM tbl_ris ";
	if($_POST["query"] != ""){
		$qs = mysqli_real_escape_string($conn, $_POST["query"]);
		$query.="WHERE ris_no LIKE '%$qs%' OR reference_no LIKE '%$qs%' OR division LIKE '%$qs%' OR office LIKE '%$qs%' OR requested_by LIKE '%$qs%' OR purpose LIKE '%$qs%' OR item LIKE '%$qs%' ";
	}
	$query.="ORDER BY ris_id DESC ";

	$sql_orig = mysqli_query($conn, $query);
	$sql = mysqli_query($conn, $query."LIMIT ".$start.", ".$limit."");
	$tbody = "";
	$total_data = mysqli_num_rows($sql_orig);
	if($total_data != 0){
		while($row = mysqli_fetch_assoc($sql)){
			$rb = str_replace(' ', '', $row["requested_by"]);
			$ris_no = $row["ris_no"];
			$category = mysqli_fetch_assoc(mysqli_query($conn, "SELECT category FROM tbl_ris WHERE ris_no = '$ris_no'"))["category"];
			$call_print = ($category != "Drugs and Medicines" && $category != "Medical Supplies") ? "print_ris(this.value);" : "print_ris_dm(this.value);";
			$call_excel = ($category != "Drugs and Medicines" && $category != "Medical Supplies") ? "download_xls(this.value);" : "download_xls_dm(this.value);";

			$in = array();
			$get_items = mysqli_query($conn, "SELECT item FROM tbl_ris WHERE ris_no LIKE '$ris_no'");
			while($ri = mysqli_fetch_assoc($get_items)){
				array_push($in, $ri["item"]);
			}
			$refs = array();
			$get_rf = mysqli_query($conn, "SELECT DISTINCT reference_no FROM tbl_ris WHERE ris_no LIKE '$ris_no'");
			while($rf = mysqli_fetch_assoc($get_rf)){
				array_push($refs, $rf["reference_no"]);
			}
			$tbody.="<tr>
					<td><center>".(($row["issued"] == '0') ? "<button id=\"\" value=\"".$row["ris_no"]."\" class=\"btn btn-xs btn-danger\" style=\"border-radius: 10px;\" disabled>✖</button>" : "<button class=\"btn btn-xs\" style=\"border-radius: 10px; background-color: #00FF00; color: white; font-weight: bold;\" value=\"".$row["ris_no"]."\" onclick=\"modify_dr(this.value, 'RIS No. '+this.value, 'tbl_ris', 'ris_no');\" disabled>✓</button>")."</center></td>
					<td>".$row["ris_no"]."</td>
					<td>".$row["division"]."</td>
					<td>".$row["office"]."</td>
					<td style=\"font-size: 10px;\">".implode(", ", $refs)."</td>
					<td style=\"font-size: 10px;\">".implode(", ", $in)."</td>
					<td>".$row["d"]."</td>
					<td>".utf8_encode($row["requested_by"])."</td>
					<td>".utf8_encode($row["issued_by"])."</td>
					<td>".$row["purpose"]."</td>
					<td><center><button disabled class=\"btn btn-xs btn-primary\" value=\"".$row["ris_no"]."\" onclick=\"view_iss(this.value,'tbl_ris','view_ris','RIS','ris_no','".$rb."');\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Preview\"><i class=\"fa fa-picture-o\"></i></button>&nbsp;<button disabled class=\"btn btn-xs btn-success\" value=\"".$row["ris_no"]."\" onclick=\"".$call_print."\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Print\"><i class=\"fa fa-print\"></i></button>&nbsp;<button disabled class=\"btn btn-xs btn-warning\" value=\"".$row["ris_no"]."\" onclick=\"".$call_excel."\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Save as Excel\"><i class=\"fa fa-file-excel-o\"></i></button></center></td>
				</tr>";
		}
	}else{
		$tbody="<tr><td colspan=\"11\" style=\"text-align: center;\">No data found.</td></tr>";
	}
	$in_out = create_table_pagination($page, $limit, $total_data, array("","RIS No.","Division","Office","PO No.","Items","Date Released","Requested By", "Issued By", "Purpose", ""));
	$whole_dom = $in_out[0]."".$tbody."".$in_out[1];
	echo $whole_dom;
}

function get_ppe_details(){
	global $conn;
	connect();

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

function get_rsmi_details(){
	global $conn;
	connect();

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


$call_func = $_POST["call_func"];
switch($call_func){
	case "login":
		login();
		break;
	case "connect":
		connect();
		break;
	case "get_purchase_orders":
		get_purchase_orders();
		break;
	case "get_iar":
		get_iar();
		break;
	case "get_ics":
		get_ics();
		break;
	case "get_par":
		get_par();
		break;
	case "get_ptr":
		get_ptr();
		break;
	case "get_ris":
		get_ris();
		break;
	case "get_ppe_details":
		get_ppe_details();
		break;
	case "get_rsmi_details":
		get_rsmi_details();
		break;
	case "login":
		login();
		break;
	case "get_distinct_users":
		get_distinct_users();
		break;
	case "get_user_items":
		get_user_items();
		break;
}

?>