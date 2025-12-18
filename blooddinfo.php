<?php 
  require 'file/connection.php';
  session_start();
  if(!isset($_SESSION['rid']))
  {
  header('location:login.php');
  }
  else {
?>
<!DOCTYPE html>
<html>
<?php $title="Blood Lifestyle Tracking System | Add blood samples"; ?>
<?php require 'head.php'; ?>
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

      <div class="row justify-content-center">
          
         <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7 mb-5">
          <div class="card">
            <div class="card-header title">Add blood group available in your known community</div>
        <div class="card-body">
        <form action="file/infoAddd.php" method="post">
          <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" title="click to see">Term & conditions. </a><br>
          <div class="collapse" id="collapseExample">
          If you or your Friends/Family have the mentioned(below) blood then only add Blood group(No spam).So,that the hospital can contact you with your given details if they are in need of you or your friends/family blood.You should have a blood sample tested by your doctor’s, nurse, or trained phlebotomist , at a pathology collection centre, clinic or hospital. Blood samples are most commonly taken from the inside of the elbow where the veins are usually closer to the surface.Make sure you have been eating healthy diet(No Smoking/Drinking)atleast for a week before you have to decided to donate Blood.By clicking tick mark you are promising that you are promising that you have read and accepted the above instructions and also willing to donate blood volunteerly.<br><br>
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
          <input type="submit" name="add" value="Add" class="btn btn-primary btn-block"><br>
          <a href="Userpage.html" class="float-right" title="click here">Cancel</a>
        </form>
         </div>
       </div>
     </div>

<?php   if(isset($_SESSION['rid'])){
    $rid=$_SESSION['rid'];
    $sql = "SELECT * from blooddinfo where rid='$rid'";
    $result = mysqli_query($conn, $sql);
  }
  ?>
    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7 mb-5">
          <table class="table table-striped table-responsive">
            <th colspan="4" class="title">User</th>
            <tr>
              <th>#</th>

              <th>User</th>
              <th>Action</th>
            </tr>
            <div>
                <?php
                if ($result) {
                    $row =mysqli_num_rows( $result);
                    if ($row) { //echo "<b> Total ".$row." </b>";
                }else echo '<b style="color:white;background-color:red;padding:7px;border-radius: 15px 50px;">Nothing to show.</b>';
            }
            ?>
            </div>
            <?php $counter = 0; while($row = mysqli_fetch_array($result)) { ?>
            <tr>
              <td><?php echo ++$counter; ?></td>

              <td><?php echo $row['bg'];?></td>
              <td><a href="file/deleted.php?bdid=<?php echo $row['bdid'];?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php } ?>
          </table>
      </div>

   </div>
</div>
<?php require 'footer.php' ?>
</body>
<?php } ?>