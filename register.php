<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <style>
body{
    background: linear-gradient(135deg, rgba(255, 107, 107, 0.9) 0%, rgba(238, 90, 111, 0.9) 25%, rgba(201, 42, 42, 0.9) 50%, rgba(166, 30, 77, 0.9) 75%, rgba(134, 46, 156, 0.9) 100%), url(jastimage/bb1.jpg) no-repeat center;
    background-size: cover;
    background-attachment: fixed;
    min-height: 100vh;
    animation: fadeIn 0.6s ease-in;
  }
  
  .register-container {
    animation: slideUp 0.8s ease-out;
  }
  
  @keyframes slideUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
.login-form{
    width: calc(100% - 20px);
    max-height: 650px;
    max-width: 500px;
    background: transparent;
    border: none;
    box-shadow: none;
    padding: 30px 0;
    transition: all 0.3s ease;
}

.card {
    background: transparent;
    border: none;
    box-shadow: none;
    border-radius: 0;
    overflow: visible;
}

.register-wrapper {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 245, 245, 0.95) 100%);
    backdrop-filter: blur(10px);
    border-radius: 25px;
    padding: 0;
    box-shadow: 0 20px 60px rgba(220, 53, 69, 0.3);
    overflow: hidden;
    transition: all 0.3s ease;
}

.register-wrapper:hover {
    box-shadow: 0 25px 70px rgba(220, 53, 69, 0.4);
    transform: translateY(-5px);
}

.nav-tabs {
    background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%) !important;
    border: none !important;
    border-radius: 0;
}

.nav-tabs .nav-link {
    color: rgba(255, 255, 255, 0.8) !important;
    border: none !important;
    border-radius: 0 !important;
    padding: 15px 30px !important;
    font-weight: 600;
    transition: all 0.3s ease;
}

.nav-tabs .nav-link:hover {
    color: white !important;
    background: rgba(255, 255, 255, 0.1) !important;
}

.nav-tabs .nav-link.active {
    background: rgba(255, 255, 255, 0.2) !important;
    color: white !important;
    border-bottom: 3px solid white !important;
}

.form-control {
    border: 2px solid rgba(220, 53, 69, 0.2);
    border-radius: 8px;
    padding: 12px 15px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    transform: translateY(-2px);
}

.btn-primary {
    background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%);
    border: none;
    border-radius: 8px;
    padding: 12px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #c92a2a 0%, #a61e4d 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
}

.tab-content {
    padding: 25px;
    background: white;
    border-radius: 0 0 15px 15px;
}

.tab-pane {
    animation: fadeInTab 0.4s ease-in;
}

@keyframes fadeInTab {
    from {
      opacity: 0;
      transform: translateX(10px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
}

.login-link {
    color: #dc3545;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.login-link:hover {
    color: #c92a2a;
    text-decoration: underline;
    transform: translateX(5px);
}

.login-icon {
    text-align: center;
    margin-bottom: 20px;
    padding-top: 20px;
}

.login-icon i {
    font-size: 4rem;
    color: #dc3545;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
      transform: scale(1);
    }
    50% {
      transform: scale(1.1);
    }
}

select.form-control {
    border: 2px solid rgba(220, 53, 69, 0.2);
    border-radius: 8px;
    padding: 12px 15px;
    transition: all 0.3s ease;
}

select.form-control:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    transform: translateY(-2px);
}
</style>
</head>
<?php $title="Blood Lifestyle Tracking System | Register"; ?>
<?php require 'head.php'; ?>
<body class="page-transition">
  <?php include 'header.php'; ?>

    <div class="container cont">

    <?php require 'message.php'; ?>
    
    <div class="register-container">

      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6 col-sm-8 col-xs-10 mb-5">
          <div class="register-wrapper">
            <div class="login-icon" style="padding-top: 30px;">
              <i class="fas fa-user-plus"></i>
            </div>
            <ul class="nav nav-tabs justify-content-center" style="padding: 0; margin: 0;">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#hospitals">
                  <i class="fas fa-hospital mr-2"></i>Hospitals
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#receivers">
                  <i class="fas fa-user mr-2"></i>User
                </a>
              </li>
            </ul>

    <div class="tab-content" style="padding: 40px 35px;">

       <div class="tab-pane container active" id="hospitals">

        <form action="file/hospitalReg.php" method="post" enctype="multipart/form-data">
          <input type="text" name="hname" placeholder="Hospital Name" class="form-control mb-3" required>
          <input type="text" name="hcity" placeholder="Hospital City" class="form-control mb-3" required>
          <input type="tel" name="hphone" placeholder="Hospital Phone Number" class="form-control mb-3" required pattern="[0,6-9]{1}[0-9]{9,11}" title="Password must have start from 0,6,7,8 or 9 and must have 10 to 12 digit">
          <input type="email" name="hemail" placeholder="Hospital Email" class="form-control mb-3" required>
          <input type="password" name="hpassword" placeholder="Hospital Password" class="form-control mb-3" required minlength="6">
          <input type="submit" name="hregister" value="Register" class="btn btn-primary btn-block mb-4">
        </form>

       </div>


       <div class="tab-pane container fade" id="receivers">

         <form action="file/receiverReg.php" method="post" enctype="multipart/form-data">
          <input type="text" name="rname" placeholder="User Name" class="form-control mb-3" required>
          <select name="rbg" class="form-control mb-3" required>
                <option disabled="" selected="">Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
          </select>
          <input type="text" name="rcity" placeholder="User City" class="form-control mb-3" required>
          <input type="tel" name="rphone" placeholder="User Phone Number" class="form-control mb-3" required pattern="[0,6-9]{1}[0-9]{9,11}" title="Password must have start from 0,6,7,8 or 9 and must have 10 to 12 digit">
          <input type="email" name="remail" placeholder="User Email" class="form-control mb-3" required>
          <input type="password" name="rpassword" placeholder="User Password" class="form-control mb-3" required minlength="6">
          <input type="submit" name="rregister" value="Register" class="btn btn-primary btn-block mb-4">
        </form>

       </div>
    </div>
    <div class="text-center p-4" style="background: linear-gradient(135deg, rgba(255, 245, 245, 0.8) 0%, rgba(255, 255, 255, 0.8) 100%); border-top: 1px solid rgba(220, 53, 69, 0.2);">
      <a href="login.php" class="login-link">
        <i class="fas fa-sign-in-alt mr-2"></i>Already have an account? Login Now
      </a>
    </div>
</div>
</div>
</div>
    </div>
<?php require 'footer.php' ?>
</body>
</html>