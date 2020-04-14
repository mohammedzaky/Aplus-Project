<?php

   $pd=new PDO("mysql:host=localhost","root","");
   $q="create database aplusV3;";

   $pd->exec($q);
   $pd->exec("use aplusV3;");
   $pd->exec(file_get_contents("aplusV3.sql")); 

?>
