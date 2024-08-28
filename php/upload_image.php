<?php

require "php_conn.php";
error_reporting(E_ALL ^ E_WARNING);

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

		$view_po = mysqli_fetch_assoc(mysqli_query($conn, "SELECT view_po FROM tbl_po WHERE po_number = '$po_number'"))["view_po"];
		if($view_po == ""){
			if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name']))){
				mysqli_query($conn, "UPDATE tbl_po SET view_po = '$fileName' WHERE po_number LIKE '$po_number'");
				$error = false;
			}else{
			    $error = true;
			}
			rename($uploaddir."/".$file['name'], $uploaddir."/".str_replace(' ', '', $file['name']));
			echo str_replace(' ', '', $file['name']);
		}else{
			$fileArray = array();
			if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name']))){
				rename($uploaddir."/".$file['name'], $uploaddir.str_replace(' ', '', $file['name']));
				mkdir($uploaddir."temp/", 0777, true);
				rename($uploaddir.$view_po, $uploaddir.'temp/'.pathinfo($uploaddir.$view_po, PATHINFO_BASENAME));
				unlink($uploaddir.$view_po);
				
				array_push($fileArray, $uploaddir.'temp/'.$view_po);
				array_push($fileArray, $uploaddir.str_replace(' ', '', $file['name']));

				$cmd = '"C:\Program Files\gs\gs9.53.3\bin\gswin64c.exe" -dNOPAUSE -sDEVICE=pdfwrite -sOUTPUTFILE='.$uploaddir.$view_po.' -dBATCH ';
				foreach($fileArray as $filed) {
				    $cmd .= $filed.' ';
				}
				shell_exec($cmd);
				unlink($uploaddir."temp/".$view_po);
				echo $view_po;

				$error = false;
			}else{
			    $error = true;
			}
		}
	}
}

/*
	
*/

?>

