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
        <link rel="stylesheet" href="P_1.3.1_termDegree/css/bootstrap.css">
        <link rel="stylesheet" href="P_1.3.1_termDegree/css/rtl.css">
        <link rel="stylesheet" href="P_1.3.1_termDegree/css/style.css">
        <script src="P_1.3.1_termDegree/js/jquery.css"></script>
        <script src="P_1.3.1_termDegree/js/bootstrap.min.js"></script>
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
            $pn=$_GET['profn'];
            $trm=$_GET['trm'];
            echo'
                <a href="P_1.3_courseDegrees.php"><label class="upperTitle" >'.$cn.', '.$trm.'</label></a>
                ';
            ?>
            </div>
            <table class="table">
                <div class="top_control">
                <?php
               echo'     <a href="P_1.3.2_editTermDegree.php?course='.$cn.'&year='.$trm.'&pn='.$pn.'" title="Edit">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                          </a>
                        
                     <a onclick="exportTableToCSV(\''.$cn.'-'.$trm.'.csv\')" style="cursor: pointer;" title="Download">
                        <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                    </a>
                    ';
                    ?>
                </div>
                <br>
                <tr class="quesRow" scope="row">
                <?php

                $qp="select Professor_ID from professor where Professor_name='$pn';";
                $prid=$db->getRow($qp,array());
                $sny=explode(" ",$trm);
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
                     $stdID=$db->getRows($qqqq,array());
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
                       echo '<td>-</td>';
                      else
                       echo'     <td>
                         '.$dr[0].'
                    </td>  ';
                     }
                     }
                    }
              echo '  </tr>   ';
              array_push($check,$stdid[$k][0]);
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
</script>
