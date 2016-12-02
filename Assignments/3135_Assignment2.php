<!-- Nico Santarin 100301343-->
<!-- Four valid Student IDs: 1001,1002,1003,1004-->

<?php
//create login variables
$servername = "localhost";
$username = "root";
$password = "";

//create connection using login
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}


//create database
$sql = "CREATE DATABASE library";
$conn->query($sql) ===TRUE;


//select database

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

$conn->query($sql) === TRUE;
$conn->query($sql2) === TRUE;






//-------------------------------Part 2 -------
//inserting values into table

$sql = "INSERT INTO students (studentid, firstname, lastname, school, upc)
		VALUES 
		('1001', 'Nico', 'Santarin', 'KPU', '123445'),
		('1002', 'Kanye', 'West', 'KPU', '123446'),
		('1003', 'Bob', 'Smith', 'UBC', '123447'),
		('1004', 'Angelina', 'Jolie', 'SFU', '123448')";

$conn->query($sql) === TRUE;

$sql2 = "INSERT INTO books (upc, title, author)
		VALUES 
		('123445', 'Harry Potter', 'J.K.Rowling'),
		('123446', '1984', 'George Orwell'),
		('123447', 'Animal Farm', 'George Orwell'),
		('123448', 'The Lord Of The Rings', 'J.R.R. Tolkien')";

$conn->query($sql2) === TRUE;
			
?>

<!-- create form-->

<!DOCTYPE html>
<html>
<body>
<style>
.error {color: #FF0000;
font-size: 12px;}

legend {
	font-family: Tahoma, Geneva, sans-serif;
	color: #d27979;
	
	text-align: center;
}
input[type=text]
{
	display: inline-block;
	clear: right;
	
}
input[type=submit] 
{	background-color: #d27979;
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


margin-right: 30%;
margin-left: 30%;
background-color: : #4CAF50;
}   

div {

    
    padding: 200px;
}
body {
	    background-color: #f2f2f2;

}
</style>

	<?php 
	$studentid = "";
	$studentidErr = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

//check student id  



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
				<legend><H1>Search Library Book</H1></legend>

				Enter Student ID:  &nbsp;<input type ="text" name="studentid" >
				<span class="error"> <br><?php echo $studentidErr;?></span> <br>

				<br>
				<input type="submit" value="Search"><p><span class="error"></span></p>
				<br>
				<b>Book Borrowed:</b>
				<textarea name="resultmsg" rows="5" cols="60" autofocus readonly placeholder="valid: 1001/1002/1003/1004">
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

// $conn->close();	
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