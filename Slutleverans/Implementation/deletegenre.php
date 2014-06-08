<!doctype html>
<html lang="sv">
   <head>
       <meta http-equiv="content-type" content="text/html" charset="ISO-8859-1" initial-scale=1.0 maximum-scale=1.0 user-scalable=0 />
        <title>Delete Genre</title>
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
    <h2 id="h2">Delete Genre</h2>
<form method="post" action="deletegenre.php">
<select name="genreide" id="input">
      <option value="1" id="input"><?php
       if(isset($_COOKIE["PHPSESSID"]))
       {
         session_start();
       }
        echo $_SESSION['list_id1'];
      ?></option>
      <option value="2" id="input"><?php
       if(isset($_COOKIE["PHPSESSID"]))
       {
         session_start();
       }
        echo $_SESSION['list_id2'];
      ?></option>
      <option value="3" id="input"><?php
       if(isset($_COOKIE["PHPSESSID"]))
       {
         session_start();
       }
        echo $_SESSION['list_id3'];
      ?></option>
</select><br><br>
<input type="submit" name="submit" id="buttons" value="Delete">
</form><br>

<?php
 if(isset($_COOKIE["PHPSESSID"]))
  {
    session_start();
  }
require_once "orm.php";

$genreid = $_POST['genreid'];


	switch ($_POST['genreide']) {
	case "1":
	    if(!empty($_SESSION['admin']))
		$genreid['genreid'] = "1";
		else{
		    
		         die("Not logged in as Admin");
		}
		break;
	case "2":
	    if(!empty($_SESSION['admin']))
	        $genreid['genreid'] = "2";
		else{
		    
		        die("Not logged in as Admin");
		}
		break;
	case "3":
		$genreid['genreid'] = "3";
		break;
	}


$db = new ORM();
if(!empty($_SESSION['username']) || !empty($_SESSION['admin']) &&  $_SERVER['REQUEST_METHOD'] == 'POST' )
{
    $db->delete()->from('genres')->where('genreid = '.$genreid['genreid']);

    try {
                    
           
            if($genreid['genreid'] == "1")
            {
                
    	        $db->executeQuery();
                echo 'Genre',$_SESSION['list_id1'], 'succefully deleted';
                unset($_SESSION['list_id1']);
            }
            if($genreid['genreid'] == "2")
            {
    	        $db->executeQuery();
                echo 'Genre',$_SESSION['list_id2'], 'succefully deleted';
                unset($_SESSION['list_id2']);
            }
            if($genreid['genreid'] == "3")
            {
            
    	        $db->executeQuery();
                echo 'Genre',' ',$_SESSION['list_id3'],' ','succefully deleted';
                unset($_SESSION['list_id3']);
            }
                
	
    } catch(exception $e) {
	    die($e->getMessage());
      }
}   
else
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        die("You must be logged in to delete genre");
        
    }
}
?>

 </div>

</body>
</html>
