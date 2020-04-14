<?php
  session_start();
  include("DB.php");
  if(isset($_SESSION["res"]))
  {
    header("Location:S_3_Home.php");
  }
  else
  {
    
  }
  
  if(isset($_SESSION['std']))
  {

    if(isset($_GET['sname']))
      {

        
        $sname=$_GET['sname'];

      } 
      if(isset($_GET['syear']))
      {


        $syear=$_GET['syear'];
        

      }
      if(isset($_GET['cname']))
      {

        $cname=$_GET['cname'];

      }
      if(isset($_GET['exam_id']))
      {

        $exam_id=$_GET['exam_id'];

      }

     if(isset($_GET['stuid']))
      {

        $stuid=$_GET['stuid'];

      }

         $_SESSION['data'] = date('Y-m-d H:i:m');
         $start_time =$_SESSION['data'];

         



         $rows_time=$db->getRows("SELECT Session_time FROM student_exam WHERE Student_ID = ? and Exam_ID = ?",array($stuid,$exam_id));

        if(count($rows_time)> 0 )
          {

            foreach ($rows_time as $rt) {
              
              if($rt[0] === null)
                
                {
            
                    $db->queryOp("UPDATE `student_exam` SET Session_time = ? WHERE `student_exam`.`Student_ID` = ? AND `student_exam`.`Exam_ID` = ?",array($start_time,$stuid,$exam_id));


               }

               else
               {

                    $start_time=$rt[0];
               }


              }


          }
         
  }
      else
      {
        header("Location:0_login.php");
      }



?>


<!DOCTYPE html>
<html>
    <head>
        <title> A+ | Exam </title>                           <!--course Title-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="S_3.1_answer/css/bootstrap.css">
        <link rel="stylesheet" href="S_3.1_answer/css/rtl.css">
        <link rel="stylesheet" href="S_3.1_answer/css/style.css">
        <script src="S_3.1_answer/js/jquery.css"></script>
        <script src="S_3.1_answer/js/bootstrap.min.js"></script>
        
    </head>
    <body onload="document.body.style.opacity='1';">
     
    <?php

    // put time value 


     $rows_time=$db->getRows("UPDATE `student_exam` SET Session_time = ? WHERE `student_exam`.`Student_ID` = ? AND `student_exam`.`Exam_ID` = ?",array($start_time,$stuid,$exam_id));


     $rows_d=$db->getRows("SELECT `Exam_Q-degree` FROM exam where Exam_ID = ?",array($exam_id));

     foreach ($rows_d as $r) {}   



    ?>
    <form class="form" name="examform" id="examform" action="s_3.2_result.php" method="POST"><!--S_3.2_result.php-->  
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
                        <li>
                            <a class="countDown">
                                <input class="countDownText" style="text-align: right;" name="minutes" id="minutes" type="text" >
                                <span class="countDownText">:</span>
                                <input class="countDownText" style="text-align: left;" name="seconds" id="seconds" type="text" >
                            </a>
                        </li>
                        <a class="submitButton btn btn-success "data-toggle="modal" data-target="#exampleModalCenter">
                            Submit
                        </a>
                    </ul>
                </div>
            </div>
        </nav>
        <div align="center">
            <?php
                       $no_secs=$db->getRow("SELECT Exam_duration FROM exam WHERE Exam_ID = ?",array($exam_id)); 
            
            foreach ($no_secs as $time) {
            
            }

            $rows_no=$db->getRows("SELECT Question_ID , Question_name , Question_a ,Question_b, Question_c , Question_d , Question_answer FROM question WHERE Exam_ID = ?",array($exam_id)); 
            $count_questions=0;


            if(count($rows_no)>0){

                foreach ($rows_no as $c) {      }
                                
            }


           
?>           



<?php      
    
     $rows_q=$db->getRows("SELECT `Exam_Q-numbers` , `Exam_Q-degree` FROM exam where Exam_ID = ?",array($exam_id)); 

     foreach ($rows_q as $q) {

        
     }

     $total_points = $q[0]*$q[1];
    
    echo "      
            <div class=\"container\">
              
                <label class=\"upperTitle\" >


                       
                     $sname $syear,  $cname, $q[0] question, $total_points points 

                </label>
            </div>
             <div class=\"\">  
             <br><br>
                <table class=\"table\">
            ";

