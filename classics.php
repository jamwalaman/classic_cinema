<?php
$pageTitle = "Classic Films";
$pageSubTitle = "All Classic films available in the store.";
include("includes/header.php");
?>

<div class="container">

	<div class="row py-4 border_bot film">
		<div class="col-md-2">
			<img src="images/Gone_With_The_Wind.jpg" class="rounded img-fluid d-block mx-auto" alt="Gone with the wind poster">
		</div><!-- col-md-2 -->
		<div class="col-md-10">
			<h3>Gone With the Wind (1939)</h3>
			<p>Directed by: Victor Fleming, George Cukor, Sam Wood </p>
			<p>Starring: Clark Gable, Vivien Leigh, Leslie Howard, Olivia de Havilland, Hattie McDaniel</p>
			<p>An epic historical romance and winner of 8 Academy Awards (from 13 nominations).</p>
			$<span class="price">13.99</span>
			<?php
			echo addToCart();
			checkIfUserReviewedThis('Gone_With_The_Wind.xml');
			addReviewForm('Gone_With_The_Wind.xml');
			?>
		</div>
	</div><!-- row -->
	<div class="row py-4 border_bot film">
		<div class="col-md-2">
			<img src="images/The_Jazz_Singer.jpg" class="rounded img-fluid d-block mx-auto" alt="The Jazz Singer poster">
		</div><!-- col-md-2 -->
		<div class="col-md-10">
			<h3>The Jazz Singer (1927)</h3>
			<p>Directed by: Alan Crosland </p>
			<p>Starring: Al Jolson, May McAvoy, Warner Oland, Cantor Rosenblatt</p>
			<p>The first feature length 'talkie', The Jazz Singer is a piece of cinematic history</p>
			$<span class="price">13.99</span>
			<?php
			echo addToCart();
			checkIfUserReviewedThis('The_Jazz_Singer.xml');
			addReviewForm('The_Jazz_Singer.xml');
			?>
		</div>
	</div><!-- row -->
	<div class="row py-4 border_bot film">
		<div class="col-md-2">
			<img src="images/Metropolis.jpg" class="rounded img-fluid d-block mx-auto" alt="Metropolis poster">
		</div><!-- col-md-2 -->
		<div class="col-md-10">
			<h3>Metropolis (1927)</h3>
			<p>Directed by: Alan Crosland </p>
			<p>Starring: Al Jolson, May McAvoy, Warner Oland, Cantor Rosenblatt</p>
			<p>The first feature length 'talkie', The Jazz Singer is a piece of cinematic history</p>
			$<span class="price">19.99</span>
			<?php
			echo addToCart();
			checkIfUserReviewedThis('Metropolis.xml');
			addReviewForm('Metropolis.xml');
			?>
		</div>
	</div><!-- row -->

</div><!-- container -->

<?php include("includes/footer.php") ?>