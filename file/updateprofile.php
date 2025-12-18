<?php 
session_start();
require 'connection.php';
if (isset($_SESSION['rid'])) {
if(isset($_POST['update'])){
    $id=$_SESSION['rid'];
    $rname = $_POST['rname'];
    $remail = $_POST['remail'];
    $rphone = $_POST['rphone'];
    $bg = $_POST['bg'];
    $rcity = $_POST['rcity'];
    $rpassword = $_POST['rpassword'];
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $latitude = isset($_POST['latitude']) ? floatval($_POST['latitude']) : null;
    $longitude = isset($_POST['longitude']) ? floatval($_POST['longitude']) : null;
    
    // Check if columns exist, if not add them
    $check_cols = mysqli_query($conn, "SHOW COLUMNS FROM receivers LIKE 'latitude'");
    if(mysqli_num_rows($check_cols) == 0) {
        mysqli_query($conn, "ALTER TABLE receivers ADD COLUMN latitude DECIMAL(10, 8) NULL AFTER rcity, ADD COLUMN longitude DECIMAL(11, 8) NULL AFTER latitude, ADD COLUMN address VARCHAR(255) NULL AFTER longitude");
    }
    
    if ($latitude && $longitude) {
        $update = "UPDATE receivers SET rname='$rname', remail='$remail', rpassword='$rpassword', rphone='$rphone', rbg='$bg', rcity='$rcity', address='$address', latitude='$latitude', longitude='$longitude' WHERE id='$id'";
    } else {
        $update = "UPDATE receivers SET rname='$rname', remail='$remail', rpassword='$rpassword', rphone='$rphone', rbg='$bg', rcity='$rcity', address='$address' WHERE id='$id'";
    }
    if ($conn->query($update) === TRUE) {
        $msg = "Your profile is updated successfully.";
        header( "location:../rprofile.php?msg=".$msg);
    } else {
        $error = "Error: " . $update . "<br>" . $conn->error;
        header( "location:../rprofile.php?error=".$error );
    }
    $conn->close();
}


}elseif (isset($_SESSION['hid'])) {
    if(isset($_POST['update'])){
        $id=$_SESSION['hid'];
    $hname = $_POST['hname'];
    $hemail = $_POST['hemail'];
    $hphone = $_POST['hphone'];
    $hcity = $_POST['hcity'];
    $hpassword = $_POST['hpassword'];
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $latitude = isset($_POST['latitude']) ? floatval($_POST['latitude']) : null;
    $longitude = isset($_POST['longitude']) ? floatval($_POST['longitude']) : null;
    
    // Check if columns exist, if not add them
    $check_cols = mysqli_query($conn, "SHOW COLUMNS FROM hospitals LIKE 'latitude'");
    if(mysqli_num_rows($check_cols) == 0) {
        mysqli_query($conn, "ALTER TABLE hospitals ADD COLUMN latitude DECIMAL(10, 8) NULL AFTER hcity, ADD COLUMN longitude DECIMAL(11, 8) NULL AFTER latitude, ADD COLUMN address VARCHAR(255) NULL AFTER longitude");
    }
    
    if ($latitude && $longitude) {
        $update = "UPDATE hospitals SET hname='$hname', hemail='$hemail', hpassword='$hpassword', hphone='$hphone', hcity='$hcity', address='$address', latitude='$latitude', longitude='$longitude' WHERE id='$id'";
    } else {
        $update = "UPDATE hospitals SET hname='$hname', hemail='$hemail', hpassword='$hpassword', hphone='$hphone', hcity='$hcity', address='$address' WHERE id='$id'";
    }
    if ($conn->query($update) === TRUE) {
        $msg= "Your profile is updated successfully.";
        header( "location:../hprofile.php?msg=".$msg);
    } else {
        $error= "Error: " . $update . "<br>" . $conn->error;
        header( "location:../hprofile.php?error=".$error);
    }
    $conn->close();
}
}else{
    header("location:../login.php");
}
?>