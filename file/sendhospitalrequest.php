<?php
session_start(); 
require 'connection.php';

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
		
		if (!mysqli_query($conn, $create_table_sql)) {
			$error = "Error creating table: " . mysqli_error($conn);
			header("location:../hospitalrequest.php?error=".$error);
			exit();
		}
	}
	
	if(isset($_POST['sendhospitalrequest'])){
		$from_hid = $_POST['from_hid'];
		$to_hid = $_POST['to_hid'];
		$bg = $_POST['bg'];
		$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
		
		// Check if request already exists
		$check_data = mysqli_query($conn, "SELECT reqid FROM hospitalrequest where from_hid='$from_hid' and to_hid='$to_hid' and bg='$bg' and status='Pending'");
		
		if(mysqli_num_rows($check_data) > 0){
			$error = "You have already sent a request for this blood group to this hospital.";
			header("location:../hospitalrequest.php?error=".$error);
		} else {
			$sql = "INSERT INTO hospitalrequest (bg, from_hid, to_hid, quantity, status) VALUES ('$bg', '$from_hid', '$to_hid', '$quantity', 'Pending')";
			if ($conn->query($sql) === TRUE) {
				$msg = 'You have sent a blood request for '.$quantity.' unit(s) of blood group '.$bg.' to the hospital. They will be notified and can accept or reject your request.';
				header("location:../hospitalrequest.php?msg=".$msg);
			} else {
				$error = "Error: " . $sql . "<br>" . $conn->error;
				header("location:../hospitalrequest.php?error=".$error);
			}
		}
		$conn->close();
	}
}
?>

