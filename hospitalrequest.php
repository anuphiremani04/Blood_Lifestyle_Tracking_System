<?php 
require 'file/connection.php'; 
session_start();
  if(!isset($_SESSION['hid']))
  {
  header('location:login.php');
  }
  else {
    $hid = $_SESSION['hid'];
    
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
            header("location:hospitalpage.html?error=".$error);
            exit();
        }
    }
    
    // Get all hospitals except current one
    $hospitals_sql = "SELECT * FROM hospitals WHERE id != '$hid' ORDER BY hname ASC";
    $hospitals_result = mysqli_query($conn, $hospitals_sql);
    
    // Get incoming requests from other hospitals
    $incoming_sql = "SELECT hospitalrequest.*, hospitals.* FROM hospitalrequest, hospitals WHERE hospitalrequest.to_hid='$hid' && hospitalrequest.from_hid=hospitals.id ORDER BY hospitalrequest.reqid DESC";
    $incoming_result = mysqli_query($conn, $incoming_sql);
    
    // Get outgoing requests to other hospitals
    $outgoing_sql = "SELECT hospitalrequest.*, hospitals.* FROM hospitalrequest, hospitals WHERE hospitalrequest.from_hid='$hid' && hospitalrequest.to_hid=hospitals.id ORDER BY hospitalrequest.reqid DESC";
    $outgoing_result = mysqli_query($conn, $outgoing_sql);
?>

<!DOCTYPE html>
<html>
<?php $title="Blood Lifestyle Tracking System | Hospital to Hospital Requests"; ?>
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
    margin-bottom: 30px;
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
  
  .btn-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    border: none;
    border-radius: 8px;
    padding: 8px 20px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(23, 162, 184, 0.3);
    color: white;
    cursor: pointer;
  }
  
  .btn-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(23, 162, 184, 0.4);
    color: white;
  }
  
  .btn-success, .btn-danger {
    border-radius: 8px;
    padding: 8px 20px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
  }
  
  .btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
  }
  
  .btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
  }
  
  .btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%);
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
  
  .form-control {
    border: 2px solid rgba(220, 53, 69, 0.2);
    border-radius: 10px;
    padding: 10px 15px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.9);
  }
  
  .form-control:focus {
    border-color: #dc3545;
    box-shadow: 
      0 0 10px rgba(220, 53, 69, 0.3),
      0 0 0 0.2rem rgba(220, 53, 69, 0.15);
    transform: translateY(-2px);
    background: white;
    outline: none;
  }
  
  .modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 15px 40px rgba(220, 53, 69, 0.3);
  }
  
  .modal-header {
    background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%);
    color: white;
    border-radius: 20px 20px 0 0;
    border: none;
  }
  
  .modal-body {
    padding: 30px;
  }
  
  .modal-footer {
    border-top: 1px solid rgba(220, 53, 69, 0.1);
    padding: 20px 30px;
  }
  
  .nav-tabs {
    border-bottom: 3px solid rgba(220, 53, 69, 0.3);
    margin-bottom: 20px;
  }
  
  .nav-tabs .nav-link {
    color: #dc3545;
    font-weight: 600;
    border: none;
    border-bottom: 3px solid transparent;
    padding: 15px 25px;
    transition: all 0.3s ease;
  }
  
  .nav-tabs .nav-link:hover {
    border-bottom-color: rgba(220, 53, 69, 0.5);
  }
  
  .nav-tabs .nav-link.active {
    color: #dc3545;
    background: transparent;
    border-bottom-color: #dc3545;
  }
