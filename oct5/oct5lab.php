<?php
// ----------------------------Part 1 of assignment 2 ---
//create login variables
$servername = "localhost";
$username = "root";
$password = "";

//create connection using login
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully" . "<br>"; 

//create database
$sql = "CREATE DATABASE company";
if ($conn->query($sql) ===TRUE ) {
	echo "Databse created successfully" . "<br>";
}
	else {
		echo "Error creating database: "  . "<br>". $conn->error; 
	}

//select database
$conn->select_db("company");	

$sql = "CREATE TABLE employee ( 
	userid char(6) not null primary key,
	password char(9),
	email char(20)
	)";


	if ($conn->query($sql) === TRUE ) {
		echo "Table employee created successfully". "<br>";
	}
		else {
			echo "Error creating table: " . $conn->error . "<br>";
		}

		//$conn->close();

//-------------------------------Part 2 -------
//inserting values into table

$sql = "INSERT INTO employee (userid, password, email)
		VALUES ('Nico1', 'pw1', 'nico1@kpu.ca')";

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		}
			else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

		// $conn->close();	


//---------------------------------Part 3 ----------
//query a database and show results

$sql = "SELECT userid, password, email FROM employee";
$result = $conn->query($sql);

if ($result->num_rows> 0) {
	while($row = $result->fetch_assoc()) {
		echo "userid: " 
		. $row["userid"]
		. " - password: "
		. $row["password"] 
		. " - email: "
		 . $row["email"]
		 . "<br>";
	}
}

// $conn->close();	

// ---------prepared statements

$stmt = $conn->prepare ("INSERT INTO employee (userid, password, email) values (?,?,?)");
$stmt->bind_param("sss", $userid, $password, $email);
//set parameters and execute
$userid = "Nico2";
$password = "pw2";
$email = "Nico2@kpu.ca";

$stmt->execute();


$conn->close();	

?>