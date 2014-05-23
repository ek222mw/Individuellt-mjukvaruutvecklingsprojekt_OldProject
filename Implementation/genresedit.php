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
<form method="post" action="genresedit.php">
<select name="genrepick">
      <option value="1">Power Metal</option>
      <option value="2">Thrash Metal</option>
      <option value="3">Test</option>
</select>
<input type="submit" name="submit" id="submit" value="Submit the form">
</form>

<!--//<?php
  // $option = isset($_POST['genrepick']) ? $_POST['genrepick'] : false;
   //if($option) {
     // echo htmlentities($_POST['genrepick'], ENT_QUOTES, "UTF-8");
   //} else {
  //   echo "task option is required";
    // exit; 
  // }
// ?>-->
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
	            
	            //echo $genrename['genrename'];
	            $_SESSION['Powermetal'] = $genrename['genrename'];
	            
	            
	        }
	       
	       
	       elseif($genrename['genrename'] == "Thrash Metal")
	       {
	          
	           //echo $genrename['genrename'];
	           $_SESSION['Thrashmetal'] = $genrename['genrename'];
	            
	       }
	       elseif($genrename['genrename'] == "Test")
	       {
	           //echo $genrename['genrename'];
	           $_SESSION['Test'] = $genrename['genrename'];
	            
	       }
	       
          
        }
        } catch(exception $e) {
	           die($e->getMessage());
        }
         
	?>
 
 <form action="genresedit.php" method="post">
picked to edit: <input type="text" name="edit" value="<?php
 if(isset($_COOKIE["PHPSESSID"]))
  {
    session_start();
  }
require_once "orm.php";
$db = new ORM();
$genrename = $_POST['genrename'];

$genrepick = $_POST['genrepick'];
$genreid = $_POST['genreid'];
	switch ($_POST['genrepick']) {
	case "1":
    $genreid = "1";
    $genrename =  $_SESSION['Powermetal'];
    
		break;
		case "2":

	$genreid ="2";
	$genrename = $_SESSION['Thrashmetal'];
	
		break;
		case "3":
   
   $genreid = "3";
   $genrename = $_SESSION['Test'];
   
		break;
	}


$db->update(array('genrename' => $genrename))->setTableName('genres')->where('genreid = '.$genreid);

try {
	$db->executeQuery();
	echo $genrename;
} catch(exception $e) {
	die($e->getMessage());
}	
        
	?>"><br>
<input type="submit" name="edit" value="Edit">
</form>


 
</body>
</html>