<?php
session_start();
unset($_SESSION['admin']);
unset($_SESSION['username']);
print "You have been logged out. <a href='index.php'>Go back</a>";
echo '<META HTTP-EQUIV="Refresh" content="2; URL=http://www.metalgenre.se/index.php">';
exit;
?>