<?php
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    /** Data base config **/
    define('DB_NAME','myMVC_db');
    define('DB_HOST','localhost');
    define('DB_USER','root');
    define('DB_PASS','');

    define('ROOT', 'http://localhost/mvc/public');
} else {
    // When you move your website to online system
     /** Data base config **/
     define('DB_NAME','myMVC_db');
     define('DB_HOST','localhost');
     define('DB_USER','root');
     define('DB_PASS','');
     
    define('ROOT', 'https://www.yourwebsite.com');
}
define("APP_NAME",'My Website');
define("APP_DESC",'MVC Is Cool');
/**
 * true means show errors
 */
define('DEBUG',true);