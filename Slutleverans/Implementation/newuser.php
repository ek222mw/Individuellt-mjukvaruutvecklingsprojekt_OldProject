<!doctype html>
<html lang="sv">
   <head>
       <meta http-equiv="content-type" content="text/html" charset="ISO-8859-1" initial-scale=1.0 maximum-scale=1.0 user-scalable=0 />
        <title>metalgenre.se Start</title>
       <link rel="stylesheet" type="text/css" href="Css/bootstrap.css" media="screen and (min-width:481px)" />
        <link rel="stylesheet" type="text/css" href="Css/bootstrap.css" media="screen and (max-width:481px)" />
       <link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="print" />
        <link rel="shortcut icon" href="css/pics/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="css/pics/apple-touch-icon-114x114-precomposed.png" />
    </head>
<body>
<Header id="header">
    <img id="headerbild"  src="Pics/header_projekt.png" alt="pic_projekt" title="Picture Projekt" />
    <h1>Welcome to MetalGenre.se!</h1>
    <Nav id="navigation"><h1>Menu</h1>
    <ul>
    <li class="active"><a class="start" href="index.php">Start</a></li>
    <li><a class="contact" href="Contact.html">ContactForm</a></li>
    <li><a class="Genres" href="genres.php">Genres</a></li>
    </ul> </Nav>
    </Header><br>
    <div id="logincolumn">
	<form action="newuser.php" method="post"/>
	Username: <input type="text" name="username" id="input"/><br><br>
	Password: <input type="password" name="password" id="input"/><br><br>
		  <input type="submit" value="Create" id="buttons"/>
	</form><br>
	<form action="index.php" method="post"/>
	<input type="submit" value="Cancel" id="buttons"/>
	</form><br>
	


<?php
session_start();
require_once "orm.php";
//Insert query
$db = new ORM();
$username = $_POST['username'];
$password = $_POST['password'];
if($username !=NULL& $password != NULL& $username != "admin")
{
    $db->insert(array('username' => $username, 'password' => $password))->into('users');

try {
	$db->executeQuery();
	
	$latestInsertedId = $db->getLastInsertedId();
	echo "New user created with info(print it!): Username: $username, Password: $password";
} catch(exception $e) {
	die($e->getMessage());
}
}
else
{
    echo "Username or Password cannot be empty try again.";
}
?>
</div>
</body>
</html>