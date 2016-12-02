<?php

// include function files for this application
require_once('music_sc_fns.php');
session_start();

do_html_header("Updating book");
if (check_admin_user()) {
  if (filled_out($_POST)) {
    $oldupc = $_POST['oldupc'];
    $upc = $_POST['upc'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $catid = $_POST['catid'];
    $price = $_POST['price'];

    if(update_book($oldupc, $upc, $title, $author, $catid, $price)) {
      echo "<p>Book was updated.</p>";
    } else {
      echo "<p>Book could not be updated.</p>";
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
