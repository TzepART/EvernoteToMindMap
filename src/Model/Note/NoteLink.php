<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 29/07/2018
 * Time: 03:32
 */

namespace Model\Note;


use Evernote\Model\SearchResult;

/**
 * This class bridge for SearchResult
 * Class NoteLink
 * @package Model\Note
 */
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

    /**
     * @return string
     */
    public function getGuid(): string
    {
        return $this->searchResult->guid;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->searchResult->type;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->searchResult->title;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return new \DateTime($this->searchResult->created);
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return new \DateTime($this->searchResult->updated);
    }


}