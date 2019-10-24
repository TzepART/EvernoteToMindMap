<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 29/07/2018
 * Time: 03:39
 */

namespace Model\Note;


/**
 * Class NoteLinksList
 * @package Model\Note
 */
class NoteLinksList implements NoteLinksListInterface
{
    /**
     * @var array
     */
    private $noteLinks = [];

    /**
     * @param NoteLinkInterface $noteLink
     * @return $this
     */
    public function addNoteLink(NoteLinkInterface $noteLink)
    {
        $this->noteLinks[] = $noteLink;
        return $this;
    }

    /**
     * @param NoteLinkInterface $noteLink
     * @return $this
     */
    public function deleteNoteLink(NoteLinkInterface $noteLink)
    {
        // TODO: Implement deleteNoteLink() method.
        return $this;
    }

    /**
     * @return array
     */
    public function getNoteLinks(): array
    {
        return $this->noteLinks;
    }

}