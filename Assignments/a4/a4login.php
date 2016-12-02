<!DOCTYPE html>

<?php
    session_start();
    echo '<h1>Home Page</h1>';

    if (isset($_SESSION['nameVar']))
    {
        echo '<a href="../a4logout.php">Logout </a>';

    	echo '<p> You are logged in as '.$_SESSION['nameVar'].' </p> ';
        echo '<a href="a4access/a4Members.php"> Members Section </a>';
    	
    }
    else
    {
    	echo '<p> You are not logged in </p> ';
    	
    }
?>

<!-- <a href="a4home.php"> Back to main page </a> -->

</html>
