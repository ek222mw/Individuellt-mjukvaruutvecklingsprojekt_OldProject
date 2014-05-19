<!doctype html>
<html lang="sv">
   <head>
       <meta http-equiv="content-type" content="text/html" charset="ISO-8859-1" initial-scale=1.0 maximum-scale=1.0 user-scalable=0 />
        <title>Power Metal</title>
       <link rel="stylesheet" type="text/css" href="Css/Gallery.css" media="screen and (min-width:481px)" />
        <link rel="stylesheet" type="text/css" href="Css/style.css" media="screen and (max-width:481px)" />
       <link rel="stylesheet" type="text/css" href="css/Utskrift.css" media="print" />
        <link rel="shortcut icon" href="css/pics/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="css/pics/apple-touch-icon-114x114-precomposed.png" />
    </head>
<body>
<h1>Edit Genre</h1>
<h1>Menu</h1>
    <ul>
    <li><a class="start" href="index.php">Start</a></li>
    <li><a class="contact" href="Contact.html">ContactForm</a></li>
    <li><a class="Genres" href="genres.php">Genres</a></li>
    </ul>
	<form action="genresedit.php" method="post"/>
	GenreName: <input type="text" name="genrename" /><p>
		  <input type="submit" value="Edit"/>
	</form>
	

<?php
session_start();
require_once "orm.php";
//Update query
    $db = new ORM();
    $genrename = $_POST['genrename'];
    $genreid = $_POST['genreid'];

$db->update(array('genrename' => $genrename))->setTableName('genres')->where('genreid = '.$genreid);

try {
	$db->executeQuery();
	var_dump($genreid);
} catch(exception $e) {
	die($e->getMessage());
}
?>
</body>
</html>