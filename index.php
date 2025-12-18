<?php 
    // Redirect to home.php (home page with carousel)
    header("location:home.php");
    exit();
?>

    <div class="container cont">

   <?php require 'message.php'; ?>

        <!-- Prominent Login/Register Buttons at Top -->
        <div class="row justify-content-center mb-4">
            <div class="col-12 text-center">
                <div class="d-inline-block mr-3 mb-2">
                    <a href="login.php" class="btn btn-danger btn-lg" style="font-weight: bold; padding: 15px 40px; font-size: 1.2rem; min-width: 200px;">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </div>
                <div class="d-inline-block mb-2">
                    <a href="register.php" class="btn btn-primary btn-lg" style="font-weight: bold; padding: 15px 40px; font-size: 1.2rem; min-width: 200px;">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                </div>
            </div>
        </div>

        <!-- Login and Register Call-to-Action Section -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card shadow-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                    <div class="card-body text-center text-white p-5">
                        <h2 class="card-title mb-3" style="color: white; font-weight: bold;">
                            <i class="fas fa-heartbeat"></i> Join Our Blood Lifestyle Tracking Community
                        </h2>
                        <p class="card-text mb-4" style="font-size: 1.1rem;">
                            Help save lives by donating blood or register your hospital to manage blood inventory efficiently.
                        </p>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 col-sm-6 mb-3">
                                <a href="login.php" class="btn btn-light btn-lg btn-block" style="font-weight: bold; padding: 12px 30px; font-size: 1.1rem;">
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 mb-3">
                                <a href="register.php" class="btn btn-outline-light btn-lg btn-block" style="font-weight: bold; padding: 12px 30px; border-width: 2px; font-size: 1.1rem;">
                                    <i class="fas fa-user-plus"></i> Register
                                </a>
                            </div>
                        </div>
                        <p class="mt-3 mb-0" style="font-size: 0.9rem; opacity: 0.9;">
                            Already have an account? <a href="login.php" style="color: white; text-decoration: underline; font-weight: bold;">Login here</a> | 
                            New user? <a href="register.php" style="color: white; text-decoration: underline; font-weight: bold;">Register now</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5 col-xs-6 mb-5" style="width: 60%">
                <div class="card">
                    <img src="image/bg.png" class="card-img-top">
                </div>
            </div>

            <div class="col-lg-9">
            <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-5">
                <div class="card">
                    <div class="card-header text-center">A+</div>
                    <div class="card-body">
                        If you are A+: You can give blood to A+ and AB+. You can receive blood from A+, A-, O+ and O-
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-5">
                <div class="card">
                    <div class="card-header text-center">A-</div>
                    <div class="card-body">
                        If you are A-: You can give blood to A-, A+, AB- and AB+. You can receive blood from A- and O-. 
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-5">
                <div class="card">
                    <div class="card-header text-center">B+</div>
                    <div class="card-body">
                         You can give blood to A+ and AB+. You can receive blood from A+, A-, O+ and O-.
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-5">
                <div class="card">
                    <div class="card-header text-center">B-</div>
                    <div class="card-body">
                        If you are B-: You can give blood to B-, B+, AB+ and AB-, You can receive blood from B- and O-.You can give blood to B+ and AB+.
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-5">
                <div class="card">
                    <div class="card-header text-center">AB+</div>
                    <div class="card-body">
                         People with AB+ blood can receive red blood cells from any blood type. This means that demand for AB+ can donate with AB only.
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-5">
                <div class="card">
                    <div class="card-header text-center">AB-</div>
                    <div class="card-body"> 
                         AB- patients can receive red blood cells from all negative blood types.
                         AB- can give red blood cells to both AB- and AB+ blood types.
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-5">
                <div class="card">
                    <div class="card-header text-center">O+</div>
                    <div class="card-body">
                        Blood O+ can donate to A+, B+, AB+ and O+ Blood
                        Group O can donate red blood cells to anybody. It's the universal donor.
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-5">
                <div class="card">
                    <div class="card-header text-center">O-</div>
                    <div class="card-body">
                        O- can donate to A+, A-, B+, B-, AB+, AB-, O+ and O- Blood
                        People with O negative blood can only receive red cell donations from O negative donors.
                    </div>
                </div>
            </div>
            
            </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-6 rounded mb-5">

            </div>
            <div class="col-lg-6 rounded mb-5">
                 </div>
        </div>

        <div class="row mb-5">
            <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Health tips</div>
                <div class="card-body">
                    <dt>Eat a healthy diet</dt>
                    <dd>Eat a combination of different foods, including fruit, vegetables, legumes, nuts and whole grains. Adults should eat at least five portions (400g) of fruit and vegetables per day. You can improve your intake of fruits and vegetables by always including veggies in your meal; eating fresh fruit and vegetables as snacks; eating a variety of fruits and vegetables; and eating them in season. By eating healthy, you will reduce your risk of malnutrition and noncommunicable diseases (NCDs) such as diabetes, heart disease, stroke and cancer.</dd>
                    <dt> Consume less salt and sugar</dt>
                    <dd>On the other hand, consuming excessive amounts of sugars increases the risk of tooth decay and unhealthy weight gain. In both adults and children, the intake of free sugars should be reduced to less than 10% of total energy intake. This is equivalent to 50g or about 12 teaspoons for an adult. WHO recommends consuming less than 5% of total energy intake for additional health benefits. You can reduce your sugar intake by limiting the consumption of sugary snacks, candies and sugar-sweetened beverages.</dd>
                    <dt>Be active</dt>
                    <dd>Physical activity is defined as any bodily movement produced by skeletal muscles that requires energy expenditure. This includes exercise and activities undertaken while working, playing, carrying out household chores, travelling, and engaging in recreational pursuits. The amount of physical activity you need depends on your age group but adults aged 18-64 years should do at least 150 minutes of moderate-intensity physical activity throughout the week. Increase moderate-intensity physical activity to 300 minutes per week for additional health benefits.</dd>
                    <dt>Don't smoke</dt>
                    <dd>Smoking tobacco causes NCDs such as lung disease, heart disease and stroke. Tobacco kills not only the direct smokers but even non-smokers through second-hand exposure. Currently, there are around 15.9 million Filipino adults who smoke tobacco but 7 in 10 smokers are interested or plan to quit.
                    If you are currently a smoker, it's not too late to quit. Once you do, you will experience immediate and long-term health benefits. If you are not a smoker, that's great! Do not start smoking and fight for your right to breathe tobacco-smoke-free air.</dd>
                    <dt>Drink only safe water</dt>
                    <dt>Get tested</dt>
                    <dt>Follow traffic laws</dt>
                    <dt>Talk to someone you trust if you're feeling down</dt>
                    <dt>Clean your hands properly</dt>
                    <dt>Have regular check-ups</dt>
                    Visit here to get more health tips.
                    <a href="https://www.who.int/philippines/news/feature-stories/detail/20-health-tips-for-2020" target="_blank"> World Health Organisation</a>
                </div>
            </div>
            </div>
        </div>

        <!-- Quick Action Buttons Section -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10 col-md-12">
                <div class="card border-primary">
                    <div class="card-body text-center p-4">
                        <h4 class="card-title mb-4" style="color: #667eea;">
                            <i class="fas fa-bolt"></i> Quick Actions
                        </h4>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <i class="fas fa-hospital fa-3x mb-3" style="color: #667eea;"></i>
                                        <h5 class="card-title">For Hospitals</h5>
                                        <p class="card-text">Manage your blood inventory and handle requests efficiently.</p>
                                        <a href="register.php" class="btn btn-primary btn-block">
                                            <i class="fas fa-user-plus"></i> Register Hospital
                                        </a>
                                        <a href="login.php" class="btn btn-outline-primary btn-block mt-2">
                                            <i class="fas fa-sign-in-alt"></i> Hospital Login
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <i class="fas fa-user fa-3x mb-3" style="color: #764ba2;"></i>
                                        <h5 class="card-title">For Donors/Receivers</h5>
                                        <p class="card-text">Donate blood or request blood when in need.</p>
                                        <a href="register.php" class="btn btn-primary btn-block">
                                            <i class="fas fa-user-plus"></i> Register as User
                                        </a>
                                        <a href="login.php" class="btn btn-outline-primary btn-block mt-2">
                                            <i class="fas fa-sign-in-alt"></i> User Login
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <i class="fas fa-info-circle fa-3x mb-3" style="color: #f093fb;"></i>
                                        <h5 class="card-title">Learn More</h5>
                                        <p class="card-text">Find out about blood compatibility and donation requirements.</p>
                                        <a href="#blood-info" class="btn btn-primary btn-block" onclick="document.querySelector('.row.justify-content-center').scrollIntoView({behavior: 'smooth'});">
                                            <i class="fas fa-arrow-down"></i> View Blood Info
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require 'footer.php'; ?>

</body>
</html>