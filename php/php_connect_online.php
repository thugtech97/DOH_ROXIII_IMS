<?php

$DBHOST = "128.199.78.112:3306";
$DBUSER = "jude";
$DBPASS = "jude_Admin123!";
$DBNAME = "epabs";

/*

$connect_epabs = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);

if($connect_epabs){
	echo "connected";
}else{
	echo "not connected";
}

*/

$conn_epabs = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);

/*

$listdbtables = array_column($conn_epabs->query('SHOW TABLES')->fetch_all(),0);
print_r($listdbtables);

echo "<br><br>===================================================================================================";

$sql = mysqli_query($conn_epabs, "SELECT * FROM tbl_pr_details");

while($row = mysqli_fetch_assoc($sql)){
	$json_pretty = json_encode($row, JSON_PRETTY_PRINT);
	echo "<pre>".$json_pretty."<pre/>";
}

*/

?>