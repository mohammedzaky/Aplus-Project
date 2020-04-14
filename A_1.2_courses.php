<?php
  session_start();
  include("DB.php");
  if(isset($_SESSION['adm']))
  {
  }
  else
  {
    header("Location:0_login.php");
  }

  if(isset($_GET['id']))
    {
      $id= $_GET['id'];   // 58 semester_ID
      /*1*/
      $q="SELECT Semester_name , Semester_year FROM semester WHERE Semester_ID=?"; //to print the name of semester in this page 
      $rows_sem=$db->getRows($q,array($id));
      /*2*/
      $q1="SELECT Course_ID  FROM semester_course_professor where Semester_ID = ?";      
      $rows_course=$db->getRows($q1,array($id));
      /*3*/
      $q2 = "SELECT Professor_ID  FROM semester_course_professor where Semester_ID =?";     
      $prof_ids=$db->getRows($q2,array($id));
      
    }
     
 
    if(isset($_POST['submit2']))
     {
       $id= $_GET['id']; // where iam in the semester_id here in this page 
       $c_name=$_POST['c_name'];      // course name
       $p_name=$_POST['p_name'];      // professor name

       if($c_name != "null" &&  $p_name != "null")
         {

               $q1="SELECT Course_ID FROM semester_course_professor WHERE Semester_ID = ?";
               $c_rows_ids=$db->getRows($q1,array($id));

               $q2="SELECT Professor_ID FROM semester_course_professor WHERE Semester_ID = ?";
               $p_rows_ids=$db->getRows($q2,array($id));

               $q3="SELECT Course_ID FROM course WHERE Course_name = ?";
               $c_id=$db->getRow($q3,array($c_name));

               $p_id=array();
               $q4="SELECT Professor_ID FROM professor WHERE Professor_name = ?";
               $p_id=$db->getRow($q4,array($p_name));

               $c=0;
               if(count($c_rows_ids)>0) //there are courses in DB in C_S_P table and isnt empty
                 {
                         
                  foreach($c_rows_ids as $row)
                    {
                        if($row[0]==$c_id[0])
                        {
                           $c++;
                        }
                    }
                    if($c==0)
                    { 
                    
                          $q="INSERT INTO semester_course_professor VALUES (?,?,?)";
                          $db->queryOp($q,array($id,$c_id[0],$p_id[0]));   
                    }
                } 
                else {  // there isnt any rows in database Empty

                      //insert
                     $q="INSERT INTO semester_course_professor VALUES (?,?,?)";
                     $db->queryOp($q,array($id,$c_id[0],$p_id[0]));   
                }
               
         }
    }

   if(isset($_POST['submit3']))
     {
          $id= $_POST['semesterID_Popup']; // where iam in the semester_id here in this page 
          $c_id=$_POST['courseID_Popup'];      // course id
          $p_id=$_POST['profID_Popup'];      // professor id
          $new_c_id=$_POST['course_name_popup'];
          $new_p_id=$_POST['prof_name_popup'];

                   // echo "<h1>$new_p_id eee</h1>";

       $q5="UPDATE semester_course_professor SET Course_ID = ?, Professor_ID = ? WHERE semester_course_professor. Semester_ID = ? AND semester_course_professor .Course_ID = ?; ";


       $db->queryOp($q5,array($new_c_id,$new_p_id,$id,$c_id));   

    }

   if(isset($_POST['submit4']))
     {

       $sem_id=$_POST['DEL_popup_hidden_ID'];
       $c_id=$_POST['course_id_popup'];

       $rows=$db->getRows("SELECT Student_ID FROM semester_course_student where Course_ID = ? ",array($c_id));

       foreach ($rows as $value) {
         
            $d=$value[0];
            $db->queryOp("DELETE FROM student where Student_ID = ?",array($d));

       }




       $q2="DELETE FROM `semester_course_professor` WHERE `semester_course_professor`.`Semester_ID` = ? AND `semester_course_professor`.`Course_ID` = ?";
       $db->queryOp($q2,array($sem_id,$c_id));   


    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> A+ | Admin </title>                           <!--course Title-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="A_1.2_courses/css/bootstrap.css">
        <link rel="stylesheet" href="A_1.2_courses/css/rtl.css">
        <link rel="stylesheet" href="A_1.2_courses/css/style.css">
        <script src="A_1.2_courses/js/jquery.css"></script>
        <script src="A_1.2_courses/js/bootstrap.min.js"></script>
        <script>
                                                           
            function editID(sem_id, c_id, p_id, Cname, Pname, row){
                document.getElementById("semesterID_Popup").value=sem_id;
                document.getElementById("courseID_Popup").value=c_id;
                document.getElementById("profID_Popup").value=p_id;
                var sel = document.getElementById('course_name');
                var opts = sel.options;
                for (var opt, j = 0; opt = opts[j]; j++) {
                  if (opt.value == c_id) {
                    sel.selectedIndex = j;
                    break;
                  }
                }
                var selY = document.getElementById('prof_name');
                var optsY = selY.options;
                for (var opt, j = 0; opt = optsY[j]; j++) {
                  if (opt.value == p_id) {
                    selY.selectedIndex = j;
                    break;
                  }
                }
            }
            function delID(id,course_id){
              document.getElementById("DEL_popup_hidden_ID").value=id;
              document.getElementById("course_id_popup").value=course_id;
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
                        <li><a href="A_1.6_courses.php">Courses</a></li>
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
  
        if(count($rows_sem)>0){

            //semester name here 
          foreach($rows_sem as $row)
            {
      echo "      
            <div class=\"container\">
                
                <a href=\"A_1.1_terms.php\"><label class=\"upperTitle\" > $row[0] $row[1]</label></a>
            </div>

      
        ";
    }}
?>
            
            <table class="table">
                    
                    <tr class="quesRow" scope="row">
                        <th>
                            <label class="studName"> Cousre name </label>
                        </th>
                        <th>
                            <label class="studName"> Professor name </label>
                        </th>
                        <th></th>
                    </tr>
                    <tr class="tr-add">
 <?php 

    $q="SELECT Course_name FROM course";
    $courses_names=$db->getRows($q,array());
    $id= $_GET['id'];

    echo "
                        <form action=\"A_1.2_courses.php?id=$id\" method=\"POST\">
                            <td>

                                <div class=\"countainer\">
                                  <select class=\"c course form-control\" name= \"c_name\" required>
                                        <option value=\"null\"> </option>

                                       
        ";
                if( count($courses_names)>0 ){

                         foreach($courses_names as $row){

                                     echo " <option value=\"$row[0]\">$row[0]</option>" ; 
                                 
                           }
                         }
?>
                                   
                                </div>
                            </td>
                            <td>
                                <div class="countainer">
                                    <select class="c course form-control" name="p_name" required>
                                        <option value="null"> </option>
  <?php
    $q="SELECT Professor_name FROM professor";
    $Professors_names=$db->getRows($q,array());
  

                   if( count($Professors_names)>0 ){

                         foreach($Professors_names as $row){

                                     echo " <option value=\"$row[0]\">$row[0]</option>" ; 
                                 
                           }
                         }
?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <button type="submit" name = "submit2" class="btn btn-success">  Add course</button>                                
                            </td>
                        </form>
                        
                    </tr>

<?php
    
      //2//
      $q1="SELECT Course_ID  FROM semester_course_professor where Semester_ID =?;";      
      $rows_course=$db->getRows($q1,array($id));
      //3//
      $q2 = "SELECT Professor_ID  FROM semester_course_professor where Semester_ID =?;";     
      $prof_ids=$db->getRows($q2,array($id));
      
/*------------------------------------------------------------------------------------------------------------*/
       $prof_names=array();
       if(count($prof_ids)>0){
             // here the value will be print below
            foreach ($prof_ids as $row) 
                 {
                    $q2="SELECT Professor_name FROM professor WHERE Professor_ID = ?";
                    $row2=$db->getRow($q2,array($row[0]));
                    array_push($prof_names,$row2[0]);
                 }
            }
            //else {   echo('empty1'); }
/*------------------------------------------------------------------------------------------------------------*/            
        $course_names=array();
        if(count($rows_course)>0){
            // here the value will be print below
            foreach ($rows_course as $row) 
                 {
                    
                   $q3="SELECT Course_name FROM course where Course_ID = ?";
                   $row2=$db->getRow($q3,array($row[0]));
                   array_push($course_names,$row2[0]);
                }
              }
            //else {   echo('empty2'); }
            
/*------------------------------------------------------------------------------------------------------------*/   
//get course id from up (from table course_semester_prof)      

    $course_ids=array();

     foreach ($rows_course as $row) {
        
            // to print array by for loop do this steps 
              array_push($course_ids,$row[0]);
            
    }


/*------------------------------------------------------------------------------------------------------------*/   
    $professor_ids=array();

     foreach ($prof_ids as $row) {
        
            // to print array by for loop do this steps 
              array_push($professor_ids,$row[0]);
            
    }


/*------------------------------------------------------------------------------------------------------------*/   
       if(count($course_names) > 0 ){
              $j=0;
              for( $i=0 ; $i<sizeof($course_names) ; $i++ )
                { 
    echo "
                    <tr class='click-row' >

                        <td onclick=\"window.location.href = 'A_1.3_course.php?cname=$course_names[$i]&pname=$prof_names[$i]&id=$id'\">
                            <br>
                            $course_names[$i]
                            
                        </td>
                        ";

     echo "               
                        <td onclick=\"window.location.href = 'A_1.3_course.php?cname=$course_names[$i]&pname=$prof_names[$i]&id=$id'\">
                            <br>
                            <span class=\"crs_info\"> 

                                 $prof_names[$i] 

                            </span>
                        </td>
                        

                           <td>
                            <div class=\"row_options\">
                                <a data-toggle=\"modal\" title='Edit' onclick=\"editID('$id','$course_ids[$i]','$professor_ids[$i]','$course_names[$i]','$prof_names[$i]','$j')\"data-target=\"#editPopup\">
                                    <span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span>
                                </a>
                                <br><br>
                                <a data-toggle=\"modal\" title='Remove' onclick=\"delID('$id',' $course_ids[$i]')\"data-target=\"#deletePopup\">
                                    <span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>
                                </a>
                            </div>
                        </td>

                        </tr>

                ";
              $j++;
            } }

?>

                    </tr>
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
            <form method="POST"> <!--Return to same page -- show that edit was succesfully -->
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle"> <b>Edit course and professor name</b> </h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="semesterID_Popup"class="course form-control" name= "semesterID_Popup" required>
                        <input type="hidden" id="courseID_Popup"class="course form-control" name= "courseID_Popup" required>
                        <input type="hidden" id="profID_Popup"class="course form-control" name= "profID_Popup" required>
                        <label class="studName"> Cousre name </label>
                        <br>
                     <select style="width:100%;" class="c course form-control" id= "course_name" name= "course_name_popup" required>
                          
<?php 

    $q="SELECT * FROM `course`;";

    $courses_ids_names=$db->getRows($q,array());
  
  
                if( count($courses_ids_names)>0 ){
                    
                         foreach($courses_ids_names as $row){
                                    
                                     echo " <option value=\"$row[0]\">$row[1]</option>" ; 
                                 
                           }
                      
                         }
                         
?>
                        </select>
                        <br><br>
                        <label class="studName"> Professor name </label>
                        <select style="width:100%;" class="form-control" id= "prof_name" name= "prof_name_popup"  required>
                           
  <?php

    $q="SELECT Professor_ID , Professor_name from professor";
    $Professors_names_ids=$db->getRows($q,array());

                   if( count($Professors_names)>0 ){

                          foreach ($Professors_names_ids as $row) {
         
                                echo "<option value=\"$row[0]\">$row[1]</option>";    
          
                            }
                     }
?>
                        </select>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-success" name="submit3">Save</button>
                    </div>
                  </div>
                </div>
            </form>
        </div>
        
        <!--delete popup-->
        <div class="modal fade" id="deletePopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <form method="post">
                <div class="modal-content">
                  <div class="modal-body">
                      Are You sure you want to delete this course form term ?
                  </div>
                  <div class="modal-footer">
                      <input id="DEL_popup_hidden_ID" name="DEL_popup_hidden_ID" type="hidden" value="">
                      <input id="course_id_popup" name="course_id_popup" type="hidden" value="">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-success" name="submit4"  >Delete</button>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </body>
</html>
