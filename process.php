<?php
include('simple_html_dom.php');

  //get values from login
  $aggrName = $_POST['agName'];
  $keywords = $_POST['keywords'];
  $type = $_POST['radAnswer'];

  $origfilePath = realpath($_FILES["UploadFileName"]["name"]);
  $tempfilePath = realpath($_FILES["UploadFileName"]["tmp_name"]);
  $target_path = "uploads/";
  $target_path = $target_path . basename( $_FILES['UploadedFileName']['name']);
  #$handle = fopen($_FILES["UploadFileName"]["tmp_name"], 'r');
  #$dir = dirname(__FILE__);
  #$target='uploads/'.basename($_FILES['UploadFileName']['name']);

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

//generate guid



/*
 if ($result = $mysqli->query("SELECT * FROM users")) {
    $row = $result->fetch_row();
    printf("Index: %s.\n", $row[0]);
    printf("Username: %s.\n", $row[1]);
    printf("Password: %s.\n", $row[2]);
    $result->close();
  }
*/

  if ($result = $mysqli->query("INSERT INTO users (id, username, password)
    VALUES (3, '$aggrName', '$keywords')")) {

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

    }
    $result->close();
  } else {
    #printf("username %s", $filePath);
    printf("fail");
  }



  mysqli_close();

?>
