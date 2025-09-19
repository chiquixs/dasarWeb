<?php 
$seats = 45;
$cust = 28;

$c = $seats - $cust;
$emptySeat = ($c / $seats) * 100;

echo("Empty Seats Presentage : {$emptySeat} % <br>");
echo "Empty Seats Presentage : " . round($emptySeat, 2) . "%";
?>
