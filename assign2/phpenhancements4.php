<!DOCTYPE html>
<html lang="en">
<head>
<title>Corporate</title>
<meta charset="utf-8">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/flexslider.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Assignment2">
<meta name="keywords" content="Assignment2">
<meta name="author" content="Nguyen Dinh Dung, Pham Quang Thai, Nguyen Ngoc Thanh Thanh">
<meta name="charset" content="Corporate">
</head>
<body>
<?php
// index2.php - Admin interface

session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: phpenhancements.php");
    exit();
}

echo "Welcome Admin, this is your exclusive page!";
?>

<div class="container">
  <header class="sixteen columns alpha omega"> <a href="index.php"><img class="brand" src="img/logo.png" alt="Corporate"></a>
    <nav class="main-nav sixteen columns">
      <ul class="ten columns alpha">
        <li><a href="index.php">Home</a></li>
        <li><a href="jobs.php">Jobs</a></li>
        <li><a href="apply.php">Apply</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="phpenhancements2.php">Profile</a></li>
        <li><a href="manage.php">Manage</a></li>
      </ul>
      <div class="social six columns omega">  <a href="https://www.facebook.com/">facebook</a> <a href="https://x.com/home">X</a> </div>
      <!--Close Social Div-->
    </nav>
  </header>
  <section class="sixteen columns feature">
    <h2>Corporate</h2>
    <div class="flexslider">
      <ul class="slides">
        <li> 
          <video autoplay loop muted>
            <source src="img/intro.mp4" type="video/mp4">
          </video> 
        </li>
        <li> <a href="https://www.youtube.com/watch?v=yTD1tbcbPrw&t=2s"><img src="img/feature_1-(1).png" alt="feature-1"></a> </li>
        <li> <a href="about.php"><img src="img/feature_2-(1).png" alt="feature-2"></a> </li>
      </ul>
    </div>
    <!--Close Flexslider Div-->
  </section>
  <div class="sixteen columns">
    <div class="h-border">
      <div class="heading">
        <h1>Latest Work</h1>
      </div>
      <!--Close "Heading" Div-->
    </div>
    <!--Close H-border Div-->
  </div>
  <section class="latest-work row">
    <div class="one-third column thumbnail"> <a href="phpenhancements8.php"> <img src="img/front-end.png" alt="front-end">
      <div class="details">
        <h2>Front End Developer</h2>
          
            <ul>
              <li>Bachelor’s degree or equivalent AND 3 years of experience</li>
              <li>Hybrid Eligible - Minimum 2 days in office a week</li>
              <li>Fluent in English (spoken and written)</li>
            </ul>
          
        <div class="job-overview">
            <div class="job-details">
              <img src="img/location-icon.svg" class="job-icon" alt="location-icon">
              <p>Seattle, WA</p>
            </div>
            <div class="job-details">
              <img src="img/salary-icon.svg" class="job-icon" alt="salary-icon">
              <p>$25-$35/hr</p>
            </div>
        </div>
      </div>
      <!--Close Details Div-->
      </a> </div>
    <!--Close Thumbnail Div-->
    <div class="one-third column thumbnail"> <a href="phpenhancements5.php"> <img src="img/back-end.png" alt="back-end">
      <div class="details">
        <h2>Back End Developer</h2>
        
          <ul>
            <li>2-3 years experience in WordPress design and managing multiple websites simultaneously</li>
            <li>In-Office work</li>
            <li>Fluent in English (spoken and written)</li>
          </ul>
        
        <div class="job-overview">
          <div class="job-details">
            <img src="img/location-icon.svg" class="job-icon" alt="location-icon">
            <p>Philadelphia,<br>PA</p>
          </div>
          <div class="job-details">
            <img src="img/salary-icon.svg" class="job-icon" alt="salary-icon">
            <p>$47-$48/hr</p>
          </div>
        </div>
      </div>
      <!--Close Details Div-->
      </a> </div>
    <!--Close Thumbnail Div-->
    <div class="one-third column thumbnail"> <a href="phpenhancements11.php"> <img src="img/ML-Ops.png" alt="ML-Ops">
      <div class="details">
        <h2>Machine Learning Operations</h2>
        
          <ul>
            <li>5+ years of experience in Python Pandas, Spark and large-scale data pipelines</li>
            <li>Remote job with flexible schedule</li>
            <li>Fluent in English (spoken and written)</li>
          </ul>
        
        <div class="job-overview">
          <div class="job-details">
            <img src="img/location-icon.svg" class="job-icon" alt="location-icon">
            <p>Austin, TX</p>
          </div>
          <div class="job-details">
            <img src="img/salary-icon.svg" class="job-icon" alt="salary-icon">
            <p>$60-$70/hr</p>
          </div>
        </div>
      </div>
      <!--Close Details Div-->
      </a> </div>
    <!--Close Thumbnail Div-->
  </section>
  <div class="sixteen columns row">
    <div class="h-border">
      <div class="heading">
        <h2>Who Are We?</h2>
      </div>
      <!--Close "Heading" Div-->
    </div>
    <!--Close H-border Div-->
    <div class="focused-text"> 
        Welcome to Corporate – a forward-thinking technology company dedicated to innovation in both software and hardware solutions. At Corporate, we are shaping the future by bridging the gap between cutting-edge software development and advanced hardware technologies. Our projects range from sophisticated cloud-based systems to groundbreaking IoT devices, creating a seamless experience that empowers users around the globe.<br>
        <br>
          <div class="business-logo">
            <div class="toast replace1">
                <img src="img/business-logo1.svg" alt="OpenTable">
            </div>
            <div class="toast replace2">
                <img src="img/business-logo2.svg" alt="HubSpot">
            </div>
            <div class="toast replace3">
                <img src="img/business-logo3.svg" alt="Amazon">
            </div>
            <div class="toast replace4">
                <img src="img/business-logo4.svg" alt="Shopify">
            </div>
            <div class="toast replace5">
                <img src="img/business-logo5.svg" alt="Slack">
            </div>
          </div>
        <br>
        At Corporate, we thrive on collaboration and strategic partnerships that drive technological progress. Our success is built upon strong relationships with some of the most influential companies in the tech ecosystem, including OpenTable, HubSpot, Amazon, Shopify, and Slack. These partnerships allow us to integrate and leverage a diverse range of platforms, enhancing our capabilities across software and hardware development.
    </div>
    <!--Close Focused-text Div-->
  </div>
  <div class="row">
    <div class="eight columns center">
      <div class="h-border">
        <div class="heading">
          <h2>Web Designers</h2>
        </div>
        <!--Close "Heading" Div-->
      </div>
      <!--Close H-border Div-->
      <img src="img/webdesign.jpg" alt="webdesign">
      <p class="focused-text">At Corporate, Web Designers hold a central role, shaping the core look and feel of our digital products. They lead the visual design process, ensuring every user interaction is intuitive, engaging, and seamlessly integrated across all platforms.</p>
    </div>
    <div class="eight columns center">
      <div class="h-border">
        <div class="heading">
          <h2>Software Engineers</h2>
        </div>
        <!--Close "Heading" Div-->
      </div>
      <!--Close H-border Div-->
      <img src="img/SoftwareEngineering.webp" alt="SoftwareEngineering">
      <p class="focused-text">At Corporate, Software Engineers are at the heart of our innovation, driving the development of our core technologies. They lead the creation of scalable, high-performance systems that form the foundation of our software and hardware integration, ensuring seamless and impactful user experiences.</p>
    </div>
  </div>
  <footer class="row">
    <div class="eight columns omega">
      <p>&copy;2024 <a href="index.php">Corporate</a> | HD aimers</p>
    </div>
    <nav class="eight columns alpha">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="jobs.php">Jobs</a></li>
        <li><a href="apply.php">Apply</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="manage.php">Manage</a></li>
      </ul>
    </nav>
  </footer>
</div>
<!--Close Container Div-->
<!--Grab JS Files-->
<script src="js/jquery.js" ></script>
<script src="js/jquery.flexslider.js" ></script>
<script>
$(window)
    .load(function () {
    $('.flexslider')
        .flexslider({
        animation: "slide"
    });
});
</script>
</body>
</html>
