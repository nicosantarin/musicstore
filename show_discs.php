<?php
  include ('music_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  $upc = $_GET['upc'];

  // get this disc out of database
  $disc = get_discs_details($upc);
  do_html_header($disc['title']);
  display_discs_details($disc);


  // set url for "continue button"
  $target = "index.php";
  if($disc['catid']) {
    $target = "show_cat.php?catid=".$disc['catid'];
  }

  // if logged in as admin, show edit disc links
  if(check_admin_user()) {
    display_button("edit_book_form.php?upc=".$upc, "edit-item", "Edit Item");
    display_button("admin.php", "admin-menu", "Admin Menu");
    display_button($target, "continue", "Continue");
  } else {

    if (isset($_SESSION['nameVar']))
    {
    display_button("show_cart.php?new=".$upc, "add-to-cart",
                   "Add".$disc['title']." To My Shopping Cart");
  }
    display_button($target, "continue-shopping", "Continue Shopping");
  }

  do_html_footer();
?>
