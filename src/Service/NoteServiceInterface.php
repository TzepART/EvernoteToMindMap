<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 25/07/2018
 * Time: 17:08
 */

interface NoteServiceInterface
{
    /**
     * @return string
     */
    public function getCheckListFromNote() : string;
}