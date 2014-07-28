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
    <li class="active"><a class="Genres" href="genres.php">Genres</a></li>
    </ul> </Nav>
    </Header><br>
    <Main id="genrecontainer">
    <a id="atags" href="creategenre.php">Create new Genre</a><br>
     <a id="atags" href="genresedit.php">Edit Genre</a><br>
     <a id="atags" href="deletegenre.php">Delete Genre</a><br><br>
<?php   
if(isset($_COOKIE["PHPSESSID"]))
  {
    session_start();
}
require_once "orm.php";
    //Select query
    $db = new ORM();
    $genrename = $_POST['genrename'];
    $db->select(array('genrename'))->from('genres');
    try {
	    $result = $db->executeQuery()->getResultArray();
	    foreach($result as $genrename) {
	        
	        if($genrename['genrename'] == "Power Metal")
	        { 
	            
	            echo '<div class="Gallery">','<a href="powermetal.php"  title="Power Metal">','<img height="200" width="300" src="Pics/powermetal.png" alt="Power Metal" title="Power Metal" />','</a>','</div>';
	           
	            
	        }
	       
	       if($genrename['genrename'] == "Thrash Metal")
	       {
	          
	           echo '<div class="Gallery">','<a href="thrashmetal.php" title="Thrash Metal">','<img height="200" width="300" src="Pics/thrashmetal.png" alt="Thrash Metal" title="Thrash Metal" />','</a>','</div>';
	       }
	       if($genrename['genrename'] == "Hair Metal")
	       {
	          
	           echo '<div class="Gallery">','<a href="hairmetal.php" title="Hair Metal">','<img height="200" width="300" src="Pics/hairmetal.jpg" alt="Hair Metal" title="Hair Metal" />','</a>','</div>';
	       }
	       if($genrename['genrename'] == "Speed Metal")
	       {
	          
	           echo '<div class="Gallery">','<a href="speedmetal.php" title="Speed Metal">','<img height="200" width="300" src="Pics/speedmetal.png" alt="Speed Metal" title="Speed Metal" />','</a>','</div>';
	       }
	      
	       
	       
           
        }
        } catch(exception $e) {
	           die($e->getMessage());
        }
         
        
?>
</Main>
        <!--
        http://rateyourmusic.com/list/kettle6_6/top_20_thrash_metal_albums/
        //http://www.welovemetal.com/newsite/wordpress/2013/10/08/top-10-tuesday-damn-you-google-power-metal-edition/-->
      <!-- <div class="Gallery">
       
    </body>
    </html>		