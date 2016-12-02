<?php
function calculate_shipping_cost() {
  // as we are shipping products all over the world
  // via teleportation, shipping is fixed
  return 20.00;
}

function get_categories() {
   // query database for a list of categories
   $conn = db_connect();
   $query = "select catid, catname from categories";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_category_name($catid) {
   // query database for the name for a category id
   $conn = db_connect();
   $query = "select catname from categories
             where catid = '".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $row = $result->fetch_object();
   return $row->catname;
}


function get_books($catid) {
   // query database for the books in a category
   if ((!$catid) || ($catid == '')) {
     return false;
   }

   $conn = db_connect();
   $query = "select * from books where catid = '".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_books = @$result->num_rows;
   if ($num_books == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_discs($catid) {
   // query database for the books in a category
   if ((!$catid) || ($catid == '')) {
     return false;
   }

   $conn = db_connect();
   $query = "select * from discs where catid = '".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_discs = @$result->num_rows;
   if ($num_discs == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_scores($catid) {
   // query database for the books in a category
   if ((!$catid) || ($catid == '')) {
     return false;
   }

   $conn = db_connect();
   $query = "select * from scores where catid = '".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_scores = @$result->num_rows;
   if ($num_scores == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_book_details($upc) {
  // query database for all details for a particular book
  if ((!$upc) || ($upc=='')) {
     return false;
  }
  $conn = db_connect();
  $query = "select * from books where upc='".$upc."'";
  $result = @$conn->query($query);
  if (!$result) {
     return false;
  }
  $result = @$result->fetch_assoc();
  return $result;
}


function get_score_details($upc) {
  // query database for all details for a particular score
  if ((!$upc) || ($upc=='')) {
     return false;
  }
  $conn = db_connect();
  $query = "select * from scores where upc='".$upc."'";
  $result = @$conn->query($query);
  if (!$result) {
     return false;
  }
  $result = @$result->fetch_assoc();
  return $result;
}
// function get_discs_details($upc) {
//   // query database for all details for a particular book
//   if ((!$upc) || ($upc=='')) {
//      return false;
//   }
//   $conn = db_connect();
//   $query = "select * from discs where upc='".$upc."'";
//   $result = @$conn->query($query);
//   if (!$result) {
//      return false;
//   }
//   $result = @$result->fetch_assoc();
//   return $result;
// }

function get_discs_details($upc) {
  // query database for all details for a particular book
  if ((!$upc) || ($upc=='')) {
     return false;
  }
  $conn = db_connect();

  $query = "select * from discs where upc = '".$upc."'";
  $result = @$conn->query($query);
  if (!$result) {
     return false;
  }
  $result = @$result->fetch_assoc();
  return $result;
}

function get_scores_details($upc) {
  // query database for all details for a particular book
  if ((!$upc) || ($upc=='')) {
     return false;
  }
  $conn = db_connect();
  $query = "select * from scores where upc='".$upc."'";
  $result = @$conn->query($query);
  if (!$result) {
     return false;
  }
  $result = @$result->fetch_assoc();
  return $result;
}

// function get_tracklist_details($upc) {
//   // query database for all details for a particular book
//   if ((!$upc) || ($upc=='')) {
//      return false;
//   }
//   $conn = db_connect();
//   $query = "select * from tracklist where upc='".$upc."'";
//   $result = @$conn->query($query);
//   if (!$result) {
//      return false;
//   }
//   $result = @$result->fetch_assoc();
//   return $result;
// }




function calculate_price($cart) {
  // sum total price for all items in shopping cart
  $price = 0.0;
  if(is_array($cart)) {
    $conn = db_connect();
    foreach($cart as $upc => $qty) {
      $query = "select discs.price, books.price from discs,books where upc like'.$upc.'";
     
      $result = $conn->query($query);
      
      if ($result) {
        $item = $result->fetch_object();
        $item_price = $item->price;
        $price +=$item_price*$qty;
      }
    }
  }
  return $price;
}

function calculate_items($cart) {
  // sum total items in shopping cart
  $items = 0;
  if(is_array($cart))   {
    foreach($cart as $upc => $qty) {
      $items += $qty;
    }
  }
  return $items;
}
?>
