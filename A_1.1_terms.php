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
   if(isset($_POST['submit']))
     {
       
       $s_name=$_POST['sem_name'];
       $s_year=$_POST['sem_year'];

       if($s_year != "null" &&  $s_name != "null")
         {
            // we didnt need for check here for dublicated record beasue they are unique in DB structure

               $q1="SELECT Semester_name , Semester_year FROM semester;";
               $rows=$db->getRows($q1,array());
               $c=0;
               if(count($rows)>0)
                 {

                    $row=$db->myExec("DELETE FROM semester",array());             
                    $row=$db->myExec("DELETE FROM student",array());             
                    $row=$db->myExec("DELETE FROM question",array());             
                    $row=$db->myExec("DELETE FROM exam",array());             
                    
                }
                
                $q="INSERT INTO `semester` (`Semester_name`, `Semester_year`) VALUES (?,?)";
                    $db->queryOp($q,array($s_name,$s_year));   
                    
          }
               
      }
    
    if (isset($_POST['submit2']))
    {


        $id=$_POST['popup_hidden_ID'];
        $sname=$_POST['semestereName'];
        $syear=$_POST['semesterYear'];

        $c=0;  $i=0;

        $q1="SELECT Semester_name FROM semester";

        $Semester_names=$db->getRows($q1,array());

        $q2="SELECT Semester_year FROM semester";
        $Semester_years=$db->getRows($q2,array());
        $Semester_year= array();
        
        foreach ($Semester_years as $row) {
          
          array_push($Semester_year, $row[0]);

        }

          if(count($Semester_names)>0)
          {
              foreach ($Semester_names as $row) {
                  
                  if($row[0]==$sname  && $Semester_year[$i] == $syear)
                    {

                          $c++;
                          break;

                    }

                  $i++;
              }
                if($c==0)
                  {
                     $q="UPDATE semester SET Semester_name = ? , Semester_year = ? WHERE semester . Semester_ID = ?";
                     $row=$db->queryOp($q,array($sname,$syear,$id));

                  }

          }

/*

          else
          {
             $q="UPDATE semester SET Semester_name = ? , Semester_year = ? WHERE semester . Semester_ID = ?";
             $row=$db->queryOp($q,array($sname,$syear,$id));
          }
*/


    }
    if (isset($_POST['submit3']))
    {


          $id=$_POST['DEL_popup_hidden_ID'];

         
         $q="DELETE FROM `semester` WHERE `semester` . `Semester_ID` = ?";
         $row=$db->queryOp($q,array($id));
            $row=$db->myExec("DELETE FROM semester",array());             
                    $row=$db->myExec("DELETE FROM student",array());             
                    $row=$db->myExec("DELETE FROM question",array());             
                    $row=$db->myExec("DELETE FROM exam",array());             
                    




    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title> A+ | Admin </title>                           <!--course Title-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="A_1.1_terms/css/bootstrap.css">
        <link rel="stylesheet" href="A_1.1_terms/css/rtl.css">
        <link rel="stylesheet" href="A_1.1_terms/css/style.css">
        <script src="A_1.1_terms/js/jquery.css"></script>
        <script src="A_1.1_terms/js/bootstrap.min.js"></script>
        <script>
                                                           
            function editID(id, name, year, row){
                document.getElementById("popup_hidden_ID").value=id;
                var sel = document.getElementById('semestereName');
                var opts = sel.options;
                for (var opt, j = 0; opt = opts[j]; j++) {
                  if (opt.value == name) {
                    sel.selectedIndex = j;
                    break;
                  }
                }
                var selY = document.getElementById('semesterYear');
                var optsY = selY.options;
                for (var opt, j = 0; opt = optsY[j]; j++) {
                  if (opt.value == year) {
                    selY.selectedIndex = j;
                    break;
                  }
                }
            }
            function delID(id){
              document.getElementById("DEL_popup_hidden_ID").value=id;
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
            <table class="table">
                <tr class="quesRow" scope="row">
                    <th>
                        <label class="studName"> Semester name </label>
                    </th>
                    <th></th>
                    <th></th>
                </tr>
                <tr class="tr-add">
                    <form action="A_1.1_terms.php" method="POST"> <!--when submit __ go to A_1.2 to add courses at this semester-->
                        <td>
                            <div class="countainer">
                                <select class="c course form-control" name="sem_name" id="courseName" required>
                                    <option value="null"> </option>
                                    <option value="Winter">Winter</option>
                                    <option value="Spring">Spring</option>
                                    <option value="Summer">Summer</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <select class="c course form-control" name="sem_year">
                                     <option value="null" > </option> 
                                     <option value="2017/2018">2017/2018</option>
                                     <option value="2018/2019">2018/2019</option>
                                     <option value="2019/2020">2019/2020</option>
                                     <option value="2020/2021">2020/2021</option>
                                     <option value="2021/2022">2021/2022</option>
                                     <option value="2022/2023">2022/2023</option>
                                     <option value="2023/2024">2023/2024</option>
                                     <option value="2024/2025">2024/2025</option>
                                 </select>       


                            <!--semester name (in table) = (up) option + 2017/2018-->
                        </td>
                        <td>
                            <button type="submit" name = "submit" class="btn btn-success"> Add semester</button>
                        </td>
                    </form
                </tr>
 <?php
            $rows= array();
            // all of semsters 
            $q1="SELECT * from semester;";
            $rows=$db->getRows($q1,array());

               $q1="SELECT Course_ID  FROM semester_course_professor where Semester_ID =?;";             
        
            if(count($rows)>0){
                  $i=1;
                foreach($rows as $row)
                 {
                    
                echo "
                <tr class='click-row' > 
                    <td onclick=\"window.location.href = 'A_1.2_courses.php?id=$row[0]'\"> 
                        <br>
                        <span id=\"semesterName_$i\">$row[1]    </span>

                        <span id=\"semesterYear_$i\">$row[2]</span>  
                    </td>
                    ";

                    $rows_course=$db->getRows($q1,array($row[0]));
                    $count=count($rows_course);
                  echo "
                    <td onclick=\"window.location.href = 'A_1.2_courses.php?id=$row[0]'\">
                        <br>
                        <span class=\"crs_info\">  ".$count." courses </span>
                    </td>
                    <td>
                        <div class=\"row_options\">
                            <a data-toggle=\"modal\" onclick=\"editID('$row[0]','$row[1]','$row[2]','$i');\"data-target=\"#editPopup\" title='Edit'>
                                <!--edit this semester name Use ctrl+f to find this section ((Edit popup)) -->
                                <span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span>
                            </a>
                            <br><br>
                            <a data-toggle=\"modal\" onclick=\"delID('$row[0]');\" data-target=\"#deletePopup\" title='Remove'>
                                <!--edit this semester name Use ctrl+f to find this section ((delete popup)) -->
                                <span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>
                            </a>
                        </div>
                    </td>
                </tr>
                ";
                $i++;
                }}
?>
           
            </table>
        </div>
        <br><br><br><br><br><br>
        <nav class=" nav navbar-bottom">
        </nav>
        
        
        <!--logout poopup-->
        <div id="popup" uib-modal-window="modal-window" class=" popup modal fade ng-scope ng-isolate-scope in" role="dialog" size="sm" index="0" animate="animate" ng-style="{'z-index': 1050 + $$topModalIndex*10, display: 'block'}" tabindex="-1" uib-modal-animation-class="fade" modal-in-class="in" modal-animation="true" style="z-index: 1050; visibility:hidden;display: block;" onchange="document.body.style.opacity='1'";>
            <div class="modal-dialog modal-sm" >
                <div class="modal-content" uib-modal-transclude="">
                    <div class="panel-heading">
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading">Logout</h4>
                                <h5 class="media-heading-down ">Are you sure? </h5>
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
        
        <!--Edit popup-->
        <div class="modal fade" id="editPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <form  method="POST"> <!--Return to same page A_1.1 show it was edited successfuly-->
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle"><b>Edit semester</b></h5>
                    </div>
                    <div class="modal-body">
                      <input id="popup_hidden_ID" name="popup_hidden_ID" type="hidden" value="">
                        <select class="c course form-control" id="semestereName" name="semestereName" required>
                            <option> </option>
                            <option>Winter</option>
                            <option>Spring</option>
                            <option>Summer</option>
                        </select>
                        <br><br>
                        <select class="c course form-control" id="semesterYear" name="semesterYear" required>
                              <option value="null" > </option> 
                              <option>2017/2018</option>
                              <option>2018/2019</option>
                              <option>2019/2020</option>
                              <option>2020/2021</option>
                              <option>2021/2022</option>
                              <option>2022/2023</option>
                              <option>2023/2024</option>
                              <option>2024/2025</option>
                        </select>
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
              <div class="modal-content">
                <form  method="POST">
                  <div class="modal-body">
                      Are you sure you want to remove this semester?
                  </div>
                  <input id="DEL_popup_hidden_ID" name="DEL_popup_hidden_ID" type="hidden" value="">
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-success" name="submit3">Remove</button>
                  </div>
                 </form> 
              </div>
            </div>
        </div>
    </body>
</html>
