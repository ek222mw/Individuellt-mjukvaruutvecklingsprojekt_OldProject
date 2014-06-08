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
    </Header>
    <div id="logincolumn">

    <h2 id="hmid">Login</h2>
	<form action="login.php" method="post"/>
	Username:<input type="text" name="username" id="input"/><br><br>
	Password:<input type="password" name="password" id="input"/><br><br>
	<input type="submit" value="Log in" id="buttons"/>
	</form><br>
	<form action="logout.php" method="post"/>
	<input type="submit" value="Log out" id="buttons"/>
	</form><br>
	<a href="newuser.php" id="links">Create new user</a><br><br>
	
    <?php
    if(isset($_COOKIE["PHPSESSID"]))
      {
        session_start();
    }
    if(!empty($_SESSION['admin']))
    {
        echo "You are logged in as Admin.";
    }
    else
    {
    if( !empty($_SESSION['username']) )
    {
         echo "You are logged in as user.";
    }
    else
    {
        echo "You are not logged in.";
    }
    }
    ?>
	
	</div>
	<Main id="newscolumn">
	
	<?php   
if(isset($_COOKIE["PHPSESSID"]))
{
    session_start();
}
require_once "orm.php";
    //Select query
    $db = new ORM();
    $news = $_POST['news'];
    $db->select(array('news'))->from('news');
    try {
	    $result = $db->executeQuery()->getResultArray();
	    echo '<h2 id="hmid">','News','</h2>';
	    foreach($result as $news) {
	        
	            echo '<a href="'.$news['news'].'">',$news['news'],'</a>','<br>';
	           
        }
        } catch(exception $e) {
	           die($e->getMessage());
        }
         
        
?>
	
	<Main>
</body>
</html>	