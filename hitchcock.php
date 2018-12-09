<?php
$pageTitle = "Alfred Hitchcock Films";
$pageSubTitle = "All Alfred Hitchcock films available in the store.";
include("includes/header.php");
?>

<div class="container">

	<div class="row py-4 border_bot film">
		<div class="col-md-2">
			<img src="images/Vertigo.jpg" class="rounded img-fluid d-block mx-auto" alt="Vertigo poster">
		</div><!-- col-md-2 -->
		<div class="col-md-10">
			<h3>Vertigo (1958)</h3>
			<p>Directed by: Alfred Hitchcock </p>
			<p>Starring: James Stuart, Kim Novak, Barbara Bel Geddes</p>
			<p>A classic piece of Hitchcock, often included in lists of the best films of all time.</p>
			$<span class="price">16.99</span>
			<?php
			echo addToCart();
			checkIfUserReviewedThis('Vertigo.xml');
			addReviewForm('Vertigo.xml');
			?>
		</div>
	</div><!-- row -->
	<div class="row py-4 border_bot film">
		<div class="col-md-2">
			<img src="images/The_Birds.jpg" class="rounded img-fluid d-block mx-auto" alt="The Birds poster">
		</div><!-- col-md-2 -->
		<div class="col-md-10">
			<h3>The Birds (1963)</h3>
			<p>Directed by: Alfred Hitchcock </p>
			<p>Starring: Rod Taylor, Jessica Tandy, Suzanne Pleshette, Tippi Hedren</p>
			<p>The follow up to his box office sensation, Psycho, the Birds mixes suspense and horror from an everyday source.</p>
			$<span class="price">14.99</span>
			<?php
			echo addToCart();
			checkIfUserReviewedThis('The_Birds.xml');
			addReviewForm('The_Birds.xml');
			?>
		</div>
	</div><!-- row -->
	<div class="row py-4 border_bot film">
		<div class="col-md-2">
			<img src="images/Dial_M_For_Murder.jpg" class="rounded img-fluid d-block mx-auto" alt="Dial M For Murder poster">
		</div><!-- col-md-2 -->
		<div class="col-md-10">
			<h3>Dial M For Murder (1954)</h3>
			<p>Directed by: Alfred Hitchcock </p>
			<p>Starring: Ray Milland, Grace Kelly, Robert Cimmings, John Williams</p>
			<p>Shot in 3D, but only released in 2D because of lack of interest in the process, it was shown in 3D in the 1980s, and has recently been released in 3D Blu-ray format.</p>
			$<span class="price">12.99</span>
			<?php
			echo addToCart();
			checkIfUserReviewedThis('Dial_M_For_Murder.xml');
			addReviewForm('Dial_M_For_Murder.xml');
			?>
		</div>
	</div><!-- row -->
	<div class="row py-4 border_bot film">
		<div class="col-md-2">
			<img src="images/The_Man_Who_Knew_Too_Much.jpg" class="rounded img-fluid d-block mx-auto" alt="The Man Who Knew Too Much poster">
		</div><!-- col-md-2 -->
		<div class="col-md-10">
			<h3>The Man Who Knew Too Much (1956)</h3>
			<p>Directed by: Alfred Hitchcock </p>
			<p>Starring: James Stewart, Doris Day, Brenda De Banzie, Bernard Miles, Alan Mowbray, Hillary Brooke, Christopher Olsen</p>
			<p>Hitchcock's remake of his own earlier (1934) version.</p>
			$<span class="price">11.99</span>
			<?php
			echo addToCart();
			checkIfUserReviewedThis('The_Man_Who_Knew_Too_Much.xml');
			addReviewForm('The_Man_Who_Knew_Too_Much.xml');
			?>
		</div>
	</div><!-- row -->
	<div class="row py-4 border_bot film">
		<div class="col-md-2">
			<img src="images/North_By_Northwest.jpg" class="rounded img-fluid d-block mx-auto" alt="Dial M For Murder poster">
		</div><!-- col-md-2 -->
		<div class="col-md-10">
			<h3>North By Northwest (1959)</h3>
			<p>Directed by: Alfred Hitchcock </p>
			<p>A classic thriller in which an innocent man is pursued by mysterious agents over government secrets.</p>
			<p>Hitchcock's remake of his own earlier (1934) version.</p>
			$<span class="price">14.99</span>
			<?php
			echo addToCart();
			checkIfUserReviewedThis('North_By_Northwest.xml');
			addReviewForm('North_By_Northwest.xml');
			?>
		</div>
	</div><!-- row -->

</div><!-- container -->

<?php include("includes/footer.php") ?>