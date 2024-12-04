<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/login.css" rel="stylesheet" type="text/css">
	<meta name="description" content="Assignment2">
	<meta name="keywords" content="Assignment2">
	<meta name="author" content="Nguyen Dinh Dung, Pham Quang Thai, Nguyen Ngoc Thanh Thanh">
	<meta name="charset" content="Corporate">
	<title>Sign Up</title>
</head>
<body>
<?php
// sign_up.php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $location = $_POST['location'];

    // Hash the password securely
	function custom_random_bytes($length) {
		$bytes = '';
		for ($i = 0; $i < $length; $i++) {
			$bytes .= chr(mt_rand(0, 255));
		}
		return $bytes;
	}
	function custom_password_hash($password) {
		// Use a strong salt
		$salt = substr(str_replace('+', '.', base64_encode(custom_random_bytes(16))), 0, 22);
		$hash = crypt($password, '$2y$10$' . $salt);
		return $hash;
	}
    $hashed_password = custom_password_hash($password);

    // Database connection
    $conn = new mysqli('feenix-mariadb.swin.edu.au', 's104991438', '181105', 's104991438_db');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert user into database
    $sql = "INSERT INTO users (username, password, role, email, location) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $hashed_password, $role, $email, $location);

    if ($stmt->execute()) {
        echo "User created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>
	<div class="container">
		<div class="screen">
			<div class="screen__content">
				<a href="index.php"><img class="brand" src="img/logo.png" alt="Corporate"></a>
				<form class="login" action="phpenhancements1.php" method="POST">
                    <div class="login__field">
                        <label for="role">Role:</label>
                        <select id="role" name="role" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
					</div>
					<div class="login__field">
						<i class="login__icon fas fa-user"></i>
						<label for="email">Email:</label><br>
						<input id="email" type="text" class="login__input" name="email" required>
					</div>
                    <div class="login__field">
						<i class="login__icon fas fa-user"></i>
						<label for="location">Location:</label>
						<input id="location" type="text" class="login__input" name="location" required>
					</div>
                    <div class="login__field">
						<i class="login__icon fas fa-user"></i>
						<label for="username">Username:</label>
						<input id="username" type="text" class="login__input" name="username" required>
					</div>
					<div class="login__field">
						<i class="login__icon fas fa-lock"></i>
						<label for="password">Password:</label>
						<input id="password" type="password" class="login__input" name="password" required>
					</div>
					<button class="button login__submit" type="submit" value="Sign Up">
						<span class="button__text">Sign Up</span>
						<i class="button__icon fas fa-chevron-right"></i>
					</button>
					<div class="sign-up">Already had an account?<br><a href="phpenhancements.php">Login here</a></div>				
				</form>
				
    
			</div>
			<div class="screen__background">
				<span class="screen__background__shape screen__background__shape4"></span>
				<span class="screen__background__shape screen__background__shape3"></span>		
				<span class="screen__background__shape screen__background__shape2"></span>
				<span class="screen__background__shape screen__background__shape1"></span>
			</div>		
		</div>
	</div>
</body>
</html>