<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 31/07/2018
 * Time: 00:31
 */

namespace Model\MindMap;


/**
 * Class ComponentFactory
 * @package Model\MindMap
 */
class ComponentFactory
{
    /**
     * @param string $name
     * @param bool $status
     * @param ParentComponentInterface|null $parent
     * @return ComponentInterface
     */
    public static function makeComponent(string $name, bool $status, ParentComponentInterface $parent = null)
    {
        // TODO logic for creating component
        return new Node($name,$status);
    }
}