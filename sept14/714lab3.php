<!DOCTYPE html>
<html>
<!-- associative array -->

<?php

$ar1 = array("leaf" => "green", "flower" => "red");
$ar2 = array('Season' => "summer", "Month" => "June" );


$resArray = ($ar1 + $ar2);

foreach ($resArray as $key => $value) {
	echo "$key $value <br>";
}
?>

</html>

<!-- sort() - sort arrays in ascending order
rsort() - sort arrays in descending order
asort() - sort associative arrays in ascending order, according to the value
ksort() - sort associative arrays in ascending order, according to the key
arsort() - sort associative arrays in descending order, according to the value
krsort() - sort associative arrays in descending order, according to the key -->