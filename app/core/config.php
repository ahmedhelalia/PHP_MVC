<?php
if($_SERVER['SERVER_NAME'] == 'localhost'){
define('ROOT','http://localhost/mvc/public');
}else{
// When you move your website to online system
 define('ROOT','https://www.yourwebsite.com');
}