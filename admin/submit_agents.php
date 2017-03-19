<?php

require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php"); 
Session::confirm_logged_in('login_user');

    require_once './header.php';


    $firstname = $_POST['firstname'];
    $secondname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $password = ($_POST["password"]);
    $added_by = $_SESSION['login_user'];



    $sql = "INSERT INTO `agents` (`firstname`, `secondname`, `phonenumber`, `password`, `added_by`) "
            . "VALUES ('$firstname', '$secondname', '$phone', '$password', '$added_by')";

    $res = mysqli_query($conn, $sql);

    if ($res === false) {


        echo "very wrong", mysqli_error($conn);
    } else {

        echo '<script type="text/javascript"> alert ("Account successfully Created!!!");' . ' ' .
        'window.location=\'View_Agents.php\';</script>' .
        '';
    }

    
?> 

