<?php

  //connect to server
  $mysqli = new mysqli("localhost", "root", "root");

  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
//choose database
  $mysqli->select_db("mmda");

 if ($result = $mysqli->query("SELECT DATABASE()")) {
    $row = $result->fetch_row();
    #printf("Default database is %s.\n", $row[0]);

    $result->close();
  }
  echo "ORPHANS";
  echo "<br>";
  if ($result2 = $mysqli->query("SELECT CID FROM components WHERE PID NOT IN (SELECT ID FROM dagr)" )) {

      #$row = $result2->fetch_row();
      while($row = $result2->fetch_row()) {
        echo "ID: " . $row[0];
        echo "<br>";
      }

      $result2->close();
  } else {
    echo "FAILURE";
  }


  mysqli_close();

?>
