<?php
$pd=new PDO("mysql:host=localhost","root","");
$q="create database if not exists pro;";
$pd->exec($q);
?>
