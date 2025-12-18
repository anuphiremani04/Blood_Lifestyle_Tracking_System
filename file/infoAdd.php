<?php
require 'connection.php';
session_start();
if(!isset($_SESSION['hid']))
{
	header('location:login.php');
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
	
	if(isset($_POST['add'])){
		$hid=$_SESSION['hid'];
		$bg=$_POST['bg'];
		$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
		$check_data = mysqli_query($conn, "SELECT hid, quantity FROM bloodinfo where hid='$hid' && bg='$bg'");
		if(mysqli_num_rows($check_data) > 0){
			// If blood group exists, update quantity instead
			$existing = mysqli_fetch_array($check_data);
			$new_quantity = $existing['quantity'] + $quantity;
			$update_sql = "UPDATE bloodinfo SET quantity='$new_quantity' WHERE hid='$hid' && bg='$bg'";
			if ($conn->query($update_sql) === TRUE) {
				$msg = "You have updated the quantity for blood group $bg. New total: $new_quantity units.";
				header( "location:../bloodinfo.php?msg=".$msg );
			} else {
				$error = "Error updating quantity: " . $conn->error;
				header( "location:../bloodinfo.php?error=".$error );
			}
		}else{
			$sql = "INSERT INTO bloodinfo (bg, hid, quantity) VALUES ('$bg', '$hid', '$quantity')";
			if ($conn->query($sql) === TRUE) {
				$msg = "You have added $quantity unit(s) of blood group $bg successfully.";
				header( "location:../bloodinfo.php?msg=".$msg );
			} else {
				$error = "Error: " . $sql . "<br>" . $conn->error;
				header( "location:../bloodinfo.php?error=".$error );
			}
		}
		$conn->close();
	}
}
}
?>