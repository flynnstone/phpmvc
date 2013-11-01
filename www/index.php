<?php
/**
 * Site index page.
 * 
 * This file serves as the web facing side of the mvc.  It is the only file that
 * needs to be in the web root.  The rest of the files should be located above
 * the web root for security.
 * 
 * @author Stephen Flynn
 * 
 */
define('DEBUG', 'TRUE');

if (DEBUG == True) {
    error_reporting(~0);
    ini_set('display_errors', 1);
}


define('SERVER_ROOT', '/home/steve/Programming/php/phpmvc');
define('SITE_URL', 'localhost:88');
define('TEMPLATE_DIR', SERVER_ROOT . '/views');
/**
 * Include Main Router
 */
require_once(SERVER_ROOT . '/controllers/routes.php');
?>