<?php

require "php_conn.php";
require "php_general_functions.php";

function get_groups(){
    global $conn;

    if(!$conn) {
        echo "<table class=\"table table-bordered\">
                <tr><th colspan=\"5\">Not connected to the server.</th></tr>
              </table>";
        return;
    }

    $limit = 10;
    $page = max(1, (int)$_POST["page"]);
    $start = ($page - 1) * $limit;
    $search = mysqli_real_escape_string($conn, $_POST["search"]);
    
    $query = "SELECT * FROM tbl_inspectorate_group";
    if($search != "") {
        $query .= " WHERE name LIKE '%$search%'";
    }

    $sql_orig = mysqli_query($conn, $query);
    $total_data = mysqli_num_rows($sql_orig);

    $query .= " LIMIT $start, $limit";
    $sql = mysqli_query($conn, $query);

    $tbody = "";
    if($total_data > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $group_id = $row['id'];
            
            $member_query = "SELECT * FROM tbl_inspectorate_members WHERE group_id = '$group_id'";
            $member_result = mysqli_query($conn, $member_query);
            $members = [];
            $data_members = [];
            while($member_row = mysqli_fetch_assoc($member_result)) {
                $members[] = $member_row['name'];
                $data_members[] = array("id"=>$member_row['id'], "name" =>$member_row['name'], "designation"=>$member_row['designation']);
            }
            $members_list = implode(', ', $members);
            $data_members_json = htmlspecialchars(json_encode($data_members), ENT_QUOTES, 'UTF-8');
            
            $tbody .= "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td style=\"font-size: 10px;\">$members_list</td>
                        <td>{$row['created_at']}</td>
                        <td>
                            <center>
                                <button id=\"{$row['id']}\" class=\"btn btn-xs btn-info dim\" data-toggle=\"tooltip\" title=\"View\" onclick=\"edit_group(this.id, '".$row['name']."', $data_members_json);\">
                                    <i class=\"fa fa-edit\"></i>
                                </button>
                                <button id=\"{$row['id']}\" class=\"btn btn-xs btn-danger dim\" data-toggle=\"tooltip\" title=\"View\" onclick=\"delete_group(this.id);\">
                                    <i class=\"fa fa-trash\"></i>
                                </button>
                            </center>
                        </td>
                    </tr>";
        }
    } else {
        $tbody = "<tr><td colspan=\"5\" style=\"text-align: center;\">No data found.</td></tr>";
    }

    $pagination = create_table_pagination($page, $limit, $total_data, ["Group ID", "Group Name", "Inspectors", "Date Created", ""]);
    echo $pagination[0] . $tbody . $pagination[1];
}

function insert_group($group_name, $inspector_names, $designations){
    global $conn;

    $query = "INSERT INTO tbl_inspectorate_group (name) VALUES ('$group_name')";
    
    if (mysqli_query($conn, $query)) {
        $group_id = mysqli_insert_id($conn);

        foreach ($inspector_names as $index => $inspector_name) {
            $designation = isset($designations[$index]) ? $designations[$index] : '';
            $inspector_query = "INSERT INTO tbl_inspectorate_members (group_id, name, designation) VALUES ('$group_id', '$inspector_name', '$designation')";
            mysqli_query($conn, $inspector_query);
        }

        echo "INSERTED";
    } else {
        echo "Error inserting group: " . mysqli_error($conn);
    }
}

function save_group() {
    global $conn;

    $group_id = mysqli_real_escape_string($conn, $_POST["group_id"]);
    $group_name = mysqli_real_escape_string($conn, $_POST["group_name"]);
    $inspector_names = $_POST["inspector_name"];
    $designations = $_POST["designation"];
    $existing_inspector_ids = $_POST["id"];

    $update_query = "UPDATE tbl_inspectorate_group SET name = '$group_name' WHERE id = '$group_id'";
    mysqli_query($conn, $update_query);

    $submitted_inspector_ids = [];

    foreach ($inspector_names as $index => $inspector_name) {
        $designation = isset($designations[$index]) ? mysqli_real_escape_string($conn, $designations[$index]) : '';
        $inspector_name = mysqli_real_escape_string($conn, $inspector_name);

        if (!empty($inspector_name)) {
            if (isset($existing_inspector_ids[$index]) && !empty($existing_inspector_ids[$index])) {
                $inspector_id = mysqli_real_escape_string($conn, $existing_inspector_ids[$index]);
                $inspector_update_query = "UPDATE tbl_inspectorate_members SET name = '$inspector_name', designation = '$designation' WHERE id = '$inspector_id'";
                mysqli_query($conn, $inspector_update_query);
                $submitted_inspector_ids[] = $inspector_id;
            } else {
                $inspector_insert_query = "INSERT INTO tbl_inspectorate_members (group_id, name, designation) VALUES ('$group_id', '$inspector_name', '$designation')";
                mysqli_query($conn, $inspector_insert_query);
                $submitted_inspector_ids[] = mysqli_insert_id($conn);
            }
        }
    }

    $delete_query = "DELETE FROM tbl_inspectorate_members WHERE group_id = '$group_id' AND id NOT IN (" . implode(",", array_map('intval', $submitted_inspector_ids)) . ")";
    mysqli_query($conn, $delete_query);

    echo "Group saved successfully!";
}

function delete_group(){
    global $conn;

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    mysqli_query($conn, "DELETE FROM tbl_inspectorate_group WHERE id = '$id'");
    mysqli_query($conn, "DELETE FROM tbl_inspectorate_members WHERE group_id = '$id'");
}


$call_func = mysqli_real_escape_string($conn, $_POST["call_func"]);
if ($call_func === "get_groups") {
    get_groups();

} elseif ($call_func === "insert_group") {
    $group_name = mysqli_real_escape_string($conn, $_POST["group_name"]);
    $inspector_names = $_POST["inspector_name"];
    $designations = $_POST["designation"];
    insert_group($group_name, $inspector_names, $designations);

} elseif ($call_func === "save_group") {
    save_group();
} elseif ($call_func === "delete_group") {
    delete_group();
}

?>
