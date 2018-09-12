<?php
    //connect to server
    $mysqli = new mysqli("localhost", "root", "root");

      if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
      }
   //  //choose database
      $mysqli->select_db("mmda");
  if($relation = $mysqli->query("SELECT id, name FROM categories")) {
    $curr_row = $relation->fetch_row();
    $categories = array();
    while ($curr_row != NULL) {
      $category = $curr_row[1];
      $categories[$curr_row[0]] = $category;
      $curr_row = $relation->fetch_row();
    }



    $map = array();
    foreach ($categories as $id => $category) {
      $relation = $mysqli->query("SELECT name FROM subcategories WHERE cid='{$id}'");
      $curr_row = $relation->fetch_row();
      $subcategories = array();
      $i = 0;
      while ($curr_row != NULL) {
        $subcategories[$i] = $curr_row[0];
        $curr_row = $relation->fetch_row();
        $i = $i + 1;
      }

      $map[$category] = $subcategories;
    }

    printf("<br><br>");
    #print_r($map);
    printf("<br><br>");



  }
  $_SESSION['map'] = $map;
  $_SESSION['categories'] = $categories;
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <title>DB Website</title>
  </head>

  <body>
<h1>Create a new DAGR</h1>
<form method='POST' enctype='multipart/form-data' action='uploadfile.php'>
  <p>
    <label>DAGR Name:</label>
    <input type="text" id="agName" name="agName">
  </p>
  <p>
    <label>Category</label>

    <select id="categories">
    <?php

    $categories = $_SESSION['categories'];

    foreach ($categories as $category) {
      echo "<option value='{$category}'>{$category}</option>";
    }



      //  if ($relation = $mysqli->query("SELECT name FROM categories") {
      //    $curr_row = $relation->fetch_row();
      //    while($curr_row != NULL) {
      //      $category = $curr_row[0];
      //      echo "<option value='{$category}'>{$category}</option>"
      //      $curr_row = $relation->fetch_row();
      //    }
      //  }


       ?>

       </select>

  </p>
  <p>
  <p>
    <label>Subcategories</label>
    <select id="subcategories">

    </select>
  </p>
  <p>
    <label>Annotations (seperate by commas)</label>
    <input type="text" id="annotations" name="annotations">
  </p>
  <p>
      <p>File to upload: <input type= "file" name="uploadfile" onSubmit="getPath();"></p>
<!--
      <input type="submit" id="btn" value="Submit">
    -->
  </p>
<!--
  <p>
    <lable>Password:</lable>
    <input type="text" id="pass" name = "pass">
  </p>
-->
Input Type
  <p>
    <input type="radio" name="radAnswer" value="picture">Picture<br>
    <input type="radio" name="radAnswer" value="video">Video<br>
    <input type="radio" name="radAnswer" value="text">Text<br>
    <input type="radio" name="radAnswer" value="html">HTML<br>
    <input type="radio" name="radAnswer" value="other">Other<br>
  </p>
  <p>
    <input type="submit" id="btn" value="Submit">
  </p>
<!--
  <input type="submit">
  Picture<input name="Picture" type="radio">
  Text File<input name="TextFile" type="radio">
-->
</form>
<script>
         var s = document.getElementById("categories");
         var selected = s.options[s.selectedIndex].text;

         var map = <?php echo json_encode($map) ?>;


         console.log('Map: ' + map[selected]);

         function pop_sub() {
           var sub = document.getElementById("subcategories");
           map[selected].forEach(function(element) {
             var opt = document.createElement('option');
             opt.value = element;
             opt.innerHTML = element;
             sub.appendChild(opt);
           });
         }

         function remove_sub() {
           var sub = document.getElementById("subcategories");
           while (sub.firstChild) {
             sub.removeChild(sub.firstChild);
           }


         }

        pop_sub();
         s.addEventListener("change", function() {
           selected = s.options[s.selectedIndex].text;
           console.log('About to remove');
           remove_sub();
           console.log('About to pop');
           pop_sub();

          // console.log('Number: ' + number);
         });

       </script>
  </body>

</html>
