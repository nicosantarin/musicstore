<?php

// include function files for this application
require_once('music_sc_fns.php');
session_start();

do_html_header("Adding a disc");
if (check_admin_user()) {
  if (filled_out($_POST)) {
    $upc = $_POST['upc'];
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $catid = $_POST['catid'];
    $price = $_POST['price'];
    $producer = $_POST['producer'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    

    if(insert_disc($upc, $title, $artist, $catid, $price, $producer, $year, $genre)) {
      echo "<p>Disc <em>".stripslashes($title)."</em> was added to the database.</p>";
    } else {
      echo "<p>Disc <em>".stripslashes($title)."</em> could not be added to the database.</p>";
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
