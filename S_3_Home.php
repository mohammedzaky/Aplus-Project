<?php
  session_start();
  include("DB.php");
  if(isset($_SESSION['res']))
  {
    unset($_SESSION['res']);
    unset($_SESSION['std']);
  }
    
  if(isset($_SESSION['std']))
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
        <title> A+ | Home </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="S_3_Home/css/bootstrap.css">
        <link rel="stylesheet" href="S_3_Home/css/rtl.css">
        <link rel="stylesheet" href="S_3_Home/css/style.css">
        <script src="S_3_Home/js/jquery.css"></script>
        <script src="S_3_Home/js/bootstrap.min.js"></script>
    </head>
    <body background="img/background.png" onload="document.body.style.opacity='1'">
        <div class="backfilter"></div>
        <nav class="navbar navbar-fixed-top navbar-default">
            <div class=" pop container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                   <img class="navbar-brand" src="img/logo-white-small.png">
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a onclick="getElementById('popup').style.visibility='visible';">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="navbar ">
            
        </nav>
        <div align="center" >
            <div class=" panel-default">
                <h4 class="welcStud"> Welcome 
<?php 
    
        $q1="select Student_name from student where Student_username = ?;";
        $rows=$db->getRows($q1,array($_SESSION['std']));
          if(count($rows)>0)
            {
              foreach($rows as $r1)
              {
                    echo $r1[0] ; 
              }
            }


        //get the id here 
        $q2="SELECT Student_ID FROM student where Student_username = ?;";
        $rows=$db->getRows($q2,array($_SESSION['std']));
            if(count($rows)>0)
            {
              foreach($rows as $r1)
              {
                    //echo $r1[0]; 
              }
              //echo $r1[0]; 
            }        
            echo "<br>";

            $row=$db->getRows("SELECT Semester_ID , Course_ID from semester_course_student WHERE Student_ID =?" ,array($r1[0])); 

            if(count($row)>0)
            {
                  foreach($row as $r2)
                  {
                        //echo $r2[0]."  ".$r2[1];
                        // $r2[0] - > semster_ID
                        // $r2[1] - > course_ID
                  }

            }
            //[1] get semeter info
            $row2=$db->getRows("SELECT Semester_name ,Semester_year FROM semester where Semester_ID = ?" ,array($r2[0])); 
            
            if(count($row2)>0)
            {
                  foreach($row2 as $row)
                  {

                  }

            }
            //[2] get course info
            $row_course=$db->getRows("SELECT Course_name FROM course where Course_ID = ?;" ,array($r2[1])); 
            
            if(count($row_course)>0)
            {
                  foreach($row_course as $c)
                  {

                  }

            }
            //[3] get professor info [id]

            $row_prof=$db->getRows("SELECT Professor_ID FROM semester_course_professor WHERE Semester_ID = ? and Course_ID = ?" ,array($r2[0],$r2[1])); 
            
            if(count($row_prof)>0)
            {
                  foreach($row_prof as $p)
                  {
                    
                  }

            }
            else
            $p = 0;


            //[4] get exam info 
            $row_exam=$db->getRows("SELECT Exam_Title FROM exam WHERE Course_ID = ? and Professor_ID = ? and Exam_active = ?",array($r2[1],$p[0],'1')); 
          


       if(count($row_exam)>0)
            {

                  foreach($row_exam as $ex)
                  {
                      
                  }


            //get exam id 
            $rows_exam_id=$db->getRows("SELECT Exam_ID  FROM exam WHERE Course_ID = ? and Professor_ID = ? and Exam_Title = ?",array($r2[1],$p[0],$ex[0])); 



             if(count($rows_exam_id)>0)
                {
                   
                   
                    
                      foreach($rows_exam_id as $ex_id)
                      {

                            //echo $ex_ac[0];
                      }

                      //
                    
                }
              }
              else
              {
               $ex_id=0;
              }



            //check if the student get back
            $st_ex_deg=$db->getRows(" SELECT Student_Exam_degree FROM student_exam WHERE Student_ID = ? and Exam_ID = ?",array($r1[0],$ex_id[0]));

            if(count($st_ex_deg)>0)
                {

                      foreach($st_ex_deg as $deg)
                      {


                      }

                }

              if(count($st_ex_deg)==0) {$deg = array(); $deg[0]=null;}
              
/*----------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

            if(count($row_exam)>0 && $deg[0] === null)
            {

                  foreach($row_exam as $ex)
                  {
                      
                  }


            //get exam id 
            $rows_exam_id=$db->getRows("SELECT Exam_ID  FROM exam WHERE Course_ID = ? and Professor_ID = ? and Exam_Title = ?",array($r2[1],$p[0],$ex[0])); 



             if(count($rows_exam_id)>0)
                {
                   
                   
                    
                      foreach($rows_exam_id as $ex_id)
                      {

                            //echo $ex_ac[0];
                      }

                      //
                    
                }
            
            echo "
                  </h4>

                  <h6 class=\"welcStud\"> <span>$c[0], $row[0]  $row[1]</span></h6>
                  <br>
                  <a href=\"S_3.1_answer.php?sname=$row[0]&syear=$row[1]&cname=$c[0]&exam_id=$ex_id[0]&stuid=$r1[0]\" class=\" bt btn btn-squared-default-plain \" style=\" width:auto;min-width:150px;\">
                      <span class=\"ButtonTitle glyphicon\" aria-hidden=\"true\">$ex[0]</span>
                      <br>
                      <span class=\"glyphicon-class\">$c[0]</span>
                  </a>
              ";

            }
            else
            {

                 echo "
                    </h4>

                    <h4 class=\"welcStud\"> <span>$row[0]  $row[1]</span></h4>
                    <br>
                  
                ";

            }

            
       
        ?>        
            </div>
        </div>

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
                        <input type="submit" name="sub" value="logout" class=" btn btn-success "  >
             </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

