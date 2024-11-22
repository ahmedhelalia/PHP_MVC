<?php
// load whatever class you want that you cannot find
// it's only call the function if php tries to run a class and can't find it 
spl_autoload_register(function($className){
    require $fileName = "../app/models/".ucfirst($className).".php";
});
// every file in the core folder will be loaded here
require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';
