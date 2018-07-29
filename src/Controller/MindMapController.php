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

        /**
         * The search string
         */
        $search = new \Evernote\Model\Search('');
        /**
         * The notebook to search in
         */
        $notebook = null;


        try{
                $results = $client->findNotesWithSearch($search);
        }catch (\Exception $exception){
            var_dump($exception->getMessage());
        }

        echo "<pre>";
        if(!empty($results)){
            foreach ($results as $result) {
                var_dump($result);

//                $noteGuid    = $result->guid;
//                $noteType    = $result->type;
//                $noteTitle   = $result->title;
//                $noteCreated = $result->created;
//                $noteUpdated = $result->updated;
            }
        }else{
            echo "Empty results";
        }
        echo "</pre>";


    }

    public function viewMindMapAction(Request $request)
    {
        var_dump('Hello!');
        die();
    }
}