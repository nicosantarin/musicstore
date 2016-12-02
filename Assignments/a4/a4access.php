<!DOCTYPE html>

<?php
    session_start();
    echo '<h1>Profile Details</h1>';

    if (isset($_SESSION['nameVar']))
    {
        echo '<a href="../a4logout.php">Logout </a>';

        echo '<p> Welcome! </p> ';
        echo '<p> You are a a Registered Member since: November 16, 2016  </p> ';

    	echo '<p> Your Account ID is:  <b> '.$_SESSION['nameVar']. '</b>  </p> ';
    	
       
        

        
        
    }
    else
    {
    	echo '<p> Sorry! You are not logged in </p> ';
    	echo '<p> Only logged in members may see the contents of this page </p> ';
    }
?>

<a href="a4login.php"> Back to main page </a>

</html>
