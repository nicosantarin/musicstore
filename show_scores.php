<?php
  include ('music_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  $upc = $_GET['upc'];

  // get this book out of database
  $score = get_scores_details($upc);
  do_html_header($score['title']);
  display_scores_details($score);

  // set url for "continue button"
  $target = "index.php";
  if($score['catid']) {
    $target = "show_cat.php?catid=".$score['catid'];
  }

  // if logged in as admin, show edit book links
  if(check_admin_user()) {
    display_button("edit_score_form.php?upc=".$upc, "edit-item", "Edit Item");
    display_button("admin.php", "admin-menu", "Admin Menu");
    display_button($target, "continue", "Continue");
  } else {

    if (isset($_SESSION['nameVar']))
    {
    display_button("show_cart.php?new=".$upc, "add-to-cart",
                   "Add".$score['title']." To My Shopping Cart");
  }
    display_button($target, "continue-shopping", "Continue Shopping");
  }

  do_html_footer();
?>
