<?php
header("Location: orders.php");

//$xml = simplexml_load_file('includes/orders.xml');
$xml = simplexml_load_file('orders.xml');
$orders = $xml->xpath('order');
foreach ($orders as $order) {
    unset($order[0]);
}
//$xml->saveXML('includes/orders.xml');
$xml->saveXML('orders.xml');
