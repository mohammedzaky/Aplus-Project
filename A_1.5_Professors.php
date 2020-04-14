<?php

   include("DB.php");
  session_start();
  if(isset($_SESSION['adm']))
  {
  }
  else
  {
    header("Location:0_login.php");
  }
if(isset($_POST['submit2']))
{
        $id=$_POST['popup_hidden_ID'];
        $aname=$_POST['popup_name'];
        $uname=$_POST['popup_username'];
        $paswd=$_POST['popup_password'];
        $email=$_POST['popup_email'];
        $tele=$_POST['popup_tel'];

         $q="UPDATE  professor  SET  Professor_name  =   ?  ,  Professor_username  =   ?  ,  Professor_password  =   ?   ,Professor_email =   ?  , Professor_telephone =   ?   WHERE  professor . Professor_ID  =   ?  ;";
                    $row=$db->queryOp($q,array($aname,$uname,$paswd,$email,$tele,$id));

}
else
    {  echo "<h1>Ahmed Kamel fen el talaba</h1>"; }

if(isset($_POST['submit3']))
{
        $id=$_POST['del_popup_hdn'];
       

         $q="DELETE FROM `professor` WHERE `professor`.`Professor_ID` = ?";
         $row=$db->queryOp($q,array($id));

}

 if(isset($_POST['submit']))
    {
        $aname=$_POST['aname'];
        $uname=$_POST['uname'];
        $paswd=$_POST['pass'];
        $email=$_POST['mail'];
        $tele=$_POST['tel'];

   if(strlen($aname)>=3 && strlen($uname)>=3 && strlen($paswd)>=3)
        {
            $chu=substr($uname,0,2);
            $uname= strtolower($uname);
            $chu=strtolower($chu);
            if($chu== "p_")
                {
                    //  ex- > input:p_sultan  in DB -> p_sultan
                    $q="INSERT INTO `professor` (`Professor_name`, `Professor_username`, `Professor_password`, `Professor_email`, `Professor_telephone`) VALUES (?,?,?,?,?)";
                    $db->queryOp($q,array($aname,$uname,$paswd,$email,$tele));
                }
            else if ( $chu == "s_"){

                        //  ex- > input:s_sultan  in DB -> p_sultan
                        $chu="p_";
                        $search="s_";
                        $uname = str_replace($search, '', $uname);
                        $uname2=$chu.$uname;
                        $q="INSERT INTO `professor` (`Professor_name`, `Professor_username`, `Professor_password`, `Professor_email`, `Professor_telephone`) VALUES (?,?,?,?,?)";
                    $db->queryOp($q,array($aname,$uname2,$paswd,$email,$tele));       

                }
                else if ( $chu == "a_"){

                        //  ex- > input:a_sultan  in DB -> p_sultan
                        $chu="p_";
                        $search="a_";
                        $uname = str_replace($search, '', $uname);
                        $uname2=$chu.$uname;
                        $q="INSERT INTO `professor` (`Professor_name`, `Professor_username`, `Professor_password`, `Professor_email`, `Professor_telephone`) VALUES (?,?,?,?,?)";
                    $db->queryOp($q,array($aname,$uname2,$paswd,$email,$tele));       

                }
            else {
                        // deafult ex- > input:sultan  in DB -> p_sultan
                        $chc="p_";
                        $uname2=$chc.$uname;
                        $q="INSERT INTO `professor` (`Professor_name`, `Professor_username`, `Professor_password`, `Professor_email`, `Professor_telephone`) VALUES (?,?,?,?,?)";
                    $db->queryOp($q,array($aname,$uname2,$paswd,$email,$tele));       
            }
       }
   }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title> A+ | Admin </title>                           <!--course Title-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="A_1.5_Professors/css/bootstrap.css">
        <link rel="stylesheet" href="A_1.5_Professors/css/rtl.css">
        <link rel="stylesheet" href="A_1.5_Professors/css/style.css">
        <script src="A_1.5_Professors/js/jquery.css"></script>
        <script src="A_1.5_Professors/js/bootstrap.min.js"></script>
        <script>
            function editID(IDnum,num){
              document.getElementById("popup_hidden_ID").value=IDnum;
              document.getElementById("popup_name").value = document.getElementById("name_"+num).innerHTML;
              document.getElementById("popup_username").value = document.getElementById("username_"+num).innerHTML;
              document.getElementById("popup_password").value = document.getElementById("password_"+num).innerHTML;
              document.getElementById("popup_email").value = document.getElementById("mail_"+num).innerHTML;
              document.getElementById("popup_tel").value = document.getElementById("phone_"+num).innerHTML;
            }
            function delID(IDnum){
              document.getElementById("del_popup_hdn").value=IDnum;
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
                        <li><a href="A_1.1_terms.php">Semesters</a></li>
                        <li><a href="A_1.4_admins.php">Admins</a></li>
                        <li class="active"><a href="A_1.5_Professors.php">Professors</a></li>
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
                        <label class=""> Professor name </label>
                    </th>
                    <th>
                        <label class="">  Username</label>
                    </th>
                     <th>
                        <label class="">  Password</label>
                    </th>
                     <th>
                        <label class="">  E-mail</label>
                     </th>
                    <th>
                        <label class=""> Telephone </label>
                    </th>
                    <th></th>
                </tr>
                <tr>
                    <form method="POST"> <!--add prof return to same page-->
                        <td>
                            <input type="text" class="course form-control" name= "aname" required>
                        </td>
                        <td>
                            <input type="text" class="course form-control" name= "uname" required>
                        </td>
                        <td>
                            <input type="password" class="course form-control" name= "pass" required >
                        </td>
                        <td>
                            <input type="email" class="course form-control" name= "mail" required>
                        </td>
                        <td>
                            <input type="tel" class="course form-control"  name= "tel" required>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success"  name="submit" onclick="document.Form.submit();" >Add professor</button>
                        </td>
                    </form>
                </tr>
<?php  
            $q="SELECT * FROM professor";
            $rows=$db->getRows($q,array());
                $i=1;
                 if(count($rows)>0){
                foreach($rows as $row)
                     {
             echo "<tr> 
                   <td>
                        <br>
                        <span id='name_$i' class='crs_info'>$row[1]</span>
                    </td>
                    <td>
                        <br>
                        <span id='username_$i' class='crs_info'>$row[2]</span>
                    </td>
                    <td>
                        <br>
                        <span id='password_$i' class='crs_info'>$row[3]</span>
                    </td>
                    <td>
                        <br>
                        <span id='mail_$i' class='crs_info'>$row[4]</span>
                    </td>
                    <td>
                        <br>
                        <span id='phone_$i' class='crs_info'>$row[5]</span>
                    </td>
                    <td>
                        <div class='row_options'>
                            <a id='edit_$i' onclick='editID($row[0],$i);' data-toggle='modal' data-target='#editProf' title='Edit' style='cursor: pointer;'>
                                <span class='glyphicon glyphicon-edit' aria-hidden='true'></span>
                            </a>
                            <br><br>
                            <a id='delete_$i' onclick='delID($row[0]);' data-toggle='modal' data-target='#deletePopup' title='Remove' style='cursor: pointer;'>
                                <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
                            </a>
                        </div>
                    </td>
                </tr>";
                $i++;
            }}
?>
        </table>
        </div>
        <br><br><br><br><br><br>
        <nav class='nav navbar-bottom'>
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
        
     
        <!--Edit ppopup-->
        <div align="center"class="addCourses modal fade" id="editProf" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <form method ="POST" >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                             <h4 class="modal-title" id="exampleModalCenterTitle"><b> Professor information</b></h4>
                        </div>
                        <div class="modal-body">
                            <table>
                              <tr>
                                 <td>
                                    <br>
                                    <div class="countainer">
                                       <label> Prof. name </label>
                                    </div>
                                 </td>
                                 <td>
                                    <br>
                                    <div class="countainer">
                                       <input id="popup_name" name = "popup_name" type="text" class="c course form-control" value="    " required>
                                     </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <br>
                                    <div class="countainer">
                                       <label> Username </label>
                                    </div>
                                 </td>
                                 <td>
                                    <br>
                                    <div class="countainer">
                                        <input id="popup_username" name = "popup_username" type="text" class="c course form-control" required>
                                    </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <br>
                                    <div class="countainer">
                                       <label> Password </label>
                                       </div>
                                 </td>
                                 <td>
                                    <br>
                                    <div class="countainer">
                                        <input id="popup_password" name = "popup_password" type="text" class="c course form-control" required>
                                    </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <br>
                                    <div class="countainer">
                                       <label> E-mail </label>
                                    </div>
                                 </td>
                                 <td>
                                    <br>
                                    <div class="countainer">
                                       <input id="popup_email" name = "popup_email" type="email" class="c course form-control" required>
                                    </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <br>
                                    <div class="countainer">
                                       <label> Telephone </label>
                                    </div>
                                 </td>
                                 <td>
                                    <br>
                                    <div class="countainer">
                                        <input id="popup_tel" name = "popup_tel" type="tel" class="c course form-control" required>
                                    </div>
                                 </td>
                              </tr>
                              <input id="popup_hidden_ID" name = "popup_hidden_ID" type="hidden" value="">
                            </table>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                           <button type="submit" class="btn btn-success" name="submit2"  >Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <!--delete popup-->
        <div class="modal fade" id="deletePopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                
                <form method="POST">
                  <div class="mod-del modal-content">
                    <input type="hidden" id="del_popup_hdn" name="del_popup_hdn">
                    <div class="modal-body">
                        Are You sure you want to remove this professor?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" name="submit3" >Remove</button>
                    </div>
                  </div>
              </form>
            </div>
        </div>
    </body>
</html>
