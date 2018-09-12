<?php
//connect to server
$mysqli = new mysqli("localhost", "root", "root");

  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
//choose database
  $mysqli->select_db("mmda");
if($relation = $mysqli->query("SELECT name FROM categories")) {
$curr_row = $relation->fetch_row();
$categories = array();
$i = 0;
while ($curr_row != NULL) {
  $category = $curr_row[0];
  $categories[$i] = $category;
  $curr_row = $relation->fetch_row();
  $i = $i + 1;
}
}

$_SESSION['categories'] = $categories;
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Create a category!</title>
    </head>

    <h2>Create a new category</h2>
    <form method='POST' enctype='multipart/form-data' action='category.php'>
        <p>
          <label>Category Name:</label>
          <input type="text" id="cName" name="cName">
        </p>
        <p>
                <input type="submit" id="btn" value="Submit" />
        </p>
      </form>

      <h2>or</h2>
      <br>
      <h2>Create a new subcategory</h2>

    <form method='POST' enctype='multipart/form-data' action='subcategory.php'>
        <label>Category</label>
        <select name="selectedCategory">
        <?php

    $categories = $_SESSION['categories'];

    foreach ($categories as $category) {
      echo "<option value='{$category}'>{$category}</option>";
    }
       ?>

        <select>
            <br><br>
        <label>Subcategory</label>
        <input type="text" id="sName" name="sName">

        <p>
            <input type="submit" id="btn" value="Submit" />
        </p>
    </form>
</html>
