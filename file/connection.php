<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodbank";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
 die('Could not Connect MySql:' . $conn->connect_error);
}
?>