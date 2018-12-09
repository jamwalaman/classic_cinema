<?php
$pageTitle = "Login";
$pageSubTitle = "Please login to order films.";

include("includes/header.php");

if (isset($_SESSION['authenticatedUser'])) {
	header('Location: index.php');
}

$conn = dbConnect();

if ($conn->connect_errno) {
	echo "Couldn't connect to the database";
}

$loginUsername = $loginPassword = "";

if (isset($_POST["loginUsername"])) {
	$loginUsername = $conn->real_escape_string($_POST["loginUsername"]);
}
if (isset($_POST["loginPassword"])) {
	$loginPassword = $conn->real_escape_string( sha1($_POST["loginPassword"]) );
}

$_SESSION['loginUsername'] = $loginUsername;

$formOK = false;
if (isset($_POST['submit'])) {
	// All form errors inside an array
	$errorsList = array();

	if (!isEmpty($_POST['loginUsername']) && !isEmpty($_POST['loginPassword'])) {
		$result = $conn->query("SELECT * FROM users WHERE username = '$loginUsername' AND password = '$loginPassword'");
		if ($result->num_rows === 0) {
			array_push($errorsList, "Login unsuccessful. Incorrect username or password. Please try again.");
		} else {
			//Login successful
			$row = $result->fetch_assoc();
			$_SESSION['role'] = $row['role'];
			$_SESSION['authenticatedUser'] = $loginUsername;
			$_SESSION['loginMsg'] = "Logged in as " . $_SESSION['authenticatedUser'];
		}
	} else {
		array_push($errorsList, "Username and Password cannot be blank");
	}
	// If no errors, then form is ok
	if (count($errorsList) === 0) {
		$formOK = true;
		unset($_SESSION['loginUsername']);
		header('Location: index.php');
		
		$result->free();
		$conn->close();
	} else {
		// form not ok. Shwo the errors
		if (isset($errorsList) && is_array($errorsList)) {
			echo "<div class='container'><div class='row'><div class='col-md-6'><div class='alert alert-danger' role='alert'><h5 class='alert-heading'>Please fix the following errors</h5><ul>";
			foreach ($errorsList as $errors) {
				echo"<li>$errors</li>";
			}
			echo "</ul></div></div></div></div>";
		}
	}
}
if (!$formOK) { ?>
	<div class="container" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<form method="post">
			<div class="form-group form-row">
				<div class="col-md-6 mr-aut0">
					<label for="loginUsername">Username</label>
					<input type="text" class="form-control" id="loginUsername" name="loginUsername" placeholder="Enter username" <?php getValue("loginUsername"); ?>>
				</div>
			</div><!-- username -->
			<div class="form-group form-row">
				<div class="col-md-6 mr-aut0">
					<label for="loginPassword">Password</label>
					<input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Enter password">
				</div>
			</div><!-- password -->
			<div class="form-group form-row">
				<div class="col-md-6 mr-aut0">
					<button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
				</div>
			</div><!-- login in button -->
		</form><!-- form -->
	</div><!-- container -->
<?php } ?>

<?php include("includes/footer.php"); ?>