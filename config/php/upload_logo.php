<?php

require "../../php/php_conn.php";

if(isset($_GET['files'])) {
	$error = false;
	$uploaddir = "../../../archives/img/";
	$id = $_GET["id"];
	if(!is_dir($uploaddir)){
		mkdir($uploaddir, 0777, true);
	}

	foreach($_FILES as $file){
		$fileName = mysqli_real_escape_string($conn,$file['name']);
		if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name']))){
			mysqli_query($conn, "UPDATE config SET company_logo = '$fileName' WHERE id='$id'");
			$error = false;
		}else{
		    $error = true;
		}
		//rename($uploaddir."/".$file['name'], $uploaddir."/".str_replace(' ', '', $file['name']));
		echo $file['name'];
	}
}
?>