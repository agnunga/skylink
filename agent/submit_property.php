<?php

require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php");
Session::confirm_logged_in('login_user1');

//Session::confirm_password_chanded('mngmt', 'uname', $_SESSION['uname']); 

$plot_id = $_POST['plot_id'];
$estate = $_POST['estate'];
$house_no = $_POST['roomnumber'];
$rent = ($_POST["rent"]);
$state = ($_POST["state"]);
$housetype = ($_POST["housetype"]);
$owner = ($_POST["owner"]);

$sql = "insert INTO plots values ('', '$plot_id', '$estate', '$house_no','$rent', '&state', '&housetype', '&owner' )";
$res = mysqli_query($conn, $sql);

if ($res === false) {


    echo "very wrong", mysqli_error($conn);
}
echo '<script type="text/javascript"> alert ("plot successfully Created!!!");' . ' ' .
 'window.location=\'View_Agents.php\';</script>' .
 '';
?> 

