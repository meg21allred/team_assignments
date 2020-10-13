<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Scripture List</h1>
    <?php

try
{
  $dbUrl = getenv('DATABASE_URL');

  $dbOpts = parse_url($dbUrl);

  $dbHost = $dbOpts["host"];
  $dbPort = $dbOpts["port"];
  $dbUser = $dbOpts["user"];
  $dbPassword = $dbOpts["pass"];
  $dbName = ltrim($dbOpts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}


echo '  <form action="week05.php" method="get">
<label for="book">Enter Book: </label>
<input type="text" name="bookToSearch" id="book">
<input type="submit" name="search" value="Find">

</form>';

$book = '';

$book = $_GET['bookToSearch'];

echo "<ul>";

foreach ($db->query("SELECT * FROM scriptures WHERE book LIKE '%".$book."%'") as $row)
{
  echo "<li>";
  echo "<strong>" . $row['book'] . "</strong> " . $row['chapter'] . ":" . $row['verse'] . " - " . '"' . $row['content'] . '"';
  echo "</li>";
}

echo "</ul>";


echo "<ul>";

foreach ($db->query("SELECT * FROM scriptures") as $row)
{
  echo "<li>";
  echo "<strong>" . $row['book'] . "</strong> " . $row['chapter'] . ":" . $row['verse'] . " " . "<a href='details.php?id=1>content</a>";
  echo "</li>";
}

echo "</ul>";
    ?>
   
</body>
</html>