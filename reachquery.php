<?php

  //get values from login
  $aggrName = $_POST['agName'];
  $levels = $_POST['levels'];
  $type = $_POST['radAnswer'];
  $daughters = array();
  $counter = 0;


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



  if ($type == "down") {
    echo "DOWN";
    echo "<br>";
    if ($result2 = $mysqli->query("SELECT ID FROM dagr
      WHERE FileName = '$aggrName'")) {
        #echo "SUCCESS";
        #$counter = $result2->num_rows;
        #$row = $result2->fetch_row();

        #array_push($daughters, $row[0]);
        #echo $tempID;

        #print_r ($levels);

        while ($row = $result2->fetch_row()) {
          array_push($daughters, $row[0]);
          $tempID = $row[0];
          $end = count($daughters);
          $start = 0;
          for ($i = 0; $i < $levels; $i++) { //depth

            for ($j = $start; $j < $end; $j++) { //goes through all dagrs returned at prev level and gets their daughters.
              $tempID = $daughters[$j];
              if ($result3 = $mysqli->query("SELECT CID FROM components WHERE PID = '$tempID'")) {
                  #$counter = $result3->num_rows;

                  while ($row2 = $result3->fetch_row()) {
                    array_push($daughters, $row2[0]);
                    echo "ID:" . $row2[0];
                    echo "<br>";
                  }
                  #$tempID2 = $row2[0];
                  #array_push($retArray, $row2[0]);
                  #echo $row2[0];
              } else {
                echo "FAIL";
              }
            }

            $start = $end;
            $end = count($daughters);

          }
        }


        #print_r($daughters);
        $result3->close();
        $result2->close();
        $result->close();
    } else {
      echo "FAILURE";
    }
  } else {
    echo "UP";
    echo "<br>";
    if ($result2 = $mysqli->query("SELECT ID FROM dagr
      WHERE FileName = '$aggrName'")) {
        #echo "SUCCESS";
        #$counter = $result2->num_rows;
        #$row = $result2->fetch_row();

        #array_push($daughters, $row[0]);
        #echo $tempID;

        #print_r ($levels);

        while ($row = $result2->fetch_row()) {
          array_push($daughters, $row[0]);
          $tempID = $row[0];
          $end = count($daughters);
          $start = 0;
          for ($i = 0; $i < $levels; $i++) { //depth

            for ($j = $start; $j < $end; $j++) { //goes through all dagrs returned at prev level and gets their daughters.
              $tempID = $daughters[$j];
              if ($result3 = $mysqli->query("SELECT PID FROM components WHERE CID = '$tempID'")) {
                  #$counter = $result3->num_rows;

                  while ($row2 = $result3->fetch_row()) {
                    array_push($daughters, $row2[0]);
                    echo "ID:" . $row2[0];
                    echo "<br>";
                  }
                  #$tempID2 = $row2[0];
                  #array_push($retArray, $row2[0]);
                  #echo $row2[0];
              } else {
                echo "FAIL";
              }
            }

            $start = $end;
            $end = count($daughters);

          }
        }
        #print_r($daughters);
        $result3->close();
        $result2->close();
        $result->close();
    } else {
      echo "FAILURE";
    }
  }




  mysqli_close();

?>
