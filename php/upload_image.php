<?php

require "php_conn.php";

if(isset($_GET['files'])) {
	$po_number = mysqli_real_escape_string($conn, $_GET["po_no"]);
	$eu = mysqli_real_escape_string($conn, $_GET["eu"]);
	$error = false;
	$uploaddir = "../../archives/po/".substr($po_number,0,4)."/".$eu."/";
	if(!is_dir($uploaddir)){
		mkdir($uploaddir, 0777, true);
	}

	foreach($_FILES as $file){
		$fileName = mysqli_real_escape_string($conn, str_replace(' ', '', $file['name']));
		if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name']))){
			mysqli_query($conn, "UPDATE tbl_po SET view_po = '$fileName' WHERE po_number LIKE '$po_number'");
			$error = false;
		}else{
		    $error = true;
		}
		rename($uploaddir."/".$file['name'], $uploaddir."/".str_replace(' ', '', $file['name']));
		echo str_replace(' ', '', $file['name']);
	}
}
?>