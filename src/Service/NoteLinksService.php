<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 29/07/2018
 * Time: 03:26
 */

namespace Service;


use Evernote\Client;
use Evernote\Model\SearchResult;
use Model\Note\NoteLinksListInterface;
use \Evernote\Model\Search;

/**
 * Class NoteLinksService
 * @package Service
 */
class NoteLinksService implements NoteLinksServiceInterface
{
    const SEARCH_STRING = '';
    /**
     * @var Client
     */
    private $client;

    /**
     * @var NoteLinksListInterface
     */
    private $noteLinksList;

    /**
     * NoteLinksService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function initNoteLinksList()
    {
        /**
         * The search string
         */
        $search = new Search(self::SEARCH_STRING);


        try{
            $results = $this->client->findNotesWithSearch($search);
        }catch (\Exception $exception){
            var_dump($exception->getMessage());
        }

        if(!empty($results)){
            /** @var SearchResult $result */
            foreach ($results as $result) {
                var_dump($result);
//                $noteGuid    = $result->guid;
//                $noteType    = $result->type;
//                $noteTitle   = $result->title;
//                $noteCreated = $result->created;
//                $noteUpdated = $result->updated;
            }
        }
    }


    /**
     * @return NoteLinksListInterface
     */
    public function getNoteLinksList(): NoteLinksListInterface
    {
        return $this->noteLinksList;
    }

    /**
     * @param NoteLinksListInterface $noteLinksList
     * @return $this
     */
    public function setNoteLinksList(NoteLinksListInterface $noteLinksList)
    {
        $this->noteLinksList = $noteLinksList;
        return $this;
    }
}