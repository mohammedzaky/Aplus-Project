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
        <title> A+ | Professor </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="P_1_home/css/bootstrap.css">
        <link rel="stylesheet" href="P_1_home/css/rtl.css">
        <link rel="stylesheet" href="P_1_home/css/style.css">
        <script src="P_1_home/js/jquery.css"></script>
        <script src="P_1_home/js/bootstrap.min.js"></script>
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
                <h4 class="welcProf"> Welcome professor
                    <span>
    <?php
        $q1="select Professor_name from professor where Professor_username = ?;";
        $rows=$db->getRows($q1,array($_SESSION['ur']));
          if(count($rows)>0)
            {
              foreach($rows as $r1)
              {
                    echo $r1[0];
              }
            }
       ?>

                    </span>
                </h4>
                <br>
                <a href="P_1.1_setExam.php" class=" bt btn btn-squared-default-plain ">
                    <i class="fa fa-laptop fa-5x"></i>
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    <br>
                    <span class="glyphicon-class">New exam</span>
                </a>
                <a href="P_1.2_course.php" class=" bt btn btn-squared-default-plain ">
                    <i class="fa fa-laptop fa-5x"></i>
                    <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                    <br>
                    <span class="glyphicon-class">Courses</span>
                </a>
                <a href="P_1.3_courseDegrees.php" class=" bt btn btn-squared-default-plain ">
                    <i class="fa fa-laptop fa-5x"></i>
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <br>
                    <span class="glyphicon-class">Enrolled students</span>
                </a>
                
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

