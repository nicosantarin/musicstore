<!DOCTYPE html>
<html>
<body>
<?php
// This is the username and password you input when the website loads and a window appears.
if (($_SERVER['PHP_AUTH_USER'] != 'Admin') || 
	($_SERVER['PHP_AUTH_PW'] != 'admin123'))
{
	header('WWW-Authenticate: Basic realm="Realm-Name"');
	header('HTTP/1.0 401 Unauthorized');

	echo "<h1> Sorry </h1>
	<p>You are not authroized to view this resource. </p>";
}
else
{
	echo "<h1>Welcome!</h1>
	<p>You are authorized to use this page.</p>";
}
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error)
{
  die("Connection failed: " . $conn->connect_error);
}
echo "Database connection successful!" . "<br>";

$sql = "CREATE DATABASE login";
if ($conn->query($sql) === TRUE)
 {
  echo "Database created successfully" . "<br>";
 }
 else 
{
  echo "Error creating database: " . $conn->error . "<br>";
}

$conn-> select_db("login");

$sql = "CREATE TABLE loginInfo1 (
username char(20) primary key,
password varchar(45))";

if ($conn->query($sql) === TRUE)
{
  echo "Table students created successfully" . "<br>";
}
else {
  echo "Error creating table: " . $conn->error . "<br>";
}

// $sql = "INSERT INTO loginInfo1 (username, password) VALUES ('user1', sha1('pass1')), ('user2', sha1('pass2'))";

// if ($conn->query($sql) === TRUE)
// {
// 	echo "New records created successfully!" . "<br>";
// }
// else
// { 
// 	"Error: " . $sql . "<br>" . $conn->error;
// }

?>
<h1>Log In</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Username: <input type="text" name="username" value=""><br>
Password: <input type="text" name="password" value=""><br>
<input type="submit" name="submit" value="Login"><br>

<?php

	$username = null;
	$password = null;
	if (isset($_POST["username"])) 
	{
		($username = $_POST["username"]);
	}
	if (isset($_POST["password"])) 
	{
		($password = $_POST["password"]);
	}

	$Query = "SELECT * FROM loginInfo1 
	WHERE username = '$username' 
	AND password = sha1('$password')";

	$result = $conn->query($Query);
	$total = $result->num_rows;

	echo $total;
	if ($total > 0)
	{
		echo "<h4> The login credentials are correct! </h4><br>";
		echo "<h1> Welcome! </h1>";
	}
	else 
	{
		echo "<h3>You are not authorized to use this website.<h3>";
	}

// $stmt = $conn->prepare("INSERT INTO loginInfo1 (username, password) 
// 						VALUES(?,?)");
// $stmt->bind_param("ss", $user, $pw);

// $user = $username;
// $pw = sha1($password);
// $stmt->execute();
// $stmt->close();
$conn->close();
?>
</form>
</body>
</html>