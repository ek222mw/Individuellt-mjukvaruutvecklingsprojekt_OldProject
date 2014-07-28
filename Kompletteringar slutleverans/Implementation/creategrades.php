<!doctype html>
<html lang="sv">
   <head>
       <meta http-equiv="content-type" content="text/html" charset="ISO-8859-1" initial-scale=1.0 maximum-scale=1.0 user-scalable=0 />
        <title>Create Grades</title>
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
    <h2 id="hleft">Create Grades</h2>
	<form action="creategrades.php" method="post"/>
	<p>Choose grade between 1 and 10</p>
<select name="albums" id="input">
<option value="2" id="input">Glory to the brave</option>
<option value="3" id="input">Master of puppets</option>
<option value="4" id="input">Hardcore superstar</option>
<option value="5" id="input">Diamonds</option>
</select>

				
<?php
  if(isset($_COOKIE["PHPSESSID"]))
  {
    session_start();
  }
require_once "orm.php";
    //Select query
    $db = new ORM();
    $albumid = $_POST['albumid'];
    $name = $_POST['name'];
    $contents = $_POST['contents'];
    $persons = $_POST['persons'];
    $bandid = $_POST['bandid'];
    $albumpick = $_POST['albums'];
    
    $db->select(array('albumid','name','contents','persons','bandid'))->from('albums');
    try {
    
    	    $result = $db->executeQuery()->getResultArray();
    	       
                 foreach ($result as $albumid) {
                     
                     
                   
                     
                        switch ($albumpick) {
        	            case "2":
            	            $albumid = "1";
            	            $_SESSION['pickedalbum'] =  $albumid;
        		            break;
        	            case "3":
            	            $albumid = "2";
            		        $_SESSION['pickedalbum'] =  $albumid;
            		        break;
            		    case "4":
            	            $albumid = "3";
            		        $_SESSION['pickedalbum'] =  $albumid;
            		        break;
            		    case "5":
            	            $albumid = "4";
            		        $_SESSION['pickedalbum'] =  $albumid;
            		        break;
        	
        	            }
                
               
               
                }
                
    	  
            
	       
        } catch(exception $e) {
    	           die($e->getMessage());
        }
         
?>



	Grade: <input type="number" name="score" id="input"/><br><br>
		  <input type="submit" id="midbuttons" value="Rate"/>
	</form><br>
	
	


<?php
if(isset($_COOKIE["PHPSESSID"]))
  {
    session_start();
  }
require_once "orm.php";
//Insert query
$db = new ORM();

$grade = $_POST['score'];
$albmid = $_POST['albmid'];
$albmid = $_SESSION['pickedalbum'];
$usrid = $_POST['usrid'];
$gradeid= $_POST['gradeid'];






if($grade !=NULL & !empty($_SESSION['username']) ||!empty($_SESSION['admin']) && $grade>0 & $grade <11 )
{
$db->insert(array('score' => $grade, 'albmid' => $albmid, 'usrid' => $usrid))->into('grades');

try {
    
        	    
        	  
        	   
            
            
            if($albmid == 1)
    	    {
    	        
    	          
    	        
        		        for($j = 0; $j < 1; $j++) {
        		       
            		        $countgrades = count($j);
            		       
            		        
            		        
            		       
            		        if($countgrades <= 100)
            		        {
            		            
                                $db->executeQuery();
                                echo "New grade with details: Score: $grade";
                                echo '<META HTTP-EQUIV="Refresh" content="2; URL=http://www.metalgenre.se/powermetalalbums.php">';
                                exit;
                            
        		            }
        		            
                           
        		     
        	        
                       }
                    
            }
            if($albmid == 2)
    	    {
    	        
    	           
    	        
        		        for($k = 0; $k < 1; $k++) {
        		       
            		        $countgrade = count($k);
            		       
            		        
            		        
            		       
            		        if($countgrade <= 100)
            		        {
            		            
                                $db->executeQuery();
                                echo "New grade with details: Score: $grade";
                                echo '<META HTTP-EQUIV="Refresh" content="2; URL=http://www.metalgenre.se/thrashmetalalbums.php">';
                                exit;
                            
        		            }
        		            
                           
        		     
        	        
                       }
                    
            
    	    }
             if($albmid == 3)
    	    {
    	        
    	          
    	        
        		        for($l = 0; $l < 1; $l++) {
        		       
            		        $countgrades1 = count($l);
            		       
            		        
            		        
            		       
            		        if($countgrades1 <= 100)
            		        {
            		            
                                $db->executeQuery();
                                echo "New grade with details: Score: $grade";
                                echo '<META HTTP-EQUIV="Refresh" content="2; URL=http://www.metalgenre.se/hairmetalalbums.php">';
                                exit;
                            
        		            }
        		            
                           
        		     
        	        
                       }
                    
            }
            
             if($albmid == 4)
    	    {
    	        
    	          
    	        
        		        for($m = 0; $m < 1; $m++) {
        		       
            		        $countgrades2 = count($m);
            		       
            		        
            		        
            		       
            		        if($countgrades2 <= 100)
            		        {
            		            
                                $db->executeQuery();
                                echo "New grade with details: Score: $grade";
                                echo '<META HTTP-EQUIV="Refresh" content="2; URL=http://www.metalgenre.se/speedmetalalbums.php">';
                                exit;
                            
        		            }
        		            
                           
        		     
        	        
                       }
                    
            }
    	    
	    $latestInsertedId = $db->getLastInsertedId();
	   
        
        	
    
	
} catch(exception $e) {
	die($e->getMessage());
}
}
else
{
    echo "Score couldn't be created, you must logged in as user or admin.";
}
?>
</div>

</body>
</html>