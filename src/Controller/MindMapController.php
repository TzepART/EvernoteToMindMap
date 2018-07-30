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
use Service\NoteService;
use Service\ParametersService;
use Evernote\Model\Note as BaseNote;
use \Model\Note\Note;

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
                echo "<a href='/app.php/mind-map/".$noteLink->getGuid()."/'>".$noteLink->getTitle()."<a><br>";
            }
        echo "</pre>";
        // TODO send $noteLinkList to template

    }

    /**
     * @param Request $request
     * @param string $guid
     */
    public function viewMindMapAction(Request $request, $guid)
    {
        $token = (new ParametersService())->getParameterByName(AuthService::NAME_TOKEN_PARAMETER);
        $client = (new AuthService($request))->setEvernoteClientByToken($token)->getEvernoteClient();

        /** @var BaseNote $evernoteNote */
        $evernoteNote = $client->getNote($guid);

        $noteService = new NoteService(new Note($evernoteNote));
        echo "<pre>";
            var_dump($noteService->getCheckListFromNote());
        echo "</pre>";
    }
}