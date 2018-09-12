<!DOCTYPE html>
<html lang="en">

  <head>
    <title>DB Website</title>
  </head>

  <body>

<form action="test.php" method="POST">
  <p>
    <lable>Aggregate Name:</lable>
    <input type="text" id="agName" name="agName">
  </p>
    <p>
    <lable>Keywords:</lable>
    <input type="text" id="keywords" name="keywords">
  </p>
  <p>
      <p>File to upload: <input type= "file" name="UploadFileName"></p>
      <input type="submit" id="btn" value="Submit">
  </p>
<!--
  <p>
    <lable>Password:</lable>
    <input type="text" id="pass" name = "pass">
  </p>
-->
Input Type
  <p>
    <input type="radio" name="radAnswer" value="picture">Picture<br>
    <input type="radio" name="radAnswer" value="video">Video<br>
    <input type="radio" name="radAnswer" value="text">Text<br>
    <input type="radio" name="radAnswer" value="html">HTML<br>
    <input type="radio" name="radAnswer" value="other">Other<br>
  </p>
  <p>
    <input type="submit" id="btn" value="Submit">
  </p>
<!--
  <input type="submit">
  Picture<input name="Picture" type="radio">
  Text File<input name="TextFile" type="radio">
-->
</form>

  </body>

</html>
