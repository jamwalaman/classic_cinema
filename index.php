<?php
$pageTitle = "Welcome to Classic Cinema";
$pageSubTitle = "Your online store for classic film.";
include("includes/header.php");
?>

<div class="container">

	<div class="card-deck">
		<div class="card shadow">
			<img class="card-img-top" src="images/index_metropolis.jpg" alt="Card image cap">
			<div class="card-body">
				<p class="card-text">This category includes Gone With The Wind, The Jazz Singer, Metropolis</p>
				<a href="<?php echo HOME; ?>" class="btn btn-outline-primary btn-sm btn-block" role="button">Classics</a>
			</div>
		</div> <!-- Classics -->
		<div class="card shadow">
			<img class="card-img-top" src="images/index_plan_9_alternative.jpg" alt="Card image cap">
			<div class="card-body">
				<p class="card-text">This category includes King Kong, Day of the Triffids, Plan 9 From Outer Space</p>
				<a href="<?php echo SCIFI; ?>" class="btn btn-outline-primary btn-sm btn-block" role="button" style="white-space: normal;">Science Fiction and Horror</a>
			</div>
		</div> <!-- Science Fiction and Horror -->
		<div class="card shadow">
			<img class="card-img-top" src="images/index_vertigomovie.jpg" alt="Card image cap">
			<div class="card-body">
				<p class="card-text">This category includes The Birds, Dial M for Murder, The Man WHo Knew Too Much</p>
				<a href="<?php echo HITCHCOCK; ?>" class="btn btn-outline-primary btn-sm btn-block" role="button" style="white-space: normal;">Alfred Hitchcock</a>
			</div>
		</div> <!-- Alfred Hitchcock -->
	</div> <!-- card-deck -->

</div> <!-- container -->

<?php include("includes/footer.php") ?>