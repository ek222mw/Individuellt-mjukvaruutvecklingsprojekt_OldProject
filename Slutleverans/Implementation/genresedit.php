<!doctype html>
<html lang="sv">
   <head>
       <meta http-equiv="content-type" content="text/html" charset="ISO-8859-1" initial-scale=1.0 maximum-scale=1.0 user-scalable=0 />
        <title>Edit Genres</title>
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
    <h2 id="h2">Edit Genres</h2>
    <h4 id="h2">Pick Genre to edit</h4>
	<form action="genresedit.php" method="post"/>
	<select name="genrepick" id="input">
      <option value="1" id="input"><?php
      session_start();
      echo $_SESSION['list_id1'];
      ?></option>
      <option value="2" id="input"><?php
      session_start();
      echo $_SESSION['list_id2'];
      ?></option>
      <option value="3" id="input"><?php
      session_start();
      echo $_SESSION['list_id3'];
      ?></option>
    </select>
	New Genrename: <input type="text" name="genrename" id="input"/><br><br>
		  <input type="submit" id="buttons" value="Edit"/>
	</form><br>
	
	


<?php
session_start();
require_once "orm.php";
$db = new ORM();
$content = $_POST['genrename'];

$genreid = $_POST['genreid'];
	switch ($_POST['genrepick']) {
	case "1":
	    if(!empty($_SESSION['admin']))
		    $genreid = "1";
		else{
		    
		         die("Not logged in as Admin");
		}
		break;
		case "2":
         if(!empty($_SESSION['admin']))
		    $genreid ="2";
		else{
		    
		         die("Not logged in as Admin");
		}
		break;
		case "3":
        if(!empty($_SESSION['admin']))
            $genreid = "3";
        else{
		    
		         die("Not logged in as Admin");
		}    
		break;
	}

if(!empty($_SESSION['username']) || !empty($_SESSION['admin']) &&  $_SERVER['REQUEST_METHOD'] == 'POST' )
{
    $db->update(array('genrename' => $content))->setTableName('genres')->where('genreid = '.$genreid);

    try {
        if($genreid == "1")
        {
    	    $db->executeQuery();
    	    $_SESSION['list_id1'] = $content;
	    
        }
        if($genreid == "2")
        {
    	    $db->executeQuery();
    	    $_SESSION['list_id2'] = $content;
	    
        }
        if($genreid == "3")
        {
    	    $db->executeQuery();
    	    $_SESSION['list_id3'] = $content;
	    
        }
	
    } catch(exception $e) {
	    die($e->getMessage());
    }	
} 
else
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        die("You must be logged in to edit genre");
        
    }
}
?>
</div>
</body>
</html>