<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 24/07/2018
 * Time: 15:17
 */

namespace Model\MindMap;


/**
 * Class Node
 * @package Model
 */
class Node extends Component implements ParentComponentInterface
{
    /**
     * @var ComponentInterface[]
     */
    private $children;

    /**
     * CDirectory constructor.
     * @param $name
     * @param bool $status
     * @param Node|null $parent
     */
    public function __construct($name,$status, Node $parent = null)
    {
        $this->children = [];
        // Retrieve constructor of Component
        parent::__construct($name, $status, $parent);
    }

    /**
     * @return ComponentInterface[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param ComponentInterface[] $children
     * @return $this
     */
    public function setChildren(array $children)
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @param ComponentInterface $child
     * @return $this
     */
    public function addChild(ComponentInterface $child)
    {
        $child->setParent($this);
        $this->children[] = $child;
        return $this;
    }

    /**
     * @param int $level
     */
    public function showChildrenTree($level = 0)
    {
        echo str_repeat('...', $level) . $this->getName().'</br>';
        foreach ($this->getChildren() as $child) {
            if ($child instanceof ParentComponentInterface) {
                $child->showChildrenTree($level + 1);
            } else {
                echo str_repeat('...', $level + 1) . $child->getName().'</br>';
            }
        }
    }

}