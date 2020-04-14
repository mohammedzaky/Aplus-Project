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
?>
<!DOCTYPE html>
<html>
    <head>
        <title> A+ | Professor </title>                           <!--course Title-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="P_1.3.2_editTermDegree/css/bootstrap.css">
        <link rel="stylesheet" href="P_1.3.2_editTermDegree/css/rtl.css">
        <link rel="stylesheet" href="P_1.3.2_editTermDegree/css/style.css">
        <script src="P_1.3.2_editTermDegree/js/jquery.css"></script>
        <script src="P_1.3.2_editTermDegree/js/bootstrap.min.js"></script>
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
                        <li><a href="P_1.2_course.php">Courses</a></li>
                        <li class="active"><a href="P_1.3_courseDegrees.php">Enrolled students</a></li>
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
            $cn=$_GET['course'];
            $yr=$_GET['year'];
            $year=$yr;
            $pn=$_GET['pn'];
             echo    ' <a href="P_1.3_courseDegrees.php"><label class="upperTitle" >'.$cn.' , '.$year.'</label></a>
            </div>
            
            ';
            

             echo '<table class="table">

               <form action="up.php" method="post"> <!--Go to 1.3.1 -->
                    <div class="top_control">

                   <input type="submit" name="sub"  class="save btn btn-success " aria-haspopup="true" aria-expanded="false" text-decoration=" none" value="Save">
                    </div>  ';

                $qp="select Professor_ID from professor where Professor_name='$pn';";
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
                 $check=array();
                $check1=array();
                 $check2=array();
               if(count($exid)>0)
                  {
                   echo'
                    <th>
                        <label class="studName"> Student ID </label>
                    </th>
                    <th>
                        <label class="studName"> Student Name </label>
                    </th> ';
                    for($j=0;$j<$ne;$j++)
                    {
                    echo '
                    <th>
                        <label class="degree">'.$exid[$j][1].'</label>
                    </th>
                    ';
                    }

                     for($i=0;$i<$ne;$i++)
                    {
                     $ee=$exid[$i][0];
                     $qsid="select Student_ID,Student_Exam_degree from student_exam where Exam_ID='$ee';";
                     $stdid=$db->getRows($qsid,array());
                     $nstd=$db->getCount($qsid,array());
                     $qqqq="select Student_ID from semester_course_student where Semester_ID='$ssid[0]' and Course_ID='$cid[0]';";
                     $nnn=$db->getCount($qqqq,array());
                   if($nstd>0)
                 {   
                    for($k=0;$k<$nstd;$k++)
                   {
                    $ww=$stdid[$k][0];
                    $qy="select Student_name from student where Student_ID='$ww';";
                    $stdnn=$db->getRow($qy,array());
                    $nui=$db->getCount($qy,array());
                echo '
                   </tr>
                   <tr>';

                   if(!in_array($stdid[$k][0],$check1))
                   {
                    $er=$stdid[$k][0];
                    $qrstid="select Student_studentID from student where Student_ID='$er';";
                    $stdID=$db->getRow($qrstid,array());
                     echo ' <td>
                        '.$stdID[0].'
                   </td> ';
                   array_push($check1,$stdid[$k][0]);
                    }
                    if(!in_array($stdnn[0],$check2))
                    {
                    echo '
                    <td>
                       '.$stdnn[0].'
                    </td>
                    ';
                    array_push($check2,$stdnn[0]);
                    }
                    for($q=0;$q<$ne;$q++)
                    {
                        
                  echo ' <input type="hidden" name="exid[]" value='.$exid[$q][0].'>
                      <input type="hidden" name="sid[]" value='.$stdid[$k][0].'> ';
                     $eee=$exid[$q][0];
                     $www=$stdid[$k][0];
                     $qsidd="select Student_Exam_degree from student_exam where Exam_ID='$eee' and Student_ID='$www' ;";
                     $stdidd=$db->getRows($qsidd,array());
                     $nstdd=$db->getCount($qsidd,array());
                     foreach($stdidd as $dr)
                     {
                     if(!in_array($stdid[$k][0],$check))
                     {
                      if($dr[0]=="")
                      {
                       echo '<td>-</td>
                        <input type="hidden" name="nn[]"  class=" num form-control" value="NULL"> 
                       ';
                      }
                      else
                      {
                       echo'     <td>
                         <input type="number" name="nn[]" class=" num form-control" value="'.$dr[0].'">
                    </td>  ';
                      }
                     }
                     }
                    }
              echo '  </tr>   ';
              array_push($check,$stdid[$k][0]);
                   }
                }
                }
            }
                 echo '
                            <input type="hidden" name="cid" value="'.$cid[0].'">
                            <input type="hidden" name="cn" value="'.$cn.'">
                            <input type="hidden" name="yr" value="'.$year.'">
                            <input type="hidden" name="pn" value="'.$pn.'">
                    ';
                ?>
                    </tr>
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
                     <form action="logout.php" >
                        <input type="button" onclick="getElementById('popup').style.visibility='hidden';" class=" btn btn-secondary" value="cancel">
			<input type="submit" name="sub" value="logout" class=" btn btn-success " >
			 </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
