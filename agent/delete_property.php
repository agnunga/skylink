<?php

require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php");
Session::confirm_logged_in('login_user1');

//Session::confirm_password_chanded('mngmt', 'uname', $_SESSION['uname']); 

$phonenumber = $_GET['pn'];
$sql = "DELETE FROM agents WHERE phonenumber='$phonenumber'";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo '<script> alert ("Entry Deleted Successfully!!"); window.location.href=\'View_Agents.php\';</script>';
} else {
    echo '<script> alert ("THERE WAS AN ERROR DELETING THAT ENTRY!!"); window.location.href=\'View_Agents.php\';</script>';
}
?>