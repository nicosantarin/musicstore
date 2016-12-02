<?php
  include ('music_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  $upc = $_GET['upc'];

  // get this book out of database
  $tracklist = get_tracklist_details($upc);
  do_html_header($tracklist['name']);
  display_trackslist_details($tracklist);

  // set url for "continue button"
  $target = "index.php";
  if($tracklist['catid']) {
    $target = "show_cat.php?catid=".$tracklist['catid'];
  }

  // if logged in as admin, show edit book links
  if(check_admin_user()) {
    display_button("edit_book_form.php?upc=".$upc, "edit-item", "Edit Item");
    display_button("admin.php", "admin-menu", "Admin Menu");
    display_button($target, "continue", "Continue");
  } else {
    display_button("show_cart.php?new=".$upc, "add-to-cart",
                   "Add".$tracklist['title']." To My Shopping Cart");
    display_button($target, "continue-shopping", "Continue Shopping");
  }

  do_html_footer();
?>
