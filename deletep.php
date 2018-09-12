<html>

<?php $curr_dagr =  $_POST['agName'];
#echo $curr_dagr;
$other = "-" . $curr_dagr;?>
<body>
<form method='POST' enctype='multipart/form-data' action='deleteparents.php'>


    <p>
      <label>Parents</label> <br>

      <input type="radio" name="radAnswer" value=<?php echo $curr_dagr?>>Continue<br>
    </p>

    <p>
      <input type="submit" id="btn" value="Submit">
    </p>
</form>

<body>

<?php

  //get values from login
  $aggrName = $_POST['agName'];


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

    $result->close();
  }


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
        echo "<br>";

        if ($result5 = $mysqli->query("SELECT PID FROM components
        WHERE CID = '$tempID'")) {
            echo "PARENTS";
              echo "<br>";


            while($row3 = $result5->fetch_row()) {

              if ($result6 = $mysqli->query("SELECT FileName FROM dagr
                WHERE ID = '$row3[0]'")) {


                  $row6 = $result6->fetch_row();
                  echo "<br>";
                  echo "Name: " . $row6[0];
                  echo "<br>";
                  echo "ID: " . $row3[0];
                  echo "<br>";
                }

            }
            $result5->close();
        }


      }

      #print_r ($result);

      $result2->close();
      $result->close();


  } else {
    echo "FAILURE";
  }


  mysqli_close();

?>


</html>
