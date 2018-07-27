<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 26/07/2018
 * Time: 18:50
 */

namespace Service\Evernote;

use Evernote\Client;
use Model\Base\Request;
use Service\ParametersService;
use Symfony\Component\HttpFoundation\Session\Session;
use \Evernote\Auth\OauthHandler;
use Symfony\Component\Routing\Router;


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
     * @var Request
     */
    private $request;
    /**
     * @var boolean
     */
    private $sandbox;
    /**
     * @var boolean
     */
    private $china;
    /**
     * @var string
     */
    private $callback;
    /**
     * @var string
     */
    private $key;
    /**
     * @var string
     */
    private $secret;
    /**
     * @var OauthHandler
     */
    private $oauth_handler;

    /**
     * AuthService constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->parametersService = new ParametersService();
        $this->sessionService = new Session();
        $this->request = $request;
        $this->sandbox = true;
        $this->china = false;
        $this->oauth_handler = new OauthHandler($this->sandbox, false, $this->china);
        $this->callback = $this->request->getRouter()->generate('select_note_route',[],Router::ABSOLUTE_URL);
        $this->key = $this->parametersService->getParameterByName('app_key');
        $this->secret = $this->parametersService->getParameterByName('app_secret_key');

    }

    /**
     * @return bool
     */
    public function isEvernoteAuth(): bool
    {
        if (empty($this->sessionService->get(self::PARAM_MY_TOKEN_NAME))) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @return Client|null
     */
    public function getEvernoteClient(): ?Client
    {
        if (empty($this->sessionService->get(self::PARAM_MY_TOKEN_NAME))) {
            try {
                $this->client = $this->authorize();
            } catch (\Evernote\Exception\AuthorizationDeniedException $exception) {
                // TODO work with exception
            }
        } else {
            $this->client = new Client($this->sessionService->get(self::PARAM_MY_TOKEN_NAME));
        }

        return $this->client;
    }


    /**
     * @return Client|mixed
     * @throws \Evernote\Exception\AuthorizationDeniedException
     */
    protected function authorize()
    {

        $oauth_data = $this->oauth_handler->authorize($this->key, $this->secret, $this->callback);
        $this->sessionService->set(self::PARAM_MY_TOKEN_NAME,$oauth_data['oauth_token']);
        $client = new Client($this->sessionService->get(self::PARAM_MY_TOKEN_NAME));

        return $client;
    }

}