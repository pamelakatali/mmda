<?php

  //connect to server
  $mysqli = new mysqli("localhost", "root", "root");

  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
//choose database
  $mysqli->select_db("test_login");

 if ($result = $mysqli->query("SELECT DATABASE()")) {
    $row = $result->fetch_row();
    #printf("Default database is %s.\n", $row[0]);

    $result->close();
  }

  echo "STERILE";
  echo "<br>";

  if ($result2 = $mysqli->query("SELECT ID FROM dagr WHERE ID NOT IN (SELECT CID FROM components)" )) {

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
