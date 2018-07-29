<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 29/07/2018
 * Time: 03:13
 */

namespace Service;


/**
 * Interface NoteLinksInterface
 * @package Service
 */
interface NoteLinksInterface
{
    /**
     * @return array
     */
    public function getNoteLinksList() : array;
}