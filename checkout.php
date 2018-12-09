<?php
$pageTitle = "Checkout";

include("includes/header.php");

if (!isset($_SESSION['authenticatedUser'])) {
	header('Location: index.php');
}

$formFieldList = ["deliverTo", "email", "address", "city", "postcode", "cardType", "cardNumber", "cardValidation"];

if (isset($formFieldList) && is_array($formFieldList)) {
	foreach ($formFieldList as $formField) {
		if (isset($_POST[$formField])) {
			$_SESSION[$formField] = $_POST[$formField];
		} // if
	} // foreach
}
?>

<div class="container">

	<div class="row">
		<div class="col-md-4 order-md-2" id="cart">
			<!-- Content comes from checkout.js file -->
		</div><!-- col-md-6 -->
		<?php
		$formOK = false;
		if (isset($_POST['submit'])) {
			// All form errors inside an array
			$errorsList = [];

			// Check if "Deliver to" field is empty
			if (isEmpty($_POST['deliverTo'])) {
				array_push($errorsList, 'You must enter a name to deliver to');
			}
			// Check if "Email" field is empty and if not, check if the email looks valid
			if (isEmpty($_POST['email'])) {
				array_push($errorsList, "You must enter an email address");
			} else if (!isEmail($_POST['email'])) {
				array_push($errorsList, "That doesn't look like a valid email address");
			}
			// Check if "Address" field is empty (only the first address line)
			if (isEmpty($_POST['address'])) {
				array_push($errorsList, "You must enter an address to deliver to");
			}
			//Check if "City" field is empty
			if (isEmpty($_POST['city'])) {
				array_push($errorsList, "You must enter a city to deliver to");
			}
			//Check if "Postcode" field is empty
			if (isEmpty($_POST['postcode'])) {
				array_push($errorsList, "You must enter a postcode");
			} else if (!isDigits($_POST['postcode'])) {
				array_push($errorsList, "Postcodes must only constain digits");
			} else if (!checkLength($_POST['postcode'], 4)) {
				array_push($errorsList, "Postcodes must be exactly 4 digits long");
			}
			//Check Card type and the card number
			if (!checkCardNumber(($_POST['cardType']),($_POST['cardNumber']))) {
				if (isEmpty(($_POST['cardNumber']))) {
					array_push($errorsList, "You must enter a credit card number");
				} else if (!isDigits($_POST['cardNumber'])) {
					array_push($errorsList, "The credit card number should only contain the digits 0-9");
				} else if ($_POST['cardType'] === 'amex') {
					array_push($errorsList, "American Express card numbers must be 15 digits long and start with a '3'");
				} else if ($_POST['cardType'] === 'mcard') {
					array_push($errorsList, "MasterCard numbers must be 16 digits long and start with a '5'");
				} else if ($_POST['cardType'] === 'visa') {
					array_push($errorsList, "Visa card numbers must be 16 digits long and start with a '4'");
				}
			}
			//Check if card's expiry is in the future
			if (!checkCardDate(($_POST['cardMonth']),($_POST['cardYear']))) {
				array_push($errorsList, "The card expiry date must be in the future");
			}
			//Check if "CVC" field is empty and if its not check if it looks valid for the card type chosen
			if (!checkCardVerification(($_POST['cardType']),($_POST['cardValidation']))) {
				if (isEmpty($_POST['cardValidation'])) {
					array_push($errorsList, "You must enter a CVC value");
				} else if (!isDigits($_POST['cardValidation'])) {
					array_push($errorsList, "The CVC should only contain the digits 0-9");
				} else if ($_POST['cardType'] === 'amex') {
					array_push($errorsList, "American Express CVC values must be 4 digits long");
				} else if ($_POST['cardType'] === 'mcard') {
					array_push($errorsList, "MasterCard CVC values must be 3 digits long");
				} else if ($_POST['cardType'] === 'visa') {
					array_push($errorsList, "Visa CVC values must be 3 digits long");
				}
			}

			// Show errors, or if none, process the form
			if (count($errorsList) === 0) {
				$formOK = true;
				if (isset($formFieldList) && is_array($formFieldList)) {
					// Clear the values in the form fields
					foreach ($formFieldList as $formField) {
						unset($_SESSION[$formField]);
					}
				}
				echo "<p>Order submitted</p>";

				$cart = json_decode($_COOKIE['cart']);

				// No errors in the form, so add the order in the xml file
				$orders = simplexml_load_file('orders.xml');
				// <order>
				$newOrder = $orders->addChild('order');
				// <order = "username"> ("username" will be replaced with the whoever the logged in user is)
				$newOrder->addAttribute('orderedBy', $_SESSION['authenticatedUser']);
				//<username>
				$delivery = $newOrder->addChild('username');
				$delivery->addChild('user', $_SESSION['authenticatedUser']);
				// <delivery>
				$delivery = $newOrder->addChild('delivery');
				$delivery->addChild('name', $_POST['deliverTo']);
				$delivery->addChild('email', $_POST['email']);
				$delivery->addChild('address', $_POST['address']);
				$delivery->addChild('city', $_POST['city']);
				// <items>
				$cartItems = $newOrder->addChild('items');
				foreach ($cart as $i) {
					//<item>
					$item = $cartItems->addChild('item');
					$item->addChild('title', $i->title);
					$item->addChild('price', $i->price);
				}

				//$orders->saveXML('includes/orders.xml');
				$orders->saveXML('orders.xml');

				// Clear the cookies
				setcookie('cart', '', time()-3600, '/');
				unset($_COOKIE['cart']);
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
			<div class="col-md-6 order-md-1" id="checkoutForm">
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" novalidate>
					<h4 class="font-weight-light">Delivery Details</h4>
					<div class="form-row">
						<!-- Deliver to -->
						<div class="form-group col-md-6">
							<label for="deliverTo">Deliver to</label>
							<input type="text" class="form-control" id="deliverTo" name="deliverTo" <?php getValue("deliverTo"); ?> >
						</div>
						<!-- Email -->
						<div class="form-group col-md-6">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email" <?php getValue("email"); ?> >
						</div>
					</div><!-- form-row -->
					<div class="form-row">
						<!-- Address -->
						<div class="form-group col-md-4">
							<label for="address">Address</label>
							<input type="text" class="form-control" id="address" name="address" <?php getValue("address"); ?> >
						</div>
						<!-- City -->
						<div class="form-group col-md-4">
							<label for="city">City</label>
							<input type="text" class="form-control" id="city" name="city" <?php getValue("city"); ?> >
						</div>
						<!-- Postcode -->
						<div class="form-group col-md-4">
							<label for="postcode">Postcode</label>
							<input type="text" class="form-control" id="postcode" name="postcode" maxlength="4" <?php getValue("postcode"); ?> >
						</div>
					</div><!-- form-row -->
					<h4 class="font-weight-light">Payment Details</h4>
					<div class="form-row">
						<!-- Card type -->
						<div class="form-group col-md-6">
							<label for="cardType">Card type</label>
							<select id="cardType" name="cardType" class="form-control">
								<option value="amex" <?php if (isset($_SESSION["cardType"])) {isSelected($_SESSION["cardType"] === "amex");} ?>>American Express</option>
								<option value="mcard" <?php if(isset($_SESSION["cardType"])) {isSelected($_SESSION["cardType"] === "mcard");} ?> >Master Card</option>
								<option value="visa" <?php if(isset($_SESSION["cardType"])) {isSelected($_SESSION["cardType"] === "visa");} ?> >Visa</option>
							</select>
						</div>
						<!-- Card Number -->
						<div class="form-group col-md-6">
							<label for="cardNumber">Card number</label>
							<input type="text" class="form-control" id="cardNumber" name="cardNumber" maxlength="16" <?php getValue("cardNumber"); ?> >
						</div>
					</div><!-- form-row -->
					<div class="form-row">
						<!-- Expiry date (month) -->
						<div class="form-group col-md-4">
							<label for="cardMonth">Expiry date: Month</label>
							<select id="cardMonth" name="cardMonth" class="form-control">
								<?php
								for ($month = 1; $month <= 12; $month++) {
									// add a 0 if the month is in between 1 and 9
									if ($month <= 9) {$month = "0" . $month;}
									echo "<option value='$month'>$month</option>";
								}
								?>
							</select>
						</div>
						<!-- Expiry date (year) -->
						<div class="form-group col-md-4">
							<label for="cardYear">Expiry date: Year</label>
							<select id="cardYear" name="cardYear" class="form-control">
								<?php
								$curentYear = date("Y");
								for ($y = $curentYear; $y <= $curentYear+7; $y++) {
									echo "<option value='$y'>$y</option>";
								}
								?>
							</select>
						</div>
						<!-- Card Number -->
						<div class="form-group col-md-4">
							<label for="cardValidation">CVC</label>
							<input type="text" class="form-control" id="cardValidation" name="cardValidation" maxlength="4" <?php getValue("cardValidation"); ?> >
						</div>
					</div><!-- form-row -->

					<!-- Submit -->
					<button type="submit" class="btn btn-primary" name="submit">Submit</button>
				</form><!-- form -->
			</div><!-- col-md-6 -->
		<?php } ?>
	</div><!-- row -->

</div><!-- container -->

<?php include("includes/footer.php") ?>