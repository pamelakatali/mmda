<html>

<?php $curr_dagr =  $_POST['radAnswer'];
$other = "-" . $curr_dagr; ?>
<body>
<form method='POST' enctype='multipart/form-data' action='shallowdeep.php'>


    <p>
      <label>Delete Type of These Children</label> <br>
      <input type="radio" name="radAnswer" value=<?php echo $curr_dagr?>>Shallow<br>
      <input type="radio" name="radAnswer" value=<?php echo $other?>>Deep<br>
    </p>

    <p>
      <input type="submit" id="btn" value="Submit">
    </p>
</form>

<body>


<?php
  #include 'deletep.php';
  //get values from login
  #$aggrName = $_POST['agName'];

  $aggrName = $_POST['radAnswer'];
  $check = strstr($aggrName,"-");
  #print_r ($_POST);


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



  if ($result = $mysqli->query("SELECT * FROM dagr WHERE FileName = '$aggrName' ")) {
      //$row = $result->fetch_row();
      #echo $aggrName;
      $numToDel = $result->num_rows;
      date_default_timezone_set('America/New_York');
      $timezone = date_default_timezone_get();

      for ($i = 0; $i < $numToDel; $i++) {

        $deletionTime = date('Y-m-d H:i:s');

        $row = $result->fetch_row();
        $tempID = $row[0];
        #print_r ($tempID);
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
        if ($result4 = $mysqli->query("SELECT * FROM components
        WHERE PID = '$tempID'")) {
            echo "CHILDREN";
            echo "<br>";
            echo "<br>";

            while($row2 = $result4->fetch_row()) {
              echo "ID: " . $row2[0];
              echo "<br>";
            }
            $result4->close();
        }

      }

      #print_r ($result);
      //echo "SUCCESS";
      //$result3->close();

      $result2->close();

      $result->close();


  } else {
    echo "FAILURE";
  }


  mysqli_close();

?>

</html>
