<?php

require "../../php/php_conn.php";
require "../../php/php_general_functions.php";

session_start();

function print_gatepass() {
    global $conn;
}

function get_items_issuances(){
    global $conn;

    $table = mysqli_real_escape_string($conn, $_POST["table"]);
    $field = mysqli_real_escape_string($conn, $_POST["field"]);
    $issuances = $_POST["issuances"];

    if (!empty($issuances) && is_array($issuances)) {
        $sanitized_issuances = array_map(function($issuance) use ($conn) {
            return "'" . mysqli_real_escape_string($conn, $issuance) . "'";
        }, $issuances);

        $issuances_list = implode(',', $sanitized_issuances);

        $sql = "SELECT * FROM $table WHERE $field IN ($issuances_list)";
        $result = mysqli_query($conn, $sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        echo json_encode($data);
    } else {
        echo json_encode(["error" => "No data found."]);
    }
}

function get_issuance_no(){
    global $conn;

    $table = mysqli_real_escape_string($conn, $_POST["table"]);
    $field = mysqli_real_escape_string($conn, $_POST["field"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    $sql = mysqli_query($conn, "SELECT DISTINCT ".$field." FROM ".$table." ORDER BY ".$id." DESC");
    $options = "";
    if(mysqli_num_rows($sql) != 0){
        while($row = mysqli_fetch_assoc($sql)){
            $options.="<option value=".$row[$field].">".$row[$field]."</option>";
        }	
    }
    echo $options;

}

function get_latest_gatepass(){
	global $conn;

	$yy_mm = date('Y-m');
	$sql = mysqli_query($conn, "SELECT DISTINCT control_number FROM tbl_gatepass WHERE control_number LIKE '%$yy_mm%' ORDER BY id DESC LIMIT 1");
	if(mysqli_num_rows($sql) != 0){
		$row = mysqli_fetch_assoc($sql);
		echo str_pad(((int)end(explode("-", $row["control_number"]))) + 1, 3, '0', STR_PAD_LEFT);
	}else{
		echo "001";
	}
}

function delete_gatepass(){
    global $conn;
}

function update_gatepass(){
    global $conn;
}

function insert_gatepass() {
    global $conn;
}

function get_gatepass(){
    global $conn;

    if(!$conn) {
        echo "<table class=\"table table-bordered\">
                <tr><th style=\"border: 2px solid black;\" colspan=\"10\">Not connected to the server.</th></tr>
              </table>";
        return;
    }

    $limit = 10;
    $page = max(1, (int)$_POST["page"]);
    $start = ($page - 1) * $limit;
    $search = mysqli_real_escape_string($conn, $_POST["search"]);
    
    $query = "SELECT * FROM tbl_gatepass";
    if($search != "") {
        $query .= " WHERE control_number LIKE '%$search%' OR authorized_personnel LIKE '%$search%' OR plate_number LIKE '%$search%' OR driver LIKE '%$search%' OR vehicle_type LIKE '%$search%' OR checked_by LIKE '%$search%'";
    }

    $sql_orig = mysqli_query($conn, $query);
    $total_data = mysqli_num_rows($sql_orig);

    $query .= " ORDER BY id DESC LIMIT $start, $limit";
    $sql = mysqli_query($conn, $query);

    $tbody = "";
    if($total_data > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $tbody .= "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['control_number']}</td>
                        <td>{$row['authorized_personnel']}</td>
                        <td>{$row['plate_number']}</td>
                        <td>{$row['driver']}</td>
                        <td>{$row['vehicle_type']}</td>
                        <td>{$row['checked_by']}</td>
                        <td>{$row['approved_by']}</td>
                        <td>{$row['created_at']}</td>
                        <td>
                            <center>
                                <button id=\"{$row['id']}\" class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" title=\"Print\" onclick=\"print_rfi(this.id);\">
                                    <i class=\"fa fa-print\"></i>
                                </button>
                                <button id=\"{$row['id']}\" class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Delete\" onclick=\"delete_rfi(this.id);\">
                                    <i class=\"fa fa-trash\"></i>
                                </button>
                            </center>
                        </td>
                    </tr>";
        }
    } else {
        $tbody = "<tr><td colspan=\"10\" style=\"text-align: center;\">No data found.</td></tr>";
    }

    $pagination = create_table_pagination($page, $limit, $total_data, ["ID", "Control#", "Authorized Personnel", "Plate#", "Driver", "Vehicle Type", "Checked by", "Approved by", "Created at", ""]);
    echo $pagination[0] . $tbody . $pagination[1];
}


$call_func = mysqli_real_escape_string($conn, $_POST["call_func"]);
if ($call_func === "get_gatepass") {
    get_gatepass();
}elseif($call_func === "get_latest_gatepass"){
    get_latest_gatepass();
}elseif($call_func === "get_issuance_no"){
    get_issuance_no();
}elseif($call_func === "get_items_issuances"){
    get_items_issuances();
}

?>
