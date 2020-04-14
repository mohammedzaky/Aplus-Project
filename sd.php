<?php
session_start();
include("DB.php");
if(isset($_POST['sr']))
{
    $cn=$_POST['cn'];
    $et=$_POST['et'];
    $eid=$_POST['id'];
    $ed=$_POST['ed'];
    $nq=$_POST['qn'];
    $dq=$_POST['dq'];
    $yr=$_POST['yr'];
   $q=$_POST['qs'];
   $an_a=$_POST['ans_a'];
   $an_b=$_POST['ans_b'];
   $an_c=$_POST['ans_c'];
   $an_d=$_POST['ans_d'];
  // $n=$_POST['con'];
   $cn=$_POST['cn'];
  // $pn=$_POST['pn'];
   if(isset($_POST['opt']))
   $rans=$_POST['opt'];
   $qqs="select Question_ID from question where Exam_ID='$eid';";
   $qst=$db->getRows($qqs,array());
   $qsn=$db->getCount($qqs,array());
  // echo $q[0]." ".$an_a[0]." ".$an_b[0]." ".$an_c[0].$an_d[0]." ".$rans[0]." ".$eid." ".$qst[0][0];
   for($i=0;$i<$qsn;$i++)
   {
     $ww=$qst[$i][0];
    $qss="UPDATE `question` SET `Question_name` = '$q[$i]' ,`Question_a` = '$an_a[$i]' ,`Question_b` = '$an_b[$i]' ,`Question_c` = '$an_c[$i]' , `Question_d`='$an_d[$i]' , Question_answer='$rans[$i]'  WHERE `Exam_ID` ='$eid' and `Question_ID`='$ww' ;";
    echo $qss;
    $upd=$db->queryOp($qss,array());
   }
   header("Location:P_1.2.2_exam.php?course=$cn&qn=$nq&type=$et&id=$eid&&dq=$dq&ed=$ed&yr=$yr");
   }
?>
