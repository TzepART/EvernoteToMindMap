<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 29/07/2018
 * Time: 03:16
 */

namespace Model\Note;


/**
 * Interface NoteLinkInterface
 * @package Model\Note
 */
interface NoteLinkInterface
{
    /**
     * @return string
     */
    public function getGuid(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime;

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime;

    /**
     * @return int
     */
    public function getUpdateSequenceNum(): int;


}