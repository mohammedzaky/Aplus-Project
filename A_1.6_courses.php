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
  
  if(isset($_POST['sub']))
  {
    $cn=$_POST['cname'];
    $qq="select Course_name from course;";
    $courses=$db->getRows($qq,array());
    if (in_array($cn,$courses))
    {
      
    }
    else
    {
      $q2="INSERT INTO course(Course_name) VALUES ('$cn');";
     $db->myExec($q2);
    }
    
    
  }
  if(isset($_POST["submit3"]))
    {
      $oldname=$_POST['popup_name'];
      $newname=$_POST['popup_name_New'];
      $query="UPDATE course set Course_name='$newname' where Course_name='$oldname';";
      $db->myExec($query);
    }
    if(isset($_POST['submit4']))
    {
      $delname=$_POST['del_popup_hdn'];
      $querydel="DELETE from course where Course_name='$delname';";
      $db->queryOp($querydel,array());
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> A+ | Admin </title>                           <!--course Title-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="A_1.6_courses/css/bootstrap.css">
        <link rel="stylesheet" href="A_1.6_courses/css/rtl.css">
        <link rel="stylesheet" href="A_1.6_courses/css/style.css">
        <script src="A_1.6_courses/js/jquery.css"></script>
        <script src="A_1.6_courses/js/bootstrap.min.js"></script>
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
                        <li><a href="A_1.1_terms.php">Semesters</a></li>
                        <li><a href="A_1.4_admins.php">Admins</a></li>
                        <li><a href="A_1.5_Professors.php">Professors</a></li>
                        <li class="active"><a href="A_1.6_courses.php">Courses</a></li>
                        <li class="dropdown" style="margin-right: 10px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span id="position">
                                    Admin: 
                                </span>
                                <span id="userName">
                                  <?php
                                    $q1="select Admin_name from admin where Admin_username = ?;";
                                    $rows=$db->getRows($q1,array($_SESSION['adm']));
                                      if(count($rows)>0){
                                        foreach($rows as $r1){
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
            <table class="table" style="width:50%;" >
                <tr class="Row" scope="row">
                    <th width="5%">
                      
                    </th>
                    <th width="60%">
                        <label class=""> Course </label>
                    </th>
                    
                    <th width="10%"></th>
                    <th width="5%"></th>
                </tr>
                <tr>
                  <form method="POST"> <!--add Admin return to same page-->
                    <td></td>
                    <td>
                        <input type="text" class="course form-control" name= "cname" required >
                    </td>
                    <td>
                        <button type="submit" class="btn btn-success" name="sub">Add course</button>
                    </td>
                   </form>
                </tr>
                <?php
                     $qq="select Course_name from course;";
                    $courses=$db->getRows($qq,array());
                     foreach($courses as $course)
                {
                   echo '
                <tr>
                    <td></td>
                     
                    <td data-toggle="modal" data-target="#mailPopup">
                      <br>
                      '.$course[0].'
                      
                    </td> 
                     
                    <td>
                        <div class="row_options">
                            <a id="edit" onclick="editCourse(\''.$course[0].'\');" data-toggle="modal" data-target="#editcourse" title="Edit" style="cursor: pointer;">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true" </span>
                            </a>
                            <br><br>
                            <a id="delete" onclick="delCourse(\''.$course[0].'\');" data-toggle="modal" data-target="#deletePopup" title="Remove" style="cursor: pointer;">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </a>
                        </div>
                    </td>
                    <td></td>
                </tr>';
               }
                     ?> 
            </table>
        </div>
        <br><br><br><br><br><br>
        <nav class=" nav navbar-bottom">
        </nav>
        
        
        <!--poopup-->
        <div id="popup" uib-modal-window="modal-window" class=" popup modal fade ng-scope ng-isolate-scope in" role="dialog" size="sm" index="0" animate="animate" ng-style="{'z-index': 1050 + $$topModalIndex*10, display: 'block'}" tabindex="-1" uib-modal-animation-class="fade" modal-in-class="in" modal-animation="true" style="z-index: 1050; visibility:hidden;display: block;" onchange="document.body.style.opacity='1'";>
            <div class="mod-log modal-dialog modal-sm" >
                <div class="logout-modal modal-content" uib-modal-transclude="">
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
        
        <div class="modal fade" id="editcourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            
            <form method="POST"> <!--Return to same page -- show that edit was succesfully -->  
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle"> <b>Edit course name</b> </h5>
                    </div>
                    <div class="modal-body">
                        <label class="studName"> Cousre name </label>
                        <br>
                         <div class="countainer">
                            <input id="popup_name_New" name = "popup_name_New" type="text" class="c course form-control" value="" required>
                          </div>
                    </div>
                    <input type="hidden" id="popup_name"class="" name= "popup_name" >
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
              <div class="del-mod modal-content">
                <form method="POST">
                  <div class="modal-body">
                      Are you sure to remove this course ?
                  </div>
                  <input type="hidden" id="del_popup_hdn" name="del_popup_hdn">
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-success" name="submit4" >Remove</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </body>
    <script>
      function editCourse(course){
        document.getElementById('popup_name_New').value=course;
        document.getElementById('popup_name').value=course;
      }
      function delCourse(course){
        document.getElementById('del_popup_hdn').value=course;
      }
    </script>
</html>
