<?php
  include ('music_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  $catid = $_GET['catid'];
  $name = get_category_name($catid);

  do_html_header($name);

switch ($catid) {

case 1:
  // get the book info out from db
  $book_array = get_books($catid);
  display_books($book_array);
  break;

case 2:
    // get the cd dvd info out from db
  $discs_array = get_discs($catid);
  display_discs($discs_array);
  break;

case 3:
   // get the scores info out from db
  $scores_array = get_scores($catid);
  display_scores($scores_array);
  break;
}



  // if logged in as admin, show add, delete book links
  if(isset($_SESSION['admin_user'])) {
    display_button("index.php", "continue", "Continue Shopping");
    display_button("admin.php", "admin-menu", "Admin Menu");
    display_button("edit_category_form.php?catid=".$catid,
                   "edit-category", "Edit Category");
  } else {
    display_button("index.php", "continue-shopping", "Continue Shopping");
  }

  do_html_footer();
?>
