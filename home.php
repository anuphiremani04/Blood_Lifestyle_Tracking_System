<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
<?php $title="Blood Lifestyle Tracking System | Home"; ?>
<?php require 'head.php'; ?>
<head>
  <title></title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/styles.css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
</head>
<body class="page-transition">
  <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #c92a2a 0%, #a61e4d 50%, #862e9c 100%); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4); backdrop-filter: blur(10px); padding: 15px 0;">
    <div class="container">
      <a class="navbar-brand" href="home.php" style="font-weight: 700; font-size: 1.4rem; text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5); letter-spacing: 0.5px; transition: all 0.3s ease;">
        <i class="fas fa-heartbeat" style="margin-right: 10px; color: #ffebee;"></i>Blood Lifestyle Tracking System
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border: 2px solid rgba(255, 255, 255, 0.5); border-radius: 8px; padding: 8px 12px;">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto align-items-center">
          
          <li class="nav-item">
            <a class="nav-link text-white nav-link-modern active" href="home.php" style="font-weight: 600; font-size: 1rem; padding: 10px 20px !important; margin: 0 5px; border-radius: 25px; transition: all 0.3s ease; position: relative;">
              <i class="fas fa-home" style="margin-right: 8px;"></i>Home
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link text-white nav-link-modern" href="about.php" style="font-weight: 600; font-size: 1rem; padding: 10px 20px !important; margin: 0 5px; border-radius: 25px; transition: all 0.3s ease; position: relative;">
              <i class="fas fa-info-circle" style="margin-right: 8px;"></i>About
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white nav-link-modern" href="contact.php" style="font-weight: 600; font-size: 1rem; padding: 10px 20px !important; margin: 0 5px; border-radius: 25px; transition: all 0.3s ease; position: relative;">
              <i class="fas fa-phone" style="margin-right: 8px;"></i>Contact
            </a>
          </li>
          <?php if (isset($_SESSION['hid'])) { ?>
          <li class="nav-item">
            <a class="nav-link btn-modern btn-logout" href="logout.php" style="margin-left: 15px; padding: 10px 25px; border-radius: 25px; font-weight: 600; font-size: 0.95rem;">
              <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i>Logout
            </a>
          </li>
          <?php } elseif (isset($_SESSION['rid'])) { ?>
          <li class="nav-item">
            <a class="nav-link btn-modern btn-logout" href="logout.php" style="margin-left: 15px; padding: 10px 25px; border-radius: 25px; font-weight: 600; font-size: 0.95rem;">
              <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i>Logout
            </a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link btn-modern btn-login" href="login.php" style="margin-right: 10px; padding: 10px 25px; border-radius: 25px; font-weight: 600; font-size: 0.95rem;">
              <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>Login
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn-modern btn-register" href="register.php" style="padding: 10px 25px; border-radius: 25px; font-weight: 600; font-size: 0.95rem;">
              <i class="fas fa-user-plus" style="margin-right: 8px;"></i>Register
            </a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
<style>
/* Modern Navigation Styles */
.navbar {
    position: sticky;
    top: 0;
    z-index: 1000;
}

.navbar-brand {
    transition: all 0.3s ease;
}

.navbar-brand:hover {
    transform: scale(1.05);
    text-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
}

.navbar-brand i {
    animation: heartbeat 2s ease-in-out infinite;
}

@keyframes heartbeat {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* Modern Nav Links */
.nav-link-modern {
    position: relative;
    overflow: hidden;
}

.nav-link-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.15);
    transition: left 0.4s ease;
    z-index: -1;
    border-radius: 25px;
}

.nav-link-modern:hover::before {
    left: 0;
}

.nav-link-modern:hover {
    background: rgba(255, 255, 255, 0.2) !important;
    transform: translateY(-3px);
    box-shadow: 
        0 5px 15px rgba(255, 255, 255, 0.3),
        0 0 20px rgba(255, 255, 255, 0.2);
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
}

.nav-link-modern i {
    transition: transform 0.3s ease;
}

.nav-link-modern:hover i {
    transform: scale(1.2) rotate(5deg);
}

