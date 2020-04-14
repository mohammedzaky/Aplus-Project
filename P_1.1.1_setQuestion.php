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
?>
<!DOCTYPE html>
<html>
    <head>
        <title> A+ | Professor</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="P_1.1.1_setQuestion/css/bootstrap.css">
        <link rel="stylesheet" href="P_1.1.1_setQuestion/css/rtl.css">
        <link rel="stylesheet" href="P_1.1.1_setQuestion/css/style.css">
        <script src="P_1.1.1_setQuestion/js/jquery.css"></script>
        <script src="P_1.1.1_setQuestion/js/bootstrap.min.js"></script>
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
                        <li><a href="P_1_home.php">home</a></li>
                        <li class="active"><a href="P_1.1_setExam.php">New exam</a></li>
                        <li><a href="P_1.2_course.php">Courses</a></li>
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
                            <ul class="dropdown-menu">
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
        <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
        <div align="center">
             <?php

             $nq=$_SESSION['nqq'];
             $cn=$_GET['course'];
             $pn=$_GET['profn'];
             $z=0;
             echo ' <form action="sq.php" method="post">
            <table class="table">
             ';

                for($i=1;$i<=$nq;$i++)
                {
                 $z++;
                 echo '
                             <tr class="quesRow" scope="row">
                                <td>
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#mcq_q'.$i.'" role="tab" aria-controls="home" aria-selected="true">
                                        <input type="button" class="save btn btn-success " aria-haspopup="false" aria-expanded="true" text-decoration=" none" value="Malti-choice">
                                    </a>
                                    <br>

                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tf_q'.$i.'" role="tab" aria-controls="profile" aria-selected="false">
                                        <input type="button" class="save btn btn-success " aria-haspopup="false" aria-expanded="true" text-decoration=" none" value="True & false">
                                    </a>
                                </td>
                                <td>
                                    <label class="quesNumb"> Question'.$i;
                                    echo ' </label>
                                    <br>
                                    <TEXTAREA name="qs[]" class="form-control" id="ques" name="Address" rows=5 cols=250 placeholder="Write a question here"required ></TEXTAREA>
                                </td>
                                <td>
                                   <div class="tab-content">

                                         <div class="tab-pane active" id="mcq_q'.$i.'" role="tabpanel" aria-labelledby="home-tab">
                                            <label for="ans_a">
                                                a.
                                            </label>
                                            <input type="text" class="ans form-control" id="ans_a[]" name="ans_a[]" name="aa">
                                            <br>
                                            <label for="ans_b">
                                                b.
                                            </label>
                                            <input type="text" class="ans form-control" id="ans_b[]" name="ans_b[]" name="ab">
                                            <br>
                                            <label for="ans_c">
                                                c.
                                            </label>
                                            <input type="text" class="ans form-control" id="ans_c[]" name="ans_c[]" name="ac">
                                            <br>
                                            <label for="ans_d">
                                                d.
                                            </label>
                                            <input type="text" class="ans form-control" id="ans_d[]" name="ans_d[]" name="ad">
                                            <br><br><br>
                                            <div class="mcq btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="b btn btn-secondary ">
                                                  <input type="radio" name="opt[]_'.$i.'" name="rd" id="option1" autocomplete="off" value="Question_a" > a
                                                </label>
                                                <label class="b btn btn-secondary">
                                                  <input type="radio" name="opt[]_'.$i.'" name="rd" id="option2" autocomplete="off" value="Question_b"> b
                                                </label>
                                                <label class="b btn btn-secondary">
                                                  <input type="radio" name="opt[]_'.$i.'" name="rd" id="option3" autocomplete="off" value="Question_c"> c
                                                </label>
                                                <label class="b btn btn-secondary">
                                                  <input type="radio" name="opt[]_'.$i.'" name="rd" id="option3" autocomplete="off" value="Question_d"> d
                                                </label>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tf_q'.$i.'" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="t_f btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class=" b btn btn-secondary ">
                                                  <input type="radio" name="opt[]_'.$i.'" id="option1" autocomplete="off" value="true"> True
                                                </label>
                                                <label class="b btn btn-secondary">
                                                  <input type="radio" name="opt[]_'.$i.'" id="option2" autocomplete="off" value="false"> False
                                                </label>
                                                <input type="hidden" name="con" value="'.$z.'" >
                                                <input type="hidden" name="cn" value="'.$cn.'" >
                                                <input type="hidden" name="pn" value="'.$pn.'" >
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                             ';
                        }

                        echo ' </table>
                    		<br><br><br>
                        	<div class="top_control">
		                    <input name="sb" type="submit" class="save btn btn-success " aria-haspopup="true" aria-expanded="false" text-decoration=" none" value="Save">
		                </div>
		            </form> ';

                        ?>
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
            </div>
        </div>
    </body>
</html>

