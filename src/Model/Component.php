<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 24/07/2018
 * Time: 15:17
 */

namespace Model;


/**
 * Class Component
 * @package Model
 */
abstract class Component implements ComponentInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var ParentComponentInterface|null
     */
    protected $parent;

    /**
     * Component constructor.
     * @param $name
     * @param ParentComponentInterface|null $parent
     */
    public function __construct($name, ParentComponentInterface $parent = null)
    {
        $this->name = $name;
        $this->parent = $parent;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return ParentComponentInterface|null
     */
    public function getParent(): ?ParentComponentInterface
    {
        return $this->parent;
    }

    /**
     * @param ParentComponentInterface|null $parent
     * @return $this
     */
    public function setParent(?ParentComponentInterface $parent)
    {
        $this->parent = $parent;
        return $this;
    }
}