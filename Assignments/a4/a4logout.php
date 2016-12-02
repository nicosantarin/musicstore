<!DOCTYPE html>

<?php
    session_start();

    $old_user=$_SESSION['nameVar'];
    unset($_SESSION['nameVar']);
    session_destroy();
 ?>

<body>
<h1> Log out </h1>
<?php
	if (!empty($old_user))
	{
		echo 'You have successfully logged out! <br/>';
	}
	else
	{
		echo 'You were not logged in. <br/>';
	}
?>
<a href="a4Home.php"> Back to main page</a>
</body>
</html>