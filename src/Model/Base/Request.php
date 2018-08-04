<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 26/07/2018
 * Time: 01:33
 */

namespace Model\Base;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;
use \Symfony\Component\HttpFoundation\Request as BaseRequest;


/**
 * Class Request
 */
class Request extends BaseRequest
{
    const GUID_PARAMETER_NAME = 'guid';

    /**
     * @var string
     */
    protected $class;

    /**
     * @var string
     */
    protected $controllerMethod;

    /**
     * @var string
     */
    protected $routeName;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var string
     */
    protected $requestUri;

    /**
     * @var string
     */
    protected $guid = '';

    /**
     * Request constructor.
     * @param string $requestUri
     */
    public function __construct(string $requestUri)
    {
        parent::__construct();

        $fileLocator = new FileLocator(array(__DIR__));
        $requestContext = new RequestContext('/');

        // TODO cache turn off
        $this->router = new Router(
            new YamlFileLoader($fileLocator),
            __DIR__.'/../../../app/config/routes.yaml',
//            array('cache_dir' => __DIR__.'/../../app/cache'),
            array(),
            $requestContext
        );

        $this->requestUri = $requestUri;
    }

    /**
     * @return $this
     */
    public function matchRequestUri()
    {
        $result = $this->router->match($this->requestUri);

        if(!empty($result)){
            $this->setRouteName((string) $result['_route']);
            $methodPathArray = explode('::',$result['_controller']);
            $this->setClass($methodPathArray[0]);
            $this->setControllerMethod($methodPathArray[1]);

            // TODO remade!
            if(!empty($result[self::GUID_PARAMETER_NAME])){
                $this->setGuid($result[self::GUID_PARAMETER_NAME]);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function setClass(string $class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return string
     */
    public function getControllerMethod(): string
    {
        return $this->controllerMethod;
    }

    /**
     * @param string $controllerMethod
     * @return $this
     */
    public function setControllerMethod(string $controllerMethod)
    {
        $this->controllerMethod = $controllerMethod;
        return $this;
    }


    /**
     * @return string
     */
    public function getRouteName(): string
    {
        return $this->routeName;
    }

    /**
     * @param string $routeName
     * @return $this
     */
    public function setRouteName(string $routeName)
    {
        $this->routeName = $routeName;
        return $this;
    }

    /**
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->router;
    }

    /**
     * @return string
     */
    public function getGuid(): string
    {
        return $this->guid;
    }

    /**
     * @param string $guid
     * @return $this
     */
    public function setGuid(string $guid)
    {
        $this->guid = $guid;
        return $this;
    }

}