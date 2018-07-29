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
use Service\NoteLinksService;
use Service\ParametersService;

/**
 * Class MindMapController
 * @package Controller
 */
class MindMapController
{

    public function selectNoteAction(Request $request)
    {
        $token = (new ParametersService())->getParameterByName(AuthService::NAME_TOKEN_PARAMETER);
        $client = (new AuthService($request))->setEvernoteClientByToken($token)->getEvernoteClient();
        $noteLinkList = (new NoteLinksService($client))->initNoteLinksList()->getNoteLinksList();

        echo "<pre>";
            var_dump($noteLinkList->getNoteLinks());
        echo "</pre>";

    }

    public function viewMindMapAction(Request $request)
    {
        var_dump('Hello!');
        die();
    }
}