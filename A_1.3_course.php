<?php
$arr = array();
  session_start();
  include("DB.php");
  if(isset($_SESSION['adm']))
  {
  }
  else
  {
    header("Location:0_login.php");
  }

if(isset($_GET['cname']))
  {

      $cname=$_GET['cname'];

  } 
  if(isset($_GET['id']))
    {
        $id=$_GET['id'];
    }
  if(isset($_GET['pname']))
  {

       $pname=$_GET['pname'];

  }

  
                        
if(isset($_POST['submit']))
{

        $s_id_num=$_POST['s_id_num'];    
        $s_name=$_POST['s_name'];
        $s_uname=$_POST['s_uname'];     
        $s_pas=$_POST['s_pas'];  
        $id=$_GET['id'];   
       // we dont need to check here beucase in DB make uniuqe tables  
        $c=0;   
        

        

      if(strlen($s_name)>=3 && strlen($s_uname)>=3 && strlen($s_pas)>=3)
            {
                $chu=substr($s_uname,0,2);
                $s_uname= strtolower($s_uname);
                $chu=strtolower($chu);
                $k=0;


        //repeted from down to check if there is another student with the different username to be not entered here 

        $cname=$_GET['cname'];
        $id=$_GET['id'];
        $pname=$_GET['pname'];           

        $q="SELECT Course_ID from course WHERE Course_name = ? ";
        $C_ID=$db->getRows($q,array($cname));
        $c_ids=array();

         foreach ($C_ID as $row) {
            
                // to print array by for loop do this steps 
                  array_push($c_ids,$row[0]);
                
        }
         //echo $c_ids[0];
        

        $q1="SELECT Student_ID from semester_course_student WHERE Semester_ID = ? and Course_ID = ?";
        $S_IDs=$db->getRows($q1,array($id,$c_ids[0]));

        //echo count($S_IDs);

        $s_ids=array();

        foreach ($S_IDs as $row) {
            
                // to print array by for loop do this steps 
                  array_push($s_ids,$row[0]);
                
        }

        $Student_IDs=array();

        if(count($s_ids)>0){

            
             foreach ($s_ids as $row) {

               $q1="SELECT * FROM student where Student_ID = ?";   

               $row2=$db->getRow($q1,array($row[0]));
               array_push($Student_IDs,$row2[0]);
             }

        }
        //$count_students=0;
      
         

             $ii=1;
         for ($i=0; $i < sizeof($s_ids); $i++) { 

                $q1="SELECT Student_name , Student_studentID , Student_username , Student_password  FROM student WHERE Student_ID = ?";   
                $row2=$db->getRows($q1,array($s_ids[$i]));
                 
                
                 foreach ($row2 as $row) {
                    
                   if($row[0]==$s_name || $row[1]==$s_id_num)
                   {
                        $k++;
                   }

                    
                    
              }

        }   



/**************************************************************************************************************************************************/

        if($k==0)
        {
                if($chu=="s_")
                {
                    //  ex- > input:a_sultan  in DB -> a_sultan
                      $q ="INSERT INTO student (Student_studentID, Student_name,Student_username,Student_password) VALUES (?,?,?,?)";
                      $s_uname2=$s_uname;
                      $db->queryOp($q,array($s_id_num,$s_name,$s_uname2,$s_pas));

                }
                else if($chu == "a_"){
            
                        //  ex- > input:s_sultan  in DB -> a_sultan
                        $chu="s_";
                        $search="a_";
                        $s_uname = str_replace($search, '', $s_uname);
                        $s_uname2=$chu.$s_uname;
                                           
                         $q ="INSERT INTO student (Student_studentID, Student_name,Student_username,Student_password) VALUES (?,?,?,?)";
                         $db->queryOp($q,array($s_id_num,$s_name,$s_uname2,$s_pas));


                }
                  else if ( $chu == "p_"){

                        //  ex- > input:p_sultan  in DB -> a_sultan
                        $chu="s_";
                        $search="p_";
                        $s_uname = str_replace($search, '', $s_uname);
                        $s_uname2=$chu.$s_uname;

                        $q ="INSERT INTO student (Student_studentID, Student_name,Student_username,Student_password) VALUES (?,?,?,?)";
                         $db->queryOp($q,array($s_id_num,$s_name,$s_uname2,$s_pas));

                }

                else {
                        // deafult ex- > input:sultan  in DB -> a_sultan
                        $chc="s_";
                        $s_uname2=$chc.$s_uname;
                         $q ="INSERT INTO student (Student_studentID, Student_name,Student_username,Student_password) VALUES (?,?,?,?)";
                         $db->queryOp($q,array($s_id_num,$s_name,$s_uname2,$s_pas));
              }

            
            }



/*-----------------------------------------------------------------------------------------------------------------------------------------------------*/
        
      if($k==0)
      {
        $id=$_GET['id']; // id from semseter not id student
        $cname=$_GET['cname']; // we want to get id of this course not the name of it 
        //TO add this record to the table course_semester_student want [course_id , semster_id , student_id]
        $q1="SELECT Course_ID from course WHERE Course_name = ? ";
        $C_ID=$db->getRows($q1,array($cname));
        $c_ids=array();

        $q3="SELECT Student_ID FROM student WHERE Student_name = ? and Student_username = ?;";
        //$q3="SELECT Student_ID FROM student WHERE Student_name = ? ;";
        $S_ID=$db->getRows($q3,array($s_name,$s_uname2));
        $s_ids=array();

        foreach ($C_ID as $row) {
            
                // to print array by for loop do this steps 
                  array_push($c_ids,$row[0]);
                
        }
            //$c_ids back with one reoord here 

        foreach ($S_ID as $row) {
            
                // to print array by for loop do this steps 
                  array_push($s_ids,$row[0]);
                
        }
        
        //echo "<h1>".$s_ids[0]."</h1>";


        if(count($s_ids) > 0 )
        {

                $q2="INSERT INTO `semester_course_student` (`Semester_ID`, `Student_ID`, `Course_ID`) VALUES (?, ?, ?);";    
                $db->queryOp($q2,array($id,$s_ids[0],$c_ids[0]));
                //$db->queryOp("INSERT INTO student_exam (Student_ID,Exam_ID) VALUES (?,?)",array($s_ids[0],$c_ids[0]));
                


                $count=$db->getCount("SELECT Exam_ID FROM exam;",array());
                
              if($count > 0)
              {   
                  $e_ids=$db->getRows("SELECT Exam_ID FROM exam where Course_ID = ?;",array($c_ids[0]));
                  //echo $e_ids;



                if(count($e_ids) > 0)
                  {
                      foreach ($e_ids as $row) {
                        
                        // insert into student_exam the new student 
                        $v=$row[0];
                        $y=$s_ids[0];
                        //`Student_Exam_degree`, `Session_time`) VALUES ('212', '21', NULL, NULL);
                         $db->queryOp("INSERT INTO `student_exam` (`Student_ID`, `Exam_ID`)  VALUES (?,?);",array($y,$v));
                         
                         


                      }

                  }

              }




        }
    
    }
  }
}


