<?php
    session_start();
    require_once('cfg/config.php');
    require_once('cfg/common.php');
    $login_validation = 0;
    if (isset($_POST['submit_login'])) {
        if (($_POST['submit_login']) == "submit_mms_login"){
            $ch         = new clean_and_hash();
            $email      = $ch->clean_all_tags($_POST['email']);
            $password   = $ch->clean_all_tags($_POST['password']);
            $securepass = $ch->password_hash($email,$password);
            $dbconn     = new db_connection();
            $prepare_statement = "SELECT * from ".user_profile." where email='".$email."' and password='".$securepass."'";
            $result     = $dbconn->query($prepare_statement);
            if (($result->num_rows) == 1 ){
                $row = mysqli_fetch_assoc($result);
                if ($row['activation_id'] != "0" ){
                    $login_validation = -2 ; 
                }else {
                    $login_validation = 1;
                    $name                        = $row['name'];
                    $_SESSION['mms_logged_uid']  = $email;
                    $_SESSION['mms_logged_name'] = $name; 
                    header('location:dashboard.php');
                }
            }
            else {
                $login_validation = -1; 
            }

        }
    }


?>
<!doctype html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->


<head>
    <meta charset="UTF-8">
    <title>MyMoneySplit - LogIn to personalize your expenses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" href="favicon.png">

    <link rel="stylesheet" href="css/bootstrap.css">
    
    <link rel="stylesheet" href="css/animate.css">
    <!--<link rel="stylesheet" href="css/font-awesome.min.css">-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-social/4.2.1/bootstrap-social.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="js/rs-plugin/css/settings.css">

    <link rel="stylesheet" href="css/moneysplit.css">


    <script type="text/javascript" src="js/modernizr.custom.32033.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>

<body>
        
        <nav class="navbar navbar-default navbar-fixed-top scrolled" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="fa fa-bars fa-lg"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">
                           <div class="tp-caption logo_white_bold sft">
                                <img src="img/freeze/logo.png" alt="mymoneysplit.com">
                                
                            </div>
                        </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="index.php#home">home </a>
                            </li>                            
                            <li><a href="index.php#about">about</a>
                            </li>
                            <li><a href="index.php#features">features</a>
                            </li>
                            <li><a href="index.php#teams">team</a>
                            </li>
                            <li><a href="index.php#demo">demo</a>
                            </li>
                            <!--<li><a class="getApp" href="index.php#getApp">get app</a>
                            </li>-->
                            <li><a href="index.php#support">contact</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-->
            </nav>

        <!--TeamSlider-->
        <div class="login-container">
            <div class="divider">
                <?php
                    if ($login_validation == -1 ){
                        echo "<h5 class='media-heading'><font color=red> Invalid Login Please try again </font></h5>"; 
                    }
                    else if($login_validation == -2 ){
                        echo "<h5 class='media-heading'><font color=red> Your account is not yet activated. Please check your Email
                                $email </font></h5>"; 
                    }

                ?>
                <h4 class="media-heading">Sign in</h4>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8 col-sm-8  sp-effect1">
                                <form id="signin" role="form" method="POST">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email Address">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> <h5 class="media-small">Remember me</h5>
                                        </label>
                                    </div>                                   
                                    <button type="submit" name="submit_login" id="submit_login" value="submit_mms_login" class="btn btn-primary btn-lg">Login</button>
                                </form>

                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="media-heading"> Not yet <a href="signup.php">SignUp?</a> </h4>
                                    </div>
                                </div>
                                <div class="divider"><h4 class="media-body"> Or </h4></div>
                                <div class="media">
                                    <div class="media-body">                                
                                        <a class="btn btn-block btn-social btn-sm btn-facebook">
                                            <i class="fa fa-facebook"></i> Sign in with Facebook   
                                        </a>
                                    </div>
                                </div>                                    
                            </div>
                        </div>

                    </div>
                </div>
        </div>

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/placeholdem.min.js"></script>
    <script src="js/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
    <script src="js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/validation.js"></script>


</body>