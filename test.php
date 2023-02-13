<!DOCTYPE html>
<html>
<head>
<title>TEST</title>
</head>

<body>

<table border="1">

<?php
	
	require "supply_records/php/SimpleXLSX.php";
	
	error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

	$conn = mysqli_connect("localhost","root","","supply");
	$uploaddir = "the_admin/JANUARY 2023 INVENTORY.xlsx";
	
	if($xlsx = SimpleXLSX::parse($uploaddir)){
		foreach($xlsx->rows(0) as $elt){
			if($elt[1] != "" && $elt[5] != "" && $elt[7] != ""){
				$quan = $elt[7]." ".$elt[8];
				$po = $elt[1]; $ln = $elt[5];
				$sql = mysqli_query($conn, "UPDATE tbl_po SET quantity = '$quan' WHERE po_number LIKE '%$po%' AND sn_ln LIKE '%$ln%'");
				echo "<tr>
						<td>".$elt[1]."</td>
						<td>".$elt[5]."</td>
						<td>".$elt[7]."</td>
						<td>".$elt[8]."</td>
					</tr>";
			}
		}
	}

?>

</table>

</body>
</html>