/* Modern Buttons */
.btn-modern {
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
    display: inline-block;
    text-decoration: none;
}

.btn-modern::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
    z-index: 0;
}

.btn-modern:hover::before {
    width: 400px;
    height: 400px;
}

.btn-modern span, .btn-modern i {
    position: relative;
    z-index: 1;
}

/* Login Button */
.btn-login {
    background: rgba(255, 255, 255, 0.95);
    color: #dc3545 !important;
    border: 2px solid rgba(255, 255, 255, 0.8);
}

.btn-login:hover {
    background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%) !important;
    color: white !important;
    transform: translateY(-4px) scale(1.05);
    box-shadow: 
        0 0 20px rgba(255, 255, 255, 0.5),
        0 8px 25px rgba(220, 53, 69, 0.6),
        0 0 40px rgba(220, 53, 69, 0.4);
    border-color: rgba(255, 255, 255, 0.9);
}

/* Register Button */
.btn-register {
    background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%);
    color: white !important;
    border: 2px solid rgba(255, 255, 255, 0.5);
}

.btn-register:hover {
    background: linear-gradient(135deg, #c92a2a 0%, #a61e4d 100%) !important;
    transform: translateY(-4px) scale(1.05);
    box-shadow: 
        0 0 25px rgba(220, 53, 69, 0.8),
        0 8px 30px rgba(220, 53, 69, 0.6),
        0 0 50px rgba(220, 53, 69, 0.4);
    border-color: rgba(255, 255, 255, 0.8);
}

/* Logout Button */
.btn-logout {
    background: rgba(255, 255, 255, 0.2);
    color: white !important;
    border: 2px solid rgba(255, 255, 255, 0.5);
}

.btn-logout:hover {
    background: rgba(255, 255, 255, 0.3) !important;
    transform: translateY(-4px) scale(1.05);
    box-shadow: 
        0 0 20px rgba(255, 255, 255, 0.5),
        0 8px 25px rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.8);
}

/* Active State */
.nav-link-modern.active {
    background: rgba(255, 255, 255, 0.25) !important;
    box-shadow: 
        0 0 15px rgba(255, 255, 255, 0.4),
        inset 0 0 10px rgba(255, 255, 255, 0.1);
}

/* Responsive */
@media (max-width: 991px) {
    .navbar-nav {
        margin-top: 20px;
    }
    
    .nav-link-modern, .btn-modern {
        margin: 5px 0 !important;
        display: block;
        text-align: center;
    }
}
</style>
<!-- Image Gallery Section -->
<section class="my-5">
  <div class="py-5">
    <h2 class="text-center text-white" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Our Gallery</h2>
    <p class="text-center text-white">Images from our blood donation campaigns and healthcare facilities</p>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
        <div class="card neon-glow shadow-lg" style="overflow: hidden; border: 2px solid rgba(220, 53, 69, 0.3); cursor: pointer;">
          <img src="image/RBC10.jpg" class="card-img-top" alt="Blood Donation" style="height: 250px; object-fit: cover; transition: transform 0.3s;">
          <div class="card-body" style="background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%);">
            <h5 class="card-title text-danger">Blood Donation</h5>
            <p class="card-text">Every donation saves lives</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
        <div class="card neon-glow shadow-lg" style="overflow: hidden; border: 2px solid rgba(220, 53, 69, 0.3); cursor: pointer;">
          <img src="image/RBC12.jpg" class="card-img-top" alt="Healthcare" style="height: 250px; object-fit: cover; transition: transform 0.3s;">
          <div class="card-body" style="background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%);">
            <h5 class="card-title text-danger">Healthcare Services</h5>
            <p class="card-text">Quality healthcare for everyone</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
        <div class="card neon-glow shadow-lg" style="overflow: hidden; border: 2px solid rgba(220, 53, 69, 0.3); cursor: pointer;">
          <img src="jastimage/bb17.jpg" class="card-img-top" alt="Medical Care" style="height: 250px; object-fit: cover; transition: transform 0.3s;">
          <div class="card-body" style="background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%);">
            <h5 class="card-title text-danger">Medical Care</h5>
            <p class="card-text">Professional medical assistance</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
        <div class="card neon-glow shadow-lg" style="overflow: hidden; border: 2px solid rgba(220, 53, 69, 0.3); cursor: pointer;">
          <img src="jastimage/bb18.jpg" class="card-img-top" alt="Hospital" style="height: 250px; object-fit: cover; transition: transform 0.3s;">
          <div class="card-body" style="background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%);">
            <h5 class="card-title text-danger">Hospital Services</h5>
            <p class="card-text">State-of-the-art facilities</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
        <div class="card neon-glow shadow-lg" style="overflow: hidden; border: 2px solid rgba(220, 53, 69, 0.3); cursor: pointer;">
          <img src="jastimage/bb19.jpg" class="card-img-top" alt="Blood Bank" style="height: 250px; object-fit: cover; transition: transform 0.3s;">
          <div class="card-body" style="background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%);">
            <h5 class="card-title text-danger">Blood Bank</h5>
            <p class="card-text">Safe blood storage and management</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
        <div class="card neon-glow shadow-lg" style="overflow: hidden; border: 2px solid rgba(220, 53, 69, 0.3); cursor: pointer;">
          <img src="image/hospital1.jpg" class="card-img-top" alt="Medical Facility" style="height: 250px; object-fit: cover; transition: transform 0.3s;">
          <div class="card-body" style="background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%);">
            <h5 class="card-title text-danger">Medical Facility</h5>
            <p class="card-text">Modern healthcare infrastructure</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* Image hover effects */
