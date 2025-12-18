<?php 
  require 'file/connection.php';
  session_start();
  if(!isset($_SESSION['hid']))
  {
  header('location:login.php');
  }
  else {
?>
<!DOCTYPE html>
<html>
<?php $title="Blood Lifestyle Tracking System | Add blood samples"; ?>
<?php require 'head.php'; ?>
<link rel="stylesheet" href="css/blood3d.css">
<style>
    body{
    background: linear-gradient(135deg, rgba(255, 107, 107, 0.85) 0%, rgba(238, 90, 111, 0.85) 25%, rgba(201, 42, 42, 0.85) 50%, rgba(166, 30, 77, 0.85) 75%, rgba(134, 46, 156, 0.85) 100%);
    background-attachment: fixed;
    min-height: 100vh;
    animation: fadeIn 0.6s ease-in;
  }
  
  .card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 245, 245, 0.95) 100%);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(220, 53, 69, 0.2);
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(220, 53, 69, 0.3);
    transition: all 0.3s ease;
    overflow: hidden;
  }
  
  .card:hover {
    box-shadow: 0 20px 50px rgba(220, 53, 69, 0.4);
    transform: translateY(-5px);
    border-color: rgba(220, 53, 69, 0.4);
  }
  
  .card-header {
    background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%);
    color: white;
    padding: 20px;
    font-weight: 600;
    font-size: 1.2rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: none;
  }
  
  .form-control {
    border: 2px solid rgba(220, 53, 69, 0.2);
    border-radius: 10px;
    padding: 12px 15px;
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
  }
  
  .btn-primary {
    background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%);
    border: none;
    border-radius: 10px;
    padding: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
  }
  
  .btn-primary:hover {
    background: linear-gradient(135deg, #c92a2a 0%, #a61e4d 100%);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
  }
  
  a {
    color: #dc3545;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
  }
  
  a:hover {
    color: #c92a2a;
    text-shadow: 0 0 5px rgba(220, 53, 69, 0.5);
  }
  
  .collapse {
    background: rgba(255, 245, 245, 0.8);
    padding: 15px;
    border-radius: 10px;
    margin: 10px 0;
    border: 1px solid rgba(220, 53, 69, 0.2);
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

      <!-- 3D Blood Cell Animation -->
      <div style="text-align: center; margin: 20px 0;">
        <div class="blood-cell-3d blood-cell-large">
          <div class="blood-cell"></div>
        </div>
      </div>

      <div class="row justify-content-center">
          
         <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7 mb-5">
          <div class="card">
            <div class="card-header title">
              <div style="display: flex; align-items: center; justify-content: center; gap: 15px;">
                <div class="blood-cell-3d blood-cell-small">
                  <div class="blood-cell"></div>
                </div>
                <span>Add blood group available in your hospital</span>
                <div class="blood-cell-3d blood-cell-small">
                  <div class="blood-cell"></div>
                </div>
              </div>
            </div>
        <div class="card-body">
        <form action="file/infoAdd.php" method="post">
          <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" title="click to see">Term & conditions. </a><br>
          <div class="collapse" id="collapseExample">
          If you have a blood sample tested by  your doctor’s, nurse, or trained phlebotomist , at a pathology collection centre, clinic or hospital. Blood samples are most commonly taken from the inside of the elbow where the veins are usually closer to the surface. If before the needle is inserted, the area had been cleaned with an antiseptic cloth and blood sample is transferred into tubes containing the correct preservatives then add your blood group available in your hospital to your blood bank.<br><br>
        </div>
          <input type="checkbox" name="condition" value="agree" required> Agree<br><br>
          <select class="form-control" name="bg" required="">
                
                <option>A-</option>
                <option>A+</option>
                <option>B-</option>
                <option>B+</option>
                <option>AB-</option>
                <option>AB+</option>
                <option>O-</option>
                <option>O+</option>
          </select><br>
          <label style="color: #dc3545; font-weight: 600; margin-top: 10px;">
            <i class="fas fa-cubes" style="margin-right: 5px;"></i>Quantity:
          </label>
          <input type="number" class="form-control" name="quantity" min="1" value="1" required><br>
          <input type="submit" name="add" value="Add" class="btn btn-primary btn-block"><br>
          <a href="hospitalpage.html" class="text-centre" >Cancel</a><br>
        </form>
         </div>
       </div>
     </div>

<?php   if(isset($_SESSION['hid'])){
    $hid=$_SESSION['hid'];
    
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
    
    $sql = "select * from bloodinfo where hid='$hid'";
    $result = mysqli_query($conn, $sql);
  }
  ?>
    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7 mb-5">
          <table class="table table-striped table-responsive">
            <th colspan="5" class="title">
              <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                <div class="blood-cell-3d blood-cell-small">
                  <div class="blood-cell"></div>
                </div>
                <span>Blood Bank Stock</span>
                <div class="blood-cell-3d blood-cell-small">
                  <div class="blood-cell"></div>
                </div>
              </div>
            </th>
            <tr>
              <th>#</th>
              <th>Blood Group</th>
              <th>Quantity</th>
              <th colspan="2">Action</th>
            </tr>
            <div>
                <?php
                if ($result) {
                    $row =mysqli_num_rows( $result);
                    if ($row) { //echo "<b> Total ".$row." </b>";
                }else echo '<tr><td colspan="5" style="text-align: center; padding: 30px; color: #dc3545; font-weight: bold;">No blood samples in stock. Add blood groups to get started.</td></tr>';
            }
            ?>
            </div>
            <?php $counter = 0; while($row = mysqli_fetch_array($result)) { ?>
            <tr>
              <td><?php echo ++$counter; ?></td>
              <td>
                <div style="display: flex; align-items: center; gap: 10px;">
                  <div class="blood-cell-3d blood-cell-small" style="width: 30px; height: 30px; margin: 0;">
                    <div class="blood-cell"></div>
                  </div>
                  <strong style="color: #dc3545; font-size: 1.1rem;"><?php echo $row['bg'];?></strong>
                </div>
              </td>
              <td>
                <span style="font-size: 1.2rem; font-weight: bold; color: #28a745;">
                  <?php echo isset($row['quantity']) ? $row['quantity'] : '1'; ?> units
                </span>
              </td>
              <td>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editModal<?php echo $row['bid']; ?>" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); border: none; color: white; padding: 6px 15px; border-radius: 8px;">
                  <i class="fas fa-edit" style="margin-right: 5px;"></i>Edit
                </button>
              </td>
              <td><a href="file/delete.php?bid=<?php echo $row['bid'];?>" class="btn btn-danger">Delete</a></td>
            </tr>

            <!-- Edit Quantity Modal -->
            <div class="modal fade" id="editModal<?php echo $row['bid']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $row['bid']; ?>" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header" style="background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%); color: white; border-radius: 20px 20px 0 0;">
                    <h5 class="modal-title" id="editModalLabel<?php echo $row['bid']; ?>">
                      <i class="fas fa-edit" style="margin-right: 10px;"></i>
                      Update Quantity for <?php echo $row['bg']; ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="file/updatequantity.php" method="post">
                    <div class="modal-body" style="padding: 30px;">
                      <input type="hidden" name="bid" value="<?php echo $row['bid']; ?>">
                      <div class="form-group">
                        <label for="quantity<?php echo $row['bid']; ?>" style="color: #dc3545; font-weight: 600;">
                          <i class="fas fa-cubes" style="margin-right: 5px;"></i>Quantity:
                        </label>
                        <input type="number" class="form-control" name="quantity" id="quantity<?php echo $row['bid']; ?>" min="0" value="<?php echo isset($row['quantity']) ? $row['quantity'] : '1'; ?>" required>
                      </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid rgba(220, 53, 69, 0.1); padding: 20px 30px;">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" name="updatequantity" class="btn btn-primary">
                        <i class="fas fa-save" style="margin-right: 5px;"></i>Update Quantity
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php } ?>
          </table>
      </div>

   </div>
</div>
<?php require 'footer.php' ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php } ?>