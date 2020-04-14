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

if(isset($_POST['sub']))
{
 include_once("DB.php");
 $EXIDD=$_POST['eid'];
 $nofex=$_POST['nofex'];
 $cid=$_POST['cid'];
 $pid=$_POST['pid'];
 $ww=$_POST['w'];

 $q3="select `Exam_ID`, `Exam_Title`, `Exam_Q-numbers`, `Exam_Q-degree`, `Exam_duration`, `Exam_active` from exam where Course_ID='$cid' and Professor_ID='$pid';";
 $eid=$db->getRows($q3,array());
 $en=$db->getCount($q3,array());
 for($i=0;$i<$en;$i++)
 {
 $ww=$eid[$i][0];
 $qea="UPDATE exam set Exam_active='0' where Exam_ID='$ww';" ;
 $db->myExec($qea);
 }
$qeac="UPDATE exam set Exam_active='1' where Exam_ID='$EXIDD';" ;
 $db->myExec($qeac);
}
if(isset($_POST['sub2']))
{
       include_once("DB.php");
       $EXIDD=$_POST['eid'];
       $nofex=$_POST['nofex'];
       $cid=$_POST['cid'];
       $pid=$_POST['pid'];
       $ww=$_POST['w'];
      
      
       
       $qeac="UPDATE exam set Exam_active='0' where Exam_ID='$EXIDD';" ;
       $db->myExec($qeac);
}
if(isset($_POST['submit3']))
{
 include_once("DB.php");
 $exxmid=$_POST['DEL_popup_hidden_exam_ID'];
 $crsid=$_POST['DEL_popup_hidden_course_ID'];
 $qdel="delete from exam where Exam_ID='$exxmid';";
 $db->queryOp( $qdel,array());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> A+ | Professor </title>                           <!--course Title-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="P_1.2.1_exams/css/bootstrap.css">
        <link rel="stylesheet" href="P_1.2.1_exams/css/rtl.css">
        <link rel="stylesheet" href="P_1.2.1_exams/css/style.css">
        <script src="P_1.2.1_exams/js/jquery.css"></script>
        <script src="P_1.2.1_exams/js/bootstrap.min.js"></script>
        <script>
            function delID(exam_ID, course_ID){
              document.getElementById("DEL_popup_hidden_exam_ID").value=exam_ID;
              document.getElementById("DEL_popup_hidden_course_ID").value=course_ID;
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
                <a href="P_1.2_course.php"><label class="upperTitle" >
                <?php

                        $pn=$_GET['profn'];
                        $cn=$_GET['course'];
                        $trm=$_GET['trm'];
                        echo $cn.", ".$trm;
                ?>
                </label></a>
            </div>
            <table class="table">
             <?php
                       $q1="select Professor_ID from professor where Professor_name='$pn';";
                       $pid=$db->getRow($q1,array());
                       $sny=explode(" ",$trm);
                       $qss="select Semester_ID from semester where Semester_name='$sny[0]' and Semester_year='$sny[1]';";
                       $ssid=$db->getRow($qss,array());
                       $q2="select Course_ID from course where Course_name='$cn';";
                       $cid=$db->getRow($q2,array());
                       $q3="select `Exam_ID`, `Exam_Title`, `Exam_Q-numbers`, `Exam_Q-degree`, `Exam_duration`, `Exam_active` from exam where Course_ID='$cid[0]' and Professor_ID='$pid[0]';";
                       $eid=$db->getRows($q3,array());
                       $en=$db->getCount($q3,array());
                       
                       $qaexid="SELECT Exam_ID from exam where Exam_active='1' and Course_ID='$cid[0]';";
                       $actexamid=$db->getRow($qaexid,array());
                     
                        $c=1;
                        $w=1;
                         for($i=0;$i<$en;$i++)
                         {
                          
                             if ( $actexamid[0] != $eid[$i][0]){
                              echo '
                                  <tr class="click-row">
                                   <td  width="20%">
                                       
                                           <br><br>
                                       <form method="post">
                                           <button type="submit" name="sub" class=" b btn_p btn" id="op_'.$w.'" onclick="func(\'op_'.$w.'\');">
                                             <input class="op" type="radio" name="options" style="position: absolute;clip: rect(0, 0, 0, 0);" id="option_'.$w.'" autocomplete="" > Enable
                                             <input type="hidden" name="eid" value="'.$eid[$i][0].'" >
                                             <input type="hidden" name="nofex" value="'.$en.'" >
                                             <input type="hidden" name="cid" value="'.$cid[0].'" >
                                             <input type="hidden" name="pid" value="'.$pid[0].'" >
                                              <input type="hidden" name="w" value="'.$w.'" >
                                           </button>
                                       </form> 
      
                                   </td>
                                   <td onclick="window.location.href=\'P_1.2.2_exam.php?course='. $cn.'&qn='.$eid[$i][2].'&type='.$eid[$i][1].'&id='.$eid[$i][0].'&dq='.$eid[$i][3].'&ed='.$eid[$i][4].'&yr='.$trm.'\';">
                                       <br>
      
                               <label class="title">
                                '.$eid[$i][1].'
                                </label>
      
                              <br>
                              <label class="info" >'.$eid[$i][2].' questions, '.$eid[$i][4].' minutes <br>'.$eid[$i][2]*$eid[$i][3].' points </label>
                              <br>
                          </td>
                          <td >
                              <a title="Edit" href="P_1.2.3_editExam.php?course='. $cn.'&qn='.$eid[$i][2].'&type='.$eid[$i][1].'&id='.$eid[$i][0].'&dq='.$eid[$i][3].'&ed='.$eid[$i][4].'&yr='.$trm.'">
                                  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                              </a>
                              <br><br>
                              <a title="Degrees" href="P_1.2.4_examDegree.php?course='. $cn.'&qn='.$eid[$i][2].'&type='.$eid[$i][1].'&id='.$eid[$i][0].'&dq='.$eid[$i][3].'&ed='.$eid[$i][4].'&yr='.$trm.'">
                                  <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                              </a>
                              <br><br>
                              <a title="Remove" data-toggle="modal" onclick="delID(\''.$eid[$i][0].'\',\''.$cid[0].'\');" data-target="#deletePopup">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                              </a>
                          </td>
                      </tr>     ';
                             }
                             else{
                               echo '
                                  <tr class="click-row">
                                   <td  width="20%">
                                       
                                           <br><br>
                                       <form method="post">
                                           <button type="submit" name="sub2" class="active b btn_p btn" id="op_'.$w.'" onclick="func(\'op_'.$w.'\');">
                                             <input class="op" type="radio" name="options" style="position: absolute;clip: rect(0, 0, 0, 0);" id="option_'.$w.'" autocomplete="" checked> Disable
                                             <input type="hidden" name="eid" value="'.$eid[$i][0].'" >
                                             <input type="hidden" name="nofex" value="'.$en.'" >
                                             <input type="hidden" name="cid" value="'.$cid[0].'" >
                                             <input type="hidden" name="pid" value="'.$pid[0].'" >
                                             <input type="hidden" name="w" value="'.$w.'" >
                                           </button>
                                       </form> 
      
                                   </td>
                                   <td onclick="window.location.href=\'P_1.2.2_exam.php?course='. $cn.'&qn='.$eid[$i][2].'&type='.$eid[$i][1].'&id='.$eid[$i][0].'&dq='.$eid[$i][3].'&ed='.$eid[$i][4].'&yr='.$trm.'\';">
                                       <br>
      
                               <label class="title">
                                '.$eid[$i][1].'
                                </label>
      
                              <br>
                              <label class="info" >'.$eid[$i][2].' questions, '.$eid[$i][4].' minutes <br>'.$eid[$i][2]*$eid[$i][3].' points </label>
                              <br>
                          </td>
                          <td >
                              <a title="Edit" href="P_1.2.3_editExam.php?course='. $cn.'&qn='.$eid[$i][2].'&type='.$eid[$i][1].'&id='.$eid[$i][0].'&dq='.$eid[$i][3].'&ed='.$eid[$i][4].'&yr='.$trm.'">
                                  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                              </a>
                              <br><br>
                              <a title="Degrees" href="P_1.2.4_examDegree.php?course='. $cn.'&qn='.$eid[$i][2].'&type='.$eid[$i][1].'&id='.$eid[$i][0].'&dq='.$eid[$i][3].'&ed='.$eid[$i][4].'&yr='.$trm.'">
                                  <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                              </a>
                              <br><br>
                              <a title="Remove" data-toggle="modal" onclick="delID(\''.$eid[$i][0].'\',\''.$cid[0].'\');" data-target="#deletePopup">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                              </a>
                          </td>
                      </tr>     <br><br>';
                             }
                $w++;
                
                }


                ?>
            </table>
            
        </div>
        <br><br><br><br><br><br>
        <nav class=" nav navbar-bottom"></nav>


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
        
        <!--delete popup-->
        <div class="modal fade" id="deletePopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <form  method="POST">
                  <div class="modal-body">
                      Are You sure you want to remove this exam ?
                  </div>
                  <input id="DEL_popup_hidden_exam_ID" name="DEL_popup_hidden_exam_ID" type="hidden" value="">
                  <input id="DEL_popup_hidden_course_ID" name="DEL_popup_hidden_course_ID" type="hidden" value="">
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-success" name="submit3">Remove</button>
                  </div>
                 </form> 
              </div>
            </div>
        </div>
        <script>
            function func( temp ){
                var t = '#'+temp;
                //console.log(t);
                for ( var i =1 ; i<<?php echo $w;?> ; i++){
                    var tt = '#op_'+i;
                    //console.log(tt);
                    $(tt).removeClass("active");
                    $(tt).removeAttr("checked");
                }
                $(t).addClass("active");
                $(t).attr("checked");
            }

        </script>
    </body>
</html>
