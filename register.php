<?php
// include database connection configs and constants
require_once("config/db.php");

// load the registration class
require_once("classes/Registration.php");

// create the registration object.
$registration = new Registration();

// show the register form
include("views/register.php");