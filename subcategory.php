<?php
   $selectedCategory = $_POST['selectedCategory'];
   $name = $_POST['sName'];
   //connect to server
  $mysqli = new mysqli("localhost", "root", "root");

    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }

    $mysqli->select_db("mmda");
    if ($relation = $mysqli->query("SELECT id FROM categories WHERE name='{$selectedCategory}'")) {
        $curr_row = $relation->fetch_row();
        #echo "Id: " . $curr_row[0];

        $cid = $curr_row[0];
        if($result = $mysqli->query("INSERT INTO subcategories (Name, CID) VALUES ('$name', '$cid')")) {
                  echo "The " . $name . " subcategory of " . $selectedCategory . " has been created!";
              }
    } else {
        echo "FAILURE!";
    }
//   //choose database
//   $mysqli->select_db("test_login");

//   if($result = $mysqli->query("INSERT INTO subcategories (Name) VALUES ('$name')")) {
//       echo "The " . $ . " category has been created!";
//   } else {
//       echo "FAILURE!";
//   }

?>
