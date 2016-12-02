<!-- Nico Santarin 100301343-->


<?php

$servername = "localhost";
$username = "root";
$password = "";


$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully" . "<br>"; 

//create database
$sql = "CREATE DATABASE library";
if ($conn->query($sql) ===TRUE ) {
	echo "Library Database created!" . "<br>";
}
	else {
		echo "Error creating database:" . "<br> " . $conn->error; 
	}


$conn->select_db("library");	



$sql = "CREATE TABLE students ( 
	studentid char(10) not null primary key,
	firstname char(20),
	lastname char(20),
	school char(50),
	upc int(20)
	)";

$sql2 = "CREATE TABLE books ( 
	upc int(10) not null primary key,
	title char(20),
	author char(20)
	)";


	if ($conn->query($sql) === TRUE ) {
		echo "Table students created successfully". "<br>";
	}
		else {
			echo "Error creating table: " . $conn->error . "<br>";
		}

if ($conn->query($sql2) === TRUE ) {
		echo "Table books created successfully". "<br>";
	}
		else {
			echo "Error creating table: " . $conn->error . "<br>";
		}		








$sql = "INSERT INTO students (studentid, firstname, lastname, school, upc)
		VALUES 
		('1001', 'Nico', 'Santarin', 'KPU', '123445'),
		('1002', 'Kanye', 'West', 'KPU', '123446'),
		('1003', 'Bob', 'Smith', 'UBC', '123447'),
		('1004', 'Angelina', 'Jolie', 'SFU', '123448')";

		if ($conn->query($sql) === TRUE) {
			echo "New students record created successfully" ." <br>";
		}
			else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

$sql2 = "INSERT INTO books (upc, title, author)
		VALUES 
		('123445', 'HarryPotter', 'J.K.Rowling'),
		('123446', 'Life as West', 'Kanye West'),
		('123447', 'Animal Farm', 'George Orwell'),
		('123448', 'The Lord Of The Rings', 'J.R.R. Tolkien')";

		if ($conn->query($sql2) === TRUE) {
			echo "New books record created successfully"  ." <br>";
		}
			else {
				echo "Error: " . $sql2 . "<br>" . $conn->error;
			}
?>



<!DOCTYPE html>
<html>
<body>


	<?php 
	$studentid = "";
	$studentidErr = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

  



		if (empty($_POST["studentid"])) 
			{
			$studentidErr = "Please Enter Student Number";
			}

			else 
				{
					$studentid = test_input($_POST["studentid"]);
					if(!preg_match('/^\b1001|1002|1003|1004\b$/', $studentid))	
					{
						$studentidErr = "Student ID cannot be found!";
					}
					
				}

	
}

	?>
<div>
		<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method ="post">
			<fieldset>
				<legend><H1>Search for Book</H1></legend>

				Enter Student ID:  &nbsp;<input type ="text" name="studentid" >
				<span class="error"> <?php echo $studentidErr;?></span> <br>

				<br>
				<input type="submit" value="Search"><p><span class="error"></span></p>
				<br>

				<textarea name="result" rows="5" cols="60" >
<?php 
$sql = "SELECT books.*
		FROM books
		INNER JOIN students
		ON books.upc = students.upc
		WHERE studentid LIKE '$studentid'";


$result = $conn->query($sql);

if ($result->num_rows> 0) {
	while($row = $result->fetch_assoc()) {
		echo"Title: " . $row["title"]
		. "   Author: " . $row["author"]
		. "   upc: " . $row["upc"];
	}
}

$conn->close();	
?>
				</textarea>
			</fieldset>
		</form>
</div>		

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