<?php
include("DB.php");
session_start();
/*$d=array("std89547","prf85566","adn32445456");
$p=array("123","587");*/


if($_SERVER["REQUEST_METHOD"] == "POST")
{

   $usr=$_POST['usr'];
   $pass=$_POST['pwd'];
   $chu=substr($usr,0,2);

   if($chu=="a_" or $chu=="s_" or $chu=="p_")
   {
     if($chu=="p_")
     {
         
         $q1="select Professor_username,Professor_password from professor where Professor_username = ? and Professor_password = ?;";
         $rows=$db->getRows($q1,array($usr,$pass));

         if(count($rows)>0)
         {
                  $_SESSION['ur']=$usr;
                  $_SESSION['ps']=$pass;
                  header("Location:P_1_Home.php");
               
         }
            else {header("Location:0_login-invalid.php");}
            
         
      }
     

    if($chu=="a_")
    {
       $q1="select Admin_username,Admin_password from admin where Admin_username = ? and Admin_password = ?;";
       $rows=$db->getRows($q1,array($usr,$pass));

         if(count($rows)>0)
         {
                  $_SESSION['adm']=$usr;
                  $_SESSION['ps']=$pass;
                  header("Location:A_1.1_terms.php");
         }
            else { header("Location:0_login-invalid.php"); }

      }

    
    if($chu=="s_")
    {
       $q1="select Student_username,Student_password from student where Student_username= ? and Student_password = ? ;";
       $rows=$db->getRows($q1,array($usr,$pass));
       
       if(count($rows)>0)
         {
                  $_SESSION['std']=$usr;
                  $_SESSION['ps']=$pass;
                      header("Location:S_3_Home.php");
                  
         }
            else { header("Location:0_login-invalid.php"); }
     
     }
   }
   else {
    header("Location:0_login-invalid.php");
   }

 }
?>
