<?php

  $dir = $_POST['startfilepath'];
  $guid = "";
  $tempv = "";
  $guidarray = array();
  $namearray = array();
  $patharray = array();
  $catarray = array();
  $subcatarray = array();
  $temp = array();



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
    printf("Default database is %s.\n", $row[0]);
    echo "<br>";

    $result->close();
  }

  $files = scandir($dir);

  function navDirs($tempDir2, $garray, $darray, $namearray, $patharray, $newparent) {
    $guid = "";
    $temp = array();
    global $mysqli;

    $k = 0;
    $counter = 0;
    $fileArr = scandir($tempDir2);

    #$namearray = array_push($namearray,$tempDir2);
    #$patharray = array_push($patharray,$tempDir2);

    #array_push($namearray,$tempDir2);
    #array_push($patharray,$tempDir2);

    array_push($darray,$guid);


    while (list($k, $v) = each($fileArr)) {
      ++$k;
      $isfile = substr($v,0,1);

      if ($isfile != ".") {
        ++$counter;
        $res =  $tempDir2 . "/" ;
        $res = $res . $v;

        $tempv = $v;
        $pos = strpos($v,'.');



        if (!in_array($v,$namearray)){
          array_push($namearray,$v);
        }

        if (!in_array($res,$patharray)){
          array_push($patharray,$res);
        }
        /*
        echo "<br>";
        echo $res;
        echo "<br>";
        echo $guid;
        echo "<br>";
        echo $v;
        echo "<br>";
        echo $v;
        echo "<br>";
        */

        $filestring = file_get_contents('https://www.guidgen.com/');
        $filearray = explode("\n", $filestring);

        $intg = htmlspecialchars($filearray[40]);
        $tempguid = substr($intg,217,36);
        $guidArr = explode("-",$tempguid);
        $guid = implode("",$guidArr);
        array_push($temp,$guid);

        $pos = strpos($v,'.');
        $ext = substr($v,$pos);

        $cat = $ext . " file";
        $s = filesize($res);

        if ($result = $mysqli->query("INSERT INTO dagr (ID, Name, Path, FileName, Extension, Size, Category, Subcategory, Annotations, Type)
          VALUES ('$guid', '$guid', '$res','$v','$ext','$s','$cat','$res','$res','$res')")) {
            #echo "SUCCESS";
            #echo "<br>";

            if ($result2 = $mysqli->query("INSERT INTO components (CID, PID)
              VALUES ('$guid', '$newparent')")) {
                #echo "SUCCESS2";
                #echo "<br>";

            } else {
              #echo "FAILURE2";
              #echo "<br>";
            }

            date_default_timezone_set('America/New_York');
            $timezone = date_default_timezone_get();
            $creationTime = date('Y-m-d H:i:s');
            $deleted = 0;
            $hasComponents = 0;
            $creator = "guest";

            if ($result3 = $mysqli->query("INSERT INTO dagr_metadata (DID, CreationTime, Deleted, CreatorName, HasComponents)
              VALUES ('$guid', '$creationTime','$deleted','$creator','$hasComponents')")) {
                #echo "SUCCESS";
                echo "File Name: " . $v . "<br>";
                echo "Path: " . $res . "<br>";
                echo "Creation Time: " . $creationTime . "<br>";
                echo "Size: " . filesize($res) . "<br>";
                echo "<br>";

            } else {
              #echo "FAIL";
            }

        } else {
          /*
          echo "FAILURE";
          echo "<br>";
          */
        }

        #$result->close();

        $newNav = navDirs($res,$garray,$darray, $namearray, $patharray, $guid);

        $darray = $newNav[0];
        $namearray = $newNav[1];
        $patharray = $newNav[2];


      }

    }


    $type = "test";
    $keywords = "test";

    return array($darray,$namearray,$patharray);

  }

  $pos = strrpos($dir,'/');
  $firstname = substr($dir,$pos);
  echo "<br>";

  array_push($namearray, $firstname);
  array_push($patharray, $dir);

  $filestring = file_get_contents('https://www.guidgen.com/');
  $filearray = explode("\n", $filestring);

  $intg = htmlspecialchars($filearray[40]);
  $tempguid = substr($intg,217,36);
  $guidArr = explode("-",$tempguid);
  $guid = implode("",$guidArr);

  $s = filesize($dir);

  if ($result = $mysqli->query("INSERT INTO dagr (ID, Name, Path, FileName, Extension, Size, Category, Subcategory, Annotations, Type)
    VALUES ('$guid', '$guid', '$dir','$firstname','$ext', '$s', NULL, NULL, NULL,'Other')")) {
      #echo "SUCCESS";
      #echo "<br>";

      date_default_timezone_set('America/New_York');
      $timezone = date_default_timezone_get();
      $creationTime = date('Y-m-d H:i:s');
      $deleted = 0;
      $hasComponents = 0;
      $creator = "guest";

      if ($result3 = $mysqli->query("INSERT INTO dagr_metadata (DID, CreationTime, Deleted, CreatorName, HasComponents)
        VALUES ('$guid', '$creationTime','$deleted','$creator','$hasComponents')")) {
          echo "File Name: " . $firstname . "<br>";
          echo "Path: " . $dir . "<br>";
          echo "Creation Time: " . $creationTime . "<br>";
          echo "Size: " . filesize($dir) . "<br>";
          echo "<br>";
      } else {
        #echo "FAIL";
      }

  } else {
    /*
    echo "FAILURE";
    echo "<br>";
    */
  }

  $parent = "-1";
  $bulkfiles = navDirs($dir,$filearray, $guidarray, $namearray, $patharray, $guid);
  $guidarray = $bulkfiles[0];
  $namearray = $bulkfiles[1];
  $patharray = $bulkfiles[2];
  /*
  echo "<br>";
  echo "<br>";
  print_r($guidarray);
  echo "<br>";
  echo "<br>";
  print_r($namearray);
  echo "<br>";
  echo "<br>";
  print_r($patharray);
  echo "<br>";
  echo "<br>";
  */
  $length = count($guidarray);


  $result->close();


  mysqli_close();

?>
