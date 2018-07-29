<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 27/07/2018
 * Time: 01:19
 */

namespace Service\Evernote;

use Evernote\Client;


/**
 * Interface AuthInterface
 * @package Service\Evernote
 */
interface AuthInterface
{
    /**
     * @return bool
     */
    public function isEvernoteAuth() : bool;


    /**
     * @return mixed
     */
    public function setEvernoteClient();

    /**
     * @return Client|null
     */
    public function getEvernoteClient(): ?Client;
}