<!DOCTYPE html>
<!--100301343 Nico Santarin -->
<html>
<?php
// credentials to input for authentication popup.
if (($_SERVER['PHP_AUTH_USER'] != 'admin') || 
	($_SERVER['PHP_AUTH_PW'] != 'kpu123'))
{
	header('WWW-Authenticate: Basic realm="Realm-Name"');
	header('HTTP/1.0 401 Unauthorized');

	echo "<h1> Access Denied </h1>
	<p>You are not authorized to view this resource. </p>";
}
else
{
	echo "<h1>Welcome!</h1>
	<p>You have been authorized to use this page.</p>";
}
?>
<?php
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
// echo "Database connection successful!" . "<br>";

$sql = "CREATE DATABASE login";
$conn->query($sql) === TRUE;
//  {
//   echo "Database created successfully" . "<br>";
//  }
//  else 
// {
//   echo "Error creating database: " . $conn->error . "<br>";
// }


$conn-> select_db("login");

$sql = "CREATE TABLE loginInfo (
loginid char(15) primary key,
password varchar(50))";

$conn->query($sql) === TRUE;
// {
//   echo "Table logininfo created successfully" . "<br>";
// }
// else {
//   echo "Error creating table: " . $conn->error . "<br>";
// }




//inserting values
$sql = "INSERT INTO loginInfo (loginid, password) 
		VALUES 
		('user1', sha1('pw1')), 
		('user2', sha1('pw2'))";

if ($conn->query($sql) === TRUE)
{
	echo "New records created successfully!" . "<br>";
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

if (empty($_POST["loginid"])) 
			{
			$error = "Access Denied, need valid credentials!";
			}
			else 
				{
					$loginid = $_POST["loginid"];					
				}
// if (isset($_POST["loginid"])) 
// 	{
// 		($loginid = $_POST["loginid"]);
// 	}

if (empty($_POST["password"])) 
			{
			$error = "Access Denied, need valid credentials!";
			}
			else 
				{
					$password = $_POST["password"];					
				}
	// if (isset($_POST["password"])) 
	// {
	// 	($password = $_POST["password"]);
	// }

	$Query = "SELECT * FROM loginInfo 
	WHERE loginid = '$loginid' 
	AND password = sha1('$password')";

	$result = $conn->query($Query);
	$total = $result->num_rows;

	//echo $total;

	if ($total > 0)
	{
		echo "<h2> Access Granted! </h2><br>";
		echo "<h3> Hello! </h3>" . $loginid;
	}
	else 
	{
		echo "<h2>Please Input Valid Credentials<h2>";
	}

$stmt = $conn->prepare("INSERT INTO loginInfo (loginid, password) 
						VALUES(?,?)");
$stmt->bind_param("ss", $id, $pw);

$id = $loginid;
$pw = sha1($password);

$stmt->execute();
$stmt->close();
$conn->close();
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
				<input type="submit" value="Log In"><p><span class="error"></span></p> 
				<input type="submit" value="Register"><p><span class="error"></span></p>
				<br>

			</fieldset>
		</form>
</div>		

						

					</body>

					<style>
.error {color: #FF0000;
font-size: 12px;}

legend {
	font-family: Tahoma, Geneva, sans-serif;
	color: #16A085  ;
	
	text-align: center;
}
input[type=text]
{
	display: inline-block;
	clear: right;
	
}
input[type=submit] 
{	background-color: #16A085  ;
	border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
}
fieldset 
{
font-size: 20px;
padding-top: 20px;
font-family: "Trebuchet MS", Helvetica, sans-serif;


margin-right: 60%;
margin-left: 1%;
background-color: : #4CAF50;
}   

div {

    
    padding: 200px;
}
body {
	    background-color: #f2f2f2;

}
</style>
					</html>