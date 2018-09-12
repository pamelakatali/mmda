<!-- This file executes a time range query and displays it's output.
Written by Garrett Fitzgerald. -->

<?php

    // connect to mysql
    $mysqli = new mysqli("localhost", "root", "root");

    if (mysqli_connect_errno()) {
        printf("time-range-query.php: Connection attempt FAILED: %s\n", mysqli_connect_error());
        exit();
    }

  $mysqli->select_db("mmda");

  if ($result = $mysqli->query("SELECT DATABASE()")) {
     $row = $result->fetch_row();
     #printf("Default database is %s.\n", $row[0]);

     $result->close();
   }


   $start = $_POST['start'];
   $end = $_POST['end'];

   #echo $end;


   if ($result = $mysqli->query("SELECT DID, CreationTime FROM dagr_metadata
     WHERE CreationTime > '$start' AND CreationTime < '$end'")) {
       while ($row2 = $result->fetch_row()) {
           echo "ID: " . $row2[0];
           echo "<br>";
           echo "Time: ". $row2[1];
           echo "<br>";
          echo "<br>";
       }
   } else {
     echo "FAIL";
   }
   $result->close();
?>
