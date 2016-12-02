<?php
 require_once('music_sc_fns.php');
 session_start();
 do_html_header("User Login");

 if (isset($_SESSION['nameVar']))
    {
        echo '<a href="../logout.php">Logout </a>';

    	echo '<p> You are logged in as '.$_SESSION['nameVar'].' </p> ';

    	echo '<a href="../index.php">Logout </a>';
}
$conn = db_connect();
 // do_html_footer();
?>

<?php 

//check 
$loginid = $password= null;
$error ="";

if (isset($_POST['loginbtn'])){
if (empty($_POST["loginid"])) 
			{
			$error = "Access Denied, need valid credentials!";
			}
			else 
				{
					$loginid = $_POST["loginid"];
										
				}


if (empty($_POST["password"])) 
			{
			$error = "Access Denied, need valid credentials!";
			}
			else 
				{
					$password = $_POST["password"];					
				}


	$query = "SELECT * FROM customers 
	WHERE customerid = '$loginid' 
	AND password = sha1('$password')";

	$result = $conn->query($query);
	$total = $result->num_rows;



	if ($total > 0)
	{
		$_SESSION['nameVar'] = $loginid;
		echo "<h2> Access Granted! </h2><br>";

		//echo "<h3> Hello! </h3>" . $loginid;
	}
	else 
	{
		echo "<h2>Error! Please Input Valid Credentials<h2>";
	}
}



 do_html_footer();
?>

<div>
		<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method ="post">
			<fieldset>
				<legend><H1>Log In Here</H1></legend>

				Enter Login Name: &nbsp; <input type ="text" name="loginid" value="">
				<span class="error"> <br><?php echo $error;?></span> <br>

				Enter Password: &nbsp; <input type ="text" name="password" value="">
				<span class="error"> <br><?php echo $error;?></span> <br>

				<br>
				<input type="submit" value="Log In"  name="loginbtn" href="custlogin.php"><p><span class="error"></span></p> 
				<br>
				<a href="register.php" align="left" valign="bottom">Click Here to Register!</a>
			</fieldset>
		</form>
</div>		