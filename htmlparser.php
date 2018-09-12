<?php

  //get values from login
  $aggrName = "tester";
  $keywords = $_POST['keywords'];
  $type = $_POST['radAnswer'];
  $url = $_POST['enterURL'];

  $guid = "";

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

  $filestring = file_get_contents('https://www.guidgen.com/');
  $filearray = explode("\n", $filestring);

  $intg = htmlspecialchars($filearray[40]);
  $tempguid = substr($intg,217,36);
  $guidArr = explode("-",$tempguid);
  $guid = implode("",$guidArr);
  #echo $guid;
  echo "<br>";



  if ($url) {
    $path = $url;


    if ($result = $mysqli->query("INSERT INTO dagr (ID, Name, Path, FileName, Extension, Size, Category, Subcategory, Annotations, Type)
      VALUES ('$guid', '$guid', '$path','', '.url',NULL,'.url file','','','Other')")) {
        #echo "SUCCESS";

        date_default_timezone_set('America/New_York');
        $timezone = date_default_timezone_get();
        $creationTime = date('Y-m-d H:i:s');
        $deleted = 0;
        $hasComponents = 0;
        #echo $creationTime;
        $creator = "guest";

        if ($result3 = $mysqli->query("INSERT INTO dagr_metadata (DID, CreationTime, Deleted, CreatorName, HasComponents)
          VALUES ('$guid', '$creationTime','$deleted','$creator','$hasComponents')")) {
            #echo "SUCCESS2";
            echo "<br>";
            echo "URL: " . $path . "<br>";
            echo "Creation Time: " . $creationTime . "<br>";
            echo "Keywords: " . $tags['keywords'] . "<br>";
            echo "<br>";

        } else {
          echo "FAIL1";
        }

          #print_r (htmlspecialchars($html));
          $urlhtml = file_get_contents($url);
          $dom = new DOMDocument;
          $dom->loadHTML($urlhtml);
          $pictgs = $dom->getElementsByTagName('img');
          $linktgs = $dom->getElementsByTagName('a');
          #print_r(htmlspecialchars($urlhtml));


          foreach ($pictgs as $t) {
            $tt = $t->getAttribute('src');
            #echo $tt;
            echo "<br>";

            $filestring = file_get_contents('https://www.guidgen.com/');
            $filearray = explode("\n", $filestring);

            $intg = htmlspecialchars($filearray[40]);
            $tempguid = substr($intg,217,36);
            $guidArr = explode("-",$tempguid);
            $guid2 = implode("",$guidArr);

            $pos = strpos($tt,'.');


            $pos2 = strrpos($tt,'/');
            $pos2 = $pos2 + 1;
            $n = substr($tt,$pos2, $pos3);

            $pos3 = strrpos($tt,'.');
            $ext = substr($tt,$pos3);



            $cat = $ext . " file";

            if ($result2 = $mysqli->query("INSERT INTO dagr (ID, Name, Path, FileName, Extension, Size, Category, Subcategory, Annotations, Type)
              VALUES ('$guid2', '$guid2', '$tt','','$ext',NULL,'$cat','','','picture')")) {
                #echo "SUCCESS";

                date_default_timezone_set('America/New_York');
                $timezone = date_default_timezone_get();
                $creationTime = date('Y-m-d H:i:s');
                $deleted = 0;
                $hasComponents = 0;
                #echo $creationTime;
                $creator = "guest";



                if ($result3 = $mysqli->query("INSERT INTO dagr_metadata (DID, CreationTime, Deleted, CreatorName, HasComponents)
                  VALUES ('$guid2', '$creationTime','$deleted','$creator','$hasComponents')")) {
                    #echo "SUCCESS2";

                    if ($result4 = $mysqli->query("INSERT INTO components (CID, PID)
                      VALUES ('$guid2', '$guid')")) {
                        #echo "SUCCESS2";

                        echo "Image: " . $tt . "<br>";
                        echo "Extension: " . $ext . "<br>";
                        echo "Creation Time: " . $creationTime . "<br>";
                        #echo "Size: " . filesize($res) . "<br>";
                        echo "<br>";

                    } else {
                      echo "FAIL2";
                    }

                } else {
                  echo "FAIL1";
                }

            } else {
              echo "FAILURE";
            }


            #print_r($guid2);

            echo "<br>";
          }

          foreach ($linktgs as $t) {
            $tt = $t->getAttribute('href');
            #echo $tt;
            echo "<br>";

            $filestring = file_get_contents('https://www.guidgen.com/');
            $filearray = explode("\n", $filestring);

            $intg = htmlspecialchars($filearray[40]);
            $tempguid = substr($intg,217,36);
            $guidArr = explode("-",$tempguid);
            $guid2 = implode("",$guidArr);

            $pos = strpos($tt,'.');


            $pos2 = strrpos($tt,'/');
            $pos2 = $pos2 + 1;
            $n = substr($tt,$pos2, $pos3);

            $pos3 = strrpos($tt,'.');
            $ext = substr($tt,$pos3);



            $cat = $ext . " file";

            if ($result2 = $mysqli->query("INSERT INTO dagr (ID, Name, Path, FileName, Extension, Size, Category, Subcategory, Annotations, Type)
              VALUES ('$guid2', '$guid2', '$tt','','.url',NULL,'.url file','','','url')")) {
                #echo "SUCCESS";

                date_default_timezone_set('America/New_York');
                $timezone = date_default_timezone_get();
                $creationTime = date('Y-m-d H:i:s');
                $deleted = 0;
                $hasComponents = 0;
                #echo $creationTime;
                $creator = "guest";



                if ($result3 = $mysqli->query("INSERT INTO dagr_metadata (DID, CreationTime, Deleted, CreatorName, HasComponents)
                  VALUES ('$guid2', '$creationTime','$deleted','$creator','$hasComponents')")) {
                    #echo "SUCCESS2";

                    if ($result4 = $mysqli->query("INSERT INTO components (CID, PID)
                      VALUES ('$guid2', '$guid')")) {
                        #echo "SUCCESS2";

                        echo "Link: " . $tt . "<br>";
                        echo "Creation Time: " . $creationTime . "<br>";
                        #echo "Size: " . filesize($res) . "<br>";
                        echo "<br>";

                    } else {
                      echo "FAIL2";
                    }

                } else {
                  echo "FAIL1";
                }

            } else {
              echo "FAILURE";
            }


            #print_r($guid2);

            echo "<br>";
          }




          #print_r($guid2);

          echo "<br>";
          #echo fread($myfile,$_FILES['uploadfile']['size']));


        $result4->close();
        $result3->close();
        $result2->close();
        $result->close();
    } else {
      echo "FAILURE";
    }
  } else {


    $filestring = file_get_contents('https://www.guidgen.com/');
    $filearray = explode("\n", $filestring);

    $intg = htmlspecialchars($filearray[40]);
    $tempguid = substr($intg,217,36);
    $guidArr = explode("-",$tempguid);
    $guid = implode("",$guidArr);
    #echo $guid;
    #echo "<br>";

    $path = $_FILES['uploadfile']['tmp_name'];
    $type = $_FILES['uploadfile']['type'];
    $size = $_FILES['uploadfile']['size'];
    $name = $_FILES['uploadfile']['name'];
    $temp = file_get_contents($_FILES['uploadedfile']['tmp_name']); //use uploadfile not uploadedfile

    $pos3 = strrpos($tt,'.');
    $ext = substr($tt,$pos3);

    if ($result = $mysqli->query("INSERT INTO dagr (ID, Name, Path, FileName, Extension, Size, Category, Subcategory, Annotations, Type)
      VALUES ('$guid', '$guid', '$path','$name','$ext','$size','.html file','','','$type')")) {
        #echo "SUCCESS";

        date_default_timezone_set('America/New_York');
        $timezone = date_default_timezone_get();
        $creationTime = date('Y-m-d H:i:s');
        $deleted = 0;
        $hasComponents = 0;
        #echo $creationTime;
        $creator = "guest";

        if ($result3 = $mysqli->query("INSERT INTO dagr_metadata (DID, CreationTime, Deleted, CreatorName, HasComponents)
          VALUES ('$guid', '$creationTime','$deleted','$creator','$hasComponents')")) {
            #echo "SUCCESS2";

        } else {
          #echo "FAIL1";
        }

        if ($_FILES['uploadfile']['type'] == "text/html") {
          #echo $_FILES['uploadfile']['name'];
          $myfile = fopen($_FILES['uploadfile']['tmp_name'], "r");
          $html = "";

          while(!feof($myfile)) {
            #echo "#";
            $html = $html . fgets($myfile);
            #print_r (htmlspecialchars(fgets($myfile)). "<br>");
          }
          fclose($myfile);

          #print_r (htmlspecialchars($html));
          $dom = new DOMDocument;
          $dom->loadHTML($html);
          $pictgs = $dom->getElementsByTagName('img');
          $linktgs = $dom->getElementsByTagName('a');
          $tgs = array();

          $path = $_FILES['uploadfile']['tmp_name'];
          $name = $_FILES['uploadfile']['name'];
          $type = $_FILES['uploadfile']['type'];

          foreach ($pictgs as $t) {
            $tt = $t->getAttribute('src');
            #echo $t->getAttribute('href');
            echo "<br>";

            $filestring = file_get_contents('https://www.guidgen.com/');
            $filearray = explode("\n", $filestring);

            $intg = htmlspecialchars($filearray[40]);
            $tempguid = substr($intg,217,36);
            $guidArr = explode("-",$tempguid);
            $guid2 = implode("",$guidArr);

            if ($result2 = $mysqli->query("INSERT INTO dagr (ID, Name, Path, FileName, Extension, Size, Category, Subcategory, Annotations, Type)
              VALUES ('$guid2', '$guid2', '$path','$name','.html','$size','.html file', '', '', '$type')")) {
                #echo "SUCCESS";

                date_default_timezone_set('America/New_York');
                $timezone = date_default_timezone_get();
                $creationTime = date('Y-m-d H:i:s');
                $deleted = 0;
                $hasComponents = 0;
                #echo $creationTime;
                $creator = "guest";

                if ($result3 = $mysqli->query("INSERT INTO dagr_metadata (DID, CreationTime, Deleted, CreatorName, HasComponents)
                  VALUES ('$guid2', '$creationTime','$deleted','$creator','$hasComponents')")) {
                    #echo "SUCCESS2";
                    #echo $guid;
                    #echo $guid2;

                    if ($result4 = $mysqli->query("INSERT INTO components (CID, PID)
                      VALUES ('$guid2', '$guid')")) {
                        #echo "SUCCESS2";
                        echo "Image: " . $tt . "<br>";
                        echo "Extension: " . ".html" . "<br>";
                        echo "Creation Time: " . $creationTime . "<br>";
                        #echo "Size: " . filesize($res) . "<br>";
                        echo "<br>";

                    } else {
                      echo "FAIL2";
                    }

                } else {
                  echo "FAIL1";
                }

            } else {
              echo "FAILURE";
            }


            print_r($guid2);
            #print_r($t->getAttribute('src'));
            echo "<br>";
            #$t->setAttribute('src', )
          }

          foreach ($linktgs as $t) {
            $tt = $t->getAttribute('href');
            #echo $t->getAttribute('href');
            #echo "<br>";

            $filestring = file_get_contents('https://www.guidgen.com/');
            $filearray = explode("\n", $filestring);

            $intg = htmlspecialchars($filearray[40]);
            $tempguid = substr($intg,217,36);
            $guidArr = explode("-",$tempguid);
            $guid2 = implode("",$guidArr);

            if ($result2 = $mysqli->query("INSERT INTO dagr (ID, Name, Path, FileName, Extension, Size, Category, Subcategory, Annotations, Type)
              VALUES ('$guid2', '$guid2', '$path','$name','.html','$size','.html file', '', '', '$type')")) {
                #echo "SUCCESS";

                date_default_timezone_set('America/New_York');
                $timezone = date_default_timezone_get();
                $creationTime = date('Y-m-d H:i:s');
                $deleted = 0;
                $hasComponents = 0;
                #echo $creationTime;
                $creator = "guest";

                if ($result3 = $mysqli->query("INSERT INTO dagr_metadata (DID, CreationTime, Deleted, CreatorName, HasComponents)
                  VALUES ('$guid2', '$creationTime','$deleted','$creator','$hasComponents')")) {
                    #echo "SUCCESS2";
                    #echo $guid;
                    #echo $guid2;

                    if ($result4 = $mysqli->query("INSERT INTO components (CID, PID)
                      VALUES ('$guid2', '$guid')")) {
                        #echo "SUCCESS2";

                        echo "Link: " . $tt . "<br>";
                        echo "Creation Time: " . $creationTime . "<br>";
                        #echo "Size: " . filesize($res) . "<br>";
                        echo "<br>";

                    } else {
                      echo "FAIL2";
                    }

                } else {
                  echo "FAIL1";
                }

            } else {
              echo "FAILURE";
            }


            #print_r($guid2);
            #print_r($t->getAttribute('src'));
            echo "<br>";
            #$t->setAttribute('src', )
          }
          #echo fread($myfile,$_FILES['uploadfile']['size']));
        }


        $result4->close();
        $result3->close();
        $result2->close();
        $result->close();
    } else {
      echo "FAILURE";
    }
  }





  mysqli_close();

?>
