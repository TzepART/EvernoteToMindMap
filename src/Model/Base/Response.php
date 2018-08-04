<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 26/07/2018
 * Time: 02:00
 */

namespace Model\Base;


/**
 * Class Response
 * @package Model\Base
 */
class Response
{
    /**
     * @var Request
     */
    private $request;

    /**
     * Response constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        $controllerClass = 'Controller\\'.$this->request->getClass();
        $method = $this->request->getControllerMethod();

        $controller = new $controllerClass;

        // TODO remade!
        if(empty($this->request->getGuid())){
            return $controller->$method($this->request);
        }else{
            return $controller->$method($this->request,$this->request->getGuid());
        }
    }
}