if(isset($_POST['submit2']))
{

 

    $sid=$_POST['id_popup'];
    $s_name=$_POST['name_popup'];
    $id_student=$_POST['stud_ID_popup'];
    $s_uname=$_POST['UsrName_popup'];
    $s_pass=$_POST['pass_popup'];
    
      $q1="UPDATE student SET Student_studentID = ?, Student_name = ? , Student_username = ?, Student_password = ?
                               WHERE student . Student_ID = ?; ";


                $db->queryOp($q1,array($id_student,$s_name,$s_uname,$s_pass,$sid));   

    


}

if(isset($_POST['submit3']))
{

     $sid=$_POST['DEL_popup_hidden_ID'];
     $db->queryOp("DELETE FROM student WHERE student . Student_ID = ?",array($sid));   
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title> A+ | Admin </title>                           <!--course Title-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="A_1.3_course/css/bootstrap.css">
        <link rel="stylesheet" href="A_1.3_course/css/rtl.css">
        <link rel="stylesheet" href="A_1.3_course/css/style.css">
        <script src="A_1.3_course/js/jquery.css"></script>
        <script src="A_1.3_course/js/bootstrap.min.js"></script>
         <script>
              
                                  
                                  
                                 
            function editID(ID,studName,studID,studUsername,studPass){
                  document.getElementById("id_popup").value=ID;
                  document.getElementById("name_popup").value = studName;
                  document.getElementById("stud_ID_popup").value = studID;
                  document.getElementById("UsrName_popup").value = studUsername;
                  document.getElementById("pass_popup").value = studPass;
            }
            function delID(IDnum){
                document.getElementById("DEL_popup_hidden_ID").value=IDnum;
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
                        <li class="active"><a href="A_1.1_terms.php">Semesters</a></li>
                        <li><a href="A_1.4_admins.php">Admins</a></li>
                        <li><a href="A_1.5_Professors.php">Professors</a></li>
                        <li><a href="A_1.6_mails.php">Mails</a></li>
                        <li class="dropdown" style="margin-right: 10px;">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span id="position">
                                         Admin: 
                                </span>
                                <span id="userName">
<?php 
        $q1="select Admin_name from admin where Admin_username = ?;";
        $rows=$db->getRows($q1,array($_SESSION['adm']));
          if(count($rows)>0)
            {
              foreach($rows as $r1)
              {
                    echo $r1[0]; 
              }
            }
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
            <?php 
             $id=$_GET['id'];
            $q="SELECT Semester_name , Semester_year FROM semester WHERE Semester_ID=?"; //to print the name of semester in this page 
            $rows_sem=$db->getRows($q,array($id));
/*---------------------------------------------------------------------------------------------------------------------------------------------------*/
//  REPEATED FROM DOWN   to get number of students 
   $cname=$_GET['cname'];
        $id=$_GET['id'];
        $pname=$_GET['pname'];           

        $q="SELECT Course_ID from course WHERE Course_name = ? ";
        $C_ID=$db->getRows($q,array($cname));
        $c_ids=array();

         foreach ($C_ID as $row) {
            
                // to print array by for loop do this steps 
                  array_push($c_ids,$row[0]);
                
        }

        $q1="SELECT Student_ID from semester_course_student WHERE Semester_ID = ? and Course_ID = ?";
        $S_IDs=$db->getRows($q1,array($id,$c_ids[0]));

        //echo count($S_IDs);

        $s_ids=array();

        foreach ($S_IDs as $row) {
            
                // to print array by for loop do this steps 
                  array_push($s_ids,$row[0]);
                
        }

        $Student_IDs=array();

        if(count($s_ids)>0){

            
             foreach ($s_ids as $row) {

               $q1="SELECT * FROM student where Student_ID = ?";   

               $row2=$db->getRow($q1,array($row[0]));
               array_push($Student_IDs,$row2[0]);
             }

        }
/*---------------------------------------------------------------------------------------------------------------------------------------------------*/

      if(count($rows_sem)>0){

            //semester name here 
          foreach($rows_sem as $row)
                    {
            
                    echo "
                    <div class=\"container\">
                        

                        <a href=\"A_1.1_terms.php\"><label class=\"upperTitle\" > $row[0] $row[1]</label></a>

                        
                        <br>
                        <a href=\"A_1.2_courses.php?id=$id\"><label class=\"upperTitle\">$cname, ".count($s_ids)." students, prof.$pname</label></a>

                    </div>
                    ";
                }}
            ?>
            <table class="table">
                    
                    <tr class="quesRow" scope="row">
                        <th>
                            <label class="studName"> Student name </label>
                        </th>
                        <th>
                            <label class="studName"> Student ID </label>
                        </th>
                        <th>
                            <label class="studName"> Username </label>
                        </th>
                        <th>
                            <label class="studName"> Password </label>
                        </th>

                        <th>

                         
                        </th>
                    </tr>
                    <tr class="tr-add">
<?php 
        $cname=$_GET['cname'];
        $id=$_GET['id'];
        $pname=$_GET['pname'];                        

        echo "
                        <form action=\"A_1.3_course.php?cname=$cname&pname=$pname&id=$id\" method=\"POST\">
                            <td >
                                <div class=\"countainer\">
                                    <input type=\"text\" class=\"form-control\" name = \"s_name\" required >
                                </div>
                                
                            </td>
                            <td>
                                <div class=\"countainer\">
                                     <input type=\"text\" class=\"form-control\" name = \"s_id_num\" required>
                                </div>
                            </td>
                            <td>
                                <div class=\"countainer\">
                                     <input type=\"text\" class=\"form-control\" name = \"s_uname\" required>
                                </div>
                            </td>
                            <td>
                                <div class=\"countainer\">
                                     <input type=\"text\" class=\"form-control\" name = \"s_pas\" required>
                                </div>
                            </td>
                            <td>
                                <button type = \"submit\" class =\"btn btn-success\" name=\"submit\"> Add student</button>
                            </td>
                        </form>
                    </tr>
                    ";
    ?>
<?php
        $cname=$_GET['cname'];
        $id=$_GET['id'];
        $pname=$_GET['pname'];           

        $q="SELECT Course_ID from course WHERE Course_name = ? ";
        $C_ID=$db->getRows($q,array($cname));
        $c_ids=array();

         foreach ($C_ID as $row) {
            
                // to print array by for loop do this steps 
                  array_push($c_ids,$row[0]);
                
        }
         //echo $c_ids[0];
        /*-------------------------------------------------------------------------------------------------------------------------------------------------*/

        $q1="SELECT Student_ID from semester_course_student WHERE Semester_ID = ? and Course_ID = ?";
        $S_IDs=$db->getRows($q1,array($id,$c_ids[0]));

        //echo count($S_IDs);

        $s_ids=array();

        foreach ($S_IDs as $row) {
            
                // to print array by for loop do this steps 
                  array_push($s_ids,$row[0]);
                
        }

        $Student_IDs=array();

        if(count($s_ids)>0){

            
             foreach ($s_ids as $row) {

               $q1="SELECT * FROM student where Student_ID = ?";   

               $row2=$db->getRow($q1,array($row[0]));
               array_push($Student_IDs,$row2[0]);
             }

        }
        //$count_students=0;
      
             $ii=1;
         for ($i=0; $i < sizeof($s_ids); $i++) { 

                $q1="SELECT Student_name , Student_studentID , Student_username , Student_password  FROM student WHERE Student_ID = ?";   
                $row2=$db->getRows($q1,array($s_ids[$i]));
                 
                
                 foreach ($row2 as $row) {
                    
                    echo "


                    <tr>
                        <td>
                            <br>
                            <span id=\"studName_$ii\" >$row[0]</span>
                        </td>
                        <td>
                            <br>
                            <span id=\"studID_$ii\"class=\"crs_info\">$row[1]</span>
                            "; 

                            echo"
                        </td>
                        <td>
                            <br>
                            <span id=\"studUsername_$ii\" class=\"crs_info\">$row[2]</span>
                        </td>
                        <td>
                            <br>
                            <span id=\"studPass_$ii\" class=\"crs_info\">$row[3]</span>
                        </td>
                        <td>
                            <div class=\"row_options\">
                                <a data-toggle=\"modal\" style=\"cursor: pointer;\" onclick=\"editID('$s_ids[$i]','$row[0]','$row[1]','$row[2]','$row[3]');\"data-target=\"#editPopup\" title='Edit'>
                                    <span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span>
                                </a>
                                <br><br>
                                <a data-toggle=\"modal\" style=\"cursor: pointer;\" onclick=\"delID('$s_ids[$i]');\" data-target=\"#deletePopup\" title='Remove'>
                                    <span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    ";
                    $ii++;
                    
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
                                <input type="submit" name="sub" value="logout" class=" btn btn-success "  >
                            </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!--Edit ppopup-->
        <div class="modal fade" id="editPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <form method="POST"> <!--return selected row to input-->
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="edit-mod modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit student information</h5>
                        
                  
                    </div>
                    <div class="modal-body">
                        <br>
                        <table >

                                    <input type="hidden" name="id_popup" id="id_popup">
                            <tr>
                                <td>
                                    <label class="studName"> Student name </label>
                                    <br><br>
                                </td>
                                <td>
                                    <input type="text" name="name_popup" id="name_popup" class="form-control"  required>
                                    <br><br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="studName"> Stuednt ID </label>
                                    <br><br>
                                </td>
                                <td>
                                    <input type="number" name="stud_ID_popup" id="stud_ID_popup" class="form-control"  required>
                                    <br><br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     <label class="studName"> Username </label>
                                     <br><br>
                                </td>
                                <td>
                                    <input type="text" name="UsrName_popup" id="UsrName_popup" class="form-control"  required>
                                    <br><br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="studName"> Password </label>
                                    <br><br>
                                </td>
                                <td>
                                    <input type="text" name="pass_popup" id="pass_popup" class="form-control" required>
                                    <br><br>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-success" name="submit2" >Save</button>
                    </div>
                  </div>
                </div>
            </form>
        </div>
        
        <!--delete popup-->
        <div class="modal fade" id="deletePopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="POST">
              <div class="modal-content">
                <div class="modal-body">
                    Are You sure you want to remove this student form course ?
                </div>
                <div class="modal-footer">
                    <input id="DEL_popup_hidden_ID" name="DEL_popup_hidden_ID" type="hidden" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success"  name="submit3" >Remove</button>
                </div>
              </div>
          </form>
            </div>
        </div>
    </body>
</html>
