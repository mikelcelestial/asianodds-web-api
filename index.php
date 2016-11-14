<?php
/* ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1); */

// include database connection configs and constants
require_once("config/db.php");

// load the login class
require_once("classes/Login.php");

// create the login object
$login = new Login();

// ask if we are logged in and show proper view
if ($login->isUserLoggedIn() == true) {
	include("views/logged_in.php");
} else {
    include("views/not_logged_in.php");
}
