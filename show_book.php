<?php
  include ('music_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  $upc = $_GET['upc'];

  // get this book out of database
  $book = get_book_details($upc);
  do_html_header($book['title']);
  display_book_details($book);

  // set url for "continue button"
  $target = "index.php";
  if($book['catid']) {
    $target = "show_cat.php?catid=".$book['catid'];
  }

  // if logged in as admin, show edit book links
  if(check_admin_user()) {
    display_button("edit_book_form.php?upc=".$upc, "edit-item", "Edit Item");
    display_button("admin.php", "admin-menu", "Admin Menu");
    display_button($target, "continue", "Continue");
  } else {

    if (isset($_SESSION['nameVar']))
    {
    display_button("show_cart.php?new=".$upc, "add-to-cart",
                   "Add".$book['title']." To My Shopping Cart");
  }
    display_button($target, "continue-shopping", "Continue Shopping");
  }

  do_html_footer();
?>
