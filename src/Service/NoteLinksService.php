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
use Model\Note\NoteLink;
use Model\Note\NoteLinksList;
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
        $searchResults = [];

        try{
            $searchResults = $this->client->findNotesWithSearch($search);
        }catch (\Exception $exception){
            var_dump($exception->getMessage());
        }

        $this->initNoteLinkListBySearchResults($searchResults);

        return $this;
    }


    /**
     * @return NoteLinksListInterface|null
     */
    public function getNoteLinksList(): ?NoteLinksListInterface
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

    /**
     * @param array $searchResults
     * @return $this
     */
    protected function initNoteLinkListBySearchResults(array $searchResults)
    {
        if (!empty($searchResults)) {
            $noteLinksList = new NoteLinksList();
            /** @var SearchResult $searchResult */
            foreach ($searchResults as $searchResult) {
                $noteLinksList->addNoteLink(new NoteLink($searchResult));
            }
            $this->setNoteLinksList($noteLinksList);
        }

        return $this;
    }
}