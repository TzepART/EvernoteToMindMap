<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 26/07/2018
 * Time: 18:52
 */

namespace Service;

use Symfony\Component\Yaml\Yaml;


/**
 * Class ParametersService
 * @package Service
 */
class ParametersService
{

    const PARAMETERS_NAME = 'parameters';
    /**
     * @var array
     */
    private $ymalParseArray;

    /**
     * AuthService constructor.
     */
    public function __construct()
    {
        $this->ymalParseArray = Yaml::parseFile(__DIR__.'/../../app/parameters.yml');
    }

    /**
     * @param string $parameterName
     * @return string|null
     */
    public function getParameterByName(string $parameterName)
    {
        if(isset($this->ymalParseArray[self::PARAMETERS_NAME][$parameterName])){
            return $this->ymalParseArray[self::PARAMETERS_NAME][$parameterName];
        }else{
            return null;
        }
    }


}