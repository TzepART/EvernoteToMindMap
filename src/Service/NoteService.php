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
        $content = $this->note->getContent();
        $xml = new \SimpleXMLElement($content);
        foreach ($xml->div as $index => $item) {
            var_dump((array) $item);
            isset($item['en-todo']) ? var_dump($item['en-todo']) : var_dump("NoN") ;
        }

        // TODO logic for selecting checkList
        // create models for check List

        return $checkList;
    }

}