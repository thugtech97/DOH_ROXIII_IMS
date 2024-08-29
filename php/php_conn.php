<?php

$set = 0;

$server = ($set == 0) ? "localhost" : "192.168.1.15";
$username = ($set == 0) ? "root" : "root";
$password = ($set == 0) ? "" : "";

$conn = mysqli_connect($server, $username, $password, "supply");
$connhr = mysqli_connect($server, $username, $password, "hr");

?>
