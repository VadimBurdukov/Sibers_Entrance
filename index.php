<?
require 'app/lib/Dev.php';
use app\core\Router;

// Autoloader for classes
spl_autoload_register(function($class){
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
    	require $path;
    }
});

session_start();

/*
 * Create an instance of route class, to compare the URL with controllers and actions
 */
$router = new Router;
$router -> RunRouter();
?> 