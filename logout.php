<?php
session_start();
if(isset($_SESSION['ur']))
{
 session_destroy();
 header("Location:0_login.php");
}
else
{
  header("Location:0_login.php"); 
}

?>
