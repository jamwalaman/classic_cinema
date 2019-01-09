<?php
ob_start(); // output buffering is turned on

// Database connection
function dbConnect() {
	return new mysqli('localhost', 'root', '', 'movies_db');
}
// Navigation
function nav_active($currentPage) {
	switch ($currentPage) {
		case HOME:
		case CLASSICS;
		case SCIFI;
		case HITCHCOCK;
		return "active";
		break;
		default:
		return false;
	}
}
// Navigation links
function nav_links($currentPage, $pageLink, $pageName) {
	$html = " <li class='nav-item " . nav_active($currentPage == $pageLink) . " ' > ";
	$html .= " <a class='nav-link' href='$pageLink'> $pageName </a> ";
	$html .= " </li> ";
	return $html;
}
function addToCart() {
	if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
		// Admin only needs to check for orders, so no need to show the Add to Cart button
		$string = "<button type='button' class='btn btn-info buy'>Add to cart</button>";
		return $string;
	}
}
// Get the value of a form field
function getValue ($str) {
	if (isset($_SESSION[$str])) {
		$value = $_SESSION[$str];
		echo "value = '$value'";
	}
}
function isSelected($cardType) {
	switch ($cardType) {
		case "amex":
		case "mcard":
		case "visa":
		echo "selected";
		break;
		default:
		return false;
	}
}

/****** All form functions ******/

/**
* Check to see if a string contains any content or not.
* Leading and trailing whitespace are not considered to be 'content'.
*
* @param string $str The string to check.
* @return True if $str is empty, false otherwise.
*/
function isEmpty($str) {
	return strlen(trim($str)) == 0;
}
/**
* Check to see if a string looks like an email.
* Email validation is actually fairly complex, so this is a thin wrapper
* around a PHP filter function.
*
* @param string $str The string to check.
* @return  True if $str looks like a valid email address, false otherwise.
*/
function isEmail($str) {
    // There's a built in PHP tool that has a go at this
	return filter_var($str, FILTER_VALIDATE_EMAIL);
}
/**
* Check to see if a string is composed entirely of the digits 0-9.
* Note that this is different to checking if a string is numeric since
* +/- signs and decimal points are not permitted.
*
* @param string $str The string to check.
* @return True if $str is composed entirely of digits, false otherwise.
*/
function isDigits($str) {
	$pattern='/^[0-9]+$/';
	return preg_match($pattern, $str);
}
/**
* Check to see if the length of a string is a given value, ignoring leading
* and trailing whitespace.
*
* @param string $str The string to check.
* @param integer $len The expected length of $str.
* @return True if $str has length $len, false otherwise.
*/
function checkLength($str, $len) {
	return strlen(trim($str)) === $len;
}
/**
* Check credit card number.
* This provides some rudimentary validation of a credit card number.
* These checks depend on the card type:
* - American express ($cardType = 'amex') card numbers must be 15 digits long and start with a 3.
* - MasterCard ($cardType = 'mcard') card numbers must be 16 digits long and start with a 5.
* - Visa ($cardType = 'visa') card numbers must be 16 digits long and start with a 4.
*
* @param string $cardType The type of card, one of 'amex', 'mcard', or 'visa'.
* @param string $cardNumber The credit card number.
* @return True if $cardNumber passes some basic checks, false otherwise.
*/
function checkCardNumber($cardType, $cardNumber) {
	if (!isDigits($cardNumber)) {
		return false;
	}

	switch ($cardType) {
		case 'amex':
		return checkLength($cardNumber, 15) && (int)$cardNumber[0] === 3;
		break;
		case 'mcard':
		return checkLength($cardNumber, 16) && (int)$cardNumber[0] === 5;
		break;
		case 'visa':
		return checkLength($cardNumber, 16) && (int)$cardNumber[0] === 4;
		break;
		default:
		return false;
	}
}
/**
* Check credit card expiry date.
* Checks that the date provided is in the future.
*
* @param string $cardMonth Numeric value of card expiry month.
* @param string $cardYear Card expiry year.
* @return True if $cardMonth/$cardYear is in the future, false otherwise.
*/
function checkCardDate($cardMonth, $cardYear) {
	$year = (int) date('Y');
	$month = (int) date('n');
	$cardYear = (int) $cardYear;
	$cardMonth = (int) $cardMonth;

	if ($year > $cardYear) {
		return false;
	} elseif ($year === $cardYear && $month >= $cardMonth) {
		return false;
	} else {
		return true;
	}
}
/**
* Check credit card verification code.
* This provides some rudimentary validation of a credit card number.
* These checks depend on the card type:
* - American express ($cardType = 'amex') card verification codes must be 4 digits long.
* - MasterCard ($cardType = 'mcard') card verification codes must be 3 digits long.
* - Visa ($cardType = 'visa') card verification codes must be 3 digits long.
*
* @param string $cardType The type of card, one of 'amex', 'mcard', or 'visa'.
* @param string $cardVerify The credit card verification code.
* @return True if $cardVerify passes some basic checks, false otherwise.
*/
function checkCardVerification($cardType, $cardVerify) {
	if (!isDigits($cardVerify)) {
		return false;
	}

	switch ($cardType) {
		case 'amex':
		return checkLength($cardVerify, 4);
		break;
		case 'mcard':
		case 'visa':
		return checkLength($cardVerify, 3);
		break;
		default:
		return false;
	}
}

// Adds the review
function addReviewForm($xmlFileName) {
	if (isset($_SESSION['authenticatedUser'])) {
		echo"
		<form class='form-inline my-2' action='addReview.php' method='POST' style='padding-top: 20px;'>
		<div class='form-group form-row'>
		<input type='hidden' name='xmlFileName' value='$xmlFileName'>
		<label for='review'>Give your rating:</label>
		<select name='review' id='review'>
		<option value='1'>1</option>
		<option value='2'>2</option>
		<option value='3'>3</option>
		<option value='4'>4</option>
		<option value='5'>5</option>
		</select>
		<button type='submit' name='submit' class='btn btn-primary ml-2 btn-sm'>Submit</button>
		</div>
		</form>
		";
	}
}
// Check if userhas already reviewd the film
function checkIfUserReviewedThis($xmlName){
	$reviews = simplexml_load_file("reviews/$xmlName");

	foreach ($reviews->review as $review) {
		$username = $review->user;
		$rating = $review->rating;

		if(isset($_SESSION['authenticatedUser'])) {
			if ($username == $_SESSION['authenticatedUser']) {
				echo "<p><strong> You rated this $rating</strong></p>";
			}
		}
	}
}