<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 25/07/2018
 * Time: 17:06
 */

namespace Controller;

use Model\Base\Request;
use Service\Evernote\AuthService;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class MindMapController
 * @package Controller
 */
class MindMapController
{

    public function selectNoteAction(Request $request)
    {
        var_dump((new Session())->get(AuthService::PARAM_MY_TOKEN_NAME));
        var_dump('Hello! selectNoteAction');
        die();
    }

    public function viewMindMapAction(Request $request)
    {
        var_dump('Hello!');
        die();
    }
}