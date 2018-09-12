<?php
    $name = $_POST["cName"];

    //echo $name;

//connect to server
  $mysqli = new mysqli("localhost", "root", "root");

    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }
  //choose database
  $mysqli->select_db("mmda");

  if($result = $mysqli->query("INSERT INTO categories (Name) VALUES ('$name')")) {
      echo "The " . $name . " category has been created!";
  } else {
      echo "FAILURE!";
  }
?>