?>
        <!--time now-->
        <input type="hidden" id="timeNow">
        <br>
        <!--session time DB-->
        <input type="hidden" id="session_time" name="session_time" value="<?php echo $start_time; ?>">
        <br>
        <!--time in JS-->
        <input type="hidden" id="JS" name="JS" >
        <br>
        <!--exam duration--> 
        <input type="hidden" id="examDuration" name="examDuration" value="<?php echo $no_secs[0]; ?>">
        <script>
        
            //var d= new Date();
            //var n = d.getHours()+':'+d.getMinutes()+':'+d.getSeconds(); // time now
            //document.getElementById('timeNow').value=d.toTimeString();
            //
            //
            //var sesstion = document.getElementById('session_time').value; // session Time
            //
            var startDate = new Date();
            document.getElementById('timeNow').value=startDate;
            // Do your operations
            //console.log(startDate);
            var endDate   = new Date(document.getElementById('session_time').value);
            //console.log(endDate);      
            //var sec = parseInt ((startDate.getTime() - endDate.getTime()) / 1000) ;
            var minn = parseInt ((startDate.getTime() - endDate.getTime()) / 1000 /60);
            var examDuration = document.getElementById('examDuration').value;
            var JsTime = examDuration-minn;
            //console.log(JsTime);
            document.getElementById('JS').value=JsTime;
            
            
        </script>
        <input type="hidden" id="localTimee" name="localTimee" value="<?php echo $time[0]*60 ;?>">
        <input type="hidden" id="quseNumber" name="quseNumber" value="<?php echo count($rows_no); ?>">
        <input type="hidden" id="exam_degree" name="exam_degree" value="<?php echo $r[0]; ?>">
        <input type="hidden" id="total_points" name="total_points" value="<?php echo $total_points; ?>">
        <input type="hidden" id="sname" name="sname" value="<?php echo $sname; ?>">
        <input type="hidden" id="syear" name="syear" value="<?php echo $syear; ?>">
        <input type="hidden" id="cname" name="cname" value="<?php echo $cname; ?>">
        <input type="hidden" id="qnum" name="qnum" value="<?php echo $q[0]; ?>">
        <input type="hidden" id="exam_id" name="exam_id" value="<?php echo $exam_id; ?>">
        <input type="hidden" id="stuid" name="stuid" value="<?php echo $stuid; ?>">
        
    <?php 

    $rows_questions=$db->getRows("SELECT Question_ID , Question_name , Question_a ,Question_b, Question_c , Question_d , Question_answer FROM question WHERE Exam_ID = ?",array($exam_id)); 
    //                                     qrow[0]      qrow[1]      qrow[2]      qrow[3]      qrow[4]         qrow[5]            qrow[6]  

        

        $i=1;

        if(count($rows_questions)>0)
        {


                foreach ($rows_questions as $qrow ) {
                    if ( $qrow[6] == "Question_a" || $qrow[6] == "Question_b" || $qrow[6] == "Question_c" || $qrow[6] == "Question_d" ){
                        
                            echo "  <br>
                                    <tr class=\"quesRow\">
                                        
                                        <td width=\"20%\">
                                            <br>
                                            <label class=\"quesNumb\"> Question $i </label>
                                        </td>

                                        <td width=\"80%\">
                                            <label class=\"q ques\"> $qrow[1]</label>
                                            <br>
                                            <div class=\" a col-sm-10\">
                                                <br>
                                                <input class=\"form-check-input\" type=\"radio\" name=\"q[]_'.$i.'\"  value=\"xx\" checked=\"checked\" hidden>

                                                <div class=\"form-check\">
                                                    <input class=\"form-check-input\" type=\"radio\" name=\"q[]_'.$i.'\" id=\"$i-a\" value=\"Question_a\" >

                                                    <label class=\"form-check-label\" for=\"$i-a\">
                                                     $qrow[2]
                                                    </label>

                                                </div>
                                                <div class=\"form-check\">
                                                    <input class=\"form-check-input\" type=\"radio\" name=\"q[]_'.$i.'\" id=\"$i-b\" value=\"Question_b\">
                                                    <label class=\"form-check-label\" for=\"$i-b\">
                                                      $qrow[3]
                                                    </label>
                                                </div>
                                                <div class=\"form-check\">
                                                    <input class=\"form-check-input\" type=\"radio\" name=\"q[]_'.$i.'\" id=\"$i-c\" value=\"Question_c\">
                                                    <label class=\"form-check-label\" for=\"$i-c\">
                                                        $qrow[4]
                                                    </label>
                                                </div>
                                                <div class=\"form-check\">
                                                    <input class=\"form-check-input\" type=\"radio\" name=\"q[]_'.$i.'\" id=\"$i-d\" value=\"Question_d\">
                                                    <label class=\"form-check-label\" for=\"$i-d\">
                                                        $qrow[5]
                                                    </label>
                                                </div>
                                                <br>
                                                <input type=\"hidden\" id=\"ans-$i\" name=\"ans[]_'.$i.'\" value=\"$qrow[6]\" >
                                           </div>
                                        </td>

                                    </tr>
                                
                           
                                ";
                    }
                    else{
                         echo "  
                                   
                                    
                                    <tr class=\"quesRow\">
                                        <td width=\"20%\">
                                            <br>
                                            <label class=\"quesNumb\"> Question $i </label>
                                        </td>
                                        <td width=\"80%\">
                                            <label class=\"q ques\"> $qrow[1]</label>
                                            <br>
                                            <div class=\" a col-sm-10\">
                                                <br>
                                                <input class=\"form-check-input\" type=\"radio\" name=\"q[]_'.$i.'\"  value=\"xx\" checked=\"checked\" hidden>
                                                <div class=\"form-check\">
                                                    <input class=\"form-check-input\" type=\"radio\" name=\"q[]_'.$i.'\" id=\"$i-a\" value=\"true\">

                                                    <label class=\"form-check-label\" for=\"$i-a\">
                                                     True
                                                    </label>

                                                </div>
                                                <div class=\"form-check\">
                                                    <input class=\"form-check-input\" type=\"radio\" name=\"q[]_'.$i.'\" id=\"$i-b\" value=\"false\">
                                                    <label class=\"form-check-label\" for=\"$i-b\">
                                                      False
                                                    </label>
                                                </div>
                                                <br>
                                                <input type=\"hidden\" id=\"ans-$i\" name=\"ans[]_'.$i.'\" value=\"$qrow[6]\" >
                                           </div>
                                        </td>
                                    </tr>
                                ";
                    }
                    $i++;
                }
                
        }   
        echo " </table>
                
            </div>";

       

