<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 27/07/2018
 * Time: 01:19
 */

namespace Service\Evernote;


interface AuthInterface
{
    public function isEvernoteAuth();

    public function authorize();
}