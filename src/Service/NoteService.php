<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 25/07/2018
 * Time: 17:08
 */

namespace Service;


use Model\Note\NoteInterface;

class NoteService implements NoteServiceInterface
{
    /**
     * @var NoteInterface
     */
    private $note;


    /**
     * NoteService constructor.
     * @param NoteInterface $note
     */
    public function __construct(NoteInterface $note)
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getCheckListFromNote() : string
    {
        $checkList = '';
        $content = $this->note->getNoteContent();

        // TODO logic for selecting checkList
        return $checkList;
    }

}