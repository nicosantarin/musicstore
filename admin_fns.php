<?php
// This file contains functions used by the admin interface
// for the Book-O-Rama shopping cart.

function display_category_form($category = '') {
// This displays the category form.
// This form can be used for inserting or editing categories.
// To insert, don't pass any parameters.  This will set $edit
// to false, and the form will go to insert_category.php.
// To update, pass an array containing a category.  The
// form will contain the old data and point to update_category.php.
// It will also add a "Delete category" button.

  // if passed an existing category, proceed in "edit mode"
  $edit = is_array($category);

  // most of the form is in plain HTML with some
  // optional PHP bits throughout
?>
  <form method="post"
      action="<?php echo $edit ? 'edit_category.php' : 'insert_category.php'; ?>">
  <table border="0">
  <tr>
    <td>Category Name:</td>
    <td><input type="text" name="catname" size="40" maxlength="40"
          value="<?php echo $edit ? $category['catname'] : ''; ?>" /></td>
   </tr>
  <tr>
    <td <?php if (!$edit) { echo "colspan=2";} ?> align="center">
      <?php
         if ($edit) {
            echo "<input type=\"hidden\" name=\"catid\" value=\"".$category['catid']."\" />";
         }
      ?>
      <input type="submit"
       value="<?php echo $edit ? 'Update' : 'Add'; ?> Category" /></form>
     </td>
     <?php
        if ($edit) {
          //allow deletion of existing categories
          echo "<td>
                <form method=\"post\" action=\"delete_category.php\">
                <input type=\"hidden\" name=\"catid\" value=\"".$category['catid']."\" />
                <input type=\"submit\" value=\"Delete category\" />
                </form></td>";
       }
     ?>
  </tr>
  </table>

<?php
}

function display_book_form($book = '') {
// This displays the book form.
// It is very similar to the category form.
// This form can be used for inserting or editing books.
// To insert, don't pass any parameters.  This will set $edit
// to false, and the form will go to insert_book.php.
// To update, pass an array containing a book.  The
// form will be displayed with the old data and point to update_book.php.
// It will also add a "Delete book" button.


  // if passed an existing book, proceed in "edit mode"
  $edit = is_array($book);

  // most of the form is in plain HTML with some
  // optional PHP bits throughout
?>
  <form method="post"
        action="<?php echo $edit ? 'edit_book.php' : 'insert_book.php';?>">
  <table border="0">
  <tr>
    <td>upc:</td>
    <td><input type="text" name="upc"
         value="<?php echo $edit ? $book['upc'] : ''; ?>" /></td>
  </tr>
  <tr>
    <td>Book Title:</td>
    <td><input type="text" name="title"
         value="<?php echo $edit ? $book['title'] : ''; ?>" /></td>
  </tr>
  <tr>
    <td>Book Author:</td>
    <td><input type="text" name="author"
         value="<?php echo $edit ? $book['author'] : ''; ?>" /></td>
   </tr>
   <tr>
      <td>Category:</td>
      <td><select name="catid">
      <?php
          // list of possible categories comes from database
          $cat_array=get_categories();
          foreach ($cat_array as $thiscat) {
               echo "<option value=\"".$thiscat['catid']."\"";
               // if existing book, put in current catgory
               if (($edit) && ($thiscat['catid'] == $book['catid'])) {
                   echo " selected";
               }
               echo ">".$thiscat['catname']."</option>";
          }
          ?>
          </select>
        </td>
   </tr>
   <tr>
    <td>Price:</td>
    <td><input type="text" name="price"
               value="<?php echo $edit ? $book['price'] : ''; ?>" /></td>
   </tr>
   <tr>
    <td>Publisher:</td>
    <td><input type="text" name="publisher"
         value="<?php echo $edit ? $book['publisher'] : ''; ?>" /></td>
   </tr>
   <tr>
    <td>Year:</td>
    <td><input type="text" name="year"
         value="<?php echo $edit ? $book['year'] : ''; ?>" /></td>
   </tr>
    <tr>
      <td <?php if (!$edit) { echo "colspan=2"; }?> align="center">
         <?php
            if ($edit)
             // we need the old upc to find book in database
             // if the upc is being updated
             echo "<input type=\"hidden\" name=\"oldupc\"
                    value=\"".$book['upc']."\" />";
         ?>
        <input type="submit"
               value="<?php echo $edit ? 'Update' : 'Add'; ?> Book" />
        </form></td>
        <?php
           if ($edit) {
             echo "<td>
                   <form method=\"post\" action=\"delete_book.php\">
                   <input type=\"hidden\" name=\"upc\"
                    value=\"".$book['upc']."\" />
                   <input type=\"submit\" value=\"Delete book\"/>
                   </form></td>";
            }
          ?>
         </td>
      </tr>
  </table>
  </form>


 <?php
}

