<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 24/07/2018
 * Time: 15:17
 */

namespace Model\MindMap;


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
     * @var bool
     */
    protected $status = false;

    /**
     * @var ParentComponentInterface|null
     */
    protected $parent;

    /**
     * Component constructor.
     * @param string $name
     * @param bool $status
     * @param ParentComponentInterface|null $parent
     */
    public function __construct($name, $status, ParentComponentInterface $parent = null)
    {
        $this->name = $name;
        $this->parent = $parent;
        $this->status = (bool) $status;
        if ($this->parent instanceof ParentComponentInterface) {
            $this->parent->addChild($this);
        }
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
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function setStatus(bool $status)
    {
        $this->status = $status;
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