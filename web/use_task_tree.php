<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 24/07/2018
 * Time: 15:37
 */

function __autoload($classname) {
    $filename = __DIR__."/../src/". str_replace('\\','/',$classname) .".php";
    include_once($filename);
}

use Model\MindMap\Node;
use Model\MindMap\Task;

$root = new Node('root',true);
$node1 = new Node('node1', true, $root);
$node2 = new Node('node2', true, $root);
$node3 = new Node('node3', false, $root);
$node4 = new Node('node4',false, $node2);
$task1 = new Task('task1', false, $node1);
$task2 = new Task('doc', false, $node4);

$root->showChildrenTree(3);