<!DOCTYPE html>
<html lang="en">

  <head>
    <title>DB Website</title>
  </head>

  <body>

<form method='POST' enctype='multipart/form-data' action='searchDB.php'>

<h1>Query Search</h1>
  <p>
    <label>Name:</label>
    <input type="text" id="name" name="name">
  </p>

  <p>
    <label>File Name:</label>
    <input type="text" id="filename" name="filename">
  </p>

  <p>
    <label>Extension:</label>
    <input type="text" id="extensions" name="extension">
  </p>

  <p>
    <label>Annotation:</label>
    <input type="text" id="anno" name="anno" />
  </p>

  <p>
    <input type="submit" id="btn" value="Submit">
  </p>

</form>

  </body>

</html>
