<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
<?php $title="Blood Lifestyle Tracking System | About page"; ?>
<?php require 'head.php'; ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(135deg, rgba(255, 107, 107, 0.85) 0%, rgba(238, 90, 111, 0.85) 25%, rgba(201, 42, 42, 0.85) 50%, rgba(166, 30, 77, 0.85) 75%, rgba(134, 46, 156, 0.85) 100%);
      background-attachment: fixed;
      min-height: 100vh;
    }
    .jumbotron {
      background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%);
      color: white;
      border-radius: 0;
      margin-bottom: 0;
    }
    .card {
      background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%);
      border: 2px solid rgba(220, 53, 69, 0.3);
      box-shadow: 0 10px 30px rgba(220, 53, 69, 0.3);
      margin-bottom: 20px;
    }
  </style>
</head>
<body class="page-transition">
  <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #c92a2a 0%, #a61e4d 50%, #862e9c 100%); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);">
    <div class="container">
      <a class="navbar-brand text-white" href="home.php" style="font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Blood Lifestyle Tracking System</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link text-white" href="home.php" style="font-weight: 500;">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link text-white" href="about.php" style="font-weight: 500;">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="contact.php" style="font-weight: 500;">Contact</a>
          </li>
          <?php if (isset($_SESSION['hid'])) { ?>
          <li class="nav-item">
            <a class="nav-link btn btn-light btn-sm text-danger font-weight-bold" href="logout.php" style="margin-left: 10px; border: 2px solid white;">Logout</a>
          </li>
          <?php } elseif (isset($_SESSION['rid'])) { ?>
          <li class="nav-item">
            <a class="nav-link btn btn-light btn-sm text-danger font-weight-bold" href="logout.php" style="margin-left: 10px; border: 2px solid white;">Logout</a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link btn btn-light btn-sm font-weight-bold" href="login.php" style="margin-right: 10px; border: 2px solid white; color: #dc3545;">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-light btn-sm text-white font-weight-bold" href="register.php" style="background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%); border: 2px solid white;">Register</a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="jumbotron jumbotron-fluid">
    <div class="container text-center">
      <h1 class="display-4">About Blood Lifestyle Tracking System</h1>
      <p class="lead">Connecting donors, recipients, and hospitals to save lives</p>
    </div>
  </div>

  <div class="container my-5">
    <div class="row mb-5">
      <div class="col-lg-6 col-md-6 col-12 mb-4">
        <img src="image/about1.png" class="img-fluid rounded shadow" alt="About Us">
      </div>
      <div class="col-lg-6 col-md-6 col-12">
        <div class="card p-4">
          <h2 class="text-danger mb-3">BLOOD - "I'm here to save you!"</h2>
          <p class="lead">We believe every life counts! Every life matters. Time is the thing we have and don't. Our goal is to make blood available in less time and save your precious life!</p>
          <p>Blood Lifestyle Tracking System is a comprehensive platform designed to bridge the gap between blood donors, recipients, and healthcare facilities. We understand that in medical emergencies, every second counts, and having quick access to the right blood type can make the difference between life and death.</p>
        </div>
      </div>
    </div>

    <div class="row mb-5">
      <div class="col-12">
        <div class="card p-4">
          <h3 class="text-center text-danger mb-4">Our Mission</h3>
          <p class="text-center lead">To create a seamless, efficient, and reliable blood management system that ensures timely access to blood for those in need while maintaining the highest standards of safety and quality.</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card p-4 text-center h-100">
          <i class="fas fa-heartbeat fa-3x text-danger mb-3"></i>
          <h4>For Donors</h4>
          <p>Register your blood type and availability. Help save lives by making it easy for hospitals to find compatible donors when needed.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card p-4 text-center h-100">
          <i class="fas fa-hospital fa-3x text-danger mb-3"></i>
          <h4>For Hospitals</h4>
          <p>Manage your blood inventory efficiently. Request blood from donors and track your blood bank stock in real-time.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-12 mb-4">
        <div class="card p-4 text-center h-100">
          <i class="fas fa-users fa-3x text-danger mb-3"></i>
          <h4>For Recipients</h4>
          <p>Find available blood quickly when you need it. Request blood from hospitals and track your request status.</p>
        </div>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-12">
        <div class="card p-4">
          <h3 class="text-center text-danger mb-4">Why Choose Us?</h3>
          <div class="row">
            <div class="col-md-6">
              <ul class="list-unstyled">
                <li class="mb-3"><i class="fas fa-check-circle text-danger mr-2"></i> <strong>Fast & Efficient:</strong> Quick blood matching and request processing</li>
                <li class="mb-3"><i class="fas fa-check-circle text-danger mr-2"></i> <strong>Real-time Updates:</strong> Get instant notifications about blood requests</li>
                <li class="mb-3"><i class="fas fa-check-circle text-danger mr-2"></i> <strong>Secure Platform:</strong> Your data is safe and protected</li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul class="list-unstyled">
                <li class="mb-3"><i class="fas fa-check-circle text-danger mr-2"></i> <strong>Easy to Use:</strong> Simple interface for all users</li>
                <li class="mb-3"><i class="fas fa-check-circle text-danger mr-2"></i> <strong>24/7 Availability:</strong> Access the system anytime, anywhere</li>
                <li class="mb-3"><i class="fas fa-check-circle text-danger mr-2"></i> <strong>Real-time Updates:</strong> Stay informed with instant status updates</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require 'footer.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>