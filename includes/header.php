<?php
if (session_id() === "") {
	session_start();
}
// Page links
define("HOME", "index.php");
define("CLASSICS", "classics.php");
define("SCIFI", "scifiandhorror.php");
define("HITCHCOCK", "hitchcock.php");
// functions file
include("functions.php");

$currentPage = htmlspecialchars(basename($_SERVER['PHP_SELF']));
$_SESSION['lastPage'] = htmlspecialchars($_SERVER['PHP_SELF']);
?>

<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="icon" href="images/favicon.ico">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
	<!-- Custom css -->
	<link rel="stylesheet" type="text/css" href="custom.css">

	<title>
		<?php
		// Changes the title according to the current page
		switch ($currentPage) {
			case HOME:
			echo "Classic Cinema | Home";
			break;
			case CLASSICS:
			echo "Classic Cinema | Classics";
			break;
			case SCIFI:
			echo "Classic Cinema | Scifi and Horror";
			break;
			case HITCHCOCK:
			echo "Classic Cinema | Alfred Hitchcock";
			break;
			case "login.php":
			echo "Classic Cinema | Login";
			break;
			case "register.php";
			echo "Classic Cinema | Register";
			break;
			case "checkout.php";
			echo "Classic Cinema | Checkout";
			break;
			case "orders.php";
			echo "Classic Cinema | Orders";
			break;
			default:
			echo "Classic Cinema";
		}
		?>
	</title>
</head>
<body>
	<!-- Navigation -->
	<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow fixed-top">
		<div class="container">
			<a class="navbar-brand" href="<?php echo HOME; ?>"><img src="images/video-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="Video icon">Classic Cinema</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto">

					<?php
					echo nav_links($currentPage, HOME, 'Home');
					echo nav_links($currentPage, CLASSICS, 'Classics');
					echo nav_links($currentPage, SCIFI, 'Scifi and Horror');
					echo nav_links($currentPage, HITCHCOCK, 'Alfred Hitchcock');
					
					if (isset($_SESSION['authenticatedUser'])) { ?>
						<!-- show the following links if user is logged -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle font-weight-bold text-info" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hi <?php echo $_SESSION['authenticatedUser'] . ' (' . $_SESSION['role'] . ')'; ?></a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="checkout.php">Checkout</a>
								<a class="dropdown-item" href="orders.php">Orders</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php">Logout</a>
							</div>
						</li>
					<?php } else { ?>
						<!-- show the login and register links if user is NOT logged in -->
						<li class="nav-item">
							<a class="nav-link text-uppercase font-weight-bold text-info" href="login.php">Login</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-uppercase font-weight-bold text-info" href="register.php">Register</a>
						</li>
					<?php } ?>
					
				</ul><!-- navbar-nav -->
			</div><!-- navbarCollapse -->
		</div><!-- container -->
	</nav><!-- nav -->

	<div class="pt-5 bg-light">
		<div class="container">
			<h1 class="display-4 pt-5"><?php if (isset($pageTitle)) {echo $pageTitle;} ?></h1>
			<p class="lead py-4"><?php if (isset($pageSubTitle)) {echo $pageSubTitle;} ?></p>
		</div>
	</div>

	<?php if (isset($_SESSION['loginMsg'])) { ?>
		<!-- show user a message when they login or logout -->
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="alert alert-success alert-dismissible fade show col-md-auto" role="alert">
					<?php
					echo $_SESSION['loginMsg'];
					unset($_SESSION['loginMsg']);
					?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div><!-- alert -->
			</div><!-- row -->
		</div><!-- container -->
		<?php } ?>