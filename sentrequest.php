<?php 
require 'file/connection.php'; 
session_start();
  if(!isset($_SESSION['rid']))
  {
  header('location:login.php');
  }
  else {
    $rid = $_SESSION['rid'];
    $sql = "select bloodrequest.*, hospitals.* from bloodrequest, hospitals where rid='$rid' && bloodrequest.hid=hospitals.id";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<?php $title="Blood Lifestyle Tracking System | Sent Requests"; ?>
<?php require 'head.php'; ?>
<style>
    body{
    background: linear-gradient(135deg, rgba(255, 107, 107, 0.85) 0%, rgba(238, 90, 111, 0.85) 25%, rgba(201, 42, 42, 0.85) 50%, rgba(166, 30, 77, 0.85) 75%, rgba(134, 46, 156, 0.85) 100%);
    background-attachment: fixed;
    min-height: 100vh;
    animation: fadeIn 0.6s ease-in;
  }
  
  .table {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 245, 245, 0.95) 100%);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(220, 53, 69, 0.3);
    border: 2px solid rgba(220, 53, 69, 0.2);
  }
  
  .table th {
    background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%);
    color: white;
    font-weight: 600;
    padding: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: none;
  }
  
  .table td {
    padding: 15px;
    border-bottom: 1px solid rgba(220, 53, 69, 0.1);
    transition: all 0.3s ease;
  }
  
  .table tbody tr {
    transition: all 0.3s ease;
  }
  
  .table tbody tr:hover {
    background: rgba(220, 53, 69, 0.05);
    transform: scale(1.01);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.2);
  }
  
  .btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%);
    border: none;
    border-radius: 8px;
    padding: 8px 20px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(220, 53, 69, 0.3);
  }
  
  .btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
  }
  
  .title {
    background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%);
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 1.5rem;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
  }
</style>
<body class="page-transition">
	<?php require 'header.php'; ?>
	
	<!-- Back Button -->
	<div style="position: fixed; top: 80px; left: 20px; z-index: 999;">
		<a href="Userpage.html" onclick="window.location.href='Userpage.html'; return false;" class="back-button" style="display: inline-flex; align-items: center; padding: 8px 15px; background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%); color: white; text-decoration: none; border-radius: 20px; font-weight: 600; box-shadow: 0 3px 10px rgba(220, 53, 69, 0.4); transition: all 0.3s ease; font-size: 14px;">
			<i class="fas fa-arrow-left" style="margin-right: 6px; font-size: 14px;"></i>
			<span>Back</span>
		</a>
	</div>
	
	<div class="container cont">

		<?php require 'message.php'; ?>

	<table class="table table-responsive table-striped rounded mb-5">
		<tr><th colspan="8" class="title">Status of Blood Requests</th></tr>
		<tr>
			<th>#</th>
			<th>Hospital Name</th>
			<th>Hospital Email</th>
			<th>Hospital City</th>
			<th>Hospital Phone</th>
			<th>Blood Group</th>
			<th>Status</th>
			<th>Action</th>
		</tr>

		    <div>
                <?php
                if ($result) {
                    $row =mysqli_num_rows( $result);
                    if ($row) { //echo "<b> Total ".$row." </b>";
                }else echo '<b style="color:white;background-color:red;padding:7px;border-radius: 15px 50px;">You have not requested blood from any hospital yet. </b>';
            }
            ?>
            </div>

		<?php $counter = 0; while($row = mysqli_fetch_array($result)) { ?>

		<tr>
			<td><?php echo ++$counter;?></td>
			<td><?php echo $row['hname'];?></td>
			<td><?php echo $row['hemail'];?></td>
			<td><?php echo $row['hcity'];?></td>
			<td><?php echo $row['hphone'];?></td>
			<td><?php echo $row['bg'];?></td>
			<td>
				<?php 
				if($row['status'] == 'Accepted'){ 
					echo '<span style="color: #28a745; font-weight: bold; padding: 5px 15px; background: rgba(40, 167, 69, 0.1); border-radius: 20px;">✓ Accepted</span>';
				} elseif($row['status'] == 'Rejected') {
					echo '<span style="color: #dc3545; font-weight: bold; padding: 5px 15px; background: rgba(220, 53, 69, 0.1); border-radius: 20px;">✗ Rejected</span>';
				} else {
					echo '<span style="color: #ffc107; font-weight: bold; padding: 5px 15px; background: rgba(255, 193, 7, 0.1); border-radius: 20px;">⏳ Pending</span>';
				}
				?>
			</td>
			<td>
				<?php if($row['status'] == 'Accepted'){ ?>
					<span style="color: #28a745; font-weight: bold;">Request Accepted</span>
				<?php } elseif($row['status'] == 'Rejected') { ?>
					<span style="color: #dc3545; font-weight: bold;">Request Rejected</span>
				<?php } else { ?>
					<a href="file/cancel.php?reqid=<?php echo $row['reqid'];?>" class="btn btn-danger">Cancel Request</a>
				<?php } ?>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
    <?php require 'footer.php'; ?>
</body>
</html>
<?php } ?>