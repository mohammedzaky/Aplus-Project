<?php
if(isset($_POST['sub']))
{
 include("DB.php");
 $cn=$_POST['cn'];
 $yr=$_POST['yr'];
 $pn=$_POST['pn'];
 $cid=$_POST['cid'];
 $exid=$_POST['exid'];
 $sid=$_POST['sid'];
 $uexid=array_unique($exid);
 $usid=array_unique($sid);
 $lenofexam=sizeof($uexid);
 $lenofstd=sizeof($usid);
 $c=0;
 $k=0;
 $m=0;
 if(isset($_POST['nn']))
 {
 $dgrs=$_POST['nn'];
  for($i=0;$i<$lenofstd;$i++)
 {
  for($j=0;$j<$lenofexam;$j++)
   {
    $dg=$dgrs[$c++];
    $q="UPDATE `student_exam` SET `Student_Exam_degree` = $dg where Student_ID='$usid[$k]' and Exam_ID='$uexid[$m]';";
    $upd=$db->queryOp($q,array());
    $m++;
   }
   $k=$k+$lenofexam;
   $m=0;
 }
 }
header("Location:P_1.3.1_termDegree.php?course=$cn&profn=$pn&trm=$yr");
}
?>