<?php
include "connection.php";
session_start();

if(!isset($_SESSION['hid']))
{
	header('location:../login.php');
}
else {
	// Check if hospitalrequest table exists, if not create it
	$table_check = mysqli_query($conn, "SHOW TABLES LIKE 'hospitalrequest'");
	if(mysqli_num_rows($table_check) == 0) {
		// Create the table if it doesn't exist
		$create_table_sql = "CREATE TABLE IF NOT EXISTS `hospitalrequest` (
		  `reqid` int(11) NOT NULL AUTO_INCREMENT,
		  `from_hid` int(11) NOT NULL,
		  `to_hid` int(11) NOT NULL,
		  `bg` varchar(11) NOT NULL,
		  `quantity` int(11) NOT NULL DEFAULT 1,
		  `status` varchar(100) NOT NULL DEFAULT 'Pending',
		  PRIMARY KEY (`reqid`),
		  KEY `from_hid` (`from_hid`),
		  KEY `to_hid` (`to_hid`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		
		mysqli_query($conn, $create_table_sql);
	}
	
	$reqid = $_GET['reqid'];
	$status = "Rejected";
	$sql = "UPDATE hospitalrequest SET status = '$status' WHERE reqid = '$reqid'";

	if (mysqli_query($conn, $sql)) {
		$msg = "You have rejected the hospital's blood request.";
		header("location:../hospitalrequest.php?msg=" . $msg);
	} else {
		$error = "Error changing status: " . mysqli_error($conn);
		header("location:../hospitalrequest.php?error=" . $error);
	}
	mysqli_close($conn);
}
?>

