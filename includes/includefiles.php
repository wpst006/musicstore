<?php
session_start();

require_once("settings.php");
require_once("includes/db.php");
require_once("includes/autoID.php");
require_once("includes/loginFunction.php");
require_once("includes/shoppingcartFunction.php");
require_once("includes/messageHelper.php");

$objLogIn = new logIn;
$isLoggedIn = $objLogIn->isLoggedIn();
?> 