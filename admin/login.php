<?php
require_once ("../includes/session.php");
require_once ("../includes/redirect.php");
require_once ("../includes/config.php");
(Session::logged_in('login_user') ? Redirect::to("./index.php?rdr=100") : '');

if (isset($_POST["login"])) {
    // username and password sent from form 

    $myusername = mysqli_real_escape_string($conn, $_POST['username']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM admin_authenticate WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    //$active = $row['active'];

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if ($count == 1) {
        // session_register("myusername");
        $_SESSION['login_user'] = $myusername;

        Redirect::to("./index.php?rdr=1");
        exit();
    } else {
        ?>
        <div class="alert-danger alert-dismissable">
            <p>Login failed!</p>
            <p>Name or Password is invalid!</p>

        </div>
        <?php
        $error = "Your Login Name or Password is invalid";
    }
}
?>

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
        <title>Skylink Admin Dashboard -</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME ICONS  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row">
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
                    <a class="navbar-brand" href="../index.php">

                        <img src="assets/img/logo.png" />
                    </a>

                </div>

                <div class="left-div">
                    <i class="fa fa-user-plus login-icon" ></i>
                </div>
            </div>
        </div>
        <!-- LOGO HEADER END-->

        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="page-head-line">Please Login To Enter </h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h4> Login to <strong>Administrator Account  :</strong></h4>
                        <br />
                        <form id="form1" name="form1" method="post" action="">
                            <label>Enter USER ID : </label> <input type="text" class="form-control" required="required" name="username"/>
                            <label>Enter Password :  </label> <input type="password" class="form-control"required="required" name="password"/>
                            <hr />
                            <input type = "submit" value = "LOGIN" class="btn btn-success" name="login"> 
                        </form>
                    </div>
                    <div class="col-md-6">

                        <div class="alert alert-success">
                            <strong> Instructions To Use:</strong>
                            <ul>
                                <li>
                                    Enter your Username and
                                </li>
                                <li>
                                    Enter yor Password 
                                </li>
                                <li>
                                    to login to the Administrator Dashboard
                                </li>

                            </ul>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- CONTENT-WRAPPER SECTION END-->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        &copy; 2016 Skylink Agencies | By : <a href="#" target="_blank">Isaac Muchiri</a>
                    </div>

                </div>
            </div>
        </footer>
        <!-- FOOTER SECTION END-->
        <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY SCRIPTS -->
        <script src="assets/js/jquery-1.11.1.js"></script>
        <!-- BOOTSTRAP SCRIPTS  -->
        <script src="assets/js/bootstrap.js"></script>
    </body>
</html>
