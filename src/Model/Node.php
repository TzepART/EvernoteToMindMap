<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 24/07/2018
 * Time: 15:17
 */

namespace App\Model;


/**
 * Class Node
 * @package App\Model
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
     * @param Node|null $parent
     */
    public function __construct($name, Node $parent = null)
    {
        $this->children = [];
        // Retrieve constructor of Component
        parent::__construct($name, $parent);
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


}