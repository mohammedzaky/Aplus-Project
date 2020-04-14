<?php
  session_start();
  include("DB.php");
  $_SESSION["res"]='done';

  if(isset($_SESSION['std']))
  {
  }
  
  else
  {
    header("Location:0_login.php");
  }


  if(isset($_POST['submit']))
    {
        

        $s_ans=$_POST['q'];
        $c_ans=$_POST['ans'];
        $exam_degree=$_POST['exam_degree'];
        $total_points=$_POST['total_points'];
        $sname=$_POST['sname'];
        $syear=$_POST['syear'];
        $cname=$_POST['cname'];
        $qnum=$_POST['qnum'];
        $exam_id=$_POST['exam_id']; 
        $stuid=$_POST['stuid'];
        $start_time=$_POST['start_time'];
        
    }

    $c=0;

    for ($i=0; $i < sizeof($c_ans); $i++) { 
            
            if($c_ans[$i]==$s_ans[$i])
                $c++;
            
        }
        $c*=$exam_degree;
       
?>



<!DOCTYPE html>
<html>
    <head>
        <title> A+ | Exam </title>                           <!--course Title-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="S_3.2_result/css/bootstrap.css">
        <link rel="stylesheet" href="S_3.2_result/css/rtl.css">
        <link rel="stylesheet" href="S_3.2_result/css/style.css">
        <style>
            .studd_Ans{
              border: 1px solid #25556a;
       }    
        </style>
        <script src="S_3.2_result/js/jquery.css"></script>
        <script src="S_3.2_result/js/bootstrap.min.js"></script>
        
    </head>
    <body onload="document.body.style.opacity='1';">
     <form class="form">    
                   
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
<?php
    echo "
                                <span class=\"countDownText\">$c/$total_points</span>
        ";

         //PUT THE DEGREE IN TABLE STUDENT_EXAM FOR THIS STUDENT
      
        
     $row_degree=$db->queryOp ("UPDATE `student_exam` SET `Student_Exam_degree` = ?  WHERE `student_exam`.`Student_ID` = ? AND `student_exam`.`Exam_ID` = ?",array($c,$stuid,$exam_id)); 
   
?>
                            </a>
                        </li>
                        <a class="submitButton btn btn-success" href="S_3_Home.php">
                            Exit
                        </a>
                    </ul>
                </div>
            </div>
        </nav>
        <div align="center">
