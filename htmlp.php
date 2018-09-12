<!DOCTYPE html>
<html lang="en">

  <head>
    <title>DB Website</title>
  </head>

  <body>

<form method='POST' enctype='multipart/form-data' action='htmlparser.php'>

  <p>
      <p>Html file to upload: <input type= "file" name="uploadfile" onSubmit="getPath();"></p>
  </p>
  OR
  <p>
      <p>Html file to upload: <input type= "url" name="enterURL" onSubmit="getPath();"></p>
  </p>

  <p>
    <input type="submit" id="btn" value="Submit">
  </p>

</form>

  </body>

</html>