?>
           
            
        </div>
        <br><br><br><br><br><br>
        <nav class=" nav navbar-bottom">
        </nav>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle"><b>Submit</b></h5>
                  
                </div>
                <div class="modal-body">
                  Are You sure you want to submit your answers ?
                </div>
                <div class="modal-footer">
                        <input type="text" hidden>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="SubmitForm" name="submit">Submit</button>
                </div>
              </div>
            </div>
        </div>
        
        
     </form>
     <script type="text/javascript">
            // set minutes
            var mins =0;
            // calculate the seconds (don't change this! unless time progresses at a different speed for you...)

            var secs = JsTime*60; //document.getElementById('JS').value;
            //document.write(document.getElementById('localTimee').value);

            var minutes, seconds;
            
            function countdown() {
              setTimeout('Decrement()',1000);
            }
            
            function Decrement() {
                // if less than a minute remaining
                if (seconds < 59) {
                    seconds.value = secs;
                    
                } else {
                    minutes.value = getminutes();
                    seconds.value = getseconds();
                }
                secs--;
                console.log("x");
                //console.log(minutes + ', ' + seconds);
                if (seconds.value <= 0 && minutes.value <= 0) {
                  console.log("xx");
                    document.getElementById('SubmitForm').click();
                    //submitForm();
                    
                    //document.examform.submit();
                    //$("#examform").submit();
                    console.log("xxx");
                    //
                    //$("form").submit();
                    //console.log("yyy");
                } else {
                    setTimeout('Decrement();',1000);
                }
            }
            
            function getminutes() {
              // minutes is seconds divided by 60, rounded down
              mins = Math.floor(secs / 60);
              return mins;
            }
            
            function getseconds() {
              // take mins remaining (as seconds) away from total seconds remaining
              return secs-Math.round(mins *60);
            }
            
            // It's necessary
            document.onreadystatechange = function() {
              if(document.readyState == "complete") {
                minutes = document.getElementById("minutes");
                seconds = document.getElementById("seconds");
                countdown();
              }
            };
            
        </script>
   
    </body>
</html>
