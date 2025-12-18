<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
<?php $title="Blood Lifestyle Tracking System | Contact page"; ?>
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
    .contact-info {
      background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
      color: white;
      padding: 30px;
      border-radius: 10px;
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
          <li class="nav-item">
            <a class="nav-link text-white" href="about.php" style="font-weight: 500;">About</a>
          </li>
          <li class="nav-item active">
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
      <h1 class="display-4">Contact Us</h1>
      <p class="lead">We are always here to help you! Get in touch with us anytime.</p>
    </div>
  </div>

  <div class="container my-5">
    <div class="row mb-5">
      <div class="col-lg-8 mx-auto">
        <div class="card p-5">
          <h2 class="text-center text-danger mb-4">Get In Touch</h2>
          <p class="text-center lead mb-4">Have questions, suggestions, or need assistance? We'd love to hear from you!</p>
          
          <div class="row mt-4">
            <div class="col-md-6 mb-4">
              <div class="text-center">
                <i class="fas fa-envelope fa-3x text-danger mb-3"></i>
                <h5>Email Us</h5>
                <p>For general inquiries and support</p>
                <a href="mailto:support@bloodlifestyle.com" class="text-danger">support@bloodlifestyle.com</a>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="text-center">
                <i class="fas fa-phone fa-3x text-danger mb-3"></i>
                <h5>Call Us</h5>
                <p>Available 24/7 for emergencies</p>
                <a href="tel:+9118000000000" class="text-danger">+91-1800-000-0000</a>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-md-6 mb-4">
              <div class="text-center">
                <i class="fas fa-map-marker-alt fa-3x text-danger mb-3"></i>
                <h5>Visit Us</h5>
                <p>Our office location</p>
                <p class="text-muted">123 Healthcare Avenue<br>Medical District, City - 123456<br>India</p>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="text-center">
                <i class="fas fa-clock fa-3x text-danger mb-3"></i>
                <h5>Business Hours</h5>
                <p>When you can reach us</p>
                <p class="text-muted">Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM<br>Sunday: Closed</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6 mb-4">
        <div class="card p-4 h-100">
          <h4 class="text-danger mb-3"><i class="fas fa-question-circle mr-2"></i>Frequently Asked Questions</h4>
          <p><strong>How do I register as a donor?</strong><br>
          Simply click on Register and select "User" tab. Fill in your details including your blood group and you're ready to help save lives!</p>
          <p><strong>How do hospitals request blood?</strong><br>
          Hospitals can register and then request blood samples from available donors through the system.</p>
          <p><strong>Is my information secure?</strong><br>
          Yes, we take data security seriously. All your information is encrypted and protected.</p>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card p-4 h-100">
          <h4 class="text-danger mb-3"><i class="fas fa-info-circle mr-2"></i>Support & Help</h4>
          <p>If you need technical support or have questions about using the system, please don't hesitate to contact us. Our support team is available to assist you with:</p>
          <ul>
            <li>Account registration and login issues</li>
            <li>Blood request and donation processes</li>
            <li>System navigation and features</li>
            <li>General inquiries about the platform</li>
          </ul>
          <p class="mt-3"><strong>Emergency Blood Requests:</strong><br>
          For urgent blood requirements, please contact your nearest hospital directly or call our emergency helpline.</p>
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