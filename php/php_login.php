<?php

require "php_conn.php";

session_start();

$username = mysqli_real_escape_string($connhr, $_POST["username"]);
$password = mysqli_real_escape_string($connhr, $_POST["password"]);

$sql = mysqli_query($connhr, "SELECT * FROM tbl_employee WHERE username = '$username' AND password = AES_ENCRYPT('$password', 'pass') AND (role = 'CMT - III' OR role = 'FINANCE' OR role = 'SUPPLY' OR role = 'SUPPLY_SU')");


if(mysqli_num_rows($sql) != 0){
	$row = mysqli_fetch_assoc($sql);
	$_SESSION["emp_id"] = $row["emp_id"];
	$_SESSION["username"] = $username;
	$_SESSION["emp_name"] = $row["fname"]." ".($row["mname"] != null ? $row["mname"][0].". ": "")."".$row["lname"];
	$_SESSION["role"] = $row["role"];
	$_SESSION["link0"] = "Dashboards";
	$_SESSION["link1"] = "Supply Records";
	$_SESSION["link2"] = "Reference Tables";
	$_SESSION["link3"] = "Stock Card";
	$_SESSION["link4"] = "Archive";
	echo "1";
}else{
	echo "0";
}

?>
