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
    const CHECK_ELEMENT_KEY = 'enTodo';

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
            var_dump($this->checkLists);
        echo "</pre>";

        // TODO logic for selecting checkList
        // create models for check List


        return $checkList;
    }

    /**
     * @param SimpleXmlIterator $sxi
     */
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

    /**
     * @param SimpleXmlIterator $sxi
     * @return bool
     */
    protected function checkExistKey(SimpleXmlIterator $sxi)
    {
        for($sxi->rewind(); $sxi->valid(); $sxi->next() ){
            if($sxi->key() == self::CHECK_ELEMENT_KEY){
                return true;
            }
        }
        return false;
    }

    /**
     * @param SimpleXmlIterator $sxi
     * @return $this
     */
    protected function addToList(SimpleXmlIterator $sxi)
    {
        if(!$this->isExistCurrentList()){
            $attr = [];
            $checkAttr = [];
            foreach($sxi->attributes() as $attrName => $attrValue) {
                $attr[(string) $attrName] = (string) $attrValue;
            }

            if($sxi->enTodo->attributes() instanceof SimpleXMLIterator){
                foreach($sxi->enTodo->attributes() as $attrCheckName => $attrCheckValue) {
                    $checkAttr[(string) $attrCheckName] = (string) $attrCheckValue;
                }
            }

            $element = [
                'attr' =>  $attr,
                'name' => $sxi->taskName->getName(),
                'checkedAttr' => $checkAttr
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
        $replacement = '</en-todo><taskName>${1}</taskName></div>';
        $content = preg_replace($pattern, $replacement, $content);
        $content = str_replace('en-todo','enTodo',$content);
        return $content;
    }

}