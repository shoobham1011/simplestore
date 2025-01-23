<?php
session_start();
session_unset();
session_destroy();
echo "Session destroyed";  // Debugging line to check session status
header("location: /simplestore/Authentication/login.php");  // Redirect to login page after logout
exit();
?>
