<?php
// once we load this index page using htaccess we start our session
session_start();
// require our initialization file which actually loads every thing in the core folder
require '../app/core/init.php';
// instantiating the App class 
$app = new App;
$app->loadController();