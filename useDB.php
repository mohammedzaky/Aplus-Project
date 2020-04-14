<?php
  
  include("DB.php");

   $pd=new PDO("mysql:host=localhost","root","");
   $q="use aplusv2;";

   $pd->exec($q);

?>
