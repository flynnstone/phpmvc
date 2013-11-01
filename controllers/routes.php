<?php

/**
 * This controller script routes all incoming requests to the appropriate 
 * specific controller.
 * 
 * @author Stephen Flynn
 */
require_once SERVER_ROOT . '/vendor/autoload.php';
require_once SERVER_ROOT . '/vendor/twig/twig/lib/Twig/Autoloader.php';

Twig_Autoloader::register();



//Add model/controller classes to __autoload using an anonomous function and 
//spl_autoload_register.
spl_autoload_register(function( $className ) {
    list( $prefix, $filename ) = explode('_', $className);

    if ($prefix == 'Controller') {
        $file = SERVER_ROOT . '/controllers/' . strtolower($filename) . '.php';
    } elseif ($prefix == 'Model') {
        $file = SERVER_ROOT . '/models/' . strtolower($filename) . '.php';
    }
    if (file_exists($file)) {
        include_once $file;
    } else {
        throw new Exception('Class Not found');
    }
});

//List of controllers other than index controller.
$controllers = array(
    'pages'
);


//Check to see if a controller is specified. 
foreach ($controllers as $key => $parameter) {
    $value = filter_input(INPUT_GET, $parameter, FILTER_SANITIZE_STRING);
    if ($value === '') {
        $controller = $parameter;
        unset($_GET[$parameter]);
    }
}
if (!isset($controller)) {
    $controller = 'index';
}

//List of url parameters other than controllers.
$extraParameters = array(
    'slug' => ''
);

//Only parse those $_GET parameters we are expecting.
foreach ($extraParameters as $key => $parameter) {
    if (filter_input(INPUT_GET, $key, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH)) {
        $extraParameters[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    } else {
        unset($extraParameters[$key]);
    }
}

$class = 'Controller_' . ucfirst($controller);
$controller = new $class;
//Call controller main method to render page.
$controller->main($extraParameters);
?>
