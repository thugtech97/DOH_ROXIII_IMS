<?php

$set = 0;

$server = ($set == 0) ? "localhost" : "192.168.5.30";
$username = ($set == 0) ? "root" : "epabs";
$password = ($set == 0) ? "" : "epabsystem";

$conn = mysqli_connect($server, $username, $password, "supply");
$connhr = mysqli_connect($server, $username, $password, "hr");

?>