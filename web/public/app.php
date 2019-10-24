<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 25/07/2018
 * Time: 19:22
 */

use Model\Base\Request;
use Model\Base\Response;

/**
 * @var Composer\Autoload\ClassLoader $loader
 */
$loader = require __DIR__ . '/../app/autoload.php';

$requestUri = $_SERVER["PATH_INFO"];

spl_autoload_register(function ($class_name) {
    include  __DIR__ . '/../src/' .str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
});


try{
    $request = (new Request($requestUri))->matchRequestUri();
    $response = (new Response($request))->getResponse();
}catch (\Exception $exception){
    echo $exception->getMessage();
}

