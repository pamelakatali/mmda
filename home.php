<!DOCTYPE html>
<html lang="en">

  <head>
    <style>
      h1 {
          text-align: center;
          font-size: 250%;
      }

      h4 {
        text-align: center;
      }
    </style>
    <title>MMDA</title>
  </head>

  <body>

<h1> MMDA </h1>
<h4>By Pamela Katali and<br>Garrett Fitzgerald</h4>

<form method='POST' enctype='multipart/form-data' action='bulk.php'>
  <p>
    <input type="submit" id="btn" value="Bulk Data Entry">
  </p>
</form>

<form method='POST' enctype='multipart/form-data' action='htmlp.php'>
  <p>
    <input type="submit" id="btn" value="Html Parser">
  </p>
</form>

<form method='POST' enctype='multipart/form-data' action='insert.php'>

  <p>
    <input type="submit" id="btn" value="Insert DAGR">
  </p>
</form>


<form method='POST' enctype='multipart/form-data' action='annot.php'>
  <p>
    <input type="submit" id="btn" value="Add Annotations">
  </p>
</form>

<form method='POST' enctype='multipart/form-data' action='category-creation.php'>
      <p>
        <input type="submit" id="btn" value="Create a category!" />
      </p>
</form>

<form method='POST' enctype='multipart/form-data' action='delete.php'>
  <p>
    <input type="submit" id="btn" value="Delete DAGR">
  </p>
</form>

<form method='POST' enctype='multipart/form-data' action='search.php'>
  <p>
    <input type="submit" id="btn" value="Search">
  </p>
</form>

<form method='POST' enctype='multipart/form-data' action='orphans.php'>
  <p>
    <input type="submit" id="btn" value="Orphan reports">
  </p>
</form>

<form method='POST' enctype='multipart/form-data' action='sterile.php'>
  <p>
    <input type="submit" id="btn" value="Sterile reports">
  </p>
</form>

<form method='POST' enctype='multipart/form-data' action='reach.php'>
  <p>
    <input type="submit" id="btn" value="Reach reports">
  </p>
</form>

<form method='POST' enctype='multipart/form-data' action='timerangequery.php'>
  <p>
      <input type="submit" id="btn" value="Time Range Query">
  </p>
</form>





  </body>

</html>
