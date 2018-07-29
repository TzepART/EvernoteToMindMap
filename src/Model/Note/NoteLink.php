<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 29/07/2018
 * Time: 03:32
 */

namespace Model\Note;


use Evernote\Model\SearchResult;

class NoteLink implements NoteLinkInterface
{
    /**
     * @var SearchResult
     */
    private $searchResult;

    /**
     * NoteLink constructor.
     * @param SearchResult $searchResult
     */
    public function __construct(SearchResult $searchResult)
    {
        $this->searchResult = $searchResult;
    }

    public function getGuid(): string
    {
        return $this->searchResult->guid;
    }

    public function getType(): string
    {
        return $this->searchResult->type;
    }

    public function getTitle(): string
    {
        return $this->searchResult->title;
    }

    public function getCreated(): \DateTime
    {
        return new \DateTime($this->searchResult->created);
    }

    public function getUpdated(): \DateTime
    {
        return new \DateTime($this->searchResult->updated);
    }


}