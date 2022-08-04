<?php

require "php_conn.php";
session_start();

if(isset($_GET['files'])) {
	$iss_number = mysqli_real_escape_string($conn, $_GET["iss_number"]);
	$table = mysqli_real_escape_string($conn, $_GET["table"]);
	$field = mysqli_real_escape_string($conn, $_GET["field"]);
	$iss = mysqli_real_escape_string($conn, $_GET["iss"]);
	$iss_field = mysqli_real_escape_string($conn, $_GET["iss_field"]);
	$rb = mysqli_real_escape_string($conn, $_GET["rb"]);
	$uploaddir = "";
	$error = false;
	if($iss != "IAR"){
		$uploaddir = "../../archives/".$iss."/".substr($iss_number,0,4)."/".$rb."/";
	}else{
		$uploaddir = "../../archives/".$iss."/".str_replace(' ', '', $rb)."/";
	}
	
	if(!is_dir($uploaddir)){
		mkdir($uploaddir, 0777, true);
	}

	foreach($_FILES as $file){
		$fileName = mysqli_real_escape_string($conn, str_replace(' ', '', $file['name']));
		if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name']))){
			mysqli_query($conn, "UPDATE ".$table." SET ".$field." = '$fileName' WHERE ".$iss_field." LIKE '".$iss_number."'");
			$error = false;
		}else{
		    $error = true;
		}
		
		$emp_id = $_SESSION["emp_id"];
		$description = $_SESSION["username"]." uploaded a PDF Preview for ".$iss." No. ".$iss_number;
		mysqli_query($conn, "INSERT INTO tbl_logs(emp_id,description) VALUES('$emp_id','$description')");

		rename($uploaddir."/".$file['name'], $uploaddir."/".str_replace(' ', '', $file['name']));
		echo str_replace(' ', '', $file['name']);
	}
}

?>