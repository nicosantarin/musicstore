<!DOCTYPE html>
<html>

<head>
	<title>
		<?php 
		$var = "PHP Tutorial";
		echo $var;
		?>
	</title>

	<H3>
		<?php 
		echo $var;
		?>
	</H3>
</head>

<body>

	<?php
	$x = array(true,false); 
	$y = array('1',"0"); 
	var_dump($x + $y);

	var_dump ($x == $y);
	var_dump ($x === $y);

	?> 
</body>
</html>