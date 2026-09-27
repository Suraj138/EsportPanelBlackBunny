<?php

$servername = "localhost";
$username = "drywbqkt_bhaskar";
$password = "drywbqkt_bhaskar";
$dbname = "drywbqkt_bhaskar";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn) {

die(" PROBLEM WITH CONNECTION : " . mysqli_connect_error());

}
  
?>