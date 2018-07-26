<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 26/07/2018
 * Time: 18:50
 */

namespace Service\Evernote;

use Evernote\Client;
use Service\ParametersService;
use Symfony\Component\HttpFoundation\Session\Session;
use \Evernote\Auth\OauthHandler;


/**
 * Class AuthService
 * @package Service\Evernote
 */
class AuthService implements AuthInterface
{
    const PARAM_MY_TOKEN_NAME = 'my_oauth_token';

    /**
     * @var ParametersService
     */
    private $parametersService;

    /**
     * @var Session
     */
    private $sessionService;


    /**
     * @var Client|null
     */
    private $client;

    /**
     * AuthService constructor.
     */
    public function __construct()
    {
        $this->parametersService = new ParametersService();
        $this->sessionService = new Session();
    }

    public function isEvernoteAuth() : bool
    {
        if(empty($_SESSION['my_oauth_token'])){
            return false;
        }else{
            return true;
        }
    }

    public function authorize()
    {
        $sandbox = true;
        $china   = false;
        $oauth_handler = new OauthHandler($sandbox, false, $china);
        $callback = 'http://localhost:8000/index.php';
        $key      = $this->parametersService->getParameterByName('app_key');
        $secret   = $this->parametersService->getParameterByName('app_secret_key');

        $oauth_data  = $oauth_handler->authorize($key, $secret, $callback);

        $this->client = new \Evernote\Client($oauth_data['oauth_token']);
        $_SESSION['my_oauth_token'] = $oauth_data['oauth_token'];
    }

    public function getEvernoteClient(): ?Client
    {
        return $this->client;
    }
}