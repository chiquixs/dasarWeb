<?php 
$price = 120000;
$discount = 0.2;

$totalDiscount = $price * $discount;
$lastPrice = $price - $totalDiscount;
echo "The price to be paid : $lastPrice";

?>