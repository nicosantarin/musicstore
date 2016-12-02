<!DOCTYPE html>

<?php
    session_start();
    echo '<h1> Members Section</h1>';

    if (isset($_SESSION['nameVar']))
    {
        echo '<a href="../a4logout.php">Logout </a>';

    	echo '<p> You are logged in as: <b> '.$_SESSION['nameVar']. '</b>  </p> ';
    	echo '<p> Members only content </p> ';
       
        

        echo '<a href="../a4access.php"> <p> View more </p> </a>';

         echo '<a href="../a4login.php"> Back to main page </a>';
        
    }
    else
    {
    	echo '<p> Sorry! You are not logged in </p> ';
    	echo '<p> Only logged in members may see this page </p> ';
        echo '<a href="../a4home.php"> Back to main page </a>';
    }
?>

<!-- <a href="../a4login.php"> Back to main page </a> -->

</html>
