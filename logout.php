<?php
session_start();
header('Location: ' . $_SESSION['lastPage']);
$_SESSION['loginMsg'] = 'Logged out successfuly';
unset($_SESSION['role']);
unset($_SESSION['authenticatedUser']);
?>