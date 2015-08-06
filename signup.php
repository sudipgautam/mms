<?php
    session_start();
    require_once('cfg/config.php');
    require_once('cfg/common.php');
    $success_registration = 0;
    if (isset($_POST['submit_btn'])) {
        if (($_POST['submit_btn']) == "submit_val"){
            $ch = new clean_and_hash();
            $name       = $ch->clean_all_tags($_POST['name']);
            $email      = $ch->clean_all_tags($_POST['email']);
            $password   = $ch->clean_all_tags($_POST['password']);
            $c_password = $ch->clean_all_tags($_POST['c_password']);
            if ($password != $c_password ){
                header('location:signup.php?error=1');
            }            
            $secure_pass = $ch->password_hash($email,$password);
            $activation_id = $ch->get_activation_code($email);
            $dbconn = new db_connection();
            $prepare_statement = "SELECT * from ".user_profile." where email = '".$email."' and reg_type='self'";
            $result = $dbconn->query($prepare_statement);
            $num_rows = $result->num_rows;
            if($num_rows == 0 ){    
                // new users 
                $insert_statement = "INSERT into ".user_profile." (email,password,name,activation_id) values ('".$email."','".$secure_pass."','".$name."','".$activation_id."')";
                $insert_cmd = $dbconn->query($insert_statement);
                if ($insert_cmd) {
                    $success_registration = 1; 
                }
                else {
                        $success_registration = 0;
                }
            }
            else  {
                // user already exists send back to login.php with some verify & userid 
                header('location:login.php?return=verify&user='.$email);
                //print "User already registered";

            }
        }
        else {
            print "You are trying to mess with stuff";
            header('location:index.php');
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
                    if (isset($_GET['error']) && ($_GET['error'] == 1)) {
                       print "<div align='center'><h4 class='media-heading'>You tried to cheat our validator</h4></div>";
                    }
                    if( $success_registration == 1 ){

                        echo "  <h4 class='media-heading'>You have been successfully registered.<br>
                                An activation email has been sent to <b> $email </b> with acitvation code. Please activate 
                                your account by loggin into your registered email. <br><br>
                                    <a align='right' href='login.php'>Login</a> </h4></div>";
                    }
                    else {
                ?>
                <h4 class="media-heading">Hola! Lets Sign Up </h4></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8 col-sm-8  sp-effect1">
                                <form data-toggle="validator" id="signup" role="form" method="POST" >
                                    <div class="form-group">
                                        <input type="name" class="form-control" name="name" id="name" placeholder="FirstName LastName" data-minlength="2" 
                                            pattern="^[a-zA-Z]+ [A-Za-z]+$" data-error="you need Firstname & Lastname" required >
                                        <span class="help-block with-errors"></span>
                                    </div>

                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" data-error="thats not valid email address" required >
                                         <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" data-minlength="6" required >
                                        <span class="help-block">Minimum of 6 characters</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="c_password" id="c_password" placeholder="Confirm Password" 
                                            data-match="#password" data-match-error="Whoops, password don't match" data-minlength="6" required >
                                        <div class="help-block with-errors"></div>

                                    </div>
                                    <button type="submit" name="submit_btn" value="submit_val" class="btn btn-primary btn-lg">Sign Up</button>
                                </form>
                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="media-heading"> Already Sign Up ? <a href="login.php">Login</a> </h4>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        ?>
        </div>

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/placeholdem.min.js"></script>
    <script src="js/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
    <script src="js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/validator.min.js"></script>




</body>