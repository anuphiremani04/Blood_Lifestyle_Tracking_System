<nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="background: linear-gradient(135deg, #c92a2a 0%, #a61e4d 50%, #862e9c 100%); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);">
    <div class="container">
        <a class="navbar-brand text-white" href="home.php" style="font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);"><img src="image/favicon.jpg" width="30" height="30" class="rounded-circle">Blood Lifestyle Tracking System</a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"><i class="fas fa-align-left"></i></span>
          </button>

          <div class="collapse navbar-collapse" id="collapsibleNavbar">

        <?php if (isset($_SESSION['hid'])) { ?>
                    <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link btn btn-light btn-sm text-danger font-weight-bold" href="logout.php" style="border: 2px solid white;">Logout</a>
            </li>
        </ul>
        <?php } elseif (isset($_SESSION['rid'])) { ?>
                    <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link btn btn-light btn-sm text-danger font-weight-bold" href="logout.php" style="border: 2px solid white;">Logout</a>
            </li>
        </ul>
        <?php }  else { ?>
                    <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link btn btn-light btn-sm font-weight-bold" href="login.php" style="margin-right: 10px; border: 2px solid white; color: #dc3545;">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-light btn-sm text-white font-weight-bold" href="register.php" style="background: linear-gradient(135deg, #dc3545 0%, #c92a2a 100%); border: 2px solid white;">Register</a>
            </li>

        </ul>

        <?php } ?>
       </div>
    </div>
</nav>
<style>
/* Enhanced hover effects for header navigation buttons */
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
</style>