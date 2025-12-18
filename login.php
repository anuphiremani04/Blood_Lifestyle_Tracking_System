<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <style>
    body{
    background: linear-gradient(135deg, rgba(255, 107, 107, 0.9) 0%, rgba(238, 90, 111, 0.9) 25%, rgba(201, 42, 42, 0.9) 50%, rgba(166, 30, 77, 0.9) 75%, rgba(134, 46, 156, 0.9) 100%), url(image/RBC11.jpg) no-repeat center;
    background-size: cover;
    background-attachment: fixed;
    min-height: 100vh;
    animation: fadeIn 0.6s ease-in;
  }
  
  .login-container {
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
  
  .login-wrapper {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 245, 245, 0.95) 100%);
    backdrop-filter: blur(10px);
    border-radius: 25px;
    padding: 0;
    box-shadow: 0 20px 60px rgba(220, 53, 69, 0.3);
    overflow: hidden;
    transition: all 0.3s ease;
  }
  
  .login-wrapper:hover {
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
  
  .form-label {
    color: #dc3545;
    font-weight: 600;
    margin-bottom: 8px;
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
  
  .register-link {
    color: #dc3545;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
  }
  
  .register-link:hover {
    color: #c92a2a;
    text-decoration: underline;
    transform: translateX(5px);
  }
  
  .login-icon {
    text-align: center;
    margin-bottom: 20px;
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
</style>
</head>
<?php $title="Blood Lifestyle Tracking System | Login"; ?>
<?php require 'head.php'; ?>
<body class="page-transition">
  <?php require 'header.php'; ?>

    <div class="container cont">
      
      <?php require 'message.php'; ?>

      <div class="row justify-content-center login-container">
        <div class="col-lg-5 col-md-6 col-sm-8 col-xs-10 mb-5">
          <div class="login-wrapper">
            <div class="login-icon" style="padding-top: 30px;">
              <i class="fas fa-heartbeat"></i>
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
                <form action="file/hospitalLogin.php" class="login-form" method="post">
                  <div class="form-group">
                    <label class="form-label"><i class="fas fa-envelope mr-2"></i>Hospital Email</label>
                    <input type="email" name="hemail" placeholder="Enter your hospital email" class="form-control mb-4" required>
                  </div>
                  <div class="form-group">
                    <label class="form-label"><i class="fas fa-lock mr-2"></i>Hospital Password</label>
                    <input type="password" name="hpassword" placeholder="Enter your password" class="form-control mb-4" required>
                  </div>
                  <input type="submit" name="hlogin" value="Login" class="btn btn-primary btn-block mb-4">
                </form>
              </div>

              <div class="tab-pane container fade" id="receivers">
                <form action="file/receiverLogin.php" class="login-form" method="post">
                  <div class="form-group">
                    <label class="form-label"><i class="fas fa-envelope mr-2"></i>User Email</label>
                    <input type="email" name="remail" placeholder="Enter your email" class="form-control mb-4" required>
                  </div>
                  <div class="form-group">
                    <label class="form-label"><i class="fas fa-lock mr-2"></i>User Password</label>
                    <input type="password" name="rpassword" placeholder="Enter your password" class="form-control mb-4" required>
                  </div>
                  <input type="submit" name="rlogin" value="Login" class="btn btn-primary btn-block mb-4">
                </form>
              </div>
            </div>
            <div class="text-center p-4" style="background: linear-gradient(135deg, rgba(255, 245, 245, 0.8) 0%, rgba(255, 255, 255, 0.8) 100%); border-top: 1px solid rgba(220, 53, 69, 0.2);">
              <a href="register.php" class="register-link">
                <i class="fas fa-user-plus mr-2"></i>Don't have an account? Register Now
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php require 'footer.php' ?>
</body>
</html>