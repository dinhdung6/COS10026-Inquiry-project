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
	<title>Log In</title>
</head>
<body>
<?php
// login.php


session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
	$conn = new mysqli('feenix-mariadb.swin.edu.au', 's104991438', '181105', 's104991438_db');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user exists
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
		function custom_hash_equals($known_string, $user_string) {
			if (strlen($known_string) !== strlen($user_string)) {
				return false;
			}
			$res = 0;
			for ($i = 0; $i < strlen($known_string); $i++) {
				$res |= ord($known_string[$i]) ^ ord($user_string[$i]);
			}
			return $res === 0;
		}

        // Verify password
        if (custom_hash_equals($user['password'], crypt($password, $user['password']))) {
			// Login successful
			// Store user info in session
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] == 'admin') {
                header("Location: phpenhancements4.php");
                exit();
            } else {
                header("Location: phpenhancements3.php");
                exit();
            }
		} else {
			// Login failed
			echo "Incorrect password.";
		}
    } else {
        echo "User not found.";
    }

    $conn->close();
}
?>
	<div class="container">
		<div class="screen">
			<div class="screen__content">
				<a href="index.php"><img class="brand" src="img/logo.png" alt="Corporate"></a>
				<form class="login" action="phpenhancements.php" method="POST">
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
					<button class="button login__submit" type="submit" value="Login">
						<span class="button__text">Log In</span>
						<i class="button__icon fas fa-chevron-right"></i>
					</button>
					<div class="sign-up">Haven't had an account yet?<br><a href="phpenhancements1.php">Sign up here</a></div>				
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