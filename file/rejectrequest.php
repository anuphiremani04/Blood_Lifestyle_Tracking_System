<?php
include "connection.php";
session_start();

if(!isset($_SESSION['rid']))
{
	header('location:../login.php');
}
else {
	$reqid = $_GET['reqid'];
	$status = "Rejected";
	$sql = "UPDATE bloodrequest SET status = '$status' WHERE reqid = '$reqid'";

	if (mysqli_query($conn, $sql)) {
		$msg = "You have rejected the hospital's blood request.";
		header("location:../blooddonate.php?msg=" . $msg);
	} else {
		$error = "Error changing status: " . mysqli_error($conn);
		header("location:../blooddonate.php?error=" . $error);
	}
	mysqli_close($conn);
}
?>

