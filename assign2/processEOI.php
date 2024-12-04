

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status</title>
    <script>
        // Delay before redirecting
        setTimeout(function() {
            window.location.href = "phpenhancements4.php";  // Change this URL based on user role or destination
        }, 5000); // Delay in milliseconds (5000 ms = 5 seconds)
    </script>
</head>
<body>
<?php
session_start(); // Start the session to store success message

// Redirect if accessed directly without form submission
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: apply.php"); // Redirect to the apply page
    exit;
}

// Database connection
require_once('setting.php');


// Create MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the eoi table exists, and create it if it does not
$tableCheckSQL = "SHOW TABLES LIKE 'eoi'";
$tableExists = $conn->query($tableCheckSQL);

if ($tableExists->num_rows == 0) {
    // Table does not exist, so create it
    $createTableSQL = "CREATE TABLE eoi (
        EOInumber INT AUTO_INCREMENT PRIMARY KEY,
        job_ref_no VARCHAR(20) NOT NULL,
        first_name VARCHAR(20) NOT NULL,
        last_name VARCHAR(20) NOT NULL,
        dob DATE NOT NULL,
        gender ENUM('male', 'female', 'other') NOT NULL,
        street_address VARCHAR(40) NOT NULL,
        suburb VARCHAR(40) NOT NULL,
        state ENUM('VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT') NOT NULL,
        postcode CHAR(4) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(12) NOT NULL,
        skills TEXT,
        other_skills TEXT,
        status ENUM('New', 'Current', 'Final') DEFAULT 'New'
    )";

    if (!$conn->query($createTableSQL)) {
        die("Error creating table: " . $conn->error);
    }
}

// Helper function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Get and sanitize form data
$job_ref_no = isset($_POST['job-reference-number']) ? sanitizeInput($_POST['job-reference-number']) : '';
$first_name = isset($_POST['first-name']) ? sanitizeInput($_POST['first-name']) : '';
$last_name = isset($_POST['last-name']) ? sanitizeInput($_POST['last-name']) : '';
$dob = isset($_POST['dob']) ? sanitizeInput($_POST['dob']) : '';
$gender = isset($_POST['gender']) ? sanitizeInput($_POST['gender']) : '';
$street_address = isset($_POST['street-address']) ? sanitizeInput($_POST['street-address']) : '';
$suburb = isset($_POST['suburb']) ? sanitizeInput($_POST['suburb']) : '';
$state = isset($_POST['State']) ? sanitizeInput($_POST['State']) : '';
$postcode = isset($_POST['postcode']) ? sanitizeInput($_POST['postcode']) : '';
$email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
$phone = isset($_POST['phone-number']) ? sanitizeInput($_POST['phone-number']) : '';
$other_skills = isset($_POST['other-skills']) ? sanitizeInput($_POST['other-skills']) : '';

// Handle skills checkboxes
$skills = isset($_POST['skills']) ? implode(", ", $_POST['skills']) : '';
$other_skills = isset($_POST['other-skills']) ? sanitizeInput($_POST['other-skills']) : '';

// Validation
$errors = [];

if (!preg_match("/^[A-Za-z0-9]{5}$/", $job_ref_no)) {
    $errors[] = "Job Reference number must be exactly 5 alphanumeric characters.";
}
if (!preg_match("/^[A-Z a-z]{1,20}$/", $first_name)) {
    $errors[] = "First name must be a maximum of 20 alphabetic characters.";
}
if (!preg_match("/^[A-Z a-z]{1,20}$/", $last_name)) {
    $errors[] = "Last name must be a maximum of 20 alphabetic characters.";
}
if (!preg_match("/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(19[0-9]{2}|20[0-2][0-9])$/", $dob)) {
    $errors[] = "Date of birth must be in dd/mm/yyyy format.";
} else {
    // Convert date format for database
    $dob_date = DateTime::createFromFormat('d/m/Y', $dob);
    if ($dob_date) {
        // Calculate age
        $age = $dob_date->diff(new DateTime())->y;
        if ($age < 15 || $age > 80) {
            $errors[] = "Age must be between 15 and 80.";
        }
        $dob = $dob_date->format('Y-m-d'); // Format for MySQL
    } else {
        $errors[] = "Invalid date format.";
    }
}
if (!in_array($gender, ['male', 'female', 'other'])) {
    $errors[] = "Gender is required.";
}
if (strlen($street_address) > 40) {
    $errors[] = "Street address must be a maximum of 40 characters.";
}
if (strlen($suburb) > 40) {
    $errors[] = "Suburb must be a maximum of 40 characters.";
}
if (!in_array($state, ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'])) {
    $errors[] = "Invalid state.";
}
if (!preg_match("/^[0-9]{4}$/", $postcode)) {
    $errors[] = "Postcode must be exactly 4 digits.";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}
if (!preg_match("/^[0-9 ]{8,12}$/", $phone)) {
    $errors[] = "Phone number must be 8 to 12 digits or spaces.";
}

// Check if 'Others' is selected in skills and other_skills is empty
if (strpos($skills, 'Others') !== false && empty($other_skills)) {
    $errors[] = "If you select 'Others' in the skill list, please list the relevant skills in the 'Other Skills' field.";
}

// If errors exist, display them and provide a back button
if (!empty($errors)) {
    echo "<h2>Error(s) found:</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo "<button onclick='history.back()'>Go Back</button>";
    exit;
}

// Prepare SQL statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO eoi (job_ref_no, first_name, last_name, dob, gender, street_address, suburb, state, postcode, email, phone, skills, other_skills) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Error in prepare statement: " . $conn->error);
}

$stmt->bind_param("sssssssssssss", 
    $job_ref_no,
    $first_name,
    $last_name,
    $dob,
    $gender,
    $street_address,
    $suburb,
    $state,
    $postcode,
    $email,
    $phone,
    $skills,
    $other_skills
);

// Flag for success
$successMessage = '';

if ($stmt->execute()) {
    // If successful, set the success message
    $_SESSION['successMessage'] = "Your application was successfully submitted!"; // Store success message in session
} else {
    echo "<h2>Error</h2>";
    echo "<p>Sorry, there was an error submitting your application. Please try again later.</p>";
    echo "<p>Error details: " . $stmt->error . "</p>";
    echo "<button onclick='history.back()'>Go Back</button>";
}
// Display the success message if it is set in the session
if (isset($_SESSION['successMessage'])) {
    echo "<p style='color: green;'>" . $_SESSION['successMessage'] . "</p>";
    unset($_SESSION['successMessage']); // Clear the message after displaying it
}
// Closing the statement and connection
$stmt->close();
$conn->close();
?>


</body>
</html>
