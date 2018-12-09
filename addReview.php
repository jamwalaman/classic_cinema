<?php
session_start();
header('Location: ' . $_SESSION['lastPage']);

$rating = $_POST['review'];
$authenticatedUser = $_SESSION['authenticatedUser'];
$fileName = $_POST['xmlFileName'];

$reviews = simplexml_load_file('reviews/'.$fileName);
//<review>
$newReview = $reviews->addChild('review');
    //<username>
    $user = $newReview->addChild('user', $authenticatedUser);
    //rating
    $rating = $newReview->addChild('rating', $rating);
$reviews->saveXML('reviews/'.$fileName);
