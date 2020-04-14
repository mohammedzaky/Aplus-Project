<?php
  session_start();
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
        <title> A+ | Professor </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="P_1.1_setExam/css/bootstrap.css">
        <link rel="stylesheet" href="P_1.1_setExam/css/rtl.css">
        <link rel="stylesheet" href="P_1.1_setExam/css/style.css">
        <script src="P_1.1_setExam/js/jquery.css"></script>
        <script src="P_1.1_setExam/js/bootstrap.min.js"></script>
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
                        <li class="active"><a href="P_1.1_setExam.php">New exam</a></li>
                        <li><a href="P_1.2_course.php">Courses</a></li>
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
        <form action="se.php" method="post">
            <center>
                <br><br>
                <div class= "examInfo container">
                    <table class="table" >
                        <tr scope="row">
                            <td>
                                <label for="title" > Exam Title</label>
                                <input type="text" class=" t c course form-control" id="title" min="0" step="15" name="exam_title" required>
                            </td>
                            <td>
                                <label for="numQuestion" > Number of questions</label>
                                <input type="number" min="1" class=" num form-control" id="numQuestion" name="numQuestion" required>
                                
                            </td>
                        </tr>
                        <tr scope="row">
                            <td>
                                <label for="courseName" style="display: inline-block " > Course name</label>
                                <select class="c course form-control" id="courseName" name="courseName">
                                    <?php
                                    include_once("DB.php");
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
                                    echo '<option id="courseName" name="courseName">'.$cn[0].'</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <label for="quesDegree" > Degree for a question</label>
                                <input type="number"  step="0.5"min="0.5" class="num form-control" id="quesDegree" name="quesDegree" required>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="quesTime" > Exam duration (mins) </label>
                                <input type="number"  class=" num form-control" id="quesTime" min="0" name="quesTime" placeholder="minuts"required>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" name="sm" target="P_1.1.1_setQuestion.php" class="b btn btn-success" aria-haspopup="true" aria-expanded="false" text-decoration=" none"  value="Next">
                </div>
            </center>
        </form>
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
