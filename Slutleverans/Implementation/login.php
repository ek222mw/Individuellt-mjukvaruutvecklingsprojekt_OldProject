<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once "orm.php";
 
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
if($username&&$password)
{
      
    try
    {
                
                $db = new ORM();
                $db->select(array('userid','username', 'password'))->from('users')->where('username = \''. $username.'\'');
                $db->executeQuery();
                $user = $db->getSingleResultObject();
               
                if($username === "admin")
                {
                    echo "You are logged in as Admin!";
                    $_SESSION['admin'] = $user;
                     echo '<META HTTP-EQUIV="Refresh" content="2; URL=http://www.metalgenre.se/index.php">';
                     exit;
                }
                else
                {
                if($user->password == $password)
                {
                        echo "You are logged in!";
                        $_SESSION['username'] = $user;
                        $_SESSION['loginname'] = $username;
                        echo '<META HTTP-EQUIV="Refresh" content="2; URL=http://www.metalgenre.se/index.php">';
                        exit;
                        
                }
                else
                {
                        echo "Your password or username is incorrect!";
                        echo '<META HTTP-EQUIV="Refresh" content="2; URL=http://www.metalgenre.se/index.php">';
                        exit;
                        
                       
                }
                }
    }
    catch(Exception $e)
    {
                var_dump($db);
               
    }
}
 
else
{
     echo "Please enter a username and password!";
     echo '<META HTTP-EQUIV="Refresh" content="2; URL=http://www.metalgenre.se/index.php">';
     exit;
}
?>							