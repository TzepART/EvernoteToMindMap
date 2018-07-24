<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 24/07/2018
 * Time: 15:18
 */

namespace App\Model;

interface ParentComponentInterface extends ComponentInterface
{
    /**
     * @return ComponentInterface[]
     */
    public function getChildren();

    /**
     * @param ComponentInterface[] $children
     */
    public function setChildren($children);

    /**
     * @param ComponentInterface $child
     */
    public function addChild(ComponentInterface $child);
}