<?php

// include function files for this application
require_once('music_sc_fns.php');
session_start();

do_html_header("Adding a Supplier");
if (check_admin_user()) {
  if (filled_out($_POST)) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
  

    if(insert_supplier($name, $address, $city)) {
      echo "<p>Supplier <em>".stripslashes($name)."</em> was added to the database.</p>";
    } else {
      echo "<p>Supplier <em>".stripslashes($name)."</em> could not be added to the database.</p>";
    }
  } else {
    echo "<p>You have not filled out the form.  Please try again.</p>";
  }

  do_html_url("admin.php", "Back to administration menu");
} else {
  echo "<p>You are not authorised to view this page.</p>";
}

do_html_footer();

?>
