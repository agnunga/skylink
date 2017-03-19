<?php

session_start();

class Session {

    public static function logged_in($user) {

        return isset($_SESSION[$user]);
    }

    public static function confirm_logged_in($_user) {

        if (!Session::logged_in($_user)) {
            Redirect::to("./login.php?rdr=0");
            exit();
        }
    }

    public static function logout() {

        if (isset($_COOKIE[session_name()])) {

            setcookie(session_name(), '', time() - 72000, '/');
        }
        session_unset();
        session_destroy();
        Redirect::to("./login.php?rdr=0");
        exit();
    }

    public static function confirm_password_chanded($table, $user_col, $session) {
        global $db;
        $pwd = sha1($session);
        $query = "SELECT $user_col FROM $table WHERE $user_col = '$session' "
                . " AND pwd = '$pwd'";
        if ($db->select($query, NULL, NULL) == 1) {
            Redirect::to("");
            exit();
        }
    }

}
