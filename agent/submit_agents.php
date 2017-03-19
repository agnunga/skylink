<?php

require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php");
Session::confirm_logged_in('login_user1');

//Session::confirm_password_chanded('mngmt', 'uname', $_SESSION['uname']); 


$firstname = $_POST['firstname'];
$secondname = $_POST['secondname'];
$phone = $_POST['phonenumber'];
$password = md5($_POST["password"]);

$sql = "insert INTO agents values ('', '$firstname', '$secondname', '$phone','$password' )";
$res = mysqli_query($conn, $sql);

if ($res === false) {
    echo "very wrong", mysqli_error($conn);
}
echo '<script type="text/javascript"> alert ("Account successfully Created!!!");'
. ' window.location=\'admin_view_agents.php\';</script>';
?> 






