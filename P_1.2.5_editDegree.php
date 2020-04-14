<?php

  session_start();
  include("DB.php");
  if(isset($_SESSION['ur']))
  {
  }
  else
  {
    header("Location:0_login.php");
  }

$cn=$_GET['course'];
$et=$_GET['type'];
$eid=$_GET['id'];
$ed=$_GET['ed'];
$nq=$_GET['qn'];
$dq=$_GET['dq'];
$yr=$_GET['yr'];
$q="select Student_ID from student_exam where Exam_ID='$eid';";
$n=$db->getCount($q,array());
$stdid=$db->getRows($q,array());
?>
<!DOCTYPE html>
<html>
    <head>
        <title> A+ | Professor </title>                           <!--course Title-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="P_1.2.5_editDegree/css/bootstrap.css">
        <link rel="stylesheet" href="P_1.2.5_editDegree/css/rtl.css">
        <link rel="stylesheet" href="P_1.2.5_editDegree/css/style.css">
        <script src="P_1.2.5_editDegree/js/jquery.css"></script>
        <script src="P_1.2.5_editDegree/js/bootstrap.min.js"></script>
    </head>
    <body onload="document.body.style.opacity='1';">
        <nav class="navbar navbar-fixed-top navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand"><img class="navbar-brand" src="img/logo-col-small.png"></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="P_1_home.php">Home</a></li>
                        <li><a href="P_1.1_setExam.php">New exam</a></li>
                        <li class="active"><a href="P_1.2_course.php">Courses</a></li>
                        <li><a href="P_1.3_courseDegrees.php">Enrolled students</a></li>
                        <li class="dropdown" style="margin-right: 10px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span id="userName">
                                    professor
                                </span>
                                <span id="position">
                                    <?php
                                    
                                    include_once("DB.php");
                                    $usr=$_SESSION['ur'];
                                    $q="select Professor_name from professor where Professor_username='$usr';";
                                    $r=$db->getRow($q,array());
                                    echo $r[0];
                                    ?>
                                </span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a onclick="getElementById('popup').style.visibility='visible';">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div align="center" >
            <!--<h4><a href="P_1.2_cources.php" class="title btn">Course name ></a> </h4>--> 
            <div class="container">
            <?php
            $qprn=" select Professor_name from professor where Professor_username='$usr';";
            $pn=$db->getRow($qprn,array());
              echo '  <a href="P_1.2_course.php"><label class="upperTitle" >'.$cn.', '.$yr.' </label></a>
                <br>
                <a href="P_1.2.1_exams.php?course='.$cn.'&profn='.$pn[0].'&trm='.$yr.'"><label class="upperTitle" >'.$et.', '.$nq.' questions, '.$ed.' minutes, '.$dq*$nq.' points </label></a>
            </div>

            <table class="table">
                <form action="P_1.2.4_examDegree.php" > <!--Go to P_1.2.4-->
                    <div class="top_control">
                   <input type="submit" name="eds" class="save btn btn-success " aria-haspopup="true" aria-expanded="false" text-decoration=" none" value="Save">
                    </div>
                    <input type="hidden" value="'.$cn.'" name="course">
                    <input type="hidden" value="'.$et.'" name="type">
                    <input type="hidden" value="'.$eid.'" name="id">
                    <input type="hidden" value="'.$ed.'" name="ed">
                    <input type="hidden" value="'.$nq.'" name="qn">
                    <input type="hidden" value="'.$dq.'" name="dq">
                    <input type="hidden" value="'.$yr.'" name="yr">
                    
                    ';
                    ?>
                    <br>
    <?php
              $qp="select Professor_ID from professor where Professor_username='$usr';";
                $prid=$db->getRow($qp,array());
                $sny=explode(" ",$yr);
               // $qss="select Semester_ID from semester where Semester_name='$sny[0]' and Semester_year='$sny[1]';";
                $qss="select Semester_ID from semester ORDER BY Semester_ID DESC LIMIT 1;";
                $ssid=$db->getRow($qss,array());
                $q2="select Course_ID from course where Course_name='$cn';";
                $cid=$db->getRow($q2,array());
                $qss="select Exam_ID,Exam_Title from exam where Professor_ID='$prid[0]' and Course_ID='$cid[0]';";
                $exid=$db->getRows($qss,array());
                $ne=$db->getCount($qss,array());


    if(count($exid)>0)
    {

        echo
              '
                 <tr class="quesRow" scope="row">
                    <th>
                        <label class="studName"> Student ID </label>
                    </th>
                    <th>
                        <label class="studName"> Student name </label>
                    </th>
                    <th>
                        <label class="degree">'.$et.'</label>
                    </th>
                    ';
                     $ee=$eid;
                     $qsid="select Student_ID,Student_Exam_degree from student_exam where Exam_ID='$ee';";
                     $stdid=$db->getRows($qsid,array());
                     $nstd=$db->getCount($qsid,array());
            if($nstd>0)
            {
                    for($k=0;$k<$nstd;$k++)
                   {
                    $ww=$stdid[$k][0];
                    $qy="select Student_name from student where Student_ID='$ww';";
                    $stdnn=$db->getRow($qy,array());
                    $nui=$db->getCount($qy,array());
                    $uu=$stdid[$k][0];
                    $qynid="select Student_studentID from student where Student_ID='$uu';";
                    $stdID=$db->getRow($qynid,array());
                echo '
                   </tr>
                   <tr>
                   <td>
                        '.$stdID[0].'
                    </td>
                    <td>
                       '.$stdnn[0].'
                     </td> ';
                    if($stdid[$k][1]=="")
                    {
                       echo ' <td>-</td></tr>
                       <input type="hidden" name="dox[]" class=" num form-control" value="NULL">
                       ';
                    }
                    else
                    {
                        echo '<td><input type="number" name="dox[]" class=" num form-control" value="'.$stdid[$k][1].'"></td>';
                    }
                }
                }
            else
            {
                $qSID="SELECT Student_ID from semester_course_student where Semester_ID='$ssid[0]' and Course_ID='$cid[0]';";
                  $SID=$db->getRows($qSID,array());
                  $SIDNUM=$db->getCount($qSID,array());
                  for($j=0;$j<$SIDNUM;$j++)
                  {
                    $RY=$SID[$j][0];
                    $QSTN="select Student_studentID from student where Student_ID='$RY';";
                    $SSID=$db->getRow( $QSTN,array());
                    $QSTNN="select Student_name from student where Student_ID='$RY';";
                    $SSNAM=$db->getRow($QSTNN,array());
                   echo '
                   </tr>
                   <tr>
                   <td>
                        '.$SSID[0].'
                    </td>
                    <td>
                       '.$SSNAM[0].'
                    </td>
                    <td>'."-".'</td> </tr>';
                  }
            }
                }
            ?>
                </form> 
            </table>
        </div>
        <br><br><br><br><br><br>
        <nav class=" nav navbar-bottom">
        </nav>
        
        
                                        <!--poopup-->
        <div id="popup" uib-modal-window="modal-window" class=" popup modal fade ng-scope ng-isolate-scope in" role="dialog" size="sm" index="0" animate="animate" ng-style="{'z-index': 1050 + $$topModalIndex*10, display: 'block'}" tabindex="-1" uib-modal-animation-class="fade" modal-in-class="in" modal-animation="true" style="z-index: 1050; visibility:hidden;display: block;" onchange="document.body.style.opacity='1'";>
            <div class="modal-dialog modal-sm" >
                <div class="modal-content" uib-modal-transclude="">
                    <div class="panel-heading">
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading">Logout</h4>
                                <h5 class="media-heading-down ">Are you sure ? </h5>
                            </div>
                            <div class="media-right">
                                <span class=" glyphicon glyphicon-log-out" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button class=" btn btn-secondary" onclick="getElementById('popup').style.visibility='hidden';">
                            Cancel
                        </button>
                        <button class=" btn btn-success " ng-click="submit()">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
