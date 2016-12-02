<!DOCTYPE html>
<html>
<body>

<!-- using POST
 -->
<?php
 $nameErr = $phoneErr= $commentErr = "";
$name = $phone = $comment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["name"])) {
		$nameErr = "Name is required";
	}
	else {
		$name = test_input($_POST["name"]);
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
		$nameErr = "only letters and white space allowed";
	}
}
	
		if (empty($_POST["phone"])) {
		$phoneErr = "a number is required";
	}
	else {
		$phone = test_input($_POST["phone"]);
		if (!preg_match("/^[0-9]*$/",$phone)) {
		$phoneErr = "only numbers allowed";
	}
}

			if (empty($_POST["comment"])) {
		$comment = "";
	}
	else {
		$comment = test_input($_POST["name"]);
		
	}
}
?>

 <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method ="post">

Name: <input type="text" name="name">
<span class="error">* <?php echo $nameErr;?> </span> <br>
<br>
Phone #: <input type="text" name="phone">
<span class="error">* <?php echo $phoneErr;?> </span> <br>
<br>
Comment: <input type="textbox" name="comment">
<span class="error">* <?php echo $commentErr;?> </span> <br>

<br>
<input type="submit">
<br>

</form>

<?php
echo $_POST["name"];  
echo $_POST["phone"]; 
echo $_POST["comment"]; 
?>




<?php
function test_input($data) {
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

</body>
</html>