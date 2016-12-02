<?php

// include function files for this application
require_once('music_sc_fns.php');
session_start();

do_html_header("Updating Score");
if (check_admin_user()) {
  if (filled_out($_POST)) {
    $oldupc = $_POST['oldupc'];
    $upc = $_POST['upc'];
    $composer = $_POST['composer'];
    $title = $_POST['title'];
    $catid = $_POST['catid'];
    $price = $_POST['price'];
    $publisher = $_POST['publisher'];

    if(update_score($oldupc, $upc, $composer, $title, $catid, $price, $publisher)) {
      echo "<p>Score was updated.</p>";
    } else {
      echo "<p>Score could not be updated.</p>";
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
