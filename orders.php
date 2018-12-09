<?php
$pageTitle = "Order";

include("includes/header.php");

if (!isset($_SESSION['authenticatedUser'])) {
	header('Location: index.php');
}
?>

<div class="container">

	<div class="row">
		<div class="col-md-6">
			
			<?php
			$orders = simplexml_load_file('orders.xml');

			foreach ($orders->order as $order) {

				$username = $order->username->user;
				// Admin can see all orders
				if ($username == $_SESSION['authenticatedUser'] || $_SESSION['role'] === "admin") {
					$name = $order->delivery->name;
					$email = $order->delivery->email;
					$address = $order->delivery->address;
					$city = $order->delivery->city;

					echo"
					<h3>Delivery details</h3>
					<p>Username: $username</p> 
					<p>Name: $name</p>
					<p>Email: $email</p>
					<p>Address: $address</p>
					<p>City: $city</p>
					";
					?>

					<?php
					$totalPrice = 0;
					$items = $order->xpath('./items');

					echo"
					<h3>Items ordered</h3>
					<table style='border-bottom: 1px solid #000; margin-bottom: 40px;'>
					<tr><th>Title (Year)</th><th>Price</th></tr>
					";

					foreach ($items[0] as $item) {
						$title = $item->title;
						$price = $item->price;

						echo"
						<tr><td>$title</td><td>$price</td></tr>
						";
						$totalPrice += floatval($price);
					}

					echo"
					<tr><td>Total Price:</td><td>$totalPrice</td></tr>
					</table>
					";
				}

			}
			if ($_SESSION['role'] === "admin") {
				// Show the delete link to admin
				echo "<p><a href='ordersdelete.php'>Delete orders</a></p>";
			}
			?>
		</div><!-- col-md-6 -->
	</div><!-- row -->

</div><!-- container -->

<?php include("includes/footer.php"); ?>