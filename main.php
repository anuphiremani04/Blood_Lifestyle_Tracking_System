<?php 
    // Redirect to home.php
    header("location:home.php");
    exit();
?>
      
      <li class="nav-item">
        <a class="nav-link text-white" href="about.php" style="font-weight: 500;">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="contact.php" style="font-weight: 500;">Contact</a>
      </li>
      <?php if (isset($_SESSION['hid'])) { ?>
      <li class="nav-item">
        <span class="nav-link text-white" style="font-weight: 500;">Hospital: <?php echo isset($_SESSION['hname']) ? $_SESSION['hname'] : 'Logged In'; ?></span>
      </li>
      <li class="nav-item">
        <a class="nav-link btn btn-light btn-sm text-danger font-weight-bold" href="logout.php" style="margin-left: 10px; border: 2px solid white;">Logout</a>
      </li>
      <?php } elseif (isset($_SESSION['rid'])) { ?>
      <li class="nav-item">
        <span class="nav-link text-white" style="font-weight: 500;">User: <?php echo isset($_SESSION['rname']) ? $_SESSION['rname'] : 'Logged In'; ?></span>
      </li>
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
</nav>
<style>
/* Enhanced hover effects for navigation buttons */
.navbar .btn {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.navbar .btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
    z-index: -1;
}

.navbar .btn:hover::before {
    width: 300px;
    height: 300px;
}

.navbar .btn:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.6);
}

.navbar .btn-light:hover {
    background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%) !important;
    color: white !important;
    border-color: #dc3545 !important;
}

.navbar .btn[style*="background: linear-gradient"]:hover {
    background: linear-gradient(135deg, #c92a2a 0%, #a61e4d 100%) !important;
}

/* Nav link hover effects */
.navbar-nav .nav-link {
    transition: all 0.3s ease;
    position: relative;
    padding: 8px 15px !important;
}

.navbar-nav .nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 3px;
    bottom: 0;
    left: 50%;
    background: linear-gradient(135deg, #ffffff 0%, #ffebee 100%);
    transition: all 0.3s ease;
    transform: translateX(-50%);
    border-radius: 2px;
}

.navbar-nav .nav-link:hover::after {
    width: 70%;
}

.navbar-nav .nav-link:hover {
    color: #ffebee !important;
    transform: translateY(-2px);
    text-shadow: 0 2px 5px rgba(255, 255, 255, 0.3);
}
</style>
<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="image/slide-1.jpg" alt="Los Angeles" width="1100" height="500">
    </div>
    <div class="carousel-item">
      <img src="image/cc1.jpg" alt="Chicago" width="1100" height="500">
    </div>
    <div class="carousel-item">
      <img src="image/blog-4.png" alt="New York" width="1100" height="500">
    </div>
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

<section class="my-5">
  <div class="py-5">
    <h2 class="text-center text-white" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Quick Links</h2>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-12 mb-4">
        <div class="card p-4 text-center h-100" style="background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%); border: 2px solid rgba(220, 53, 69, 0.3); box-shadow: 0 10px 30px rgba(220, 53, 69, 0.3);">
          <i class="fas fa-info-circle fa-3x text-danger mb-3"></i>
          <h3>About Us</h3>
          <p>Learn more about our mission to save lives through efficient blood management.</p>
          <a href="about.php" class="btn btn-danger btn-lg mt-3">Learn More</a>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-12 mb-4">
        <div class="card p-4 text-center h-100" style="background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%); border: 2px solid rgba(220, 53, 69, 0.3); box-shadow: 0 10px 30px rgba(220, 53, 69, 0.3);">
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