<?php
session_start();
if(isset($_POST['sm']))
{
  include_once("DB.php");
  $coun=0;
 $et=$_POST['exam_title'];
 $nq=$_POST['numQuestion'];
 $cn=$_POST['courseName'];
 $qd=$_POST['quesDegree'];
 $ed=$_POST['quesTime'];
 $_SESSION['nqq']=$nq;
  $usr=$_SESSION['ur'];
 $_SESSION['cn']=$cn;
  $q1="select Professor_ID from professor where Professor_username='$usr';";
  $pid=$db->getRow($q1,array());
  $q2="select Course_ID from course where Course_name='$cn';";
  $cid=$db->getRow($q2,array());
 $q="INSERT INTO `exam` (`Exam_Title`, `Exam_Q-numbers`, `Exam_Q-degree`, `Exam_duration`, `Exam_active`, `Course_ID`, `Professor_ID`)
  VALUES ('$et','$nq','$qd','$ed','0','$cid[0]','$pid[0]');";
 // $db->myExec($q);
 $_SESSION['setexam']=$q;
 header("Location:P_1.1.1_setQuestion.php?course=$cn&profn=$usr");
}
?>
