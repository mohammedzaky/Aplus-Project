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
        <link rel="stylesheet" href="P_1.2.2_exam/css/bootstrap.css">
        <link rel="stylesheet" href="P_1.2.2_exam/css/rtl.css">
        <link rel="stylesheet" href="P_1.2.2_exam/css/style.css">
        <script src="P_1.2.2_exam/js/jquery.css"></script>
        <script src="P_1.2.2_exam/js/bootstrap.min.js"></script>
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
        <div align="center" >
            <!--<h4><a href="P_1.2_cources.php" class="title btn">Course name ></a> </h4>--> 
            <div class="container">
            <?php
            $cn=$_GET['course'];
            $qn=$_GET['qn'];
            $et=$_GET['type'];
            $eid=$_GET['id'];
            $dq=$_GET['dq'];
            $ed=$_GET['ed'];
            $yr=$_GET['yr'];
            $qpn="select Professor_name from professor where Professor_username='$usr';";
            $pn=$db->getRow($qpn,array());
                 echo  ' <a href="P_1.2_course.php"><label class="upperTitle" >'.$cn.', '.$yr.' </label></a>
                         <br>
                        <a href="P_1.2.1_exams.php?course='.$cn.'&profn='.$pn[0].'&trm='.$yr.'"><label class="upperTitle" >'.$et.', '.$qn.' questions, '.$ed.' minutes, '.$qn*$dq.' points </label></a>
                        ';
                ?>
            </div>
            <table class="table">
                <div class="top_control">
                <?php
                  echo '
                    <a href="P_1.2.3_editExam.php?course='. $cn.'&qn='.$qn.'&type='.$et.'&id='.$eid.'&dq='.$dq.'&ed='.$ed.'&yr='.$yr.'" title="Edit">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </a>
                    <a href="P_1.2.4_examDegree.php?course='. $cn.'&qn='.$qn.'&type='.$et.'&id='.$eid.'&dq='.$dq.'&ed='.$ed.'&yr='.$yr.'" title="Degrees">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    ';
                    ?>
                </div>
                <br>
                <?php
                $qq="select * from question where Exam_ID='$eid';";
                $eqs=$db->getRows($qq,array());
               
                $n=$db->getCount($qq,array());
                $c=0;
                $count=1;
                for($i=0;$i<$n;$i++)
                {
                         
                          $MCQ="";
	                      $TF="";
                          $a="";
                          $b="";
                          $cc="";
                          $d="";
                          $t="";
                          $f="";
                          $ans="";
	                   if ( $eqs[$i][6] == "Question_a" ||  $eqs[$i][6] == "Question_b" || $eqs[$i][6] == "Question_c" || $eqs[$i][6] == "Question_d" )
	                   {
	                     $MCQ="cor";
	                     $TF="";
                         
                              if ($eqs[$i][6] == "Question_a" ){
                                    $a="cor";
                                    $ans="a";
                              }
                              else if ($eqs[$i][6] == "Question_b"){
                                    $b="cor";
                                    $ans="b";
                              }
                              else if ($eqs[$i][6] == "Question_c"){
                                    $cc="cor";
                                    $ans="c";
                              }
                              else if ($eqs[$i][6] == "Question_d"){
                                    $d="cor";
                                    $ans="d";
                              }
                              echo '
		                        <tr class="quesRow" scope="row">
		                         <td  style="padding-left :100px;padding-right:100px;">
		                        <label class="quesNumb"> Question '.$count.' </label>
		                        <br>
		                        <label class="q ques"> '.$eqs[$i][1].' </label>
		                        <br><br>
		                        <div style="padding-left :100px;padding-right:100px;">
		                            <label class="'.$a.' a ans"> a.  '.$eqs[$i][2].'</label>
		                            <br>
		                            <label class="'.$b.' a ans"> b.  '.$eqs[$i][3].'</label>
		                            <br>
		                            <label class="'.$cc.' a ans"> c. '.$eqs[$i][4].'</label>
		                            <br>
		                            <label class="'.$d.' ans"> d. '.$eqs[$i][5].'</label>
		                            <br><br>
                                    <!--<label class="a ans"> Answer is '.$ans .'- '.$eqs[$i][6].' </label>-->

		                        </div>
		                    </td>
		                </tr>
		                ';
	                   }
                        else if ( $eqs[$i][6] == "true" || $eqs[$i][6] == "false" ){
                           $MCQ="";
                            $TF="cor";
                            if (  $eqs[$i][6] == "true"){
                                  $t="cor";
                            }
                            else if ($eqs[$i][6] == "false"){
                                $f="cor";
                            }
                             echo '
		                        <tr class="quesRow" scope="row">
                                    <td  style="padding-left :100px;padding-right:100px;">
                                        <label class="quesNumb"> Question '.$count.' </label>
                                        <br>
                                        <label class="q ques"> '.$eqs[$i][1].' </label>
                                        <br><br>
                                        <div style="padding-left :100px;padding-right:100px;">
                                            <label class="'.$t.' a ans"> True </label>
                                            <br>
                                            <label class="'.$f.' a ans"> False </label>
                                            <br><br>
                                            <!--<label class="'.$f.'a ans"> Answer is '.$eqs[$i][6].' </label>-->
                                        </div>
                                    </td>
                                </tr>'
                                ;
                        }


                $c=0;
                $count++;
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