</style>
<body class="page-transition">
	<?php require 'header.php'; ?>
	
	<!-- Back Button -->
	<div style="position: fixed; top: 80px; left: 20px; z-index: 999;">
		<a href="hospitalpage.html" onclick="window.location.href='hospitalpage.html'; return false;" class="back-button" style="display: inline-flex; align-items: center; padding: 8px 15px; background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%); color: white; text-decoration: none; border-radius: 20px; font-weight: 600; box-shadow: 0 3px 10px rgba(220, 53, 69, 0.4); transition: all 0.3s ease; font-size: 14px;">
			<i class="fas fa-arrow-left" style="margin-right: 6px; font-size: 14px;"></i>
			<span>Back</span>
		</a>
	</div>
	
	<div class="container cont">

		<?php require 'message.php'; ?>

	<div style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 245, 245, 0.95) 100%); border-radius: 20px; padding: 20px; margin-bottom: 20px; box-shadow: 0 10px 30px rgba(220, 53, 69, 0.2);">
		<h4 style="color: #dc3545; font-weight: bold; text-align: center; margin-bottom: 10px;">
			<i class="fas fa-hospital" style="margin-right: 10px;"></i>
			Hospital to Hospital Blood Requests
		</h4>
		<p style="color: #333; text-align: center; margin: 0; font-size: 0.95rem;">
			Request blood from other hospitals or respond to requests from other hospitals. Manage all hospital-to-hospital blood transfers in one place.
		</p>
	</div>

	<!-- Tabs -->
	<ul class="nav nav-tabs" id="requestTabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="send-tab" data-toggle="tab" href="#send" role="tab" aria-controls="send" aria-selected="true">
				<i class="fas fa-paper-plane" style="margin-right: 5px;"></i>Send Request
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="incoming-tab" data-toggle="tab" href="#incoming" role="tab" aria-controls="incoming" aria-selected="false">
				<i class="fas fa-inbox" style="margin-right: 5px;"></i>Incoming Requests
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="outgoing-tab" data-toggle="tab" href="#outgoing" role="tab" aria-controls="outgoing" aria-selected="false">
				<i class="fas fa-paper-plane" style="margin-right: 5px;"></i>Outgoing Requests
			</a>
		</li>
	</ul>

	<div class="tab-content" id="requestTabsContent">
		<!-- Send Request Tab -->
		<div class="tab-pane fade show active" id="send" role="tabpanel" aria-labelledby="send-tab">
			<table class="table table-responsive table-striped rounded mb-5">
				<tr><th colspan="6" class="title">Available Hospitals - Send Blood Request</th></tr>
				<tr>
					<th>#</th>
					<th>Hospital Name</th>
					<th>Email</th>
					<th>City</th>
					<th>Phone</th>
					<th>Action</th>
				</tr>

				<?php 
				if ($hospitals_result) {
					$row_count = mysqli_num_rows($hospitals_result);
					if ($row_count == 0) {
						echo '<tr><td colspan="6" style="text-align: center; padding: 30px; color: #dc3545; font-weight: bold;">No other hospitals found in the system.</td></tr>';
					}
				} else {
					echo '<tr><td colspan="6" style="text-align: center; padding: 30px; color: #dc3545; font-weight: bold;">Error loading hospitals.</td></tr>';
				}
				?>

				<?php $counter = 0; while($row = mysqli_fetch_array($hospitals_result)) { ?>

				<tr>
					<td><?php echo ++$counter;?></td>
					<td><strong><?php echo $row['hname'];?></strong></td>
					<td><?php echo $row['hemail'];?></td>
					<td><?php echo $row['hcity'];?></td>
					<td><?php echo $row['hphone'];?></td>
					<td>
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#requestModal<?php echo $row['id']; ?>">
							<i class="fas fa-paper-plane" style="margin-right: 5px;"></i>Send Request
						</button>
					</td>
				</tr>

				<!-- Request Modal -->
				<div class="modal fade" id="requestModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="requestModalLabel<?php echo $row['id']; ?>">
									<i class="fas fa-paper-plane" style="margin-right: 10px;"></i>
									Send Blood Request to <?php echo $row['hname']; ?>
								</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="file/sendhospitalrequest.php" method="post">
								<div class="modal-body">
									<input type="hidden" name="to_hid" value="<?php echo $row['id']; ?>">
									<input type="hidden" name="from_hid" value="<?php echo $hid; ?>">
									
									<div class="form-group">
										<label for="bg<?php echo $row['id']; ?>" style="color: #dc3545; font-weight: 600;">
											<i class="fas fa-tint" style="margin-right: 5px;"></i>Select Blood Group Needed:
										</label>
										<select name="bg" id="bg<?php echo $row['id']; ?>" class="form-control" required>
											<option value="">-- Select Blood Group --</option>
											<option value="A+">A+</option>
											<option value="A-">A-</option>
											<option value="B+">B+</option>
											<option value="B-">B-</option>
											<option value="AB+">AB+</option>
											<option value="AB-">AB-</option>
											<option value="O+">O+</option>
											<option value="O-">O-</option>
										</select>
									</div>
									
									<div class="form-group">
										<label for="quantity<?php echo $row['id']; ?>" style="color: #dc3545; font-weight: 600;">
											<i class="fas fa-cubes" style="margin-right: 5px;"></i>Quantity Needed:
										</label>
										<input type="number" class="form-control" name="quantity" id="quantity<?php echo $row['id']; ?>" min="1" value="1" required>
									</div>
									
									<div style="background: rgba(220, 53, 69, 0.1); padding: 15px; border-radius: 10px; margin-top: 15px;">
										<p style="margin: 0; color: #333; font-size: 0.9rem;">
											<strong>Hospital Details:</strong><br>
											Name: <?php echo $row['hname']; ?><br>
											Email: <?php echo $row['hemail']; ?><br>
											City: <?php echo $row['hcity']; ?><br>
											Phone: <?php echo $row['hphone']; ?>
										</p>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
									<button type="submit" name="sendhospitalrequest" class="btn btn-info">
										<i class="fas fa-paper-plane" style="margin-right: 5px;"></i>Send Request
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<?php } ?>
			</table>
		</div>

		<!-- Incoming Requests Tab -->
		<div class="tab-pane fade" id="incoming" role="tabpanel" aria-labelledby="incoming-tab">
			<table class="table table-responsive table-striped rounded mb-5">
				<tr><th colspan="8" class="title">Incoming Requests from Other Hospitals</th></tr>
				<tr>
					<th>#</th>
					<th>From Hospital</th>
					<th>Email</th>
					<th>City</th>
					<th>Phone</th>
					<th>Blood Group</th>
					<th>Quantity</th>
					<th>Status</th>
					<th colspan="2">Action</th>
				</tr>

				<?php 
				if ($incoming_result) {
					$row_count = mysqli_num_rows($incoming_result);
					if ($row_count == 0) {
						echo '<tr><td colspan="10" style="text-align: center; padding: 30px; color: #dc3545; font-weight: bold;">No incoming requests from other hospitals.</td></tr>';
					}
				}
				?>

				<?php $counter = 0; while($row = mysqli_fetch_array($incoming_result)) { ?>

				<tr>
					<td><?php echo ++$counter;?></td>
					<td><strong><?php echo $row['hname'];?></strong></td>
					<td><?php echo $row['hemail'];?></td>
					<td><?php echo $row['hcity'];?></td>
					<td><?php echo $row['hphone'];?></td>
					<td><strong style="color: #dc3545; font-size: 1.1rem;"><?php echo $row['bg'];?></strong></td>
					<td><strong style="color: #28a745; font-size: 1.1rem;"><?php echo isset($row['quantity']) ? $row['quantity'] : '1'; ?> units</strong></td>
					<td>
						<?php 
						if($row['status'] == 'Accepted'){ 
							echo '<span style="color: #28a745; font-weight: bold;">Accepted</span>';
						} elseif($row['status'] == 'Rejected') {
							echo '<span style="color: #dc3545; font-weight: bold;">Rejected</span>';
						} else {
							echo '<span style="color: #ffc107; font-weight: bold;">Pending</span>';
						}
						?>
					</td>
					<td>
						<?php if($row['status'] == 'Accepted'){ ?> 
							<a href="" class="btn btn-success disabled" style="opacity: 0.6; cursor: not-allowed;">
								<i class="fas fa-check" style="margin-right: 5px;"></i>Accepted
							</a> 
						<?php } else { ?>
							<a href="file/accepthospitalrequest.php?reqid=<?php echo $row['reqid'];?>" class="btn btn-success">
								<i class="fas fa-check" style="margin-right: 5px;"></i>Accept
							</a>
						<?php } ?>
					</td>
					<td>
						<?php if($row['status'] == 'Rejected'){ ?> 
							<a href="" class="btn btn-danger disabled" style="opacity: 0.6; cursor: not-allowed;">
								<i class="fas fa-times" style="margin-right: 5px;"></i>Rejected
							</a> 
						<?php } else { ?>
							<a href="file/rejecthospitalrequest.php?reqid=<?php echo $row['reqid'];?>" class="btn btn-danger">
								<i class="fas fa-times" style="margin-right: 5px;"></i>Reject
							</a>
						<?php } ?>
					</td>
				</tr>

				<?php } ?>
			</table>
		</div>

		<!-- Outgoing Requests Tab -->
		<div class="tab-pane fade" id="outgoing" role="tabpanel" aria-labelledby="outgoing-tab">
			<table class="table table-responsive table-striped rounded mb-5">
				<tr><th colspan="7" class="title">Your Requests to Other Hospitals</th></tr>
				<tr>
					<th>#</th>
					<th>To Hospital</th>
					<th>Email</th>
					<th>City</th>
					<th>Blood Group</th>
					<th>Quantity</th>
					<th>Status</th>
				</tr>

				<?php 
				if ($outgoing_result) {
					$row_count = mysqli_num_rows($outgoing_result);
					if ($row_count == 0) {
						echo '<tr><td colspan="7" style="text-align: center; padding: 30px; color: #dc3545; font-weight: bold;">You have not sent any requests to other hospitals yet.</td></tr>';
					}
				}
				?>

				<?php $counter = 0; while($row = mysqli_fetch_array($outgoing_result)) { ?>

				<tr>
					<td><?php echo ++$counter;?></td>
					<td><strong><?php echo $row['hname'];?></strong></td>
					<td><?php echo $row['hemail'];?></td>
					<td><?php echo $row['hcity'];?></td>
					<td><strong style="color: #dc3545; font-size: 1.1rem;"><?php echo $row['bg'];?></strong></td>
					<td><strong style="color: #28a745; font-size: 1.1rem;"><?php echo isset($row['quantity']) ? $row['quantity'] : '1'; ?> units</strong></td>
					<td>
						<?php 
						if($row['status'] == 'Accepted'){ 
							echo '<span style="color: #28a745; font-weight: bold; padding: 8px 20px; background: rgba(40, 167, 69, 0.15); border-radius: 20px; display: inline-block;">
								<i class="fas fa-check-circle" style="margin-right: 5px;"></i>Accepted
							</span>';
						} elseif($row['status'] == 'Rejected') {
							echo '<span style="color: #dc3545; font-weight: bold; padding: 8px 20px; background: rgba(220, 53, 69, 0.15); border-radius: 20px; display: inline-block;">
								<i class="fas fa-times-circle" style="margin-right: 5px;"></i>Rejected
							</span>';
						} else {
							echo '<span style="color: #ffc107; font-weight: bold; padding: 8px 20px; background: rgba(255, 193, 7, 0.15); border-radius: 20px; display: inline-block;">
								<i class="fas fa-clock" style="margin-right: 5px;"></i>Pending
							</span>';
						}
						?>
					</td>
				</tr>

				<?php } ?>
			</table>
		</div>
	</div>
</div>
    <?php require 'footer.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>

