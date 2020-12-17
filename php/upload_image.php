<?php

require "php_conn.php";

if(isset($_GET['files'])) {
	$po_number = mysqli_real_escape_string($conn, $_GET["po_no"]);
	$error = false;
	$uploaddir = "../../archives/po/".substr($po_number,0,4)."/";
	if(!is_dir($uploaddir)){
		mkdir($uploaddir);
	}

	foreach($_FILES as $file){
		$fileName = mysqli_real_escape_string($conn, $file['name']);
		if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name']))){
			mysqli_query($conn, "UPDATE tbl_po SET view_po = '$fileName' WHERE po_number LIKE '$po_number'");
			$error = false;
		}else{
		    $error = true;
		}

		echo $file['name'];
	}
}
?>