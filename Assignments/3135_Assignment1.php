<!-- Nico Santarin 100301343 -->

<!DOCTYPE html>
<html>
<body>
<style>
.error {color: #FF0000;
font-size: 12px;}

legend {
	font-family: Tahoma, Geneva, sans-serif;
	color: #4CAF50;
	
	text-align: center;
}
input[type=text]
{
	display: inline-block;
	clear: right;
}
input[type=submit] 
{	background-color: #4CAF50;
	border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;}
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
	$userid = $password = $email = $genderbtn = "";
	$useridErr = $passwordErr = $emailErr = $genderErr = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

//check userid good

		if (empty($_POST["userid"])) 
			{
			$useridErr = "User ID is required";
			}
			else 
				{
					
					$userid = test_input($_POST["userid"]);
					if (!preg_match("/^[a-zA-Z0-9]{3,6}$/", $userid)) {

				$useridErr = "Your User ID must consist of 3 to 6 Characters!";
			}
				}


//check password
				if (empty($_POST["password"])) {
					$passwordErr = "Valid password is required!";
				} 

				 elseif (strlen($_POST["password"])<'5' ) 
				 {
				 	$passwordErr = "Password Must be between 5 to 9 characters!";
				 }

				 elseif (strlen($_POST["password"])>'9' )
				 {
				 	$passwordErr = "Password Must be between 5 to 9 characters!";
				 }

				else {
						$password = test_input($_POST["password"]);
						if (!preg_match('/[^a-z0-9 _]+/i', $password))
				 {
						$passwordErr = "Must have atleast one special character";		 
					
				}
						 
				}

//check email good
				if (empty($_POST["email"]))
				{
				$emailErr = "Valid Email is required";
				}
				 else { 
				 	$email = test_input($_POST["email"]);
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
						{
						$emailErr = "Invalid email format. Example Bob@kpu.ca"; 
						}
					}



//check gendergood
		if (empty($_POST["genderbtn"])) {
   				 $genderErr = "Please select Gender";
 			} else
 				{
   				 $genderbtn = test_input($_POST["genderbtn"]);
  				}


	
}

	?>
<div>
		<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method ="post">
			<fieldset>
				<legend><H1>Register Here</H1></legend>
				Enter Desired User ID:  &nbsp;<input type ="text" name="userid" >
				<span class="error">* <?php echo $useridErr;?></span> <br>

				Enter Password: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type ="text" name="password">
				<span class="error">* <?php echo $passwordErr;?></span><br>

				Enter Email Address: &nbsp;&nbsp;&nbsp;<input type ="text" name="email">
				<span class="error">* <?php echo $emailErr;?></span><br>

					Select Gender:   Male <input type ="radio" value="Male" name="genderbtn"> Female<input type ="radio"  value="Female" name="genderbtn">
				<span class="error">* <?php echo $genderErr;?></span><br>

				<br>
				<input type="submit"> <p><span class="error">* required fields.</span></p>
				<br>


							</fieldset>
						</form>
</div>
<!-- test inputs -->

						<!-- <?php
						echo $userid;
						echo $email;
						echo $password; 
						echo $genderbtn;
						?> -->

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