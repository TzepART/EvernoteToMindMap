<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 24/07/2018
 * Time: 15:18
 */

namespace Model;

/**
 * Interface ParentComponentInterface
 * @package Model
 */
interface ParentComponentInterface extends ComponentInterface
{
    /**
     * @return ComponentInterface[]
     */
    public function getChildren();

    /**
     * @param ComponentInterface[] $children
     */
    public function setChildren(array $children);

    /**
     * @param ComponentInterface $child
     */
    public function addChild(ComponentInterface $child);

    /**
     * @param int $level
     * @return mixed
     */
    public function showChildrenTree($level = 0);
}