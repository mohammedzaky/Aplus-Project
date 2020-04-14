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
        <link rel="stylesheet" href="P_1.2_course/css/bootstrap.css">
        <link rel="stylesheet" href="P_1.2_course/css/rtl.css">
        <link rel="stylesheet" href="P_1.2_course/css/style.css">
        <script src="P_1.2_course/js/jquery.css"></script>
        <script src="P_1.2_course/js/bootstrap.min.js"></script>
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
                        <li class="active"><a href="P_1.2_course.php">Cources</a></li>
                        <li><a href="P_1.3_courseDegrees.php">Enrolled students</a></li>
                        <li class="dropdown" style="margin-right: 10px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span id="userName">
                                    Professor
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
                            <ul class="dropdown-menu">
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
            <div class="srch-up container" style="border-bottom: 0px;">
                <!--<form action="ss.php" method="post">
                    <div class="group-i">
                        <label for="courseName" style="display: inline-block" > Course</label>
                        <select class="form-control" id="courseName" name="courseName">
                        <?php

                     $usr=$_SESSION['ur'];
                     $q1="select Professor_ID from professor where Professor_username='$usr';";
                     $pid=$db->getRow($q1,array());
                     $qsny=" select Semester_ID from semester ORDER BY Semester_ID DESC LIMIT 1;";
                     $sny=$db->getRow($qsny,array());
                     $q2="select Course_ID from semester_course_professor where Professor_ID='$pid[0]' and Semester_ID='$sny[0]';";
                     $cid=$db->getRows($q2,array());
                     $n=$db->getCount($q2,array());
                     for($i=0;$i<$n;$i++)
                     {
                      $er=$cid[$i][0];
                      $q3="select Course_name from course where Course_ID='$er';";
                      $cn=$db->getRow($q3,array());
                       echo '<option>'.$cn[0].'</option>';
                      }
                        ?>
                        </select>
                    </div>
                    <div class="group-i">
                        <label for="term" style="display: inline-block" > Term</label>
                        <select class="form-control" id="term" name="term" value="Summer 2017/2018">
                              <?php

                            $c=0;
                            $qn="select Semester_name from semester ORDER BY Semester_ID DESC LIMIT 1;";
                            $rn=$db->getCount($qn,array());
                            $r1=$db->getRows($qn,array());
                           for($i=1;$i<=$rn;$i++)
                           {
                            $q1="select Semester_year from semester ORDER BY Semester_ID DESC LIMIT 1;";
                            $r2=$db->getRows($q1,array());
                            if($i==1)
                            echo ' <option value="'.$r1[$c][0]." ".$r2[$c][0].'"">'.$r1[$c][0]." ".$r2[$c][0].'</option>';
                            else
                            echo ' <option value="'.$r1[$c][0]." ".$r2[$c][0].'">'.$r1[$c][0]." ".$r2[$c][0].'</option>';
                            $c++;
                           }
                        ?>
                        </select>
                    </div>
                    <div class="group-i">
                        <button type="submit" class="srch btn btn-success" name="sbs" >
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            Search
                        </button>

                    </div>
                </form>-->
            </div>
            <?php
            if(isset($_SESSION['trm']))
            {
            $cn=$_SESSION['cn'];
            $trm=$_SESSION['trm'];
            $pn=$_SESSION['pn'];

          echo   '<table class="table" id="ooo">
                <tr class="clickable-row" data-href="P_1.2.1_exams.php?course='.$cn.'&profn='.$pn.'&trm='.$trm.'" scope="row">
                    <td>
                        <label>'.$cn.'</label>
                    </td>
                    <td>
                        <label>'.$trm.' </label>
                    </td>
                    <td>
                        <label>'.$pn.'</label>
                    </td>
                </tr>
              ';
            }
            else
            {
               $q1="select Professor_ID from professor where Professor_username='$usr';";
               $pid=$db->getRow($q1,array());
               $qsny=" select Semester_ID from semester ORDER BY Semester_ID DESC LIMIT 1;";
               $sny=$db->getRow($qsny,array());
               $qsnn="select Semester_name,Semester_year from semester where Semester_ID='$sny[0]';";
               $snyy=$db->getRows($qsnn,array());
               $q2="select Course_ID from semester_course_professor where Professor_ID='$pid[0]' and Semester_ID='$sny[0]';";
               $cid=$db->getRows($q2,array());
               $n=$db->getCount($q2,array());
               echo  '<table class="table" id="ooo"> ';
               for($i=0;$i<$n;$i++)
               {
                $er=$cid[$i][0];
                $q3="select Course_name from course where Course_ID='$er';";
                $cnn=$db->getRow($q3,array());
                $q1="select Professor_name from professor where Professor_username='$usr';";
                $pnn=$db->getRow($q1,array());
                $nn=$snyy[0][0];
                $yy=$snyy[0][1];
                 echo   '
                <tr class="clickable-row" data-href="P_1.2.1_exams.php?course='.$cnn[0].'&profn='.$pnn[0].'&trm='.$nn.' '.$yy.'" scope="row" style="color:#25556a;">
                    <td>
                        <br>
                        <label >'.$cnn[0].'</label>
                        <br><br>
                    </td>
                    <td>
                        <br>
                        <label style="color: #797979; font-weight: 100;">'.$snyy[0][0].' '.$snyy[0][1].' </label>
                        <br><br>
                    </td>
                    <td>
                        <br>
                        <label style="color: #797979; font-weight: 100;">Professor '.$pnn[0].'</label>
                        <br><br>
                    </td>
                </tr>
             ';

               }
            }
            echo ' </table> ' ;
            ?>
        </div>
        <br><br><br><br><br><br>
        <nav class=" nav navbar-bottom">
        </nav>

          ?>
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
