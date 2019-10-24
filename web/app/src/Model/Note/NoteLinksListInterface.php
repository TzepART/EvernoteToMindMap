<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 29/07/2018
 * Time: 03:13
 */

namespace Model\Note;


/**
 * Interface NoteLinksListInterface
 * @package Model\Note
 */
interface NoteLinksListInterface
{
    /**
     * @param NoteLinkInterface $noteLink
     * @return mixed
     */
    public function addNoteLink(NoteLinkInterface $noteLink);

    /**
     * @param NoteLinkInterface $noteLink
     * @return mixed
     */
    public function deleteNoteLink(NoteLinkInterface $noteLink);

    /**
     * @return array
     */
    public function getNoteLinks(): array;
}