<?php

// include function files for this application
require_once('music_sc_fns.php');
session_start();

do_html_header("Deleting book");
if (check_admin_user()) {
  if (isset($_POST['upc'])) {
    $upc = $_POST['upc'];
    if(delete_book($upc)) {
      echo "<p>Book ".$upc." was deleted.</p>";
    } else {
      echo "<p>Book ".$upc." could not be deleted.</p>";
    }
  } else {
    echo "<p>We need an upc to delete a book.  Please try again.</p>";
  }
  do_html_url("admin.php", "Back to administration menu");
} else {
  echo "<p>You are not authorised to view this page.</p>";
}

do_html_footer();

?>
