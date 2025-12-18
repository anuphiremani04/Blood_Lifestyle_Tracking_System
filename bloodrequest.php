<?php 
require 'file/connection.php'; 
session_start();
  if(!isset($_SESSION['hid']))
  {
  header('location:login.php');
  }
  else {
    $hid = $_SESSION['hid'];
    // Get all users (receivers)
    $sql = "SELECT * FROM receivers ORDER BY rname ASC";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<?php $title="Blood Lifestyle Tracking System | Blood Requests"; ?>
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
  
  .table tbody tr:last-child td {
    border-bottom: none;
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
			<i class="fas fa-info-circle" style="margin-right: 10px;"></i>
			Send Blood Requests to Users
		</h4>
		<p style="color: #333; text-align: center; margin: 0; font-size: 0.95rem;">
			Select a user from the list below and send them a blood request. Users will be able to see your request and decide whether to accept or reject it.
		</p>
	</div>

	<table class="table table-responsive table-striped rounded mb-5">
		<tr><th colspan="7" class="title">All Users - Send Blood Request</th></tr>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Email</th>
			<th>City</th>
			<th>Phone</th>
			<th>Blood Group</th>
			<th>Action</th>
		</tr>

		<?php 
		if ($result) {
			$row_count = mysqli_num_rows($result);
			if ($row_count == 0) {
				echo '<tr><td colspan="7" style="text-align: center; padding: 30px; color: #dc3545; font-weight: bold;">No users found in the system.</td></tr>';
			}
		} else {
			echo '<tr><td colspan="7" style="text-align: center; padding: 30px; color: #dc3545; font-weight: bold;">Error loading users.</td></tr>';
		}
		?>

		<?php $counter = 0; while($row = mysqli_fetch_array($result)) { ?>

		<tr>
			<td><?php echo ++$counter;?></td>
			<td><?php echo $row['rname'];?></td>
			<td><?php echo $row['remail'];?></td>
			<td><?php echo $row['rcity'];?></td>
			<td><?php echo $row['rphone'];?></td>
			<td><strong style="color: #dc3545; font-size: 1.1rem;"><?php echo $row['rbg'];?></strong></td>
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
							Send Blood Request to <?php echo $row['rname']; ?>
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="file/sendrequest.php" method="post">
						<div class="modal-body">
							<input type="hidden" name="rid" value="<?php echo $row['id']; ?>">
							<input type="hidden" name="hid" value="<?php echo $hid; ?>">
							
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
							
							<div style="background: rgba(220, 53, 69, 0.1); padding: 15px; border-radius: 10px; margin-top: 15px;">
								<p style="margin: 0; color: #333; font-size: 0.9rem;">
									<strong>User Details:</strong><br>
									Name: <?php echo $row['rname']; ?><br>
									Email: <?php echo $row['remail']; ?><br>
									City: <?php echo $row['rcity']; ?><br>
									User's Blood Group: <strong style="color: #dc3545;"><?php echo $row['rbg']; ?></strong>
								</p>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="submit" name="sendrequest" class="btn btn-info">
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
    <?php require 'footer.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>
