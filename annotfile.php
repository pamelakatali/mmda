<?php

  //get values from login
  $aggrName = $_POST['agName'];
  $keywords = $_POST['keywords'];
  $type = $_POST['radAnswer'];


  $filestring = file_get_contents('https://www.guidgen.com/');
  $filearray = explode("\n", $filestring);

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

    //insert into database

  }
  $temp = file_get_contents($_FILES['uploadedfile']['tmp_name']);



  if ($result = $mysqli->query("UPDATE dagr SET Annotations='$keywords'
  WHERE FileName = '$aggrName'")) {
    echo "File Name: " . $aggrName . "<br>";
    echo "Annotations: " . $keywords . "<br>";
    #echo "Creation Time: " . $creationTime . "<br>";
    echo "<br>";


      #echo $temp;

      $result->close();
  } else {
    echo "FAILURE";
  }
}

  mysqli_close();

?>