function display_disc_form($disc = '') {
// This displays the disc form.
// It is very similar to the category form.
// This form can be used for inserting or editing books.
// To insert, don't pass any parameters.  This will set $edit
// to false, and the form will go to insert_book.php.
// To update, pass an array containing a disc.  The
// form will be displayed with the old data and point to update_book.php.
// It will also add a "Delete disc" button.


  // if passed an existing disc, proceed in "edit mode"
  $edit = is_array($disc);

  // most of the form is in plain HTML with some
  // optional PHP bits throughout
?>
  <form method="post"
        action="<?php echo $edit ? 'edit_disc.php' : 'insert_disc.php';?>">
  <table border="0">
  <tr>
    <td>UPC:</td>
    <td><input type="text" name="upc"
         value="<?php echo $edit ? $disc['upc'] : ''; ?>" /></td>
  </tr>
  <tr>
    <td>Disc Title:</td>
    <td><input type="text" name="title"
         value="<?php echo $edit ? $disc['title'] : ''; ?>" /></td>
  </tr>
  <tr>
    <td>Disc Artist:</td>
    <td><input type="text" name="author"
         value="<?php echo $edit ? $disc['author'] : ''; ?>" /></td>
   </tr>
   <tr>
      <td>Category:</td>
      <td><select name="catid">
      <?php
          // list of possible categories comes from database
          $cat_array=get_categories();
          foreach ($cat_array as $thiscat) {
               echo "<option value=\"".$thiscat['catid']."\"";
               // if existing disc, put in current catgory
               if (($edit) && ($thiscat['catid'] == $disc['catid'])) {
                   echo " selected";
               }
               echo ">".$thiscat['catname']."</option>";
          }
          ?>
          </select>
        </td>
   </tr>
   <tr>
    <td>Price:</td>
    <td><input type="text" name="price"
               value="<?php echo $edit ? $disc['price'] : ''; ?>" /></td>
   </tr>
   <tr>
     <td>Producer:</td>
    <td><input type="text" name="producer"
               value="<?php echo $edit ? $disc['producer'] : ''; ?>" /></td>
    </tr>
    <tr>
     <td>Year:</td>
    <td><input type="text" name="year"
               value="<?php echo $edit ? $disc['year'] : ''; ?>" /></td>
    </tr>
<tr>
     <td>Genre:</td>
    <td><input type="text" name="genre"
               value="<?php echo $edit ? $disc['genre'] : ''; ?>" /></td>
    </tr>
    <tr>
     <td>Tracks:</td>
     <td><textarea rows="3" cols="50"
          name="description"><?php echo $edit ? $disc['tracks'] : ''; ?></textarea></td>
    </tr>

    <tr>
      <td <?php if (!$edit) { echo "colspan=2"; }?> align="center">
         <?php
            if ($edit)
             // we need the old upc to find disc in database
             // if the upc is being updated
             echo "<input type=\"hidden\" name=\"oldupc\"
                    value=\"".$disc['upc']."\" />";
         ?>
        <input type="submit"
               value="<?php echo $edit ? 'Update' : 'Add'; ?> Book" />
        </form></td>
        <?php
           if ($edit) {
             echo "<td>
                   <form method=\"post\" action=\"delete_disc.php\">
                   <input type=\"hidden\" name=\"upc\"
                    value=\"".$disc['upc']."\" />
                   <input type=\"submit\" value=\"Delete disc\"/>
                   </form></td>";
            }
          ?>
         </td>
      </tr>
  </table>
  </form>


<?php
}

