<?php 
session_start();
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Car Rental Portal</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
</head>
<body>

<!--Header-->
<header>
  <div class="default-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-2">
          <div class="logo"> 
            <a href="index.php">
              <img src="assets/images/logo.png" alt="image"/>
            </a> 
          </div>
        </div>
        <div class="col-sm-9 col-md-10">
          <div class="header_info">
          <?php
            // Fetch email and contact information from the database
            $sql = "SELECT EmailId, ContactNo FROM tblcontactusinfo";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            // Assign values to email and contactno
            if($query->rowCount() > 0) {
              foreach($results as $result) {
                $email = $result->EmailId;
                $contactno = $result->ContactNo;
              }
            }
          ?>

            <div class="header_widgets">
              <div class="circle_icon"> 
                <i class="fa fa-envelope" aria-hidden="true"></i> 
              </div>
              <p class="uppercase_text">For Support Mail us : </p>
              <a href="mailto:<?php echo htmlentities($email); ?>">
                <?php echo htmlentities($email); ?>
              </a>
            </div>
            <div class="header_widgets">
              <div class="circle_icon"> 
                <i class="fa fa-phone" aria-hidden="true"></i> 
              </div>
              <p class="uppercase_text">Service Helpline Call Us: </p>
              <a href="tel:<?php echo htmlentities($contactno); ?>">
                <?php echo htmlentities($contactno); ?>
              </a>
            </div>

            <!-- Login / Register -->
            <?php if(strlen($_SESSION['login']) == 0) { ?>
              <div class="login_btn"> 
                <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">
                  Login / Register
                </a> 
              </div>
            <?php } else { 
              echo "Welcome To Car Rental Portal";
            } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span> 
        </button>
      </div>
      <div class="header_wrap">
        <div class="user_login">
          <ul>
            <li class="dropdown">
              <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user-circle" aria-hidden="true"></i> 
                <?php 
                  // Fetch user full name based on session email
                  $email = $_SESSION['login'];
                  $sql = "SELECT FullName FROM tblusers WHERE EmailId=:email";
                  $query = $dbh->prepare($sql);
                  $query->bindParam(':email', $email, PDO::PARAM_STR);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  if($query->rowCount() > 0) {
                    foreach($results as $result) {
                      echo htmlentities($result->FullName);
                    }
                  }
                ?>
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
              <ul class="dropdown-menu">
                <?php if($_SESSION['login']) { ?>
                  <li><a href="profile.php">Profile Settings</a></li>
                  <li><a href="update-password.php">Update Password</a></li>
                  <li><a href="my-booking.php">My Booking</a></li>
                  <li><a href="post-testimonial.php">Post a Testimonial</a></li>
                  <li><a href="my-testimonials.php">My Testimonial</a></li>
                  <li><a href="logout.php">Sign Out</a></li>
                <?php } ?>
              </ul>
            </li>
          </ul>
        </div>

        <!-- Search Bar -->
        <div class="header_search">
          <div id="search_toggle">
            <i class="fa fa-search" aria-hidden="true"></i>
          </div>
          <form action="search.php" method="post" id="header-search-form">
            <input type="text" placeholder="Search..." name="searchdata" class="form-control" required="true">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
        </div>
      </div>
      
      <!-- Navigation Links -->
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="page.php?type=aboutus">About Us</a></li>
          <li><a href="car-listing.php">Car Listing</a></li>
          <li><a href="page.php?type=faqs">FAQs</a></li>
          <li><a href="contact-us.php">Contact Us</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navigation end -->
</header>

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>
