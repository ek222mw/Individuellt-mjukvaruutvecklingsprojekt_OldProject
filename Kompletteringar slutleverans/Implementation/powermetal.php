<!doctype html>
<html lang="sv">
   <head>
       <meta http-equiv="content-type" content="text/html" charset="ISO-8859-1" initial-scale=1.0 maximum-scale=1.0 user-scalable=0 />
        <title>Power Metal</title>
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
    </Header>
    <Main id="container">
<?php   
if(isset($_COOKIE["PHPSESSID"]))
{
    session_start();
}
require_once "orm.php";
    //Select query
    $db = new ORM();
    $name = $_POST['name'];
    $biography = $_POST['biography'];
    $genreid = $_POST['genreid'];
    $discography = $_POST['discography'];
    $bandid = $_POST['bandid'];
    $db->select(array('bandid','name','biography','discography'))->from('bands');
    try {
    
    	    $result = $db->executeQuery()->getResultArray();
    	    foreach ($result as $name) {
                    if ($name['name'] == "Hammerfall" )
                    {
                         echo '<h2 id="container">',$name['name'],'</h2>';
                         echo '<div id="container">','<img height="200" width="300" src="Pics/hammerfall.jpg" alt="Hammerfall" title="Hammerfall" />','</div>','<br>';
                       
                    }
            }
    	   
            
    	        foreach ($result as $biography) {
                    if ($biography['name'] == "Hammerfall") 
                    {
                        echo '<h2 id="container">','Biography','</h2>';
                        echo '<div id="container">',$biography['biography'],'</div>';
                    }
                }
    	     
    	     
    	     foreach ($result as $discography) {
                    if ($discography['name'] == "Hammerfall") 
                    {
                        echo '<h2 id="container">','Discography','</h2>';
                        echo '<div id="container">',$discography['discography'],'</div>','<br>';
                    }
                }
    	  
            
	       
        } catch(exception $e) {
    	           die($e->getMessage());
        }
        echo '<div id="container">','<a href="powermetalalbums.php"  title="View Power Metal albums">','<img  src="Pics/bandlink.jpg" alt="Hammerfall" title="Hammerfall" />','View Power Metal albums','</a>','</div>';
         
       
?>
</Main>
        
       
    </body>
    </html>