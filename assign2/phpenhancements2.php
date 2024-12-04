<!DOCTYPE html>
<html lang="en">
<head>
<title>Corporate | Jobs</title>
<meta charset="utf-8">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/flexslider.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<meta name="description" content="Assignment2">
<meta name="keywords" content="Assignment2">
<meta name="author" content="Nguyen Dinh Dung, Pham Quang Thai, Nguyen Ngoc Thanh Thanh">
<meta name="charset" content="Corporate">
</head>
<body>
<div class="container">
<?php
            session_start();

            if (!isset($_SESSION['username'])) {
                header("Location: phpenhancements.php");
                exit();
            }

            $username = $_SESSION['username'];
            

            $conn = new mysqli('feenix-mariadb.swin.edu.au', 's104991438', '181105', 's104991438_db');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to fetch user information, including role
            $sql = "SELECT id, username, role, created_at, email, location FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if (!$user) {
                echo "<p>User information not found.</p>";
                exit();
            }

            $user_email = $user['email'];
            ?>
  <header class="sixteen columns alpha omega"> <a href="index.php"><img class="brand" src="img/logo.png" alt="Corporate"></a>
    <nav class="main-nav sixteen columns">
      <ul class="ten columns alpha">
        <li>                <!-- Dynamic "Go back" link based on role -->
                <?php
                if ($user['role'] === 'admin') {
                    echo '<a href="phpenhancements4.php">Home</a>';
                } else {
                    echo '<a href="phpenhancements3.php">Home</a>';
                }
                ?></li>
        <li><a href="jobs.php">Jobs</a></li>
        <li><a href="apply.php">Apply</a></li>
        <li><a href="about.php">About</a></li>
      </ul>
      <div class="social six columns omega">  <a href="https://www.facebook.com/">facebook</a> <a href="https://x.com/home">X</a> </div>
      <!--Close Social Div-->
    </nav>
  </header>
  
            

        <h2 class="Your-Infor">Your Information</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Email</th>
                    <th>Location</th>
                </tr>
                <tr>
                    <td data-label="ID"><?php echo htmlspecialchars($user['id']); ?></td>
                    <td data-label="Username"><?php echo htmlspecialchars($user['username']); ?></td>
                    <td data-label="Role"><?php echo htmlspecialchars($user['role']); ?></td>
                    <td data-label="Created At"><?php echo htmlspecialchars($user['created_at']); ?></td>
                    <td data-label="Email"><?php echo htmlspecialchars($user['email']); ?></td>
                    <td data-label="Location"><?php echo htmlspecialchars($user['location']); ?></td>
                </tr>
            </table><br><br>

            <?php
            $eoi_sql = "SELECT EOInumber, job_ref_no, first_name, last_name, dob, gender, street_address, suburb, state, postcode, email, phone, skills, other_skills, status FROM eoi WHERE email = ?";
            $stmt = $conn->prepare($eoi_sql);
            $stmt->bind_param("s", $user_email);
            $stmt->execute();
            $eoi_result = $stmt->get_result();
            ?>

            <h2>Your Submitted Job Applications</h2>
            <?php if ($eoi_result->num_rows > 0): ?>
                <?php while ($eoi = $eoi_result->fetch_assoc()): ?>
                    <table class="vertical-table">
                        <tr><th>EOI Number</th><td><?php echo htmlspecialchars($eoi['EOInumber']); ?></td></tr>
                        <tr><th>Job Reference Number</th><td><?php echo htmlspecialchars($eoi['job_ref_no']); ?></td></tr>
                        <tr><th>First Name</th><td><?php echo htmlspecialchars($eoi['first_name']); ?></td></tr>
                        <tr><th>Last Name</th><td><?php echo htmlspecialchars($eoi['last_name']); ?></td></tr>
                        <tr><th>Date of Birth</th><td><?php echo htmlspecialchars($eoi['dob']); ?></td></tr>
                        <tr><th>Gender</th><td><?php echo htmlspecialchars($eoi['gender']); ?></td></tr>
                        <tr><th>Street Address</th><td><?php echo htmlspecialchars($eoi['street_address']); ?></td></tr>
                        <tr><th>Suburb</th><td><?php echo htmlspecialchars($eoi['suburb']); ?></td></tr>
                        <tr><th>State</th><td><?php echo htmlspecialchars($eoi['state']); ?></td></tr>
                        <tr><th>Postcode</th><td><?php echo htmlspecialchars($eoi['postcode']); ?></td></tr>
                        <tr><th>Email</th><td><?php echo htmlspecialchars($eoi['email']); ?></td></tr>
                        <tr><th>Phone</th><td><?php echo htmlspecialchars($eoi['phone']); ?></td></tr>
                        <tr><th>Skills</th><td><?php echo htmlspecialchars($eoi['skills']); ?></td></tr>
                        <tr><th>Other Skills</th><td><?php echo htmlspecialchars($eoi['other_skills']); ?></td></tr>
                        <tr><th>Status</th><td><?php echo htmlspecialchars($eoi['status']); ?></td></tr>
                    </table>
                    <hr>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No job applications submitted yet.</p>
            <?php endif; ?>

            <div class="logout">
                To protect your information<br>
                <a href="index.php">Logout here</a><br>

                <!-- Dynamic "Go back" link based on role -->
                <?php
                if ($user['role'] === 'admin') {
                    echo '<a href="phpenhancements4.php">Go back</a>';
                } else {
                    echo '<a href="phpenhancements3.php">Go back</a>';
                }
                ?>
            </div>

            <?php
            $stmt->close();
            $conn->close();
            ?>
  <footer class="row">
    <div class="eight columns omega">
      <p>&copy;2024 <a href="index.php">Corporate</a> | HD aimers</p>
    </div>
    <nav class="eight columns alpha">
      <ul>
        <li><?php
                if ($user['role'] === 'admin') {
                    echo '<a href="phpenhancements4.php">Home</a>';
                } else {
                    echo '<a href="phpenhancements3.php">Home</a>';
                }
                ?></li>
        <li><a href="jobs.php">Jobs</a></li>
        <li><a href="apply.php">Apply</a></li>
        <li><a href="about.php">About</a></li>
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
