<?php
 require_once('music_sc_fns.php');
 session_start();
 do_html_header("User Registration");

 if (isset($_SESSION['nameVar']))
    {
        echo '<a href="../a4logout.php">Logout </a>';

    	echo '<p> You are logged in as '.$_SESSION['nameVar'].' </p> ';
}
$conn = db_connect();
 // do_html_footer();
?>

<?php 

//check 
$loginid = $password= $firstname = $address = $city = $state = $postal = $country = null;
$error ="";

if (isset($_POST['loginbtn'])){

if (!valid_email($_POST["loginid"])) 
			{
			$error = "Error! Please Enter valid credentials!";
			}
			else 
				{
					$loginid = $_POST["loginid"];
										
				}


if (empty($_POST["password"])) 
			{
			$error = "Error! Please Enter valid credentials!";
			}
			else 
				{
					$password = $_POST["password"];					
				}

if (empty($_POST["firstname"])) 
			{
			$error = "Error! Please Enter valid credentials!";
			}
			else 
				{
					$firstname = $_POST["firstname"];					
				}

if (empty($_POST["address"])) 
			{
			$error = "Error! Please Enter valid credentials!";
			}
			else 
				{
					$address = $_POST["address"];					
				}				

if (empty($_POST["city"])) 
			{
			$error = "Error! Please Enter valid credentials!";
			}
			else 
				{
					$city = $_POST["city"];					
				}

if (empty($_POST["state"])) 
			{
			$error = "Error! Please Enter valid credentials!";
			}
			else 
				{
					$state = $_POST["state"];					
				}

if (empty($_POST["postal"])) 
			{
			$error = "Error! Please Enter valid credentials!";
			}
			else 
				{
					$postal = $_POST["postal"];					
				}

if (empty($_POST["country"])) 
			{
			$error = "Error! Please Enter valid credentials!";
			}
			else 
				{
					$country = $_POST["country"];					
				}



if(insert_customer($loginid,$password,$firstname,$address,$city,$state,$postal,$country))
 {
      echo "<p>Account <em>".stripslashes($loginid)."</em> was added to the database.</p>";
  } 
  else 
  {
      echo "<p>Account <em>".stripslashes($loginid)."</em> could not be added to the database.</p>";
   };	

	// $query = "SELECT * FROM customers 
	// WHERE customerid = '$loginid' 
	// AND password = sha1('$password')";

	// $result = $conn->query($query);
	// $total = $result->num_rows;



	// if ($total > 0)
	// {
	// 	$_SESSION['nameVar'] = $loginid;
	// 	echo "<h2> Access Granted! </h2><br>";

	// 	//echo "<h3> Hello! </h3>" . $loginid;
	// }
	// else 
	// {
	// 	echo "<h2>Error! Please Input Valid Credentials<h2>";
	// }

}

echo "$loginid";
echo "$password";
echo "$firstname";
echo "$address";
echo "$city";
echo "$state";
echo "$postal";
echo "$country";



 do_html_footer();
?>


<div>
		<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method ="post">
			<fieldset>
				<legend><H1>Account Creation</H1></legend>

				Enter Email Address: &nbsp; <input type ="text" name="loginid" value="">
				<span class="error"> <br><?php echo $error;?></span> <br>

				Enter Password: &nbsp; <input type ="text" name="password" value="">
				<span class="error"> <br><?php echo $error;?></span> <br>

				Enter First Name: &nbsp; <input type ="text" name="firstname" value="">
				<span class="error"> <br><?php echo $error;?></span> <br>

				Enter Address: &nbsp; <input type ="text" name="address" value="">
				<span class="error"> <br><?php echo $error;?></span> <br>

				Enter City: &nbsp; <input type ="text" name="city" value="">
				<span class="error"> <br><?php echo $error;?></span> <br>

				Enter State/Province: &nbsp; <input type ="text" name="state" value="">
				<span class="error"> <br></span> <br>

				Enter ZIP/Postal Code: &nbsp; <input type ="text" name="postal" value="">
				<span class="error"> <br></span> <br>

				Enter Country: &nbsp; <input type ="text" name="country" value="">
				<span class="error"> <br><?php echo $error;?></span> <br>

				<br>
				<input type="submit" value="Submit"  name="loginbtn" ><p><span class="error"></span></p> 
				<br>
				
			</fieldset>
		</form>
</div>		

<?php 

function insert_customer($loginid, $password, $firstname, $address, $city, $state, $postal, $country) {
// insert a new customer into the database

   $conn = db_connect();

   // check customerid does not already exist
   $query = "select *
             from customers
             where customerid='".$loginid."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   // insert new customer
   $query = "insert into customers values
            ('".$loginid."', sha1('".$password."'), '".$firstname."',
             '".$address."', '".$city."', '".$state."', '".$postal."', '".$country."')";

   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}
// ---------prepared statements

// $stmt = $conn->prepare ("INSERT INTO employee (userid, password, email) values (?,?,?)");
// $stmt->bind_param("sss", $userid, $password, $email);
// //set parameters and execute
// $userid = "Nico2";
// $password = "pw2";
// $email = "Nico2@kpu.ca";

// $stmt->execute();


// $conn->close();	

?>