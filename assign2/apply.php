<!DOCTYPE html>
<html lang="en">
<head>
<title>Corporate | Apply</title>
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
<div class="container">
  <header class="sixteen columns alpha omega"> <a href="index.php"><img class="brand" src="img/logo.png" alt="Corporate"></a>
    <nav class="main-nav sixteen columns">
      <ul class="ten columns alpha">
        <li><a href="index.php">Home</a></li>
        <li><a href="jobs.php">Jobs</a></li>
        <li><a href="apply.php">Apply</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="phpenhancements.php">Login</a></li>
      </ul>
      <div class="social six columns omega">  <a href="https://www.facebook.com/">facebook</a> <a href="https://x.com/home">X</a> </div>
      <!--Close Social Div-->
    </nav>
  </header>
  <div class="sixteen columns">
    <div class="h-border">
      <div class="heading">
        <h1>Job Application Form</h1>
      </div>
      <!--Close "Heading" Div-->
    </div>
    <!--Close H-border Div-->
  </div>
  <section class="row contact">
    <div class="sixteen columns">
      

      <form class="clearfix" method="post" action="processEOI.php" novalidate="novalidate"> 
        
    
        <label for="job-reference-number">Job reference number (5 alphanumeric):</label>
        <input name="job-reference-number" type="text" id="job-reference-number" class="small-text" placeholder="Job reference number (5 alphanumeric)" pattern="[A-Za-z0-9]{5}" required title="Exactly 5 alphanumeric characters">
    
        <label for="first-name">First name (Max 20 characters):</label>
        <input name="first-name" type="text" id="first-name" class="small-text" placeholder="First name" maxlength="20" pattern="[A-Z a-z]{1,20}" required title="Max 20 alpha characters">
    
        <label for="last-name">Last name (Max 20 characters):</label>
        <input name="last-name" type="text" id="last-name" class="small-text" placeholder="Last name" maxlength="20" pattern="[A-Z a-z]{1,20}" required title="Max 20 alpha characters">
    
        <label for="dob">Date of birth (dd/mm/yyyy):</label>
        <input name="dob" type="text" id="dob" class="small-text" placeholder="Date of birth" pattern="\d{2}/\d{2}/\d{4}" required title="Format: dd/mm/yyyy">
    
        <label for="street-address">Street Address (Max 40 characters):</label>
        <input name="street-address" type="text" id="street-address" class="small-text" placeholder="Street Address" maxlength="40" required title="Max 40 characters">
    
        <label for="suburb">Suburb/town (Max 40 characters):</label>
        <input name="suburb" type="text" id="suburb" class="small-text" placeholder="Suburb/town" maxlength="40" required title="Max 40 characters">
    
        <label for="postcode">Postcode (4 digits):</label>
        <input name="postcode" type="text" id="postcode" class="small-text" placeholder="Postcode" pattern="\d{4}" required title="Exactly 4 digits">
    
        <label for="email">Email (e.g. example@mail.com):</label>
        <input name="email" type="email" id="email" class="small-text" placeholder="Email" required>
    
        <label for="phone-number">Phone number (8 to 12 digits):</label>
        <input name="phone-number" type="text" id="phone-number" class="small-text" placeholder="Phone number" pattern="\d{8,12}|\d{4}\s\d{4}" required title="Phone number must be 8 to 12 digits">
    
        <!-- Flexbox for Gender and State -->
        <div class="flex-container">
          <div class="flex-item">
            <fieldset>
              <legend>Gender:</legend>
              <div class="gender-container">
                <label for="male"><input type="radio" name="gender" id="male" value="male" required> Male</label>
                <label for="female"><input type="radio" name="gender" id="female" value="female"> Female</label>
                <label for="other"><input type="radio" name="gender" id="other" value="other"> Other</label>
              </div>
            </fieldset>
          </div>
    
          <div class="flex-item">
            <fieldset>
              <legend>State:</legend>
              <p>
                <label for="State">Select your state:</label>
                <select name="State" id="State" required>
                  <option value="">Please Select</option>
                  <option value="VIC">VIC</option>
                  <option value="NSW">NSW</option>
                  <option value="QLD">QLD</option>
                  <option value="NT">NT</option>
                  <option value="WA">WA</option>
                  <option value="SA">SA</option>
                  <option value="TAS">TAS</option>
                  <option value="ACT">ACT</option>
                </select>
              </p>
            </fieldset>
          </div>
        </div>
    
        <fieldset>
          <legend>Skill list:</legend>
          <div class="skills-container">
            <label for="HTML"><input type="checkbox" id="HTML" name="skills[]" checked value="HTML"> HTML</label>
            <label for="CSS"><input type="checkbox" id="CSS" name="skills[]" value="CSS"> CSS</label>
            <label for="JavaScript"><input type="checkbox" id="JavaScript" name="skills[]" value="JavaScript"> JavaScript</label>
            <label for="PHP"><input type="checkbox" id="PHP" name="skills[]" value="PHP"> PHP</label>
            <label for="MySQL"><input type="checkbox" id="MySQL" name="skills[]" value="MySQL"> MySQL</label>
            <label for="Others"><input type="checkbox" id="Others" name="skills[]" value="Others"> Others</label>
          </div>
        </fieldset>
    
        <label for="other-skills">List any other relevant skills:</label>
        <textarea name="other-skills" id="other-skills" class="message" placeholder="List any other relevant skills"></textarea>
    
        <input type="submit" class="btn green" value="Submit">
      </form>


      <div class="h-border">
        <div class="heading">
          <h2>Where we are</h2>
          <p>Click here to see ( you can bring us your CV also)</p>
        </div>
        <!--Close "Heading" Div-->
      </div>
      <!--Close H-border Div-->
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.8121618404934!2d105.83453557379626!3d21.00016538876296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad467c957b2d%3A0xb76c97588b21774!2sHH1%20Meco%20Complex!5e0!3m2!1svi!2s!4v1727992206713!5m2!1svi!2s" width="940" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      <br>
      <small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=123+Main+St,+Staten+Island,+NY&amp;aq=0&amp;oq=123&amp;sll=35.456287,-84.608387&amp;sspn=0.09774,0.181789&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=123+Main+St,+Staten+Island,+Richmond,+New+York+10307&amp;ll=40.511842,-74.249554&amp;spn=0.020555,0.080595&amp;z=14&amp;iwloc=A" style="color: transparent ;text-align:left">map</a></small> 
    </div>
  </section>
  <div class="clear"></div>
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
        <li><phpenhancements.php">Login</a></li>
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