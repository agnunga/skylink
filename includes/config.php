<?php
$conn = mysqli_connect("localhost", "root", "", "skylink");
if ($conn) {
    //echo "CONNECTED";
} else {
    echo "Connection failed";
}
