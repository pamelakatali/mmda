<?php
  #include 'deletep.php';
  //get values from login
  #$aggrName = $_POST['agName'];
  $aggrName = $_POST['radAnswer'];
  #print_r ($_POST);
  $ans = $_POST['radAnswer'];
  $check = strstr($ans,"-");


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


  function deepDelete ($start, $deepChild) {
    #echo $start;
    global $mysqli;

    if ($result4 = $mysqli->query("SELECT * FROM components
    WHERE PID = '$start'")) {
        #echo "<br>";
        #echo "CHILDREN";
        #echo "<br>";

        while($row2 = $result4->fetch_row()) {
          /*
          if ($result6 = $mysqli->query("DELETE FROM dagr
          WHERE ID = '$row2[0]'")) {
            #echo "sucess";
          } else {
            echo "failed";
          }

          */
          #echo $row2[0];
          array_push($deepChild, $row2[0]);
          #echo "      ";
          #echo "<br>";
          $deepChild = deepDelete($row2[0], $deepChild);

        }

    }

    #echo "<br>";
    return $deepChild;
  }


if (!$check) {
  if ($result = $mysqli->query("SELECT * FROM dagr WHERE FileName = '$aggrName' ")) {
      //$row = $result->fetch_row();
      $numToDel = $result->num_rows;
      date_default_timezone_set('America/New_York');
      $timezone = date_default_timezone_get();

      for ($i = 0; $i < $numToDel; $i++) {

        $deletionTime = date('Y-m-d H:i:s');

        $row = $result->fetch_row();
        $tempID = $row[0];
        #print_r ($tempID);
        echo "Shallow Deletion";
        echo "<br>";
        echo "<br>";
        /*
        if ($result5 = $mysqli->query("SELECT PID FROM components
        WHERE CID = '$tempID'")) {
            echo "PARENTS";

            while($row3 = $result5->fetch_row()) {
              echo $row3[0];
              echo "<br>";
            }
            $result5->close();
        }
        */

        //shallow deletion of children
        if ($result4 = $mysqli->query("SELECT * FROM components
        WHERE PID = '$tempID'")) {

            while($row2 = $result4->fetch_row()) {
              date_default_timezone_set('America/New_York');
              $timezone = date_default_timezone_get();
              $creationTime = date('Y-m-d H:i:s');

              if ($result6 = $mysqli->query("DELETE FROM dagr
              WHERE ID = '$row2[0]'")) {
                if ($result7 = $mysqli->query("INSERT INTO deleted_dagrs (DID, DeletionTime)
                VALUES ('$row2[0]', '$creationTime')")) {
                  echo "<br>";
                }
                #echo "sucess";
                echo "ID: " . $row2[0];
                echo "<br>";
              } else {
                echo "failed";
              }

              #echo $row2[0];
              echo "<br>";
            }

        }

      }



      #print_r ($result);
      //echo "SUCCESS";
      //$result3->close();
      $result4->close();
      $result2->close();

      $result->close();


  } else {
    echo "FAILURE";
  }
} else {
  $aggrName = substr($check,1);
  $allChilds = array();
  $allChilds = deepDelete($aggrName, $allChilds);

  echo "Deep Deletion";
  echo "<br>";
  #echo $aggrName;
  echo "<br>";

  for ($i = 0; $i < count($allChilds); $i++) {
    date_default_timezone_set('America/New_York');
    $timezone = date_default_timezone_get();
    $creationTime = date('Y-m-d H:i:s');


    if ($result6 = $mysqli->query("DELETE FROM dagr
    WHERE ID = '$allChilds[$i]'")) {
      echo "ID: ". $allChilds[$i];
      if ($result7 = $mysqli->query("INSERT INTO deleted_dagrs (DID, DeletionTime)
      VALUES ('$allChilds[$i]', '$creationTime')")) {
        echo "<br>";
      }
    } else {
      echo "failed";
    }
  }

  if ($result6 = $mysqli->query("DELETE FROM dagr
  WHERE ID = '$aggrName'")) {
    echo "ID: ". $aggrName;
    if ($result7 = $mysqli->query("INSERT INTO deleted_dagrs (DID, DeletionTime)
    VALUES ('$aggrName', '$creationTime')")) {
      echo "<br>";
    }
  } else {
    echo "failed";
  }


}



  mysqli_close();

?>
