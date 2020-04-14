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
if(isset($_POST['smex']))
{
include_once("DB.php");
$eid=$_POST['eid'];
$et=$_POST['exam_title'];
$nq=$_POST['numQuestion'];
$cn=$_POST['courseName'];
$dq=$_POST['quesDegree'];
$ed=$_POST['quesTime'];
$yr=$_POST['yr'];
$usr=$_SESSION['ur'];
$q1="select Professor_ID from professor where Professor_username='$usr';";
$pid=$db->getRow($q1,array());
$qsny=" select Semester_ID from semester ORDER BY Semester_ID DESC LIMIT 1;";
$sny=$db->getRow($qsny,array());
$q2="select Course_ID from course where Course_name='$cn';";
$cid=$db->getRow($q2,array());
$q=  "UPDATE `exam` SET `Exam_Title` = '$et' ,`Exam_Q-numbers` = '$nq' , `Exam_Q-degree` = '$dq' , `Exam_duration` = '$ed' , `Exam_active` = '0' , `Course_ID` = '$cid[0]' , `Professor_ID` = '$pid[0]'   WHERE `exam`.`Exam_ID` = '$eid';";
$db->myExec($q);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> A+ | Professor </title>                           <!--course Title-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="P_1.2.6_editQuestion/css/bootstrap.css">
        <link rel="stylesheet" href="P_1.2.6_editQuestion/css/rtl.css">
        <link rel="stylesheet" href="P_1.2.6_editQuestion/css/style.css">
        <script src="P_1.2.6_editQuestion/js/jquery.css"></script>
        <script src="P_1.2.6_editQuestion/js/bootstrap.min.js"></script>
        <script>
       		function TF(val){
	                document.getElementById('ans_a'+val).value="";
	                document.getElementById('ans_b'+val).value="";
	                document.getElementById('ans_c'+val).value="";
	                document.getElementById('ans_d'+val).value="";
                }
        </script>

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

             echo '   <a href="P_1.2_course.php"><label class="upperTitle" >'.$cn.', '.$yr.' </label></a>
                <br>
                <a href="P_1.2.1_exams.php"><label class="upperTitle" >'.$et.', '.$nq.' questions, '.$ed.' minutes, '.$dq*$nq.' points </label></a> ';
                ?>
            </div>
            <table class="table">
             <?php
             $qexm=" select * from question where Exam_Id='$eid';";
             $exam=$db->getRows($qexm,array());

             $et=$_POST['exam_title'];
             $cn=$_POST['courseName'];
             $nn=$_POST['numQuestion'];
             $dq=$_POST['quesDegree'];
             $ed=$_POST['quesTime'];
             $qss="UPDATE `exam` SET `Exam_Q-degree` = '$dq' ,`Exam_Title` = '$et' ,`Exam_Q-numbers` = '$nn' ,`	Exam_duration` = '$ed' WHERE `exam`.`Exam_ID` ='$eid';";
             $upd=$db->queryOp($qss,array());

             echo
                  ' <form action="sd.php" method="post">
                    <div class="top_control">  ';

                    $j=1;
					
                   for($i=0;$i<$nn;$i++)
                   {
	                  $MCQ="";
	                  $TF="";
                          $a="";
                          $b="";
                          $cc="";
                          $d="";
                          $t="";
                          $f="";
						  
						  $aa="";
                          $bb="";
                          $ccc="";
                          $dd="";
                          $tt="";
                          $ff="";
	                   if ( $exam[$i][6] == "Question_a" ||  $exam[$i][6] == "Question_b" || $exam[$i][6] == "Question_c" || $exam[$i][6] == "Question_d" )
	                   {
	                     $MCQ="active";
	                     $TF="";
                              if ($exam[$i][6] == "Question_a" ){
                                   $a="active";
								   $aa="checked";
	                          $b="";
	                          $cc="";
	                          $d="";
	                          $t="";
	                          $f="";
                              }
                              else if ($exam[$i][6] == "Question_b"){
                                  $a="";
								  $bb="checked";
	                          $b="active";
	                          $cc="";
	                          $d="";
	                          $t="";
	                          $f="";
                              }
                              else if ($exam[$i][6] == "Question_c"){
                                   $a="";
								   $ccc="checked";
	                          $b="";
	                          $cc="active";
	                          $d="";
	                          $t="";
	                          $f="";
                              }
                              else if ($exam[$i][6] == "Question_d"){
                                  $a="";
								  $dd="checked";
	                          $b="";
	                          $cc="";
	                          $d="active";
	                          $t="";
	                          $f="";
                              }
	                   }
	                   else {
	                     $MCQ="";
	                     $TF="active";

                             if (  $exam[$i][6] == "true"){
                                  $a="";
								  $tt="checked";
	                          $b="";
	                          $cc="";
	                          $d="";
	                          $t="active";
	                          $f="";
                             }
                             else if ($exam[$i][6] == "false"){
                                  $a="";
								  $ff="checked";
	                          $b="";
	                          $cc="";
	                          $d="";
	                          $t="";
	                          $f="active";
                             }
	                   }
	                    $c=1;

                   echo'
                     <tr class="quesRow" scope="row">
                        <td>                                                <!--href MUST be UNIQIE EVERY ROW-- use here mcq_qX : X number of question>
                                                                            <!-- 1- ((href)) MUST be equal to ((id)) in comment number 3-->
                            <a class="nav-link '.$MCQ.'" onclick="MCQ($i)" id="home-tab" data-toggle="tab" href="#mcq_q'.$i.'" role="tab" aria-controls="home" aria-selected="false">
                            	<input type="button" class="save btn btn-success " aria-haspopup="true" aria-expanded="false" text-decoration=" none" value="Malti-choice">
                            </a>
                            <br>
                                                                            <!--href MUST be UNIQIE EVERY ROW-- use here tf_qX : X number of question>
                                                                            <!-- 2- ((href)) MUST be equal to ((id)) in comment number 4-->
                            <a class="nav-link '.$TF.'" onclick="TF('.$i.')" id="profile-tab" data-toggle="tab" href="#tf_q'.$i.'" role="tab" aria-controls="profile" aria-selected="true">
                                <input type="button" class="save btn btn-success " aria-haspopup="true" aria-expanded="false" text-decoration=" none" value="True & false">
                            </a>
                        </td>
                        <td>
                            <label class="quesNumb"> Question '.$j++.' </label>
                            <br>
                            <TEXTAREA class="form-control" id="ques" name="qs[]" rows=5 cols=250 placeholder="Write a question here"   required>'.$exam[$i][$c++].' </TEXTAREA>
                        </td>
                        <td>
                           <div class="tab-content">
                                                            <!-- 3-  here is ((id)) must be equal to href in comment 1 -->
                                 <div class="tab-pane '.$MCQ.' " id="mcq_q'.$i.'" role="tabpanel" aria-labelledby="home-tab">
                                    <label for="ans_a">
                                        a.
                                    </label>
                                    <input type="text" class="ans form-control" id="ans_a'.$i.'" name="ans_a[]" name="aa" value="'.$exam[$i][$c++].'">
                                    <br>
                                    <label for="ans_b">
                                        b.
                                    </label>
                                    <input type="text" class="ans form-control" id="ans_b'.$i.'" name="ans_b[]"  name="ab" value="'.$exam[$i][$c++].'">
                                    <br>
                                    <label for="ans_c">
                                        c.
                                    </label>
                                    <input type="text" class="ans form-control" id="ans_c'.$i.'" name="ans_c[]"  name="ac" value="'.$exam[$i][$c++].'">
                                    <br>
                                    <label for="ans_d">
                                        d.
                                    </label>
                                    <input type="text" class="ans form-control" id="ans_d'.$i.'" name="ans_d[]"  name="ad"  value="'.$exam[$i][$c++].'">

                                    <br><br><br>
                                    <div class="mcq btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="b btn btn-secondary '.$a.'">
                                          <input type="radio" id="options1" name="opt[]_'.$i.'" name="rd" autocomplete="off" value="Question_a" '.$aa.'> a
                                        </label>
                                        <label class="b btn btn-secondary '.$b.'">
                                          <input type="radio" id="options2" name="opt[]_'.$i.'" name="rd" autocomplete="off" value="Question_b" '.$bb.' > b
                                        </label>
                                        <label class="b btn btn-secondary3 '.$cc.'">
                                          <input type="radio" id="options3" name="opt[]_'.$i.'" name="rd" autocomplete="off" value="Question_c" '.$ccc.'> c
                                        </label>
                                        <label class="b btn btn-secondary '.$d.'">
                                          <input type="radio" id="options4" name="opt[]_'.$i.'" name="rd" autocomplete="off" value="Question_d" '.$dd.'> d
                                        </label>
                                    </div>
                                </div>
                                                    <!-- 4-  here is ((id)) must be equal to href in comment 2 -->
                                <div class="tab-pane '.$TF.'" id="tf_q'.$i.'" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="t_f btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class=" b btn btn-secondary '.$t.'">
                                          <input type="radio" id="options5" name="opt[]_'.$i.'" name="rd" autocomplete="off" value="true" '.$tt.'> True
                                        </label>
                                        <label class="b btn btn-secondary '.$f.'">
                                          <input type="radio" id="options6" name="opt[]_'.$i.'" name="rd" autocomplete="off" value="false" '.$ff.'> False
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <input type="hidden" value="'.$cn.'" name="cn">
                    <input type="hidden" value="'.$et.'" name="et">
                    <input type="hidden" value="'.$eid.'" name="id">
                    <input type="hidden" value="'.$ed.'" name="ed">
                    <input type="hidden" value="'.$nq.'" name="qn">
                    <input type="hidden" value="'.$dq.'" name="dq">
                    <input type="hidden" value="'.$yr.'" name="yr">
                    ';
                    }





                    ?>
                     <input type="submit" name="sr"  class="save btn btn-success " aria-haspopup="true" aria-expanded="false" text-decoration=" none" value="Save">
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
