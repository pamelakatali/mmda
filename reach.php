<!DOCTYPE html>
<html lang="en">

  <head>
    <title>DB Website</title>
  </head>

  <body>

<form method='POST' enctype='multipart/form-data' action='reachquery.php'>
  <p>
    <lable>Aggregate Name:</lable>
    <input type="text" id="agName" name="agName">
  </p>
    <p>
    <lable>Levels:</lable>
    <input type="number" id="levels" name="levels" min="1">
  </p>

Input Type
  <p>
    <input type="radio" name="radAnswer" value="up">Up<br>
    <input type="radio" name="radAnswer" value="down">Down<br>
  </p>
  <p>
    <input type="submit" id="btn" value="Submit">
  </p>

</form>

  </body>

</html>
