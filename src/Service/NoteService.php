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
    const CHECK_ELEMENT_KEY = 'en-todo';

    /**
     * @var \SplDoublyLinkedList
     */
    private $checkLists;

    /**
     * @var NoteInterface
     */
    private $note;

    /**
     * @var bool
     */
    private $existCurrentList = false;


    /**
     * NoteService constructor.
     * @param NoteInterface $note
     */
    public function __construct(NoteInterface $note)
    {
        $this->note = $note;
        $this->checkLists = new \SplDoublyLinkedList();
    }

    /**
     * @return bool
     */
    public function isExistCurrentList(): bool
    {
        return $this->existCurrentList;
    }

    /**
     * @param bool $existCurrentList
     * @return $this
     */
    public function setExistCurrentList(bool $existCurrentList)
    {
        $this->existCurrentList = $existCurrentList;
        return $this;
    }

    /**
     * @return string
     */
    public function generateMindMaps() : string
    {
        $checkList = '';
        $content = $this->note->getContent();
        $content = $this->updateContent($content);

        $sxi = new SimpleXmlIterator($content);
        $this->noteXmlToListCheckLists($sxi);

        echo "<pre>";
//            var_dump($noteArray);
            var_dump($this->checkLists);
//            var_dump($sxi);
//            var_dump(htmlspecialchars($content));
        echo "</pre>";

        // TODO logic for selecting checkList
        // create models for check List

        return $checkList;
    }

    public function noteXmlToListCheckLists(SimpleXmlIterator $sxi)
    {
        for( $sxi->rewind(); $sxi->valid(); $sxi->next() ){
            if($sxi->hasChildren()){
                if($this->checkExistKey($sxi->current())){
                    $this->addToList($sxi->current());
                }else{
                    // existList to false
                    $this->setExistCurrentList(false);
                }
            }else{
                $this->setExistCurrentList(false);
            }
        }
    }

    protected function checkExistKey(SimpleXmlIterator $sxi)
    {
        for($sxi->rewind(); $sxi->valid(); $sxi->next() ){
            if($sxi->key() == self::CHECK_ELEMENT_KEY){
                return true;
            }
        }
        return false;
    }

    protected function addToList(SimpleXmlIterator $sxi)
    {
        if(!$this->isExistCurrentList()){
            $element = [
              'attr' =>  $sxi->attributes(),
            ];
            $this->checkLists->push($element);
        }else{

        }
        return $this;
    }


    /**
     * TODO create Doubly Linked List using SplDoublyLinkedList
     * @param SimpleXmlIterator $sxi
     * @return array
     */
    protected function xmlModelsToArray(SimpleXmlIterator $sxi){
        $a = [];
        for( $sxi->rewind(); $sxi->valid(); $sxi->next() ) {
            if(!array_key_exists($sxi->key(), $a)){
                $a[$sxi->key()] = [];
            }
            if($sxi->hasChildren()){
                $a[$sxi->key()][] = $this->xmlModelsToArray($sxi->current());
            }else{
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