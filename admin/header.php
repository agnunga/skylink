<?php (isset($_GET['rdr']) && ($_GET['rdr'] == "logout") ? Session::logout() : ''); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!--[if IE]>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <![endif]-->
        <title>Skylink Admin Dashboard</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME ICONS  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <link href="../assets/cupertino/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/cupertino/theme.css" rel="stylesheet" type="text/css"/>
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" /> 
        <link href="assets/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>


        <script src="../assets/js/jquery-2.1.4.min.js" type="text/javascript"></script>

    </head>
    <body>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!--<strong>Email: </strong>isaqqmuhiri@gmail.com-->
                        <!--&nbsp;&nbsp;-->
                        <strong>Support: </strong>+254 715 027 883 / +254 712 929 181
                    </div>

                </div>
            </div>
        </header>
        <!-- HEADER END-->
        <div class="navbar navbar-inverse set-radius-zero">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./index.php">

                        <img src="assets/img/logo.png" />
                    </a>

                </div>

                <div class="left-div">
                    <div class="user-settings-wrapper">
                        <ul class="nav">

                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                    <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
                                </a>
                                <div class="dropdown-menu dropdown-settings">
                                    <div class="media">
                                        <a class="media-left" href="#">
                                            <img src="assets/img/64-64.jpg" alt="" class="img-rounded" />
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">Ndungu </h4>
                                            <h5>ADMIN</h5>

                                        </div>
                                    </div>
                                    <hr />
                                    <h5><strong>Roles : </strong></h5>
                                    System Administrator
                                    <hr />
                                    <!--                                    <?php
                                    if (isset($_POST['logout'])) {
//                                        session_unset();
//                                        session_destroy();
//
//                                        mysqli_close($conn);
//
//                                        header('location:../index.php');
                                    }
                                    ?>
                                                                        <form class="form-inline" method="post" action="">
                                                                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                                            <input name="logout" type="submit" class="btn btn-danger btn-sm" value = 'Logout'>
                                                                        </form>-->


                                </div>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- LOGO HEADER END-->
        <section class="menu-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar-collapse collapse ">
                            <ul id="menu-top" class="nav navbar-nav navbar-right">
                                <li><a class="menu-top-active" href="index.php">Dashboard</a></li>
                                <!--                                <li><a href="View_Agents.php">View Agents</a></li>
                                                                <li><a href="add_agent.php">Create Agent</a></li>-->

                                <li>
                                    <li><a href="?rdr=logout"><i  class="glyphicon glyphicon-log-out"></i>logout</a></li>
                                    <!--                                    <form class="form-inline" method="post" action="">
                                                                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                                            <input name="logout" type="submit" class="btn btn-danger btn-sm" value = 'Logout'>
                                                                              
                                                                        </form>-->
                                </li> 
                                <!--                                <li><a href="forms.html">Forms</a></li>
                                                                <li><a href="blank.html">Blank Page</a></li>  
                                                                <li><a href="blank.html">Blank Page</a></li>  -->




                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>