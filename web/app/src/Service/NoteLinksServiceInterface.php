<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 29/07/2018
 * Time: 03:13
 */

namespace Service;

use Model\Note\NoteLinksListInterface;


/**
 * Interface NoteLinksInterface
 * @package Service
 */
interface NoteLinksServiceInterface
{
    /**
     * @return NoteLinksListInterface|null
     */
    public function getNoteLinksList() : ?NoteLinksListInterface;

    /**
     * @return mixed
     */
    public function initNoteLinksList();
}