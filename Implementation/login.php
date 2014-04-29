<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once "orm.php";
session_start();
$db = new ORM();
 
$username = $_POST['username'];
$password = $_POST['password'];
//var_dump($username);
//var_dump($password);
if($username&&$password)
{
        $db = new ORM();
    $db->select(array('username', 'password'))->from('users')->where('username = \''. $username.'\'');
    try
    {
                $db->executeQuery();
                $user = $db->getSingleResultObject();
                echo "<pre>";
                var_dump($user->username);
                var_dump($user->password);
                echo "</pre>";
                if($user->password == $password)
                {
                        echo "You are logged in!";
                        $_SESSION['username'] = $user;
                }
                else
                        echo "Your password or username is incorrect!";
    }
    catch(Exception $e)
    {
                echo "fel när getsingleresultobject skulle hämtas";
    }
}
 
else
 die("Please enter a username and password!");
?>						