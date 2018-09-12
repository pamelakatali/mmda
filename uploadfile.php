<?php

  // get values from login
  $aggrName = $_POST['agName'];
  $category = $_POST['category'];
  $type = $_POST['radAnswer'];

  $filestring = file_get_contents('https://www.guidgen.com/');
  $filearray = explode("\n", $filestring);
  $anno = $_POST['annotations'];

  // connect to server
  $mysqli = new mysqli("localhost", "root", "root");

  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
// choose database
  $mysqli->select_db("mmda");

 if ($result = $mysqli->query("SELECT DATABASE()")) {
    $row = $result->fetch_row();
    #printf("Default database is %s.\n", $row[0]);

    $result->close();
  }

if(isset($_POST['uploadfile'])) {
} else {

  // get filename and extension -GF
  $filename = $_FILES['uploadfile']['name'];

  $filenameArray = explode(".", $filename);
  $extension = $filenameArray[1];
  $filename = $filenameArray[0];


  $path = $_FILES['uploadfile']['tmp_name'];

  // getting size -GF
  $size = filesize($_FILES['uploadfile']['tmp_name']);

  while (list($var, $val) = each($filearray)) {
    ++$var;
    if ($var == 41) {
      $val = trim($val);
      $guidArr = explode("-",$val);
      $tg = "";
      while (list($k, $v) = each($guidArr)) {
        ++$k;
        $k = trim($k);
        $tg = $tg . $v;
      }

      $intg = htmlspecialchars($tg);
      $guid = substr($intg,211,32);
      #printf($guid);
    }

    // insert into database

  }
  $temp = file_get_contents($_FILES['uploadedfile']['tmp_name']);

  // Check for duplicates! -GF
  if ($relation = $mysqli->query("SELECT id FROM dagr WHERE filename = '$filename' and size = '$size' and extension = '$extension'")) {
    $curr_row = $relation->fetch_row();
    if ($curr_row != NULL) {
      echo "Duplicate content identified. Your DAGR was not created. \nYour content can be refrenced and materialized from DAGR# ". $curr_row[0];
      exit();
    }
  } else {
    echo "FAILURE!";
  }


  if ($result = $mysqli->query("INSERT INTO dagr (ID, Name, Path, FileName, Extension, Size, Category, Subcategory, Annotations, Type)
    VALUES ('$guid', '$aggrName', '$path', '$filename', '$extension', '$size', '$type','$keywords', '$anno', '$type')")) {
      echo "SUCCESS";
      printf($path);
      date_default_timezone_set('America/New_York');
      $timezone = date_default_timezone_get();
      $creationTime = date('Y-m-d H:i:s');
      $deleted = 0;
      $hasComponents = 0;
      echo $creationTime;
      $creator = "guest";
      // metadata stuff
      // DID = PID = guid


      if ($result2 = $mysqli->query("INSERT INTO dagr_metadata (DID, CreationTime, Deleted, CreatorName, HasComponents)
        VALUES ('$guid', '$creationTime','$deleted','$creator','$hasComponents')")) {


          echo "SUCCESS2";
          $result2->close();
        }

      #echo $temp;

      $result->close();
  } else {
    echo "FAILURE";
  }
}

  mysqli_close();

?>
