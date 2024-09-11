<?php

require "../../php/php_conn.php";
require "../../php/php_general_functions.php";

session_start();

function print_gatepass() {
    global $conn;

    $table_field = ["ICS" => ["tbl_ics", "ics_id"], "PAR" => ["tbl_par", "par_id"], "PTR" => ["tbl_ptr", "ptr_id"], "RIS" => ["tbl_ris", "ris_id"]];

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $sql = mysqli_query($conn, "SELECT * FROM tbl_gatepass WHERE id = '$id'");
    
    if(mysqli_num_rows($sql) != 0) {
        $data = mysqli_fetch_assoc($sql);
        
        $gatepass_id = $data['id'];
        $sql_details = mysqli_query($conn, "SELECT * FROM tbl_gatepass_details WHERE gatepass_id = '$gatepass_id'");

        $items = [];
        if(mysqli_num_rows($sql_details) > 0) {
            while($row = mysqli_fetch_assoc($sql_details)) {
                $issuance_id = $row['issuance_id'];
                $issuance_type = $row['issuance_type'];

                if (array_key_exists($issuance_type, $table_field)) {
                    $table = $table_field[$issuance_type][0];
                    $field = $table_field[$issuance_type][1];

                    $sql_items = mysqli_query($conn, "SELECT * FROM $table WHERE $field = '$issuance_id'");
                    if ($sql_items && mysqli_num_rows($sql_items) > 0) {
                        $issuance_data = mysqli_fetch_assoc($sql_items);
                        $merged_data = array_merge($row, $issuance_data);
                        $items[] = $merged_data;
                    } else {
                        $items[] = ["error" => "No matching issuance found for ID $issuance_id in $table."];
                    }
                } else {
                    $items[] = ["error" => "Invalid issuance type: $issuance_type"];
                }
            }
        }
        $response = [
            'gatepass' => $data,
            'items' => $items
        ];
        echo json_encode($response);

    } else {
        echo json_encode(["error" => "No data found."]);
    }
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

function get_employee() {
    global $connhr;
    $sql = mysqli_query($connhr, "
        SELECT e.*, d.designation 
        FROM tbl_employee e 
        LEFT JOIN ref_designation d ON e.designation_fid = d.designation_id 
        WHERE e.status LIKE 'Active' 
        ORDER BY e.fname ASC
    ");
    if (mysqli_num_rows($sql) != 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            // Construct the full name
            $full_name = (($row["prefix"] != null) ? $row["prefix"] . " " : "") .
                         $row["fname"] . " " .
                         (($row["mname"] != null) ? $row["mname"][0] . ". " : "") .
                         $row["lname"] .
                         (($row["suffix"] != null) ? ", " . $row["suffix"] : "");
            echo "<option value=\"" . $full_name . "|" . $row["designation"] . "\">" . $full_name . "</option>";
        }
    }
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

    // Escape and sanitize non-array POST data
    $control_number = mysqli_real_escape_string($conn, $_POST['control_number']);
    $authorized_personnel = mysqli_real_escape_string($conn, $_POST['authorized_personnel']);
    $driver = mysqli_real_escape_string($conn, $_POST['driver']);
    $plate_number = mysqli_real_escape_string($conn, $_POST['plate_number']);
    $vehicle_type = mysqli_real_escape_string($conn, $_POST['vehicle_type']);
    $checked_by = mysqli_real_escape_string($conn, $_POST['checked_by']);
    $approved_by = mysqli_real_escape_string($conn, $_POST['approved_by']);

    $issuance_id = $_POST['issuance_id'];
    $issuance_no = $_POST['issuance_no'];
    $program = $_POST['program'];
    $purpose = $_POST['purpose'];

    $sql = "INSERT INTO tbl_gatepass (control_number, authorized_personnel, driver, plate_number, vehicle_type, checked_by, approved_by) 
            VALUES ('$control_number', '$authorized_personnel', '$driver', '$plate_number', '$vehicle_type', '$checked_by', '$approved_by')";

    if (mysqli_query($conn, $sql)) {
        $gatepass_id = mysqli_insert_id($conn);

        for ($i = 0; $i < count($issuance_id); $i++) {
            $issuance_data = explode("#", $issuance_no[$i]);
            $issuance_type = $issuance_data[0];
            $issuance_number = $issuance_data[1];

            $details_sql = "INSERT INTO tbl_gatepass_details 
                            (gatepass_id, issuance_id, issuance_type, issuance_number, issuance_program, issuance_purpose) 
                            VALUES ('$gatepass_id', 
                                    '".mysqli_real_escape_string($conn, $issuance_id[$i])."', 
                                    '".mysqli_real_escape_string($conn, $issuance_type)."', 
                                    '".mysqli_real_escape_string($conn, $issuance_number)."', 
                                    '".mysqli_real_escape_string($conn, $program[$i])."', 
                                    '".mysqli_real_escape_string($conn, $purpose[$i])."')";

            if (!mysqli_query($conn, $details_sql)) {
                echo json_encode(["error" => mysqli_error($conn)]);
            }
        }

        echo json_encode(["success" => "Data inserted successfully."]);
    } else {
        echo json_encode(["error" => mysqli_error($conn)]);
    }
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
                                <button id=\"{$row['id']}\" class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" title=\"Print\" onclick=\"print_gatepass(this.id);\">
                                    <i class=\"fa fa-print\"></i>
                                </button>
                                <button id=\"{$row['id']}\" class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Delete\" onclick=\"delete_gatepass(this.id);\">
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
}elseif($call_func === "insert_gatepass"){
    insert_gatepass();
}elseif($call_func === "get_employee"){
    get_employee();
}elseif($call_func === "print_gatepass"){
    print_gatepass();
}

?>
