<?php

// include function files for this application
require_once('music_sc_fns.php');
session_start();

do_html_header("Adding a book");
if (check_admin_user()) {
  if (filled_out($_POST)) {
    $upc = $_POST['upc'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    $catid = $_POST['catid'];
    $price = $_POST['price'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];

    if(insert_book($upc, $author, $title, $catid, $price, $publisher, $year)) {
      echo "<p>Book <em>".stripslashes($title)."</em> was added to the database.</p>";
    } else {
      echo "<p>Book <em>".stripslashes($title)."</em> could not be added to the database.</p>";
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
