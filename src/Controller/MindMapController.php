<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 25/07/2018
 * Time: 17:06
 */

namespace Controller;

use Model\Base\Request;
use Model\Note\NoteLink;
use Service\Evernote\AuthService;
use Service\NoteLinksService;
use Service\ParametersService;

/**
 * Class MindMapController
 * @package Controller
 */
class MindMapController
{

    /**
     * @param Request $request
     */
    public function selectNoteAction(Request $request)
    {
        $token = (new ParametersService())->getParameterByName(AuthService::NAME_TOKEN_PARAMETER);
        $client = (new AuthService($request))->setEvernoteClientByToken($token)->getEvernoteClient();
        $noteLinkList = (new NoteLinksService($client))->initNoteLinksList()->getNoteLinksList();

        echo "<pre>";
        /** @var NoteLink $noteLink */
        foreach ($noteLinkList->getNoteLinks() as $index => $noteLink) {
                var_dump($noteLink->getUpdated());
            }
        echo "</pre>";
        // TODO send $noteLinkList to template

    }

    /**
     * @param Request $request
     */
    public function viewMindMapAction(Request $request)
    {
        var_dump('Hello!');
        die();
    }
}