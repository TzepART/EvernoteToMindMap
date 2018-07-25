<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 25/07/2018
 * Time: 19:22
 */

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;

/**
 * @var Composer\Autoload\ClassLoader $loader
 */
$loader = require __DIR__.'/../app/autoload.php';


//// looks inside *this* directory
//$fileLocator = new FileLocator(array(__DIR__));
//$loader = new YamlFileLoader($fileLocator);
//$routes = $loader->load(__DIR__.'/../app/config/routes.yaml');

$fileLocator = new FileLocator(array(__DIR__));
$requestContext = new RequestContext('/');

$router = new Router(
    new YamlFileLoader($fileLocator),
    __DIR__.'/../app/config/routes.yaml',
    array('cache_dir' => __DIR__.'/../app/cache'),
    $requestContext
);

$path = str_replace('/app.php','',$_SERVER["REQUEST_URI"]);


echo "<pre>";
    var_dump($router->match($path));
echo "</pre>";




//$request = Request::createFromGlobals();
//$response = $kernel->handle($request);
//$response->send();