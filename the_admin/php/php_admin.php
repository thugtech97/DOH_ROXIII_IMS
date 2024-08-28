<?php

require "../../php/php_conn.php";

function save_user(){
	global $connhr;
	$user = mysqli_real_escape_string($connhr, $_POST["user"]);
	$role = mysqli_real_escape_string($connhr, $_POST["role"]);
	$uname = mysqli_real_escape_string($connhr, $_POST["uname"]);
	$pword = mysqli_real_escape_string($connhr, $_POST["pword"]);
	mysqli_query($connhr, "UPDATE tbl_employee SET username = '$uname', password = AES_ENCRYPT('$pword', 'pass'), role = '$role' WHERE emp_id LIKE '$user'");
}

function get_active_users(){
	global $connhr;
	$sql = mysqli_query($connhr, "SELECT prefix,fname,mname,lname,suffix,role FROM tbl_employee WHERE username <> '' OR password <> ''");
	if(mysqli_num_rows($sql) != 0){
		while($row = mysqli_fetch_array($sql)){
			echo "<tr>
					<td>".(($row["prefix"] != null) ? $row["prefix"]." " : "")."".utf8_encode($row["fname"])." ".utf8_encode($row["mname"][0]).". ".utf8_encode($row["lname"])."".(($row["suffix"] != null) ? ", ".$row["suffix"] : "")."</td>
					<td>".$row["role"]."</td>
					<td><center><button class=\"btn btn-xs btn-info\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\"><i class=\"fa fa-pencil-square-o\"></i></button>&nbsp;<button class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\"><i class=\"fa fa-trash\"></i></button></center></td>
				</tr>";
		}
	}
}

$call_func = mysqli_real_escape_string($conn, $_POST["call_func"]);
switch($call_func){
	case "get_active_users":
		get_active_users();
		break;
	case "save_user":
		save_user();
		break;
}

?>