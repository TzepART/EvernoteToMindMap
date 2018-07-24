<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 24/07/2018
 * Time: 15:17
 */

namespace App\Model;


class Task extends Component{

    /**
     * @var
     */
    private $type;

    /**
     * CFile constructor.
     * @param $name
     * @param $type
     * @param ParentComponentInterface|null $parent
     */
    public function __construct($name, $type, ParentComponentInterface $parent = null)
    {
        $this->type = $type;
        // Retrieve constructor of Component
        parent::__construct($name, $parent);
    }
    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @param $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

}