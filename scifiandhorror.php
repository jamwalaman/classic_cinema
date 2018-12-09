<?php
$pageTitle = "Scifi and Horror Films";
$pageSubTitle = "All Scifi and Horror films available in the store.";
include("includes/header.php");
?>

<div class="container">

	<div class="row py-4 border_bot film">
		<div class="col-md-2">
			<img src="images/Attack_of_the_50ft_Woman.jpg" class="rounded img-fluid d-block mx-auto" alt="Attack of the 50ft Woman poster">
		</div><!-- col-md-2 -->
		<div class="col-md-10">
			<h3>Attack of the 50ft Woman (1958)</h3>
			<p>Directed by: Nathan H. Juran</p>
			<p>Starring: Alison Hayes, William Hudson, Yvette Vickers</p>
			<p>A low-budget cult camp classic.</p>
			$<span class="price">8.99</span>
			<?php
			echo addToCart();
			checkIfUserReviewedThis('Attack_of_the_50ft_Woman.xml');
			addReviewForm('Attack_of_the_50ft_Woman.xml');
			?>

		</div>
	</div><!-- row -->
	<div class="row py-4 border_bot film">
		<div class="col-md-2">
			<img src="images/The_Day_of_the_Triffids.jpg" class="rounded img-fluid d-block mx-auto" alt="The Day of the Triffids poster">
		</div><!-- col-md-2 -->
		<div class="col-md-10">
			<h3>The Day of the Triffids (1962)</h3>
			<p>Directed by: Steve Sekely</p>
			<p>Starring: Howard Keel, Kieron Moore, Janatte Scott, Nicole Maurey, Mervyn Johnss</p>
			<p>A not-particularly-faithful adaptation of John Wyndham's classic novel.</p>
			$<span class="price">7.99</span>
			<?php
			echo addToCart();
			checkIfUserReviewedThis('The_Day_of_the_Triffids.xml');
			addReviewForm('The_Day_of_the_Triffids.xml');
			?>
		</div>
	</div><!-- row -->
	<div class="row py-4 border_bot film">
		<div class="col-md-2">
			<img src="images/Forbidden_Planet.jpg" class="rounded img-fluid d-block mx-auto" alt="Forbidden Planet poster">
		</div><!-- col-md-2 -->
		<div class="col-md-10">
			<h3>Forbidden Planet (1956)</h3>
			<p>Directed by: Fred M. Wilcox</p>
			<p>Starring: Walter Pidgeon, Anne Francis, Leslie Nielsen, Warren Stevens, Robby the Robot</p>
			<p>One of the great science fiction films of the 1950s, and the first appearance of science fiction icon Robby the Robot.</p>
			$<span class="price">13.99</span>
			<?php
			echo addToCart();
			checkIfUserReviewedThis('Forbidden_Planet.xml');
			addReviewForm('Forbidden_Planet.xml');
			?>
		</div>
	</div><!-- row -->
	<div class="row py-4 border_bot film">
		<div class="col-md-2">
			<img src="images/King_Kong.jpg" class="rounded img-fluid d-block mx-auto" alt="King Kong poster">
		</div><!-- col-md-2 -->
		<div class="col-md-10">
			<h3>King King (1933)</h3>
			<p>Directed by: Merian C. Cooper, Ernest B. Schoedsack</p>
			<p>Starring: Fay Wray, Bruce Cabot, Robert Armstrong</p>
			<p>The original classic stop-motion masterpiece. Who needs CGI anyway?</p>
			$<span class="price">11.99</span>
			<?php
			echo addToCart();
			checkIfUserReviewedThis('King_Kong.xml');
			addReviewForm('King_Kong.xml');
			?>
		</div>
	</div><!-- row -->
	<div class="row py-4 border_bot film">
		<div class="col-md-2">
			<img src="images/The_Mummy.jpg" class="rounded img-fluid d-block mx-auto" alt="The Mummy poster">
		</div><!-- col-md-2 -->
		<div class="col-md-10">
			<h3>The Mummy (1932)</h3>
			<p>Directed by: Karl Freund</p>
			<p>Starring: Boris Karloff, Zita Johann, David Manners, Edward van Sloan</p>
			<p>Boris Karloff, best known for his role as Frankenstein's Monster, takes on the guise of the ancient Egyptian priest Imhotep returned from the dead to seek his lost love.</p>
			$<span class="price">9.99</span>
			<?php
			echo addToCart();
			checkIfUserReviewedThis('The_Mummy.xml');
			addReviewForm('The_Mummy.xml');
			?>
		</div>
	</div><!-- row -->
	<div class="row py-4 border_bot film">
		<div class="col-md-2">
			<img src="images/Plan_9_From_Outer_Space.jpg" class="rounded img-fluid d-block mx-auto" alt="Plan 9 From Outer Space poster">
		</div><!-- col-md-2 -->
		<div class="col-md-10">
			<h3>Plan 9 From Outer Space (1959)</h3>
			<p>Directed by: Ed Wood</p>
			<p>Starring: Gregory Walcott, Mona McKinnon, Tom Keene, Tor Johnson, Dudley Manlove, Joanna Lee, John Breckinridge, Vampira, Bela Lugosi</p>
			<p>Not much science and plenty of fiction. Considered by some to be the worst film ever made, it's so bad it's good!</p>
			$<span class="price">14.99</span>
			<?php
			echo addToCart();
			checkIfUserReviewedThis('Plan_9_From_Outer_Space.xml');
			addReviewForm('Plan_9_From_Outer_Space.xml');
			?>
		</div>
	</div><!-- row -->

</div><!-- container -->

<?php include("includes/footer.php") ?>