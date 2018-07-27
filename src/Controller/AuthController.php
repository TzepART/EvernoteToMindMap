<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 27/07/2018
 * Time: 18:47
 */

namespace Controller;

use Model\Base\Request;
use Service\Evernote\AuthService;

class AuthController
{
    public function loginAction(Request $request)
    {
        $client = (new AuthService($request))->getEvernoteClient();
    }
}