<?php        
    echo "      
            <div class=\"container\">
              
                <label class=\"upperTitle\" >
     
                     $sname $syear,  $cname, $qnum question, $total_points points

                </label>
            </div>
            <div class=\"xx\"> 
            <br><br>
            <table class=\"table\">
            ";



     $rows_questions=$db->getRows("SELECT Question_ID , Question_name , Question_a ,Question_b, Question_c , Question_d , Question_answer FROM question WHERE Exam_ID = ?",array($exam_id)); 
    //                                     qrow[0]      qrow[1]      qrow[2]      qrow[3]      qrow[4]         qrow[5]            qrow[6]  


        $i=1;
        $ii=0;
        if(count($rows_questions)>0)
        {


                foreach ($rows_questions as $qrow ) {
                            $c_aa="";
                            $c_bb="";
                            $c_cc="";
                            $c_dd="";
                            $c_tt="";
                            $c_ff=""; 

                            $s_aa="";
                            $s_bb="";
                            $s_cc="";
                            $s_dd="";
                            $s_tt="";
                            $s_ff="";

                            $ss_aa="";
                            $ss_bb="";
                            $ss_cc="";
                            $ss_dd="";
                            $ss_tt="";
                            $ss_ff="";

                    if ( $qrow[6] == "Question_a" || $qrow[6] == "Question_b" || $qrow[6] == "Question_c" || $qrow[6] == "Question_d" ){

                            if ( $qrow[6] == "Question_a" ){
                                $c_aa="true_Ans ";
                            }
                            else if ( $qrow[6] == "Question_b" ){
                                $c_bb="true_Ans ";
                            }
                            else if ( $qrow[6] == "Question_c" ){
                                $c_cc="true_Ans ";
                            }
                            else if ( $qrow[6] == "Question_d" ){
                                $c_dd="true_Ans ";
                            }
                            if ( $s_ans[$ii]  == "Question_a" ){
                                $ss_aa="studd_Ans ";
                            }
                            else if ( $s_ans[$ii]  == "Question_b" ){
                                $ss_bb="studd_Ans ";
                            }
                            else if ( $s_ans[$ii]  == "Question_c" ){
                                $ss_cc="studd_Ans ";
                            }
                            else if ( $s_ans[$ii]  == "Question_d" ){
                                $ss_dd="studd_Ans ";
                            }
                            if ( $s_ans[$ii] != $qrow[6] ){
                                if ( $s_ans[$ii] == "Question_a" ){
                                    $s_aa="stud_Ans";
                                }
                                else if ( $s_ans[$ii] == "Question_b" ){
                                    $s_bb="stud_Ans";
                                }
                                else if ( $s_ans[$ii] == "Question_c" ){
                                    $s_cc="stud_Ans";
                                }
                                else if ( $s_ans[$ii] == "Question_d" ){
                                    $s_dd="stud_Ans";
                                }
                            }
                            echo "  
                                   
                                    
                                    <br>
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
                                                <div class=\"$c_aa $s_aa form-check\">
                                                    <label class=\"$ss_aa form-check-label\" for=\"$i-a\">
                                                     a- $qrow[2]
                                                    </label>

                                                </div>
                                                <div class=\"$c_bb $s_bb form-check\">
                                                    <label class=\"$ss_bb form-check-label\" for=\"$i-b\">
                                                      b- $qrow[3]
                                                    </label>
                                                </div>
                                                <div class=\"$c_cc $s_cc form-check\">
                                                    <label class=\"$ss_cc form-check-label\" for=\"$i-c\">
                                                        c- $qrow[4]
                                                    </label>
                                                </div>
                                                <div class=\"$c_dd $s_dd form-check-label\">
                                                    <label class=\"$ss_dd form-check-label\" for=\"$i-d\">
                                                        d- $qrow[5]
                                                    </label>
                                                </div>
                                                <br>
                                                <input type=\"hidden\" id=\"ans-$i\" name=\"ans[]_'.$i.'\" value=\"$qrow[6]\" >
                                                <input type=\"hidden\" id=\"ans-$i\" name=\"ans[]_'.$i.'\" value=\"$s_ans[$ii]\" >
                                           </div>
                                        </td>
                                    </tr>

                                
                           
                                ";
                    }
                    else{
                            if ( $qrow[6] == "true" ){
                                $c_tt="true_Ans ";
                            }
                            else if ( $qrow[6] == "false" ){
                                $c_ff="true_Ans ";
                            }
                            if ( $s_ans[$ii]  == "true" ){
                                $ss_tt="studd_Ans ";
                            }
                            else if ( $s_ans[$ii]  == "false" ){
                                $ss_ff="studd_Ans ";
                            }
                            if ( $s_ans[$ii] != $qrow[6] ){
                                if ( $s_ans[$ii] == "true" ){
                                    $s_tt="stud_Ans";
                                }
                                else if ( $s_ans[$ii] == "false" ){
                                    $s_ff="stud_Ans";
                                }
                            }
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
                                                <div class=\"$c_tt $s_tt form-check\">
                                                    <label class=\"$ss_tt form-check-label\" for=\"$i-a\">
                                                     a- True
                                                    </label>

                                                </div>
                                                <div class=\"$c_ff $s_ff form-check\">
                                                    <label class=\"$ss_ff form-check-label\" for=\"$i-b\">
                                                      b- False
                                                    </label>
                                                </div>
                                                <br>
                                                <input type=\"hidden\" id=\"ans-$i\" name=\"ans[]_'.$i.'\" value=\"$qrow[6]\" >
                                                <input type=\"hidden\" id=\"ans-$i\" name=\"ans[]_'.$i.'\" value=\"$s_ans[$ii]\" >
                                           </div>
                                        </td>
                                    </tr>
                                
                                
                           
                                ";

                    }
                    $i++;
                    $ii++;
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
                  <h5 class="modal-title" id="exampleModalCenterTitle">Submit</h5>
                  
                </div>
                <div class="modal-body">
                  Are You sure you want to submit your answers ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" onclick="document.Form.submit();  ">Submit</button>
                </div>
              </div>
            </div>
        </div>
        
        
     </form>
    </body>
</html>
