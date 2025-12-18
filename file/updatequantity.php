<?php
require 'connection.php';
session_start();
if(!isset($_SESSION['hid']))
{
	header('location:../login.php');
}
else {
	// Check if quantity column exists in bloodinfo table, if not add it
	$column_check = mysqli_query($conn, "SHOW COLUMNS FROM bloodinfo LIKE 'quantity'");
	if(mysqli_num_rows($column_check) == 0) {
		// Add quantity column if it doesn't exist
		$alter_sql = "ALTER TABLE `bloodinfo` ADD `quantity` INT(11) NOT NULL DEFAULT 1 AFTER `bg`";
		mysqli_query($conn, $alter_sql);
		// Update existing records to have quantity 1
		$update_sql = "UPDATE `bloodinfo` SET `quantity` = 1 WHERE `quantity` = 0 OR `quantity` IS NULL";
		mysqli_query($conn, $update_sql);
	}
	
	if(isset($_POST['updatequantity'])){
		$bid = $_POST['bid'];
		$quantity = intval($_POST['quantity']);
		
		if($quantity < 0) {
			$error = "Quantity cannot be negative.";
			header("location:../bloodinfo.php?error=".$error);
		} else {
			$sql = "UPDATE bloodinfo SET quantity='$quantity' WHERE bid='$bid'";
			if ($conn->query($sql) === TRUE) {
				$msg = "Quantity updated successfully.";
				header("location:../bloodinfo.php?msg=".$msg);
			} else {
				$error = "Error updating quantity: " . $conn->error;
				header("location:../bloodinfo.php?error=".$error);
			}
		}
		$conn->close();
	}
}
?>

