<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 30/07/2018
 * Time: 19:09
 */

namespace Model\Note;

use \Evernote\Model\Note as BaseNote;


/**
 * Class Note
 * @package Model\Note
 */
class Note implements NoteInterface
{
    /**
     * @var string
     */
    private $content;
    /**
     * @var BaseNote
     */
    private $baseNote;

    /**
     * Note constructor.
     * @param BaseNote $baseNote
     */
    public function __construct(BaseNote $baseNote)
    {
        $this->baseNote = $baseNote;
        $this->setContent($this->baseNote->getContent());
    }

    /**
     * @return BaseNote
     */
    public function getBaseNote(): BaseNote
    {
        return $this->baseNote;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }


}