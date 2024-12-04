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

            
// Redirect if accessed directly without form submission

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
        <li>                <?php
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
  
    <h1>HR Manager - EOI Management</h1>

    <!-- Form to list all EOIs -->
    <form class="form-1" action="manage.php" method="POST">
        <input type="hidden" name="action" value="listAll">
        <button type="submit">List All EOIs</button>
    </form>

    <!-- Form to list EOIs by Job Reference -->
    <form class="form-1" action="manage.php" method="POST">
        <input type="hidden" name="action" value="listByJobRef">
        <label for="jobRef">Job Reference Number:</label>
        <input type="text" id="jobRef" name="jobRef" required>
        <button type="submit">Search</button>
    </form>

    <!-- Form to list EOIs by Applicant Name -->
    <form class="form-1" action="manage.php" method="POST">
        <input type="hidden" name="action" value="listByApplicant">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName">
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName">
        <button type="submit">Search</button>
    </form>

    <!-- Form to delete EOIs by Job Reference -->
    <form class="form-1" action="manage.php" method="POST">
        <input type="hidden" name="action" value="deleteByJobRef">
        <label for="deleteJobRef">Job Reference Number to Delete:</label>
        <input type="text" id="deleteJobRef" name="deleteJobRef" required>
        <button type="submit">Delete EOIs</button>
    </form>

    <!-- Form to update EOI status -->
    <form class="form-1" action="manage.php" method="POST">
        <input type="hidden" name="action" value="updateStatus">
        <label for="eoiNumber">EOI Number:</label>
        <input type="text" id="eoiNumber" name="eoiNumber" required>
        <label for="status">New Status:</label>
        <select id="status" name="status" required>
            <option value="New">New</option>
            <option value="Current">Current</option>
            <option value="Final">Final</option>
        </select>
        <button type="submit">Update Status</button>
    </form>

    <?php
    // Start session to manage errors or messages
    
    // Handle operations based on form submission
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($action == 'listAll') {
        // List all EOIs
        $query = "SELECT * FROM eoi";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<h2>All EOIs</h2>";
            echo "<table><tr><th>EOI Number</th><th>Job Ref No</th><th>Name</th><th>Gender</th><th>Status</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td data-label='EOI Number'>{$row['EOInumber']}</td>";
                echo"<td data-label='Job Ref No'>{$row['job_ref_no']}</td>";
                echo"<td data-label='Name'>{$row['first_name']} {$row['last_name']}</td>";
                echo"<td data-label='Gender'>{$row['gender']}</td>";
                echo"<td data-label='Status'>{$row['status']}</td>";
                echo"</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No EOIs found.</p>";
        }
    }

    if ($action == 'listByJobRef') {
        // List EOIs for a particular job reference number
        $jobRef = isset($_POST['jobRef']) ? $_POST['jobRef'] : '';
        if ($jobRef) {
            $query = "SELECT * FROM eoi WHERE job_ref_no = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $jobRef);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<h2>EOIs for Job Reference: $jobRef</h2>";
                echo "<table><tr><th>EOI Number</th><th>Job Ref No</th><th>Name</th><th>Gender</th><th>Status</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td data-label='EOI Number'>{$row['EOInumber']}</td>";
                    echo"<td data-label='Job Ref No'>{$row['job_ref_no']}</td>";
                    echo"<td data-label='Name'>{$row['first_name']} {$row['last_name']}</td>";
                    echo"<td data-label='Gender'>{$row['gender']}</td>";
                    echo"<td data-label='Status'>{$row['status']}</td>";
                    echo"</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No EOIs found for job reference: $jobRef.</p>";
            }
            $stmt->close();
        }
    }

    if ($action == 'listByApplicant') {
        // List EOIs for a particular applicant based on first name, last name, or both
        $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
        $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';

        $query = "SELECT * FROM eoi WHERE first_name LIKE ? AND last_name LIKE ?";
        $stmt = $conn->prepare($query);
        $firstNameLike = "%" . $firstName . "%";
        $lastNameLike = "%" . $lastName . "%";
        $stmt->bind_param('ss', $firstNameLike, $lastNameLike);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<h2>EOIs for Applicant: $firstName $lastName</h2>";
            echo "<table><tr><th>EOI Number</th><th>Job Ref No</th><th>Name</th><th>Gender</th><th>Status</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td data-label='EOI Number'>{$row['EOInumber']}</td>";
                echo"<td data-label='Job Ref No'>{$row['job_ref_no']}</td>";
                echo"<td data-label='Name'>{$row['first_name']} {$row['last_name']}</td>";
                echo"<td data-label='Gender'>{$row['gender']}</td>";
                echo"<td data-label='Status'>{$row['status']}</td>";
                echo"</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No EOIs found for $firstName $lastName.</p>";
        }
        $stmt->close();
    }

    if ($action == 'deleteByJobRef') {
        // Delete all EOIs with a specified job reference number
        $jobRef = isset($_POST['deleteJobRef']) ? $_POST['deleteJobRef'] : '';
        if ($jobRef) {
            $query = "DELETE FROM eoi WHERE job_ref_no = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $jobRef);
            if ($stmt->execute()) {
                echo "<p>All EOIs for job reference number $jobRef have been deleted.</p>";
            } else {
                echo "<p>Error deleting EOIs.</p>";
            }
            $stmt->close();
        }
    }

    if ($action == 'updateStatus') {
        // Update the status of an EOI
        $eoiNumber = isset($_POST['eoiNumber']) ? $_POST['eoiNumber'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        if ($eoiNumber && in_array($status, ['New', 'Current', 'Final'])) {
            $query = "UPDATE eoi SET status = ? WHERE EOInumber = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('si', $status, $eoiNumber);
            if ($stmt->execute()) {
                echo "<p>Status of EOI number $eoiNumber has been updated to $status.</p>";
            } else {
                echo "<p>Error updating the status.</p>";
            }
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
    ?>


  <footer class="row">
    <div class="eight columns omega">
      <p>&copy;2024 <a href="index.php">Corporate</a> | HD aimers</p>
    </div>
    <nav class="eight columns alpha">
      <ul>
        <li><?php if ($user['role'] === 'admin') {
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
