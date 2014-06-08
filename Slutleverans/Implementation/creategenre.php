<!doctype html>
<html lang="sv">
   <head>
       <meta http-equiv="content-type" content="text/html" charset="ISO-8859-1" initial-scale=1.0 maximum-scale=1.0 user-scalable=0 />
        <title>Create new Genre</title>
       <link rel="stylesheet" type="text/css" href="Css/bootstrap.css" media="screen and (min-width:481px)" />
        <link rel="stylesheet" type="text/css" href="Css/bootstrap.css" media="screen and (max-width:481px)" />
       <link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="print" />
        <link rel="shortcut icon" href="css/pics/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="css/pics/apple-touch-icon-114x114-precomposed.png" />
    </head>
<body>
<Header id="header">
    <img id="headerbild"  src="Pics/header_projekt.png" alt="pic_projekt" title="Picture Projekt" />
    <Nav id="navigation"><h1>Menu</h1>
    <ul>
    <li class="active"><a class="start" href="index.php">Start</a></li>
    <li><a class="contact" href="Contact.html">ContactForm</a></li>
    <li><a class="Genres" href="genres.php">Genres</a></li>
    </ul> </Nav>
    </Header>
    <div id="column">
    <h2 id="h2">Create new Grade</h2>
	<form action="creategenre.php" method="post"/>
	GenreName: <input type="text" name="genrename" id="input"/><br><br>
		  <input type="submit" id="buttons" value="Create"/>
	</form><br>

	


<?php
session_start();
require_once "orm.php";
//Insert query
$db = new ORM();
$content = $_POST['genrename'];
if($content !=NULL & !empty($_SESSION['admin']) || !empty($_SESSION['username']))
{
    $db->insert(array('genrename' => $content))->into('genres');

    try {
	    $db->executeQuery();
	    $latestInsertedId = $db->getLastInsertedId();
	    echo "New genre with details: GenreName: $content";
    }catch(exception $e) {
	die($e->getMessage());
    }
}
else
{
    echo "Genrename couldn't be created";
}
?>

	</div>
</body>
</html>