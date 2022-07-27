<?php

$DBHOST = "eprocurement.dohcaraga.org";
$DBUSER = "jude";
$DBPASS = "jude_Admin123!";
$DBNAME = "eprocurement";

$conn_eprocurement = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);

$DBHOST_ = "128.199.78.112:3306";
$DBUSER_ = "jude";
$DBPASS_ = "jude_Admin123!";
$DBNAME_ = "epabs";

$conn_epabs = mysqli_connect($DBHOST_, $DBUSER_, $DBPASS_, $DBNAME_);

/*

$query = "SELECT DISTINCT pr_code, division, office, pr_no, prepared_user_name, pr_purpose FROM tbl_pr WHERE pr_no <> '' ";
$query.="ORDER BY created_at ASC ";

$sql_orig = mysqli_query($conn_epabs, $query);

while($row = mysqli_fetch_assoc($sql_orig)){
	echo $row["pr_code"]."</br>";
}

*/

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