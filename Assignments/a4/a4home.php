<!DOCTYPE html>
<!--100301343 Nico Santarin -->
<html>


<?php
session_start();

//$_SESSION['sessVar']="Hello World!";

//echo 'the content of $_SESSION[\'sessVar\'] is ' .$_SESSION['sessVar'] . "<br/>";

if (isset($_SESSION['nameVar']))
{
	 echo '<a href="a4logout.php"> Logout </a>';
}



//create login variables
$servername = "localhost";
$username = "root";
$password = "";

//create connection using login
$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error)
{
  die("Connection failed: " . $conn->connect_error);
}
//echo "Database connection successful!" . "<br>";

$sql = "CREATE DATABASE sessionDB";
if($conn->query($sql) === TRUE)
 {
  echo "Database created successfully" . "<br>";
 }
 else 
{
  //echo "Error creating database: " . $conn->error . "<br>";
}


$conn-> select_db("sessionDB");

$sql = "CREATE TABLE session (
loginid char(15) primary key,
password varchar(50))";

if($conn->query($sql) === TRUE)
{
  echo "Table session created successfully" . "<br>";
}
else {
  //echo "Error creating table: " . $conn->error . "<br>";
}



//User ID and passwords to test
//inserting values
$sql = "INSERT INTO session (loginid, password) 
		VALUES 
		('user1', sha1('pw1')), 
		('user2', sha1('pw2'))";

if ($conn->query($sql) === TRUE)
{
	//echo "New records created successfully!" . "<br>";
}
else
{ 
	"Error: " . $sql . "<br>" . $conn->error;
}
?>

<body>


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


	$Query = "SELECT * FROM session 
	WHERE loginid = '$loginid' 
	AND password = sha1('$password')";

	$result = $conn->query($Query);
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
				<input type="submit" value="Log In"  name="loginbtn" href="a4login.php"><p><span class="error"></span></p> 
				<a href="a4access/a4members.php"> Members Sections </a>
				<br>

			</fieldset>
		</form>
</div>		

						

					</body>


					</html>