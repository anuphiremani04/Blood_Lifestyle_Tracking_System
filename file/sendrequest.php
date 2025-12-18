<?php
session_start(); 
require 'connection.php';

if(!isset($_SESSION['hid']))
{
	header('location:../login.php');
}
else {
	if(isset($_POST['sendrequest'])){
		$hid = $_POST['hid'];
		$rid = $_POST['rid'];
		$bg = $_POST['bg'];
		
		// Check if request already exists
		$check_data = mysqli_query($conn, "SELECT reqid FROM bloodrequest where hid='$hid' and rid='$rid' and bg='$bg' and status='Pending'");
		
		if(mysqli_num_rows($check_data) > 0){
			$error = "You have already sent a request for this blood group to this user.";
			header("location:../bloodrequest.php?error=".$error);
		} else {
			$sql = "INSERT INTO bloodrequest (bg, hid, rid, status) VALUES ('$bg', '$hid', '$rid', 'Pending')";
			if ($conn->query($sql) === TRUE) {
				$msg = 'You have sent a blood request for blood group '.$bg.' to the user. They will be notified and can accept or reject your request.';
				header("location:../bloodrequest.php?msg=".$msg);
			} else {
				$error = "Error: " . $sql . "<br>" . $conn->error;
				header("location:../bloodrequest.php?error=".$error);
			}
		}
		$conn->close();
	}
}
?>

