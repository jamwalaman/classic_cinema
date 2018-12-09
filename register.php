<?php
$pageTitle = "Register";
$pageSubTitle = "Please register to buy films.";

include("includes/header.php");

if (isset($_SESSION['authenticatedUser'])) {
	header('Location: index.php');
}

$conn = dbConnect();
if ($conn->connect_errno) {
	echo "Couldn't connect to the database";
}

$loginUsername = $loginEmail = "";

if (isset($_POST["loginUsername"])) {
	$loginUsername = $conn->real_escape_string($_POST["loginUsername"]);
}
if (isset($_POST["loginEmail"])) {
	$loginEmail = $conn->real_escape_string($_POST["loginEmail"]);
}
if (isset($_POST["loginPassword"])) {
	$loginPassword = $conn->real_escape_string( sha1($_POST["loginPassword"]) );
}

$_SESSION['loginUsername'] = $loginUsername;
$_SESSION['loginEmail']  = $loginEmail;

$formOK = false;
if (isset($_POST['submit'])) {

	$errorsList = [];
	// Check if "Username" field is empty. Then check if the username is already taken
	$query = "SELECT * FROM users WHERE username = '$loginUsername'";
	$result = $conn->query($query);
	if (isEmpty($_POST['loginUsername'])) {
		array_push($errorsList, "Username is required");
	} else if ($result->num_rows !== 0) {
		array_push($errorsList, "The username $loginUsername is already taken");
	}
	$result->free();
	//Check if "Password" field is empty
	if (isEmpty($_POST['loginPassword'])) {
		array_push($errorsList, "Password is required");
	} else if ($_POST['loginPassword'] !== $_POST['confirmPassword']) {
		array_push($errorsList, "The passwords don't match");
	}
	//Check if "Email" field is empty and if not, check if the email looks valid
	if (isEmpty($_POST['loginEmail'])) {
		array_push($errorsList, "Email is required");
	} else if (!isEmail($_POST['loginEmail'])) {
		array_push($errorsList, "That doesn't look like a valid email address");
	}

	if (count($errorsList) === 0) {
	// No errors, so destroy the session and the form is OK
		session_destroy();
		$formOK = true;

		$queryInsert = "INSERT INTO Users (username, password, email, role) " .
		"VALUES ('$loginUsername', '$loginPassword', '$loginEmail', 'user')";
		$conn->query($queryInsert);
		echo "Successfully registered with the username $loginUsername.";
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
				<div class="col-md-6">
					<label for="loginUsername">Username</label>
					<input type="text" class="form-control" id="loginUsername" name="loginUsername" placeholder="Enter username" <?php getValue("loginUsername"); ?>>
				</div>
			</div><!-- username -->
			<div class="form-group form-row">
				<div class="col-md-6">
					<label for="loginPassword">Password</label>
					<input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Enter password">
				</div>
			</div><!-- password -->
			<div class="form-group form-row">
				<div class="col-md-6">
					<label for="confirmPassword">Confirm Password</label>
					<input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password">
				</div>
			</div><!-- Confirm password -->
			<div class="form-group form-row">
				<div class="col-md-6">
					<label for="loginEmail">Email</label>
					<input type="email" class="form-control" id="loginEmail" name="loginEmail" placeholder="Enter email" <?php getValue("loginEmail");  ?>>
				</div>
			</div><!-- username -->
			<div class="form-group form-row">
				<div class="col-md-6">
					<button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
				</div>
			</div><!-- login in button -->
		</form><!-- form -->
	</div><!-- container -->
<?php } ?>

<?php include("includes/footer.php"); ?>