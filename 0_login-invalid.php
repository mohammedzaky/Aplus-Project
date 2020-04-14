<!--
    <body onload="document.body.style.opacity='1';">
    </body>
    <style>
        body{ 
            opacity:0;
            transition: opacity 2s;
            -webkit-transition: opacity 2s; /* Safari */
        }
    </style>
-->


<!DOCTYPE html>
<html>
    <head>

        <title> A+ </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="0_login/css/bootstrap.css">
        <link rel="stylesheet" href="0_login/css/rtl.css">
        <link rel="stylesheet" href="0_login/css/style.css">
        <script src="0_login/js/jquery.css"></script>
        <script src="0_login/js/bootstrap.min.js"></script>
        
    </head>
    <body background="img/background.png"  onload="document.body.style.opacity='1';">
        
        <nav class="navbar ">
                
                    <img class="navbar-brand" src="img/logo-white-small.png"></a>
            
        </nav>
        <!--<nav class=" navbar-fixed-top ">
            
                <img class="logo" src="img/logo-white-small.png" alt="logo">
                <!--<img class="img-responsive"src="img/logo-white-small.png" />-->
            
        <!--</nav>-->
        <div align="center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="media">
                        <div class="media-body">
                            <h4 class="media-heading">Login</h4>
                            <h5 class="media-heading-down ">Enter your username and password</h5>
                        </div>
                        <div class="media-right">
                            <img class="media-object" src="img/loginKey.png">
                        </div>
                    </div>
                </div>

                    <div class="panel-body">
                        <div class="alert alert-danger" style="margin-bottom: 0px;" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        Enter a valid username or password
                    </div>
                    <form action="check.php" method="post">
                        <br>
                        <input type="text" name="usr" class="form-control" placeholder="Username" required>
                        <br>
                        <input type="password" name="pwd" class="form-control" aria-describedby="sizing-addon2" placeholder="Password" required>
                        <br>
                       <input type="submit" name="st" class=" btn btn-success " value="Sign in">
                        <br>
                        </form>
                    </div>   
            </div>
        </div>

    </body>
</html>

