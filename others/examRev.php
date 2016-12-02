
<!DOCTYPE html>
<html>
<body>

$cars[0] = "Volvo";
$cars[1] = "BMW";
$cars[2] = "Toyota";

<!-- get array length -->
$cars = array("Volvo", "BMW", "Toyota");
echo count($cars);

<!-- LOOP through indexed array -->
<?php
$cars = array("Volvo", "BMW", "Toyota");
$arrlength = count($cars);

for($x = 0; $x < $arrlength; $x++) {
    echo $cars[$x];
    echo "<br>";
}
?>
<!-- -->
<?php 
$colors = array("red", "green", "blue", "yellow"); 

foreach ($colors as $value) {
    echo "$value <br>";
}
?>
</body>
</html>

<!-- associative array -->

<?php

$ar1 = array("leaf" => "green", "flower" => "red");
$ar2 = array('Season' => "summer", "Month" => "June" );


$resArray = ($ar1 + $ar2);

foreach ($resArray as $key => $value) {
	echo "$key $value <br>";
}
?>
<!-- LOOP associative array -->
<?php
$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");

foreach($age as $x => $x_value) {
    echo "Key=" . $x . ", Value=" . $x_value;
    echo "<br>";
}
?>


<!-- multi dimensinal array -->
<?php
$cars = array
  (
  array("Volvo",22,18),
  array("BMW",15,13),
  array("Saab",5,2),
  array("Land Rover",17,15)
  );
    
for ($row = 0; $row < 4; $row++) {
  echo "<p><b>Row number $row</b></p>";
  echo "<ul>";
  for ($col = 0; $col < 3; $col++) {
    echo "<li>".$cars[$row][$col]."</li>";
  }
  echo "</ul>";
}
?>


<!-- -->
<!-- 

echo "Today is " . date("Y/m/d") . "<br>";
numbers - var_dump($x);
echo readfile("webdictionary.txt");
echo strlen("Hello world!"); // outputs 12
echo str_word_count("Hello world!"); // outputs 2

sort() - sort arrays in ascending order
rsort() - sort arrays in descending order
asort() - sort associative arrays in ascending order, according to the value
ksort() - sort associative arrays in ascending order, according to the key
arsort() - sort associative arrays in descending order, according to the value
krsort() - sort associative arrays in descending order, according to the key 

==	Equal			$x == $y	Returns true if $x is equal to $y	Show it »
===	Identical		$x === $y	Returns true if $x is equal to $y, and they are of the same type	Show it »
!=	Not equal		$x != $y	Returns true if $x is not equal to $y	Show it »
<>	Not equal		$x <> $y	Returns true if $x is not equal to $y	Show it »
!==	Not identical	$x !== $y	Returns true if $x is not equal to $y, or they are not of the same type	Show it »
>	Greater than	$x > $yellow	Returns true if $x is greater than $y	Show it »
<	Less than		$x < $y		Returns true if $x is less than $y	Show it »
>=	Greater than or equal to	$x >= $y	Returns true if $x is greater than or equal to $y	Show it »
<=	Less than or equal to

++$x	Pre-increment	Increments $x by one, then returns $x	Show it »
$x++	Post-increment	Returns $x, then increments $x by one	Show it »
--$x	Pre-decrement	Decrements $x by one, then returns $x	Show it »
$x--	Post-decrement	Returns $x, then decrements $x by one


and	And	$x and $y	True if both $x and $y are true	Show it »
or	Or	$x or $y	True if either $x or $y is true	Show it »
xor	Xor	$x xor $y	True if either $x or $y is true, but not both	Show it »
&&	And	$x && $y	True if both $x and $y are true	Show it »
||	Or	$x || $y	True if either $x or $y is true	Show it »
!	Not	!$x	True if $x is not true


+	Union	$x + $y	Union of $x and $y	Show it »
==	Equality	$x == $y	Returns true if $x and $y have the same key/value pairs	Show it »
===	Identity	$x === $y	Returns true if $x and $y have the same key/value pairs in the same order and of the same types	Show it »
!=	Inequality	$x != $y	Returns true if $x is not equal to $y	Show it »
<>	Inequality	$x <> $y	Returns true if $x is not equal to $y	Show it »
!==	Non-identity	$x !== $y	Returns true if $x is not identical to $y


-->



<!-- add int 0 - 30 and print result -->

<?php

$res = 0;
for ($num=1; $num<30; $num++)
{
	$res = $res + $num;

}
echo $res;
?>