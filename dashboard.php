<?php
session_start();
require_once('cfg/config.php');
require_once('cfg/common.php');
$dbconn     = new db_connection();

$email="sudipgtm@gmail.com" ; //this needs to come from session later //

$prepare_statement = "SELECT * from ".user_profile." where uid='".$email."'";
$result     = $dbconn->query($prepare_statement);
$row = mysqli_fetch_assoc($result);
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
    <title>MyMoneySplit - personalize your expenses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" href="favicon.png">

    <link rel="stylesheet" href="css/bootstrap.css">

    <link rel="stylesheet" href="css/animate.css">
    <!--<link rel="stylesheet" href="css/font-awesome.min.css">-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/moneysplit.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/dashboard.css">




    <!--<script type="text/javascript" src="js/modernizr.custom.32033.js"></script>

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
                           <div class="tp-caption  sft small_white_light">
                                <b>mymoneysplit.com</b>

                            </div>
                        </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#">Hello! <? echo $row['fullname']?> </a>
                            </li>
                            <li>
                              <a class="pure-button" href="#">
                                  <i class="fa fa-gears fa-lg"></i>
                              </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-->
        </nav>


        <!--TeamSlider-->
  <div class="wrapper">
              <div class="container">
                <div class="row">
                    <div class="col-md-3">
                      <div id='cssmenu'>
                        <ul>
                          <li class='last '><a href='#'><span>Dashboard</span></a></li>
                           <li class='active has-sub'><a href='#'><span>Expense</span></a>
                              <ul>
                                 <li class='last'><a href='#' onclick="LoadContent('add_expense')"><span>Add Expense</span></a>
                                 </li>
                                    <li class='last'><a href='#'><span>Settle Expense</span></a>
                                    </li>
                              </ul>
                           </li>
                           <li class='last'><a href='#'><span>Friends</span></a></li>
                        </ul>
                        </div>
                </div>
                <div class = "col-md-9">
                  <div class="content">
                    haha
                  </div>
                </div>
              </div>
            </div>

            <div class="container">
                <a href="#" class="scrollpoint sp-effect3">
                    <img src="img/freeze/logo.png" alt="" class="logo">
                </a>
                <div class="social">
                    <a href="#" class="scrollpoint sp-effect3"><i class="fa fa-twitter fa-lg"></i></a>
                    <a href="#" class="scrollpoint sp-effect3"><i class="fa fa-google-plus fa-lg"></i></a>
                    <a href="#" class="scrollpoint sp-effect3"><i class="fa fa-facebook fa-lg"></i></a>
                </div>
                <div class="rights">
                    <p>Copyright &copy; 2014</p>
                    <p>Copyright by mymoneysplit.com</p>
                </div>
            </div>

    </div>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slider.js"></script>
  <script>
  function LoadContent(url){
      $.get( "content/"+url+".html", function( data ) {
      $( ".content" ).html( data );
      console.log( "Load was performed for "+ url );
    });
  }
  </script>


</body>

</html>
