<?php (isset($_GET['rdr']) && ($_GET['rdr'] == "logout") ? Session::logout() : ''); ?>
<!DOCTYPE html>
<html>
    <head>
        <!--        <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Skylink Agencies | Agent Dashboard </title>
                 Core CSS - Include with every page 
                <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
                <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
                <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
                <link href="../assets/cupertino/jquery-ui.css" rel="stylesheet" type="text/css"/>
                <link href="../assets/cupertino/theme.css" rel="stylesheet" type="text/css"/>
                <link href="assets/css/style.css" rel="stylesheet" />
                <link href="assets/css/main-style.css" rel="stylesheet" />
                 Page-Level CSS 
                <link href="assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
                <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>-->

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Skylink | Agent Dashboad</title>
        <!-- Core CSS - Include with every page -->
        <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href="assets/css/main-style.css" rel="stylesheet" />

        <!-- Page-Level CSS -->
        <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <link href="../assets/parsley/parsley.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/parsley/parsley.css" rel="stylesheet" type="text/css"/>


        <script src="../assets/js/jquery-2.1.4.min.js" type="text/javascript"></script>

    </head>
    <body>
        <!--  wrapper -->
        <div id="wrapper">
            <!-- navbar top -->
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
                <!-- navbar-header -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">
                        <img src="assets/img/logo.png" alt="" />
                    </a>
                </div>
                <!-- end navbar-header -->
                <!-- navbar-top-links -->
                <ul class="nav navbar-top-links navbar-right">
                    <!-- main dropdown -->


                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-3x"></i>
                        </a>
                        <!-- dropdown user-->
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i>User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i>Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="?rdr=logout"><i  class="fa fa-sign-out fa-fw"></i>logout</a></li>

                        </ul>
                        <!-- end dropdown-user -->
                    </li>
                    <!-- end main dropdown -->
                </ul>
                <!-- end navbar-top-links -->

            </nav>
            <!-- end navbar top -->

            <!-- navbar side -->
            <nav class="navbar-default navbar-static-side" role="navigation">
                <!-- sidebar-collapse -->
                <div class="sidebar-collapse">
                    <!-- side-menu -->
                    <ul class="nav" id="side-menu">
                        <li>
                            <!-- user image section-->
                            <div class="user-section">
                                <div class="user-section-inner">
                                    <img src="assets/img/user.jpg" alt="">
                                </div>
                                <div class="user-info">
                                    <div> <strong>
                                            <?php echo ((!isset($_SESSION['login_user1'])) ? 'NOT LOGGED IN' : $_SESSION['login_user1']); ?>                                        </strong></div>

                                </div>
                            </div>
                            <!--end user image section-->
                        </li>
                        <li class="sidebar-search">
                            <!-- search section-->

                            <!--end search section-->
                        </li>
                        <li class="selectedXXX">
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                        </li>

                        <li>
                            <a href="view_property.php"><i class="fa fa-flask fa-fw"></i>View Property</a>
                        </li>
                        <li>
                            <a href="view_tenants.php"><i class="fa fa-table fa-fw"></i>View Tenants</a>
                        </li>
                        <li>
                            <a href="view_landlords.php"><i class="fa fa-edit fa-fw"></i>View Landlords</a>
                        </li>
                        <li>
                            <a href="receive_rent.php" ><i class="fa fa-calendar fa-fw"></i>Receive rent</a> 
                        </li>
                        <li>
                            <a href="view_tenants.php" > <i class="fa fa-rss fa-fw"></i> View  tenants</a>
                        </li>
                        <li>
                            <a href="add_landlord.php" > <i class="fa  fa-pencil fa-fw"></i>Add a new Landlord  </a>
                        </li>
                        <li>
                            <a href="view_vacants.php"> <i class="fa fa-rss fa-fw"></i>View vacants houses   </a>
                        </li>



                    </ul>
                    <!-- end side-menu -->
                </div>
                <!-- end sidebar-collapse -->
            </nav>
            <!-- end navbar side -->