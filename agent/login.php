<?php
require_once ("../includes/session.php");
require_once ("../includes/redirect.php");
require_once ("../includes/config.php");
(Session::logged_in('login_user1') ? Redirect::to("./index.php?rdr=100") : '');
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Skylink| Agent | login</title>
        <!-- Core CSS - Include with every page -->
        <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href="assets/css/main-style.css" rel="stylesheet" />

    </head>

    <body class="body-Login-back">

        <div class="container">

            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
                    <img src="assets/img/logo.png" alt=""/>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">                  
                        <div class="panel-heading">
                            <h3 class="panel-title">Please Sign In</h3>
                        </div>
                        <div class="panel-body">

                            <?php
                            if (isset($_POST["login"])) {


                                $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
                                $mypassword = mysqli_real_escape_string($conn, $_POST['password']);

                                $sql = "SELECT * FROM agents WHERE phonenumber = '$phonenumber' AND password = '$mypassword'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result);
//$active = $row['active'];

                                $count = mysqli_num_rows($result);


                                if ($count == 1) {
                                    $_SESSION['login_user1'] = $row['firstname'] . ' ' . $row['secondname'];
                                    Redirect::to("./index.php?rdr=1");
                                } else {

                                    echo '<script type="text/javascript"> alert ("LOGIN FAILED!! INVALID PHONE NUMBER OR PASSWORD!!"); ' . ' ' .
                                    'window.location=\'index.php\';</script>' .
                                    '';
//   echo mysqli_error($conn);
//  $error = "Your Login Name or Password is invalid";
                                }
                            }
                            ?> 

                            <form role="form" method="post" action="">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Phone number" name="phonenumber" required="" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="" required="">
                                    </div>

                                    <!-- Change this to a button or input when using this as a form -->
                                    <input type="submit" name="login" class="btn btn-outline btn-primary btn-lg btn-block"value="LOGIN">
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Core Scripts - Include with every page -->
        <script src="assets/plugins/jquery-1.10.2.js"></script>
        <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
        <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>

    </body>

</html>

<?php
require_once './footer.php';