function display_supplier_form($supplier = '') {

  // if passed an existing book, proceed in "edit mode"
  $edit = is_array($supplier);

  // most of the form is in plain HTML with some
  // optional PHP bits throughout
?>
  <form method="post"
        action="<?php echo $edit ? 'edit_supplier.php' : 'insert_supplier.php';?>">
  <table border="0">
  <tr>
    <td>Name:</td>
    <td><input type="text" name="name"
         value="<?php echo $edit ? $supplier['name'] : ''; ?>" /></td>
  </tr>
  <tr>
    <td>Address:</td>
    <td><input type="text" name="address"
         value="<?php echo $edit ? $supplier['address'] : ''; ?>" /></td>
  </tr>
  <tr>
    <td>City:</td>
    <td><input type="text" name="city"
         value="<?php echo $edit ? $supplier['city'] : ''; ?>" /></td>
   </tr>
    <tr>
      <td <?php if (!$edit) { echo "colspan=2"; }?> align="center">
         <?php
            if ($edit)
             // we need the old upc to find book in database
             // if the upc is being updated
             echo "<input type=\"hidden\" name=\"oldsupplier\"
                    value=\"".$supplier['upc']."\" />";
         ?>
        <input type="submit"
               value="<?php echo $edit ? 'Update' : 'Add'; ?> Supplier" />
        </form></td>
        <?php
           if ($edit) {
             echo "<td>
                   <form method=\"post\" action=\"delete_supplier.php\">
                   <input type=\"hidden\" name=\"upc\"
                    value=\"".$supplier['upc']."\" />
                   <input type=\"submit\" value=\"Delete supplier\"/>
                   </form></td>";
            }
          ?>
         </td>
      </tr>
  </table>
  </form>


<?php
}

function display_score_form($score = '') {
// This displays the score form.
// It is very similar to the category form.
// This form can be used for inserting or editing books.
// To insert, don't pass any parameters.  This will set $edit
// to false, and the form will go to insert_book.php.
// To update, pass an array containing a score.  The
// form will be displayed with the old data and point to update_book.php.
// It will also add a "Delete score" button.


  // if passed an existing score, proceed in "edit mode"
  $edit = is_array($score);

  // most of the form is in plain HTML with some
  // optional PHP bits throughout
?>
  <form method="post"
        action="<?php echo $edit ? 'edit_score.php' : 'insert_score.php';?>">
  <table border="0">
  <tr>
    <td>UPC:</td>
    <td><input type="text" name="upc"
         value="<?php echo $edit ? $score['upc'] : ''; ?>" /></td>
  </tr>
  <tr>
    <td>Composer:</td>
    <td><input type="text" name="composer"
         value="<?php echo $edit ? $score['composer'] : ''; ?>" /></td>
  </tr>
  <tr>
    <td>Title:</td>
    <td><input type="text" name="title"
         value="<?php echo $edit ? $score['title'] : ''; ?>" /></td>
   </tr>
   <tr>
      <td>Category:</td>
      <td><select name="catid">
      <?php
          // list of possible categories comes from database
          $cat_array=get_categories();
          foreach ($cat_array as $thiscat) {
               echo "<option value=\"".$thiscat['catid']."\"";
               // if existing score, put in current catgory
               if (($edit) && ($thiscat['catid'] == $score['catid'])) {
                   echo " selected";
               }
               echo ">".$thiscat['catname']."</option>";
          }
          ?>
          </select>
        </td>
   </tr>
   <tr>
    <td>Price:</td>
    <td><input type="text" name="price"
               value="<?php echo $edit ? $score['price'] : ''; ?>" /></td>
   </tr>
   <tr>
    <td>Publisher:</td>
    <td><input type="text" name="publisher"
         value="<?php echo $edit ? $score['publisher'] : ''; ?>" /></td>
   </tr>
    <tr>
      <td <?php if (!$edit) { echo "colspan=2"; }?> align="center">
         <?php
            if ($edit)
             // we need the old upc to find score in database
             // if the upc is being updated
             echo "<input type=\"hidden\" name=\"oldupc\"
                    value=\"".$score['upc']."\" />";
         ?>
        <input type="submit"
               value="<?php echo $edit ? 'Update' : 'Add'; ?> Score" />
        </form></td>
        <?php
           if ($edit) {
             echo "<td>
                   <form method=\"post\" action=\"delete_book.php\">
                   <input type=\"hidden\" name=\"upc\"
                    value=\"".$score['upc']."\" />
                   <input type=\"submit\" value=\"Delete score\"/>
                   </form></td>";
            }
          ?>
         </td>
      </tr>
  </table>
  </form>




<?php
}

