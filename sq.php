  <?php
  session_start();
  include("DB.php");
  if(isset($_POST['sb']))
  {
   $qosetexam=$_SESSION['setexam'];
   $db->myExec($qosetexam);
   
   $q=$_POST['qs'];
   $an_a=$_POST['ans_a'];
   $an_b=$_POST['ans_b'];
   $an_c=$_POST['ans_c'];
   $an_d=$_POST['ans_d'];
   $n=$_POST['con'];
   $cn=$_POST['cn'];
   $pn=$_POST['pn'];
   if(isset($_POST['opt']))
   $rans=$_POST['opt'];

   $qcid="select Course_ID from course where Course_name='$cn';";
   $cid=$db->getRow($qcid,array());
   $qs="select Exam_ID from exam where Course_ID='$cid[0]' ORDER BY Exam_ID DESC LIMIT 1;";
   $leid=$db->getRow($qs,array());
   
   //echo $leid[0];
   
   $qsny=" select Semester_ID from semester  ORDER BY Semester_ID DESC LIMIT 1;";
   $LSID=$db->getRow($qsny,array());
   /*$qin="INSERT INTO `question` (`Question_name`, `Question_a`, `Question_b`, `Question_c`, `Question_d`, `Question_answer`, `Exam_ID`)
    VALUES    */
    for($i=0;$i<$n;$i++)
    {
      $qs=$q[$i]; $a=$an_a[$i]; $b=$an_b[$i]; $c=$an_c[$i]; $d=$an_d[$i]; $ra=$rans[$i];
       $qin="INSERT INTO `question` (`Question_name`, `Question_a`, `Question_b`, `Question_c`, `Question_d`, `Question_answer`, `Exam_ID`)
             VALUES ('$qs','$a','$b','$c','$d','$ra','$leid[0]');";
       $db->myExec($qin);
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     $qSID="SELECT Student_ID from semester_course_student where Semester_ID='$LSID[0]' and Course_ID='$cid[0]';";
     $SID=$db->getRows($qSID,array());
     $SIDNUM=$db->getCount($qSID,array());
      for($j=0;$j<$SIDNUM;$j++)
        {
          $RY=$SID[$j][0];
          $QINS="INSERT INTO `student_exam` (`Student_ID`,`Exam_ID`) VALUES ('$RY','$leid[0]');";
           $db->myExec($QINS);
        }
   $qsny=" select Semester_name,Semester_year from semester  ORDER BY Semester_ID DESC LIMIT 1;";
   $sny=$db->getRow($qsny,array());
   $pp="select Professor_name from professor where Professor_username='$pn';";
   $pr=$db->getRow($pp,array());
   header("Location:P_1.2.1_exams.php?course=$cn&profn=$pr[0]&trm=$sny[0] $sny[1]");
  }
  ?>


