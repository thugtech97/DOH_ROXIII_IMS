<?php

require "php_conn.php";

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
		$uploaddir = "../../archives/".$iss."/".$rb."/";
	}
	
	if(!is_dir($uploaddir)){
		mkdir($uploaddir, 0777, true);
	}

	foreach($_FILES as $file){
		$fileName = mysqli_real_escape_string($conn, $file['name']);
		if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name']))){
			mysqli_query($conn, "UPDATE ".$table." SET ".$field." = '$fileName' WHERE ".$iss_field." LIKE '".$iss_number."'");
			$error = false;
		}else{
		    $error = true;
		}
		echo $file['name'];
	}
}

?>