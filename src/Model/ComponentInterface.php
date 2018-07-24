<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 24/07/2018
 * Time: 15:18
 */

namespace Model;

/**
 * Interface ComponentInterface
 * @package Model
 */
interface ComponentInterface
{
    /**
     * @param ParentComponentInterface $parent
     */
    public function setParent(ParentComponentInterface $parent);

    /**
     * @return ParentComponentInterface|null
     */
    public function getParent(): ?ParentComponentInterface;

    /**
     * @param string $name
     * @return mixed
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getName(): string;
}