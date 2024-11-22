<?php
// once we load this index page using htaccess we start our session
session_start();
// require our initialization file which actually loads every thing in the core folder
require '../app/core/init.php';
DEBUG ? ini_set('display_errors',1) : ini_set('display_errors',0);
// instantiating the App class 
$app = new App;
$app->loadController();
