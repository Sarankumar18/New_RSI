<?php
//Define your database name here.
$HostName = "sql202.epizy.com";
 
//Define your database name here.
$DatabaseName = "epiz_30809824_rsibot";
 
//Define your database username here.
$HostUser = "epiz_30809824";
 
//Define your database password here.
$HostPass = "Ra9lQvw6nNUvvO2";

$conn = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";

?>