.card:hover img {
  transform: scale(1.1);
}

.card {
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 40px rgba(220, 53, 69, 0.4) !important;
}
</style>

<!-- Additional Image Section -->
<section class="my-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 mb-4">
        <div class="card neon-glow shadow-lg" style="border: 2px solid rgba(220, 53, 69, 0.3); overflow: hidden; cursor: pointer;">
          <img src="image/bb2.jpg" class="card-img-top" alt="Blood Donation Campaign" style="height: 300px; object-fit: cover;">
          <div class="card-body text-center" style="background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%); color: white;">
            <h4 class="card-title">Join Our Mission</h4>
            <p class="card-text">Be a part of saving lives through blood donation</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 mb-4">
        <div class="card neon-glow shadow-lg" style="border: 2px solid rgba(220, 53, 69, 0.3); overflow: hidden; cursor: pointer;">
          <img src="jastimage/bb12.jpg" class="card-img-top" alt="Healthcare Support" style="height: 300px; object-fit: cover;">
          <div class="card-body text-center" style="background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%); color: white;">
            <h4 class="card-title">Healthcare Support</h4>
            <p class="card-text">Connecting donors with those in need</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="my-5">
  <div class="py-5">
    <h2 class="text-center text-white" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Quick Links</h2>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-12 mb-4">
        <div class="card neon-glow p-4 text-center h-100" style="background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%); border: 2px solid rgba(220, 53, 69, 0.3); box-shadow: 0 10px 30px rgba(220, 53, 69, 0.3); cursor: pointer;">
          <i class="fas fa-info-circle fa-3x text-danger mb-3"></i>
          <h3>About Us</h3>
          <p>Learn more about our mission to save lives through efficient blood management.</p>
          <a href="about.php" class="btn btn-danger btn-lg mt-3">Learn More</a>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-12 mb-4">
        <div class="card neon-glow p-4 text-center h-100" style="background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%); border: 2px solid rgba(220, 53, 69, 0.3); box-shadow: 0 10px 30px rgba(220, 53, 69, 0.3); cursor: pointer;">
          <i class="fas fa-phone fa-3x text-danger mb-3"></i>
          <h3>Contact Us</h3>
          <p>Get in touch with us for support, inquiries, or assistance.</p>
          <a href="contact.php" class="btn btn-danger btn-lg mt-3">Contact Now</a>
        </div>
      </div>
    </div>
  </div>
</section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <?php require 'footer.php'; ?>
</body>
</html>

