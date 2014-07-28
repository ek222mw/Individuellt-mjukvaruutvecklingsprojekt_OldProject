<!doctype html>
<html lang="sv">
   <head>
       <meta http-equiv="content-type" content="text/html" charset="ISO-8859-1" initial-scale=1.0 maximum-scale=1.0 user-scalable=0 />
        <title>Thrash Metal Albums</title>
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
    error_reporting(E_ALL ^ E_NOTICE);
    require_once "orm.php";
      $db = new ORM();
    $userid = $_REQUEST['userid'];
    $gradeid = $_REQUEST['gradeid'];
    $score = $_REQUEST['score'];
    $albmid = $_REQUEST['albmid'];
    $usrid = $_REQUEST['usrid'];
    $albumid = $_REQUEST['albumid'];


           
               
                $db->select(array('gradeid','score','albmid','usrid'))->from('grades');//->where('gradeid = \''. $gradeid.'\'');
                
               try {
    
    	    $result = $db->executeQuery()->getResultArray();
    	    
    	    foreach ($result as $gradeid) {
                    
                   
                }
    	   
            echo '<h2 id="container">','Master of puppets grades','</h2>';
    	        foreach ($result as $score) {
    	            if($score['albmid'] == 1)
    	            
    	                echo '<NOBR id="nobr">',$score['score'],'  ','</NOBR>';
                }
    	     
    	     
    	        foreach ($result as $albmid) {
    	            $albmid = $_SESSION['albumid'];
                }
                
                foreach ($result as $usrid) {
            

                }
                  
        } catch(exception $e) {
    	           die($e->getMessage());
        }
  
                
    

 
?>		
<?php   
session_start();
require_once "orm.php";
    //Select query
    $db = new ORM();
    $albumid = $_POST['albumid'];
    $name = $_POST['name'];
    $contents = $_POST['contents'];
    $persons = $_POST['persons'];
    $bandid = $_POST['bandid'];
    $bandid = "2";
    $db->select(array('albumid','name','contents','persons','bandid'))->from('albums')->where('bandid = '.$bandid);
    try {
    
    	    $result = $db->executeQuery()->getResultArray();
    	        foreach ($result as $name) {
    	            if($name['name'] == "Master of puppets")
                        
                         echo '<h2 id="container">',$name['name'],'</h2>';
                }
    	   
            
    	        foreach ($result as $contents) {
                     if($contents['name'] == "Master of puppets")
                     {
                         echo '<h2 id="container">','Contents','</h2>';
                         echo '<div id="container">',$contents['contents'],'</div>','<br>';
                    }   
                }
    	     
    	     
    	        foreach ($result as $persons) {
                    if($persons['name'] == "Master of puppets")
                    {
                        echo '<h2 id="container">','Personell','</h2>';
                        echo '<div id="container">',$persons['persons'],'</div>';
                    }
                }
                foreach ($result as $albumid) {
                
                $user = $albumid['albumid'];
                
                $_SESSION['albumid'] = $user['albumid'];
               
                
                }
                
    	  
            
	       
        } catch(exception $e) {
    	           die($e->getMessage());
        }
        echo '<br>';
        echo '<a id="container" href="http://cdon.se/musik/metallica/master_of_puppets-290">',"Buy Master of puppets album",'</a>','<br>';
        echo '<a id="container" href="creategrades.php">',"Set a grade on album",'</a>','<br>';
        
?>

</Main>
        
       
    </body>
    </html>		