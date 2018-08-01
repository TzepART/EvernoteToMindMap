<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 25/07/2018
 * Time: 17:08
 */

namespace Service;


use Model\Note\NoteInterface;
use \SimpleXmlIterator;

/**
 * Class NoteService
 * @package Service
 */
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
    public function generateMindMaps() : string
    {
        $checkList = '';
        $content = $this->note->getContent();
        $content = $this->updateContent($content);

        $xml = new SimpleXmlIterator($content);
        echo "<pre>";
            var_dump($this->sxiToArray($xml));
//            var_dump($xml);
//            var_dump(htmlspecialchars($content));
        echo "</pre>";

        // TODO logic for selecting checkList
        // create models for check List

        return $checkList;
    }

    /**
     * @param SimpleXmlIterator $sxi
     * @return array
     */
    protected function sxiToArray(SimpleXmlIterator $sxi){
        $a = array();
        for( $sxi->rewind(); $sxi->valid(); $sxi->next() ) {
            if(!array_key_exists($sxi->key(), $a)){
                $a[$sxi->key()] = [];
            }
            if($sxi->hasChildren()){
                $a[$sxi->key()][] = $this->sxiToArray($sxi->current());
            }
            else{
                $a[$sxi->key()][] = $sxi->current();
            }
        }
        return $a;
    }

    /**
     * It's need for correct using SimpleXmlIterator
     * @param $content
     * @return null|string|string[]
     */
    protected function updateContent($content)
    {
        $pattern = '/<\/en-todo>([^<]+)<\/div>/ui';
        $replacement = '</en-todo><task-title>${1}</task-title></div>';
        $content = preg_replace($pattern, $replacement, $content);
        return $content;
    }

}