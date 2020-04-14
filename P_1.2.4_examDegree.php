<?php
include("DB.php");
session_start();
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
$yr=$_GET['yr'];
$dq=$_GET['dq'];
$q="select Student_ID from student_exam where Exam_ID='$eid';";
$n=$db->getCount($q,array());
$n1=$n;
$stdid=$db->getRows($q,array());
if(isset($_GET['dox']))
{
$doo=$_GET['dox'];
for($i=0;$i<$n;$i++)
{   $dup=$stdid[$i][0];
    $up="UPDATE `student_exam` SET `Student_Exam_degree` = $doo[$i] where Student_ID='$dup' and Exam_ID='$eid';";
    $db->myExec($up);
}
 }
if(isset($_POST['submit5']))
{
    $examid=$_POST['examID'];
    $stdsid=$_POST['studID'];
    if($stdsid=="")
    {
        $qofallnull=" UPDATE student_exam SET Student_Exam_degree =NULL , Session_time=NULL where Exam_ID='$examid';";
        $db->myExec($qofallnull);
    }
    else
    {
        $qofstd=" UPDATE student_exam SET Student_Exam_degree =NULL , Session_time=NULL where Exam_ID='$examid' and Student_ID='$stdsid';";
        $db->myExec($qofstd); 
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> A+ | Professor </title>                           <!--course Title-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="P_1.2.4_examDegree/css/bootstrap.css">
        <link rel="stylesheet" href="P_1.2.4_examDegree/css/rtl.css">
        <link rel="stylesheet" href="P_1.2.4_examDegree/css/style.css">
        <script src="P_1.2.4_examDegree/js/jquery.css"></script>
        <script src="P_1.2.4_examDegree/js/bootstrap.min.js"></script>
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

            echo'    <a href="P_1.2_course.php"><label class="upperTitle" > '.$cn.', '.$yr.'</label></a>
                <br>
                <a href="P_1.2.1_exams.php?course='.$cn.'&profn='.$pn[0].'&trm='.$yr.'">
                <label class="upperTitle" >'.$et.', '.$nq.' questions, '.$ed.' minutes, '.$dq*$nq.' points </label></a> ';
                ?>
            </div>
            <table class="table">
                <div class="top_control">
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
                $exid=$db->getRow($qss,array());
                $ne=$db->getCount($qss,array());
                /////////////////////////////////////////////////////////////////////////////
                
                $exmid=$eid;
                $qstdid="select Student_ID from student_exam where Exam_ID='$exmid';";
                $stdsid=$db->getRows( $qstdid,array());
                //$strstid=implode(" ",$stdsid);

    if(count($exid)>0)
    {

        echo
              ' <a href="P_1.2.5_editDegree.php?&course='.$cn.'&type='.$et.'&id='.$eid.'&ed='.$ed.'&qn='.$nq.'&dq='.$dq.'&yr='.$yr.'" title="Edit">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </a>
                    <a onclick="exportTableToCSV(\''.$et.'-'.$cn.'-'.$yr.'.csv\')" style="cursor: pointer;" title="Download">
                        <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                    </a>

                    <a data-toggle="modal" onclick="resetDegreesPopupp(\''.$exmid.'\');"data-target="#resetDegreesPopup" style="cursor: pointer;" title="Reset">
                        <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>
                        
                    </a>

                    
                </div>
                <br>
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
                    <th>
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
                        '. $stdID[0].'
                    </td>
                    <td>
                       '.$stdnn[0].'
                    </td> ';
                    if($stdid[$k][1]=="")
                    {
                       echo '   <td> - </td>
                                <td>
                                 <!--<a data-toggle="modal" onclick="resetDegreesPopup(\''.$stdid[$k][0].'\',\''.$ee.'\');"data-target="#resetDegreesPopup" style="cursor: pointer;" >
                                     <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>
                                 </a>-->
                                </td>
                            </tr>';
                    }
                    else
                    {
                        echo ' <td>'.$stdid[$k][1].'</td>
                                <td>
                                    <a data-toggle="modal" onclick="resetDegreesPopup(\''.$stdid[$k][0].'\',\''.$ee.'\');"data-target="#resetDegreesPopup" style="cursor: pointer;" >
                                        <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>';
                    }
                }
                }
                }
                    ?>
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
        <!--  reset degreed -->
        <div class="modal fade" id="resetDegreesPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <form method="post">
                <div class="modal-content">
                  <div class="modal-body">
                      Are you sure you want to reset degrees ?
                  </div>
                  <div class="modal-footer">
                      <input id="studID" name="studID" type="hidden" value="">
                      <input id="examID" name="examID" type="hidden" value="">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-success" name="submit5" >
                        Reset
                      </button>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </body>
</html>

<script>
           function downloadCSV(csv, filename) {
                    var csvFile;
                    var downloadLink;

                    // CSV file
                    csvFile = new Blob([csv], {type: "text/csv"});

                    // Download link
                    downloadLink = document.createElement("a");

                    // File name
                    downloadLink.download = filename;

                    // Create a link to the file
                    downloadLink.href = window.URL.createObjectURL(csvFile);

                    // Hide download link
                    downloadLink.style.display = "none";

                    // Add the link to DOM
                    document.body.appendChild(downloadLink);

                    // Click download link
                    downloadLink.click();
            }



            function exportTableToCSV(filename) {
                    var csv = [];
                    var rows = document.querySelectorAll("table tr");

                    for (var i = 0; i < rows.length; i++) {
                        var row = [], cols = rows[i].querySelectorAll("td, th");

                        for (var j = 0; j < cols.length; j++)
                            row.push(cols[j].innerText);

                        csv.push(row.join(","));
                }

                // Download CSV file
                downloadCSV(csv.join("\n"), filename);
            }
            function resetDegreesPopupp(examID){
                //alert(studID);
                //alert(examID);
                $("#examID").val(examID);
                
            }
            function resetDegreesPopup(studID, examID){
                //alert(studID);
                //alert(examID);
                $("#studID").val(studID);
                $("#examID").val(examID);
                
            }


    </script>
