<?php   
session_start();
//Destroy The Session
session_destroy(); 
//To Redirect Back To "index.php" After Logging Out
header("location:../index.php"); 
exit();
?>