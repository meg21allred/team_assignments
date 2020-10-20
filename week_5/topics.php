<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topics</title>
</head>
<body>
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

$book = $_POST['book'];
$chapter = $_POST['chapter'];
$verse = $_POST['verse'];
$content = $_POST['content'];
$id = $_POST['id'];

$topic = $_POST['topic'];

echo "<ul>";

foreach ($db->query("SELECT * FROM scriptures") as $row)
{
  echo "<li>";
  echo "<strong>" . $row['book'] . "</strong> " . $row['chapter'] . ":" . $row['verse'] . " " . "<a href='details.php?id=" .$row['id'] ."'>content</a>";
  echo "</li>";
}

echo "</ul>";

?>
</body>
</html>