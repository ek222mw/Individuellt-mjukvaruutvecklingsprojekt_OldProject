<!doctype html>
<html lang="sv">
   <head>
       <meta http-equiv="content-type" content="text/html" charset="ISO-8859-1" initial-scale=1.0 maximum-scale=1.0 user-scalable=0 />
        <title>Genres</title>
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
    <li ><a class="start" href="index.php">Start</a></li>
    <li><a class="contact" href="Contact.html">ContactForm</a></li>
    <li><a class="Genres" href="genres.php">Genres</a></li>
    </ul> </Nav>
    </Header><br>
    <div id="column">
    <h2 id="hleft">Delete grade</h2>
<form method="post" action="deletegrade.php">
<select name="gradeide" id="input">
      <option value="1" id="input"><?php 
       
       $score = "5";
	   $albumname ="Glory to the brave";
	   echo 'Album: ',$albumname,' ','Score: ',' ',$score;
	   
       
      
      ?></option>
      <option value="2" id="input"><?php 
       
       $score = "7";
	   $albumname ="Glory to the brave";
	   
       echo 'Album: ',$albumname,' ','Score: ',' ',$score;
      
      ?></option>
      <option value="3" id="input"><?php 
       
       $score = "9";
	   $albumname ="Glory to the brave";
	    
       echo 'Album: ',$albumname,' ','Score: ',' ',$score;
      
      ?></option>
</select><br><br>
<input type="submit" name="submit" id="buttons" value="Delete">
</form>

<?php
 if(isset($_COOKIE["PHPSESSID"]))
  {
    session_start();
  }
require_once "orm.php";

$gradeid = $_POST['gradeid'];
$usrid = $_POST['usrid'];
$albmid = $_POST['albmid'];
$score = $_POST['score'];

	switch ($_POST['gradeide']) {
	case "1":
		$gradeid['gradeid'] = "1";
		$usrid['usrid'] = "1";
	    $albmid = "2";
	    $score = "5";
	    $albumname ="Glory to the brave";
		break;
	case "2":
		$gradeid = "2";
		$usrid['usrid'] = "1";
		$albmid = "2";
		$score = "7";
	    $albumname ="Glory to the brave";
		break;
	case "3":
		$gradeid = "150";
		$usrid['usrid'] = "1";
		$albmid = "2";
		$score = "9";
	    $albumname ="Glory to the brave";
		break;
	}



$db = new ORM();
if(!empty($_SESSION['username']) && $usrid['usrid'] = "1" && $_SESSION['loginname'] == "test" && $_SERVER['REQUEST_METHOD'] == 'POST' )
{
$db->delete()->from('grades')->where('gradeid = '.$gradeid['gradeid']);

    try {
                    
           
            if($_POST['gradeide'] == "1" && $albmid == "2")
            {
            
	            $db->executeQuery();
	        
                echo 'Grade succefully deleted with details: ',' ','Album:',$albumname,' Score:',$score;
            }
             if($_POST['gradeide'] == "2" && $albmid == "2")
            {
            
	            $db->executeQuery();
	       
                echo 'Grade succefully deleted with details:',' ','Album:',$albumname,' Score:',$score;
            }
             if($_POST['gradeide'] == "3" && $albmid == "2")
            {
            
	            $db->executeQuery();
	       
                echo 'Grade succefully deleted with details:',' ','Album:',$albumname,' Score:',$score;
            }    
           
        
	
    } catch(exception $e) {
	    die($e->getMessage());
      }
}   
else
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        die("You must be logged in to delete your grade");
        
    }
}
?>

</div> 

</body>
</html>
