<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 25/07/2018
 * Time: 17:13
 */

namespace Model\Note;


/**
 * Interface NoteInterface
 * @package Model\Note
 */
interface NoteInterface
{
    /**
     * @return mixed
     */
    public function getNoteContent();
}