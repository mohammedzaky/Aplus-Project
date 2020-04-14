<?php
session_start();
include_once("DB.php");
if(isset($_POST['sbs']))
{
 $cn=$_POST['courseName'];
 $trm=$_POST['term'];
 $q=" select Course_ID from course where Course_name='$cn';";
 $cid=$db->getRow($q,array());
 $sny= explode(" ", $trm);
 $q1="select Semester_ID from semester where Semester_name=? and Semester_year=?;";
 $sid=$db->getRow($q1,array($sny[0],$sny[1]));
 if(count($cid>0)and count($sid>0) )
 {
  $q2="select Professor_ID from semester_course_professor where Semester_ID='$sid[0]' and Course_ID='$cid[0]';";
  $pid=$db->getRow($q2,array());
  $q3="select Professor_name from professor where Professor_ID='$pid[0]';";
  $pn=$db->getRow($q3,array());
  echo $pn[0];
  if($pid[0]>0)
  {
  header("Location:P_1.2_course.php#ooo");
  $_SESSION['cn']=$cn;
  $_SESSION['trm']=$trm;
  $_SESSION['pn']=$pn[0];
  $_SESSION['pid']=$pid[0];
  }
  else
  {
   header("Location:P_1.2_course.php");
  }
 }
}
?>
