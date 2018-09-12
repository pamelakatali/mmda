<?php

  //get values from login
  $aggrName = $_POST['agName'];
//
  $keywords = $_POST['keywords'];
  //
  $type = $_POST['radAnswer'];



  $filestring = file_get_contents('https://www.guidgen.com/');
  $filearray = explode("\n", $filestring);

  $name = $_POST['name'];
  $extension = $_POST['extension'];
  $filename = $_POST['filename'];
  $anno = $_POST['anno'];
  #echo $anno;

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

    $result->close();
  }


$dot = substr($extension, 0, 1);
if ($dot == ".") {
  $extension = substr($extension, 1);
}

if (($result2 = $mysqli->query("SELECT * FROM dagr WHERE extension LIKE '%$extension%'")) && $anno == "" && $extension != "" && $filename == "" && $name == "") {
    $curr_row = $result2->fetch_row();
    #print_r($curr_row);
    $i = 0;
    $dagrs = array();
    while ($curr_row != NULL) {
      $dagrs[$i] = $curr_row;
      $curr_row = $result2->fetch_row();
      $i = $i + 1;
    }

    // echo "SUCCESS";

    $_SESSION['dagrs'] = $dagrs;
    $result2->close();
  } else if (($result2 = $mysqli->query("SELECT * FROM dagr WHERE extension LIKE '%$extension%' and filename LIKE '%$filename%'")) && $anno == "" && $extension != "" && $filename != "" && $name == "") {
    $curr_row = $result2->fetch_row();
  //  echo "PRINTING";
    // print_r($curr_row);
    $i = 0;
    $dagrs = array();
    while ($curr_row != NULL) {
      $dagrs[$i] = $curr_row;
      $curr_row = $result2->fetch_row();
      $i = $i + 1;
    }

    $_SESSION['dagrs'] = $dagrs;
    $result2->close();

    echo "SUCCESS HERE";
  }else if (($result2 = $mysqli->query("SELECT * FROM dagr WHERE name LIKE '%$name%'")) && $extension == "" && $filename == "" && $name != "" && $anno == "") {
    $curr_row = $result2->fetch_row();
    //  echo "PRINTING";
      // print_r($curr_row);
      $i = 0;
      $dagrs = array();
      while ($curr_row != NULL) {
        $dagrs[$i] = $curr_row;
        $curr_row = $result2->fetch_row();
        $i = $i + 1;
      }

      $_SESSION['dagrs'] = $dagrs;
      $result2->close();

      echo "SUCCESS HERE";
  }else if (($result2 = $mysqli->query("SELECT * FROM dagr WHERE annotations LIKE '%$anno%'")) && $extension == "" && $filename == "" && $name == "" && $anno != "") {
    $curr_row = $result2->fetch_row();
    //  echo "PRINTING";
      // print_r($curr_row);
      $i = 0;
      $dagrs = array();
      while ($curr_row != NULL) {
        $dagrs[$i] = $curr_row;
        $curr_row = $result2->fetch_row();
        $i = $i + 1;
      }

      $_SESSION['dagrs'] = $dagrs;
      $result2->close();

      echo "SUCCESS HERE ANNOOO";
  } else if (($result2 = $mysqli->query("SELECT * FROM dagr WHERE name LIKE '%$name%' and extension LIKE '%$extension%' and filename LIKE '%$filename%' and annotations LIKE '%$anno%'"))) {
    $curr_row = $result2->fetch_row();
    //  echo "PRINTING";
      // print_r($curr_row);
      $i = 0;
      $dagrs = array();
      while ($curr_row != NULL) {
        $dagrs[$i] = $curr_row;
        $curr_row = $result2->fetch_row();
        $i = $i + 1;
      }

      $_SESSION['dagrs'] = $dagrs;
      $result2->close();

      echo "SUCCESS HERE";
  }else{
    printf("fail");
  }

  mysqli_close();

?>

<!DOCTYPE html>
<html>
<head>
  <title>Results</title>
</head>
<body>

<h1>Results</h1>
<table style="width:100%">
<tr>
<th>Name</th>
<th>Filename</th>
<th>Extension</th>
<th>Annotations</th>
</tr>

<?php

$dagrs = $_SESSION['dagrs'];

$j = 0;
foreach ($dagrs as $dagr) {
  echo "<tr>";
  foreach($dagr as $attribute) {

    if ($j == 1 || $j == 3 || $j == 4 || $j == 8) {
      echo "<td>{$attribute}</td>";
    }

    $j = $j + 1;

  }
  echo "</tr>";

  $j = 0;
}
// echo "<tr>";
// echo "<td>Name</td>";
// echo "<td>Filename</td>";
// echo "<td>Extension</td>";
// echo "</tr>";
?>
</table>
</body>
</html>