function display_password_form() {
// displays html change password form
?>
   <br />
   <form action="change_password.php" method="post">
   <table width="250" cellpadding="2" cellspacing="0" bgcolor="#46bcfc">
   <tr><td>Old password:</td>
       <td><input type="password" name="old_passwd" size="16" maxlength="16" /></td>
   </tr>
   <tr><td>New password:</td>
       <td><input type="password" name="new_passwd" size="16" maxlength="16" /></td>
   </tr>
   <tr><td>Repeat new password:</td>
       <td><input type="password" name="new_passwd2" size="16" maxlength="16" /></td>
   </tr>
   <tr><td colspan=2 align="center"><input type="submit" value="Change password">
   </td></tr>
   </table>
   <br />
<?php
}

function insert_category($catname) {
// inserts a new category into the database

   $conn = db_connect();

   // check category does not already exist
   $query = "select *
             from categories
             where catname='".$catname."'";
   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   // insert new category
   $query = "insert into categories values
            ('', '".$catname."')";
   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function insert_book($upc, $author, $title, $catid, $price, $publisher, $year) {
// insert a new book into the database

   $conn = db_connect();

   // check book does not already exist
   $query = "select *
             from books
             where upc='".$upc."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   // insert new book
   $query = "insert into books values
            ('".$upc."', '".$author."', '".$title."',
             '".$catid."', '".$price."', '".$publisher."', '".$year."')";

   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function insert_disc($upc, $title, $artist, $catid, $price, $producer, $year, $genre) {
// insert a new disc into the database

   $conn = db_connect();

   // check disc does not already exist
   $query = "select *
             from discs
             where upc='".$upc."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   // insert new disc
   $query = "insert into discs values
            ('".$upc."', '".$artist."', '".$title."',
             '".$catid."', '".$price."', '".$producer."', '".$year."', '".$genre."')";

   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}


function insert_supplier($name, $address, $city) {
// insert a new book into the database

   $conn = db_connect();

   // // check book does not already exist
   // $query = "select *
   //           from supplier
   //           where name='".$name."'";

   // $result = $conn->query($query);
   // if ((!$result) || ($result->num_rows!=0)) {
   //   return false;
   // }

   // insert new supplier
   $query = "insert into supplier values
            ('".$name."', '".$address."', '".$city."')";

   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function insert_score($upc, $composer, $title, $catid, $price, $publisher) {
// insert a new score into the database

   $conn = db_connect();

   // check score does not already exist
   $query = "select *
             from scores
             where upc='".$upc."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   // insert new score
   $query = "insert into scores values
            ('".$upc."', '".$composer."', '".$title."',
             '".$catid."', '".$price."', '".$publisher."')";

   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}


function update_category($catid, $catname) {
// change the name of category with catid in the database

   $conn = db_connect();

   $query = "update categories
             set catname='".$catname."'
             where catid='".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function update_book($oldupc, $upc, $title, $author, $catid,
                     $price) {
// change details of book stored under $oldupc in
// the database to new details in arguments

   $conn = db_connect();

   $query = "update books
             set upc= '".$upc."',
             title = '".$title."',
             author = '".$author."',
             catid = '".$catid."',
             price = '".$price."',
             where upc = '".$oldupc."'";

   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function update_score($oldupc, $upc, $composer, $title, $catid,
                     $price, $publisher) {
// change details of score stored under $oldupc in
// the database to new details in arguments

   $conn = db_connect();

   $query = "update scores
             set upc= '".$upc."',
             title = '".$title."',
             composer = '".$composer."',
             catid = '".$catid."',
             price = '".$price."',
             publisher = '".$publisher."',
             where upc = '".$oldupc."'";

   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function delete_category($catid) {
// Remove the category identified by catid from the db
// If there are books in the category, it will not
// be removed and the function will return false.

   $conn = db_connect();

   // check if there are any books in category
   // to avoid deletion anomalies
   $query = "select *
             from books
             where catid='".$catid."'";

   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
     return false;
   }

   $query = "delete from categories
             where catid='".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}


function delete_book($upc) {
// Deletes the book identified by $upc from the database.

   $conn = db_connect();

   $query = "delete from books
             where upc='".$upc."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

?>
